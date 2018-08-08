<?php
/**
 * Created by PhpStorm.
 * User: Jne
 * Date: 2018/7/30
 * Time: 14:41
 * 管理采集的数据表
 */

namespace admin\controller;


use framework\core\Controller;
use framework\core\Factory;
use framework\tools\HttpRequest;

class QuestionController extends Controller{


    public function addAction(){
        $this->smarty->display('Question/add.html');
    }

    //接收采集的规则

    public function collectAction(){
        $url = $_POST['url'];

        $http = new HttpRequest();
        $http->url = $url;
        $result = $http->send();


        $reg = '/<a.+?href="\/q\/[0-9]{1,}\/">(.+?)<\/a>.+?<div.+?class="news_summary">(.+?)<\/div>/su';

        preg_match_all($reg,$result,$match);

        //问题的标题
        $title = $match[1];

        //问题的回复的内容
        $replys =  $match[2];

        $m_question = Factory::M('home\model\Question');
        $m_reply = Factory::M('Reply');

        foreach ($title as $k=>$v){
            $data['question_title'] = $v;
            $data['cat_id'] = 3;//分类的ID
            $data['user_id'] = 2;//用户的ID
            $data['pub_time'] = time();//小编审核时间
            //插入成功返回主键值
            $question_id = $m_question->insert($data);

            if($question_id){
                //保存该问题的对应的回复
                $dd['reply_content'] = $replys[$k];//因为是一一对应的它0就是问题的0
                $dd['user_id'] =2;
                $dd['reply_time'] = time();
                $dd['question_id'] = $question_id;
                $m_reply->insert($dd);

            }



        }

        $this->jump('index.php','采集成功');


    }

}
