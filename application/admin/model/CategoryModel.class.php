<?php
/**
 * Created by PhpStorm.
 * User: Jne
 * Date: 2018/7/13
 * Time: 21:04
 */
namespace admin\model;

//分类模块 主要操作 ask_category分类表

use framework\core\Model;

class CategoryModel  extends Model {

    protected $logic_table = 'category';

    //保存错误信息
    private  $error = array();



    /*递归查询所有分类信息
    1、参数1 查询的数组
    2、参数2 查询那个分类下面的子类，默认值是0 表示查询顶级分类下面的子类
    $p_id 它的父级id是什么

    */

    public  function getTreeCategory($cat_list,$p_id = 0,$level=0){

        static $arr = array();
        //遍历数组中的查询出来的数据
        foreach ($cat_list as $k=>$v){
            //谁的parent_id 是0 谁就是0 的子类
            if($v['parent_id'] == $p_id){
                //查询出来放到数组里面 就查询了第一层 在每个数组中的数据加一个数据
                $v['level'] = $level;
                $arr[] = $v;
                //再次查询所有分类下面的子类

                $this->getTreeCategory($cat_list,$v['cat_id'],++$level);

            }
        }

        return $arr;

    }

    public function  isLeafCategory($cat_id){

        //我们不需要返回任何的值，只需要返回true false 所以我们查询字段也可以写1 查询包含所有parent_id = cat_id如果有就说明有子类不能删，没有就可以删除就是没有子类

        $sql = "SELECT 1 FROM $this->true_table WHERE parent_id = $cat_id";

        return $this->dao->fetchColumn($sql);
    }

    public function  checkData($data){

        //1、分类标题不能为空
        if($data['cat_name']==''){
            $this->error[] = '分类标题不能为空';
        }

        //2、分类标题不能为纯数字、数字开头 1234abcd 1234

        if((int)$data['cat_name'] != 0){
            $this->error[] = '分类标题不能为纯数字，或数字开头';
        }

        //3、分类标题分类描述不能超过8个字符
        if(mb_strlen($data['cat_name'] >= 8) || mb_strlen($data['cat_desc']) >= 8){
            $this->error[] = '分类标题和描述太长了，不能超过8个字符';
        }

        //4、一个分类下面不能创建相同的子类
        if($this->hasCategory($data['cat_name'],$data['parent_id'])){
            $this->error[] = '一山不容二虎该分类已经存在';
        }

        if(empty($this->error)){
            return true;
        }else{
            return false;
        }

    }


    //查询一个分类下面是否存在某个子类
    //参数1 ：添加分类标题
    //参数2 父级分类ID查询分类下面是否参数1子类
    public  function hasCategory($cat_name,$p_id){

        $sql = "SELECT 1 FROM $this->true_table WHERE cat_name ='$cat_name' AND parent_id = $p_id";

        return $this->dao->fetchColumn($sql);

    }


    //遍历错误信息然后返回数组
    public  function showError(){
        if(!empty($this->error)){

            $err_str ='';

            foreach ($this->error as $v){
                $err_str .=$v.'<br>';
            }

            return $err_str;
        }
    }




}


