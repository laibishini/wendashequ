<?php
/**
 * Created by PhpStorm.
 * User: Jne
 * Date: 2018/7/23
 * Time: 23:06
 */

namespace home\model;


use framework\core\Model;

class UserModel extends Model{


    protected $logic_table = 'user';

    public function getHotUsers(){

        $sql = "SELECT count(q.question_id) as q_nums,u.username,u.user_pic FROM ask_user AS u LEFT JOIN ask_question AS q ON u.user_id = q.user_id GROUP BY q.user_id ORDER BY q_nums DESC LIMIT 3";
        return $this->dao->fetchAll($sql);
    }

    public function hasUserEmail($user,$email){
        $sql = "SELECT 1 FROM $this->true_table WHERE username='$user'OR email='$email'";

        return $this->dao->fetchColumn($sql);

    }

    public function checkByUserCode($user,$code){
        $sql = "SELECT * FROM $this->true_table WHERE username='$user' AND activate_code='$code'";


        return $this->dao->fetchRow($sql);
    }

    public function checkByUserPass($user,$pwd){
        $sql = "SELECT * FROM $this->true_table WHERE username='$user' AND password='$pwd'";
        return $this->dao->fetchRow($sql);
    }

    public function checkByUserPhone($username,$phone){
        $sql = "SELECT 1 FROM $this->true_table WHERE username='$username' OR phone='$phone'";
        return $this->dao->fetchColumn($sql);
    }




}