<?php
/**
 * Created by PhpStorm.
 * User: Jne
 * Date: 2018/7/25
 * Time: 22:31
 */

namespace home\controller;

use framework\core\Controller;
use framework\core\Factory;
use framework\tools\Captcha;
use framework\tools\Email;
use framework\tools\Message;
use framework\tools\Verify;

class UserController extends Controller{



    //显示用户注册的表单
    public function registerAction(){

        $this->smarty->display('user/register.html');
    }

    //2、接受表单的数据并把用户保存到数据
    public function doRegisterAction(){


       //验证是不是同意了协议
        if(isset($_POST['agreement_chk'])){
            //说明同意了协议
            //2、验证码是不是正确的要和post 和session中的代码进行比较
            session_start();
            if(strtolower($_SESSION['code']) == strtolower($_POST['seccode_verify'])){
                //验证码正确了
                //这步就是验证用户、密码、邮箱是不是符合规则
                $verify = new Verify();
                $result1 = $verify->checkUser($_POST['user_name']);
                $result2 = $verify->checkPass($_POST['password']);
                $result3 = $verify->checkEmail($_POST['email']);

                if($result1 && $result2 && $result3){
                    //说明符合规则
                    //还要验证用户名、邮箱是不是已经注册
                    $m_user = Factory::M('User');
                    $result = $m_user->hasUserEmail($_POST['user_name'],$_POST['email']);
                    if($result){
                        //查询到了说明用户已经注册
                        $this->jump('?m=home&c=user&a=registerAction','用户名，邮箱已经注册');
                    }else{
                        //说明没有注册保存到数据库，发送邮件
                        $data['username'] = $_POST['user_name'];
                        $data['password'] = md5($_POST['password']);
                        $data['email'] = $_POST['email'];
                        $data['is_active'] = 0;//未激活
                        $data['reg_time'] = time();//注册时间
                        $data['activate_code'] = md5(mt_rand(1000,9999).time());//唯一激活码

                        $result = $m_user->insert($data);

                        if($result){
                            //注册成功
                            //发送邮件
                            $title = '注册成功，请激活';
                            //激活邮件的内容
                            $content = <<<HTML
                        <a href="http://localhost/index.php?m=home&c=user&a=activateAction&code={$data['activate_code']}&user={$data['username']}">赶紧来激活吧！</a>    
                            

HTML;
                            $res = Email::send($title,$content,$data['email']);
                            ///如果它是错误的话是个字符串错误信息，所有用三个等号比对
                            if($res === true){
                                //注册成功
                                $this->jump('?m=home&c=user&a=loginAction','注册成功，激活邮件已经发送，请即时激活');
                            }else{
                                $this->jump('?m=home&c=user&a=registerAction','注册失败,请重试');
                            }

                            
                        }else{
                            //注册失败
                            $this->jump('?m=home&c=user&a=registerAction','注册失败,请重试');
                        }


                    }

                }else{
                    //不符合规则
                    $this->jump('?m=home&c=user&a=registerAction',$verify->showError());
                }

            }else{
                //验证码错误
                $this->jump('?m=home&c=user&a=registerAction','验证码错误');
            }
        }else{
            //没有同意协议
            $this->jump('?m=home&c=user&a=registerAction','请先同意协议');
        }
    }

    //激活邮件
    public function activateAction(){
        //接收传递过来的用户名、激活码
        $user = $_GET['user'];
        $code = $_GET['code'];

        //1、先去数据库查询是不是给用户发送过这个激活码
        $m_user = Factory::M('User');
        $result = $m_user->checkByUserCode($user,$code);
        //如果查询到有发过验证码，有这个账号
        if($result){

            //查询到了，看验证是不是已经过期了
            if(time() - $result['reg_time'] > 24*3600){
                $this->jump('?m=home&c=user&a=registerAction','激活链接，已经过期');

            }else{
                //3、没有过期，验证是不是已经激活了
                if($result['is_active'] == 1){
                    $this->jump('?m=home&c=user&a=loginAction','已经激活请直接登录');
                }else{
                    //说明没有激活，在这里激活，is_active更新为1
                    $data['is_active'] = 1;
                    $where = array('user_id'=>$result['user_id']);
                    $res = $m_user->update($data,$where);
                    if($res){
                        $this->jump('?m=home&c=user&a=loginAction','激活成功，请登录');
                    }else{
                        $this->jump('?m=home&c=user&a=registerAction','激活，失败，请重试');
                    }
                }
            }

        }else{
            //没有查询到
            $this->jump('?m=home&c=user&a=registerAction','请重新发送激活邮件');
        }
    }

    //显示登录
    public function  loginAction(){
        $this->smarty->display('user/login.html');
    }

