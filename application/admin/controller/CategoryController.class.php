<?php
/**
 * Created by PhpStorm.
 * User: Jne
 * Date: 2018/7/13
 * Time: 20:51
 */

namespace admin\controller;
use framework\core\Controller;
use framework\core\Factory;
use framework\tools\Thumb;
use framework\tools\Upload;

//分类模型主要操作 ask_category分类表

class CategoryController extends Controller {

    //显示问题列表
    public function  indexAction(){

        //先查询分类的信息
        $model = Factory::M('Category');
        //先查询出所有的字段
        $cat_list = $model->find();
        $cat_list = $model->getTreeCategory($cat_list);




        //分配到表单
        $this->smarty->assign('cat_list',$cat_list);


        $this->smarty->display("category/index.html");
    }
    //显示添加内容的表单
    public function  addAction(){

        //先查询分类的信息
        $model = Factory::M('Category');
        $cat_list = $model -> find();
        $cat_list = $model -> getTreeCategory($cat_list);


        //分配到表单中
        $this->smarty->assign('cat_list',$cat_list);
        $this->smarty->display('category/add.html');
    }
    //提交表单并接收表单的数据
    public function addHandleAction(){

        //先判断提交的数据是不是合法
        $model = Factory::M('Category');
        //如果它不是true 就没有验证通过
        if(!$model->checkData($_POST)){
            $this->jump('?m=admin&c=category&a=addAction',$model->showError());
        }



        //导入上传类、和图像压缩

        $upload = new Upload();
        //1、设置上传的路径
        $upload->upload_path = UPLOADS_PATH.'category/';
        $upload_file = $upload->doUpload($_FILES['cat_logo']);

        //2、图像压缩把上传的图像地址放进去
        $thumb = new Thumb(UPLOADS_PATH.'category/'.$upload_file);

        //设置缩略图的路径
        $thumb->thumb_path = THUMB_PATH.'/category/';
        //设置它的缩略图
        $thumb_path = $thumb->makeThumb(50,50);


        //把缩略图的地址和其他的表单项目一起保存到category分类数据表中
        $data['cat_name'] = $_POST['cat_name'];
        $data['cat_desc'] = $_POST['cat_desc'];
        //缩略图的路径
        $data['cat_logo'] = $thumb_path;
        $data['parent_id'] = $_POST['parent_id'];

        // 实例化模型对象，保存到数据表



        $result = $model->insert($data);

        if($result){
            //添加成功，跳转到列表页面
            $this->jump('?m=admin&c=category&a=indexAction','添加成功');
        }else{
            $this->jump('?m=admin&c=category&a=addAction','添加失败');
        }







    }
    //显示编辑表单
    public function editAction(){
        $model = Factory::M('Category');
        //先接受修改分类的序号
        $cat_id = $_GET['id'];
        //查询出数据
        $where = array('cat_id' => $cat_id);
        $result = $model->find($where);


        //然后在查询所有的分类信息
        $model = Factory::M('Category');
        $cat_list = $model->find();
        $cat_list = $model->getTreeCategory($cat_list);

        //这是ID传过来查询的数组
        $this->smarty->assign('cat',$result[0]);
        $this->smarty->assign('cat_list',$cat_list);

        $this->smarty->display('category/edit.html');


    }
    //接受提交表单并更新
    public function updateAction(){

         $data['cat_name'] = $_POST['cat_name'];
         $data['cat_desc'] = $_POST['cat_desc'];
         $data['parent_id'] = $_POST['parent_id'];

         /*先判断是不是上传了新的图标，如果上传了新的，就删除旧的，使用新的
            如果没有上传新的图标就不更新 cat_logo这个字段
         */




        if($_FILES['cat_logo']['error'] == 0) {
            //说明上传了新的分类图标 先上传图标 返回图标地址库将地址入库
            $upload = new Upload();
            $upload->upload_path = UPLOADS_PATH.'category/';
            $upload_file = $upload->doUpload($_FILES['cat_logo']);

            $thumb = new Thumb(UPLOADS_PATH.'category/'.$upload_file);
            $thumb -> thumb_path = THUMB_PATH.'category/';
            $thumb_file = $thumb -> makeThumb(50, 50);

            //如果上传了新的图标我们就把旧的删除
            unlink(THUMB_PATH.'category/'.$_POST['old_cat_logo']);

            //通过缩略图找到原图

            $origin = str_replace('thumb_','',$_POST['old_cat_logo']);
            unlink(UPLOADS_PATH.'category/'.$origin);
            $data['cat_logo'] =  $thumb_file;

        }

        //到这里说明没有上传新的图标，就不用更新cat_logo这个字段
        $model = Factory::M('category');

        $where = array('cat_id'=>$_POST['cat_id']);
        $result = $model->update($data,$where);

        if($result){
            $this->jump('?m=admin&c=category&a=indexAction','更新成功');
        }else{
            $this->jump('?m=admin&c=category&a=editAction&id='.$_POST['cat_id'],'更新失败');
        }


    }
    //删除操作
    public function  deleteAction(){

        $cat_id = $_GET['id'];
        //只能删除叶子分类，没有子类的分类
        $model = Factory::M('Category');
        $result = $model->isLeafCategory($cat_id);

        if($result){
            $this->jump('?m=admin&c=category&a=indexAction','下面还有小弟不能删除！');

        }

        //如果没有就删除
        $where = array('cat_id'=>$cat_id);
        $data = array('cat_logo');

        $result = $model->find($where,$data);

        $cat_logo = $result[0]['cat_logo'];
        unlink(THUMB_PATH.'category/'.$cat_logo);
        //删除原图的地址
        $orgin = str_replace('thumb_','',$cat_logo);

        unlink(UPLOADS_PATH.'category/'.$orgin);

        //在删除原来数据库的记录
        $result = $model->delete($cat_id);
        if($result){
            $this->jump('?m=admin&c=category&a=indexAction','删除成功');
        }else{
            $this->jump('?m=admin&c=category&a=indexAction','删除失败');
        }
    }






}