<?php

namespace framework\core;
/*
 * 基础控制器类，用来封装控制器类的公共的方法
 */
class Controller
{
    protected $smarty;
    public function __construct()
    {
        $this->session();
        $this->initTimezone();
        $this->smarty = new \Smarty();
        $this->smarty -> left_delimiter = $GLOBALS['config']['left_delimiter'];
        $this->smarty -> right_delimiter = $GLOBALS['config']['right_delimiter'];
        $this->smarty -> setTemplateDir(APP_PATH.MODEL.'/view/');
        $this->smarty  -> setCompileDir(APP_PATH.MODEL.'/runtime/tpl_c');
    }

    public function session(){
        session_start();
    }
    //由于每个页面都需要跳转这个方法

    public  function jump ($url,$message,$delay=3){

        header("Refresh:$delay;url=$url");
        echo $message;
        die();

    }

    //设置时区问题方法
    public function initTimezone()
    {
        date_default_timezone_set('PRC');
    }


    //防跳墙验证
    public function isLogin(){
        //1、先判断是否是输入了正确的用户名和密码

        if(!isset($_SESSION['user'])){
            //没有登录成功
            //2、判断浏览器是不是保存了上次登录的信息
            if(!isset($_COOKIE['uname'])){
                //说明cookie中没有用户的信息
                $this->jump(Factory::U('home/user/login'),'非法访问，请登录');
            }else{
                //说明cookie中有用户的信息，还要查询用户信息是否修改了
                $m_user = Factory::M('User');
                $result = $m_user->checkByUserPass($_COOKIE['uname'],$_COOKIE['keysid']);
                if(!$result){
                    //说明修改所密码
                    $this->jump('?c=user&a=loginAction','密码已经过期，重新登录');
                }else{
                    //说明没有改过密码，为了前台后台首页统一使用用户信息
                    $_SESSION['user'] = $_COOKIE['uname'];
                }



            }





        }
    }



}