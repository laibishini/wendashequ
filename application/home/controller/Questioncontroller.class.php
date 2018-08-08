<?php
/**
 * Created by PhpStorm.
 * User: Jne
 * Date: 2018/7/21
 * Time: 16:55
 *问题控制器，主要负责问题功能模块
 *
 */

namespace home\controller;

use framework\core\Controller;
use framework\core\Factory;

class QuestionController extends Controller{




    // 显示发起问题的表单

    public function addAction(){

        //先查询分类的信息
        $c_model = Factory::M('admin\model\Category');
        $cat_list = $c_model->find();

        $cat_list = $c_model->getTreeCategory($cat_list);

        //查询话题列表
        $t_model = Factory::M('admin\model\Topic');
        $topics = $t_model->find();

        //分配到发起问题的表单中
        $this->smarty->assign('cat_list',$cat_list);

        $this->smarty->assign('topics',$topics);


        $this->smarty->display('question/add.html');
    }

    public function addHandleAction(){
        $this->initTimezone();
        //1、手机表单中的数据

        $data['question_title'] = $_POST['question_title'];//问题标题
        $data['cat_id'] = $_POST['cat_id'];//问题标题
        $data['question_desc'] = $_POST['question_desc'];//问题描述
        $data['user_id'] = 1;//暂时写写死因为还没有账号
        $data['pub_time'] = time();//发布时间

        //问题和话题之间怎么关联呢？我们先保存问题信息

        $model = Factory::M('Question');

        //返回刚刚插入问题的序号，然后在和问题和话题进行关联
        $q_id  = $model->insert($data);


        //写入问题提和话题这张关联表中

        $qt_model = Factory::M('QuestionTopic');

        if(isset($_POST['topic_id'])){
            foreach ($_POST['topic_id'] as $v) {
                $dd['question_id'] = $q_id;
                $dd['topic_id'] = $v;
                $qt_model->insert($dd);

            }
        }

        //问题保存之后我们就返回它的ID
        if($q_id){
            //说明插入数据问题成功返回了它的ID号


            $result = $model->getDetails($q_id);





            //分配给视图
            $this->smarty->assign('question',$result['question']);
            $this->smarty->assign('replys',$result['replys']);
            $this->smarty->assign('reply_nums',count($result['replys']));

            //将返回的数据smarty解析完成之后我们在保存到缓存区存起来
            $result = $this->smarty->fetch('question/detail.html');



            //定义静态文件的根目录
            $basic_path = './application/public/html/';
            //定义时间目录
            $sub_path = date('Ymd').'/';

            if(!is_dir($basic_path.$sub_path)){
                //如果你不存在这个目录我们就创建它
                mkdir($basic_path.$sub_path,0777,true);
            }
            //定义文件链接后缀地址
            $file = 'detail_'.$q_id.'html';

            $res = file_put_contents($basic_path.$sub_path.$file,$result);



            if($res){

                //写入成功把新的文件链接地址写入到数据库//20180730/detail_30html
                $data['static_url'] = $sub_path.$file;
                $where['question_id'] = $q_id;
                $res1 = $model->update($data,$where);

                if($res1){
                    $this->jump('/','发布成功');
                }else{
                    $this->jump(Factory::U('home/question/add'),'静态地址，写入失败');
                }

            }else{
                $this->jump(Factory::U('home/question/add'),'添加失败，请重试');
            }




        }




    }

    //显示问题的详情

    public function detailAction(){

        $this->initTimezone();

        $question_id = $_GET['id'];

       $q_model = Factory::M('Question');

       $result = $q_model->getDetails($question_id);


       //分配给视图
        $this->smarty->assign('question',$result['question']);
        $this->smarty->assign('replys',$result['replys']);
        $this->smarty->assign('reply_nums',count($result['replys']));


        $this->smarty->display('question/detail.html');
    }

    public function replyAction(){
        //组装回复的数据
        $data['reply_content'] = $_POST['answer_content'];
        $data['user_id'] =$_SESSION['user']['user_id'];
        $data['reply_time'] = time();
        $data['question_id'] = $_POST['question_id'];

        //把收集到的表单数据然后写入到回复表中
        $r_model = Factory::M('admin\model\Reply');

        //写入到数据库中
        $r_id = $r_model->insert($data);

        //写入成功之后我们要查询最新的问题详情，然后来生成新的静态文件，然后跳转到该详情页面。
        if($r_id){
            //回复成功并写入到了回复数据表中
            $q_model = Factory::M('Question');
            $result = $q_model->getDetails($_POST['question_id']);

            $this->smarty->assign('question',$result['question']);
            $this->smarty->assign('replys',$result['replys']);
            $this->smarty->assign('reply_nums',count($result['replys']));

            //将返回的数据smarty解析完成之后我们在保存到缓存区存起来
            $result = $this->smarty->fetch('question/detail.html');

            //回复写入表以后然后我们再查问题表返回问题的ID查找到这个问题以后把地址更新了回复然后写入到了问题中我们要查询是那个问题然后把链接找出来

            $data = array('static_url');
            $where = array('question_id'=>$_POST['question_id']);
            $static_url = $q_model->find($where,$data);

            $filename = './application/public/html/'.$static_url[0]['static_url'];

            //然后我们把返回的地址保存到静态文件中，默认是写入内容

            $res = file_put_contents($filename,$result);
            if($res){
                $this->jump('/application/public/html/'.$static_url[0]['static_url'],'回复成功');
            }else{
                $this->jump('','回复失败');
            }


        }


    }


}
