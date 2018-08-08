<?php
/**
 * Created by PhpStorm.
 * User: Jne
 * Date: 2018/7/13
 * Time: 20:55
 */

namespace admin\controller;


//话题模块 主要负责 后台添加话题、删除话题、修改话题、查询话题等等。

use framework\core\Controller;
use framework\core\Factory;
use framework\tools\Thumb;
use framework\tools\Upload;

class TopicController extends Controller {


    //1、显示话题列表
    public function indexAction(){

        //先查询话题列表，然后在分配到index.html
        $model = Factory::M('Topic');
        $topic_list = $model->find();



        //分配数据表
        $this->smarty->assign('topics',$topic_list);
        $this->smarty->display('topic/index.html');
    }
    //2、显示添加内容的表单
    public function addAction(){
        $this->smarty->display('topic/add.html');
    }
    //3、提交表单并接收数据入库
    public function addHandleAction(){
        //1、先上传话题缩略图
        $upload = new Upload();
        $upload -> upload_path = UPLOADS_PATH .'topic/';
        //返回上传文件的路径
        $upload_file = $upload->doUpload($_FILES['topic_thumb']);

        //保存压缩图片上传完成要压缩
        $thumb = new Thumb(UPLOADS_PATH.'topic/'.$upload_file);

        $thumb->thumb_path = THUMB_PATH.'topic/';
        $topic_file = $thumb->makeThumb(50,50);

        //2 把缩略图的地址、话题标题、话题的描述保存到数据库
        $data['topic_title'] = $_POST['topic_title'];
        $data['topic_desc'] = $_POST['topic_desc'];
        $data['topic_pic'] = 'topic/'.$topic_file;
        $data['user_id']=1;//由于没有用户的登陆，我们所以暂时要写死
        $data['pub_time'] = time();//发布时间

        //3 实例化模型对象
        $model = Factory::M('Topic');
        $result = $model->insert($data);

        if($result){
            $this->jump('?m=admin&c=topic&a=indexAction','添加成功');

        }else{
            $this->jump('?m=admin&c=topic&a=addAction','添加失败');

        }





    }
    //4、显示编辑内容的表单页面
    public function editAction(){

        //1、先接收话题的ID
        $topic_id = $_GET['id'];
        $model = Factory::M('Topic');

        //查询的调价
        $where = array('topic_id'=>$topic_id);

        $result = $model->find($where);


        //根据ID查询出来以后然后分配数据
        $this->smarty->assign('topic',$result[0]);




        $this->smarty->display('topic/edit.html');

    }
    //5、提交表单并更新数据
    public function updateAction(){

        //判断是不是上传了新的图形
        if($_FILES['topic_pic']['error'] ==0){
            //说明上传了新的
            $upload = new Upload();
            $upload->upload_path = UPLOADS_PATH.'topic/';
            $upload_file = $upload->doUpload($_FILES['topic_pic']);

            //压缩
            $thumb = new Thumb(UPLOADS_PATH.'topic/'.$upload_file);
            $thumb->thumb_path = THUMB_PATH.'topic/';
            //设置缩略图
            $thumb_file = $thumb->makeThumb(50,50);

            //删除就的图像
            $old_topic_pic = $_POST['old_topic_pic'];
            $origin = str_replace('thumb_','',$old_topic_pic);

            unlink(UPLOADS_PATH.$origin);
            unlink(THUMB_PATH.$old_topic_pic);

            //更新topci_pic字段
            $data['topic_pic'] = 'topic/'.$thumb_file;





        }
            //执行到这里，说明没有上传
        $data['topic_title'] = $_POST['topic_title'];
        $data['topic_desc'] = $_POST['topic_desc'];
        $data['pub_time'] = time();

        $where = array('topic_id'=>$_POST['topic_id']);

        //实例化模型对象
        $model = Factory::M('Topic');
        $result =$model->update($data,$where);

        if($result){
            $this->jump('?m=admin&c=topic&a=indexAction','更新成功');

        }else{
            $this->jump('?m=admin&c=topic&a=editAction&id='.$_POST['topic_id'],'更新失败');

        }







    }

    //6、删除操作

    public function deleteAction(){

        $id = $_GET['id'];
        $data = ['topic_pic'];
        $where = ['topic_id' =>$id];
        //实例化模型对象

        $model = Factory::M('Topic');
        $result = $model->find($where,$data);

        $topic_pic = $result[0]['topic_pic'];

        //根据缩略图找到原图
        $origin = str_replace('thumb_','',$topic_pic);
        unlink(UPLOADS_PATH.$origin);
        unlink(THUMB_PATH.$topic_pic);

        //再删除数据表中的数据
        $result = $model->delete($id);


        if($result){
            $this->jump('?m=admin&c=topic&a=indexAction','删除成功');

        }else{
            $this->jump('?m=admin&c=topic&a=indexAction','删除失败');

        }







    }
}