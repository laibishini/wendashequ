<?php
/*
 * 分类控制器类，主要负责分类管理这个功能模块
 */
namespace  home\controller;

use framework\core\Controller;
use framework\core\Factory;
use framework\tools\Page;

class indexController extends Controller{

    public function  indexAction(){

        $this->isLogin();
        //使用后台模型来查询数据库因为前台也需要查询分类数据

        $model = Factory::M('admin\model\Category');
        //只查顶级分类

        $where = array('parent_id' => 0);
       $cat_list=  $model->find($where);



        //分配到模版



        //查询问题列表
        $q_model = Factory::M('Question');



        // 分页查询
        $page = new Page();

        // 设置总记录数到模型

        $page->total_pages = $q_model -> countQuestions();



        $page->pagesize =6;
        $page->now_page = isset($_GET['page'])?$_GET['page']:1;

        //因为在framework/里面走了第三步是多余的参数页数所以下面写一个假的跳转地址
        $page->url = Factory::U('home/index/index');
        $offset = ($page->now_page - 1) * $page->pagesize;
        $limit = $page->pagesize;



        // 分类查询也分装到模型中
        $questions = $q_model->getAllQuestion($offset,$limit);





        $page_bar = $page->create();

        //查询热门话题列表
        $m_topic = Factory::M('Topic');
        $hot_topics = $m_topic->getHotTopics();

        // 查询热门用户
        $m_user = Factory::M('User');
        $hot_users = $m_user -> getHotUsers();





        $this->smarty->assign('hot_users',$hot_users);


        $this->smarty->assign('pagebar',$page_bar);
        $this->smarty->assign('hot_topics',$hot_topics);
        $this->smarty->assign('cat_list',$cat_list);
        $this->smarty->assign('questions',$questions);





        $this->smarty->display('index.html');


    }
}