    //登录验证操作
    public  function doLoginAction(){

        //先验证用户名，和密码是不是正确
        $user = $_POST['user_name'];
        $pwd = md5($_POST['password']);

        $m_user = Factory::M('User');
        $result = $m_user->checkByUserPass($user,$pwd);
        if($result){
            //说明用户名密码正确
            //验证是不是已经激活 //笔记本那个没有activate_code这个字段
            if($result['is_active'] == 1){
                //说明已经激活，判断是不是记住我
                if(isset($_POST['net_auto_login'])){
                    //说明记住我了，记住之后用cookie保存
                    setcookie('uname',$result['username'],time()+7*24*3600);
                    setcookie('keysid',$result['password'],time()+7*24*3600);


                }
                //说明没有记住我，也可以直接登录,保存session数据用户名
//                session_start();
//                $_SESSION['user'] = $result['username'];
                //使用用户名密码登陆
                $_SESSION['user'] = $result;

                $this->jump('/','登录成功！');

            }else{
                //没有激活
                $this->jump(Factory::U('home/user/loginAction'),'请先激活，在登录！');
            }

        }else{
            //用户名密码不正确
            $this->jump(Factory::U('home/user/loginAction'),'用户名密码错误');
        }

    }


    //3生成验证码
    public function makeCaptchaAction(){
        $captcha = new Captcha();
        $captcha->font_file = FONT_PATH.'STHUPO.TTF';
        //生成验证码图片
        $captcha->makeImage();
    }

    //退出登录
    public function  logoutAction(){

        unset($_SESSION['user']);
        setcookie('uname','',time()-1);
        setcookie('keysid','',time()-1);
        $this->jump(Factory::U('home/user/loginAction'),'退出成功');

    }

    //显示短信发送提交页面
    public function msmAction(){
        $this->smarty->display('user/msm_register.html');


    }

    //显示接收注册短语验证，邮箱验证
    public function sendMessageAction(){

        //接收表单提交的数据


        if(!isset($_POST['agreement_chk'])){

            //说明没有同意协议
            $this->jump('?c=user&a=msmAction','请先同意协议');

        }else{

            //图片验证是不是正确

            if(strtolower($_SESSION['code'])==strtolower($_POST['seccode_verify'])){
                //说明验证正确
                //验证手机号码是不是符合规则
                $very = new Verify();
                $result =  $very->checkPhone($_POST['phone']);

                if($result){

                    //如果正确就发送短信验证码
                    $message = new Message();
                    $code = mt_rand(1000,9999);//随机的手机验证码
                    ///验证码有效期你自己可以配置
                    $expire = $GLOBALS['config']['expire_time'];

                    $tempId = $GLOBALS['config']['tempId'];
                    $datas = array($code,$expire);

                    $message->sendTemplateSMS($_POST['phone'],$datas,$tempId);

                    //把发送的验证码写入到数据库
                    $m_model = Factory::M('Message');
                    $data['phone'] = $_POST['phone'];
                    $data['code'] = $code;
                    $data['send_time'] = time();

                    $result = $m_model->insert($data);
                    if($result){
                        //跳转到输入验证码页面
                        $this->jump('?c=user&a=MsgRegisterAction','发送成功短信验证码');
                    }





                }else{
                    //手机号码不正确
                    $this->jump('?c=user&a=msmAction','手机号码没有写对');
                }



            }else{
                //图片验证码错误
                $this->jump('?c=user&a=msmAction','请输入正确的验证码');
            }

        }





    }

    //显示输入短信验证码页面

    public function MsgRegisterAction(){




        $this->smarty->display('user/do_register.html');
    }

    public function doSubmitAction(){

        if(isset($_POST['agreement_chk'])){
            //同意 图像验证码正确验证

            if(strtolower($_SESSION['code']) == strtolower($_POST['seccode_verify'])){
                //验证码正确
                //用户名和密码手机号是不是符合规则
                $verify = new Verify();
                $result1 = $verify->checkUser($_POST['user_name']);
                $result2 = $verify->checkPass($_POST['password']);
                $result3 = $verify->checkPhone($_POST['msm']);//手机号码

                if($result1 && $result2 && $result3){
                    //都符合规则
                    //用户名和手机号码是不是已经注册
                    $m_user = Factory::M('User');
                    $res = $m_user->checkByUserPhone($_POST['user_name'],$_POST['msm']);
                    if($res){
                        //说明已经注册
                        $this->jump('?m=home&c=user&a=MsgRegisterAction','用户名,手机已经注册');

                    }else{
                        //说明没有注册
                        //短信验证码是不是已经过期 接收表单提交的 -  数据表保存发送的时间-》配置文件定义有效期
                        $m_model = Factory::M('Message');

                        $send_time = $m_model->checkByPhoneCode($_POST['msm'],$_POST['msm_code']);

                        $num = time() - $send_time ;



                      if($num > $GLOBALS['config']['expire_time']*60){
                          //说明已经过期
                          $this->jump('?m=home&c=user&a=MsgRegisterAction','验证码已经过期');
                      }else{
                          //未过期
                          $data['username'] = $_POST['user_name'];
                          $data['password'] = md5($_POST['password']);
                          $data['phone'] = $_POST['msm'];
                          //手机注册直接让他激活
                          $data['is_active'] = 1;

                          $result4 = $m_user->insert($data);

                          if($result4){
                              $this->jump('?c=user&a=loginAction','注册成功，请登陆');
                          }else{
                              $this->jump('?m=home&c=user&a=MsgRegisterAction','注册失败');
                          }

                      }



                    }



                }else{
                    //不符合规则
                    $this->jump('?m=home&c=user&a=MsgRegisterAction',$verify->showError());
                }

            }else{
                //验证码不正确
                $this->jump('?m=home&c=user&a=MsgRegisterAction','验证码不正确');
            }
        }

    }

}