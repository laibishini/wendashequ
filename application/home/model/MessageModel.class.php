<?php
/**
 * Created by PhpStorm.
 * User: Jne
 * Date: 2018/7/21
 * Time: 17:30
 */

namespace home\model;

use framework\core\Model;

class MessageModel extends Model{

    //表的名字
//    protected $logic_table = 'message';

    public function checkByPhoneCode($phone,$code){

        $sql = "SELECT send_time FROM $this->true_table WHERE phone='$phone' AND code='$code'";
        return $this->dao->fetchColumn($sql);

    }
}