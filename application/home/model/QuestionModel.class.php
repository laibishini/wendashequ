<?php
/**
 * Created by PhpStorm.
 * User: Jne
 * Date: 2018/7/21
 * Time: 17:30
 */

namespace home\model;

use framework\core\Model;

class QuestionModel extends Model{

    //表的名字
//    protected $logic_table = 'question';

    public function getAllQuestion($offset,$limit){

        $sql = "SELECT 
 q.*,c.cat_name,u.username,u.user_pic FROM ask_question AS q LEFT JOIN ask_category AS C ON q.cat_id = c.cat_id LEFT JOIN ask_user AS u ON q.user_id = u.user_id ORDER BY q.pub_time DESC LIMIT $offset,$limit";

        return $this->dao->fetchAll($sql);

    }

    public function countQuestions(){
        $sql = "SELECT count(*) AS total FROM $this->true_table";
        return $this->dao->fetchColumn($sql);
    }

    public function getDetails($question_id){





        $sql = "SELECT q.*,c.cat_name,u.username,u.user_pic FROM ask_question AS q LEFT JOIN ask_category AS c ON q.cat_id=c.cat_id LEFT JOIN ask_user AS u ON q.user_id=u.user_id WHERE q.question_id=$question_id";

        $question = $this->dao->fetchRow($sql);



        $sql = "SELECT r.*,u.username,u.user_pic FROM ask_reply AS r LEFT JOIN ask_user AS u ON r.user_id=u.user_id WHERE r.question_id=$question_id";

        //这里是查询回复的问题多少要查询出所有的来

        $reply = $this->dao->fetchAll($sql);

        $data['question'] = $question;
        $data['replys'] = $reply;




        return $data;



    }





}