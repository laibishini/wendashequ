<?php

namespace framework\core;
use framework\dao\DAOPDO;
/*
 * 基础模型类，各个模型类中的公共的代码
 */
class Model
{
    protected $dao;
    protected $true_table;
    protected $pk;
    public function __construct()
    {
       
        //初始化PDO
        $this->initDao();
        //初始化字段

        $this-> initTrueTable();

        //获得数据包字段

        $this->initFields();


    }


    public function initDao(){

        //链接数据库定义的是全局变量
        $option = $GLOBALS['config'];

        $this->dao = DAOPDO::getSingleton($option);
    }


    //初始化表名
    public  function initTrueTable(){

        if(isset($this->logic_table)){

            $this->true_table = '`'.$GLOBALS['config']['table_prefix'].$this->logic_table.'`';
            return;

        }

        //执行到这里说明没有logic_table我们手动添加上
        //如何获得当前实例化是那个模型类 比如MessageModel
        $className = get_class($this);//home\model\QuestionModel

        //通过basename()这个方法获得分隔符后面的内容
        $className = basename($className);

        //去掉Model
        $tableName = substr($className,0,-5);

        //特殊的情况出现 TopicQuestion -  topic_question

        //匹配正则替换它
        $reg = '/(?<=[a-z])(A-Z)/';
        $tableName = strtolower(preg_replace($reg,'_$1',$tableName));

        $this->true_table = '`'.$GLOBALS['config']['table_prefix'].$tableName.'`';





    }

    /*自动插入数据
    *参数：数组（字段名称=>字段值）
     *
     * $data = array('goods_name' => 'iphone7')
     *
     * 并且要返回刚刚插入的主键值
     *
     *



    */

    public  function  insert($data){

        //insert into 表名（字段） value (值，值)

        $sql = "INSERT INTO $this->true_table";

        ///$sql = "INSERT INTO `表名`(`goods_name`,`shop_price`) VALUES('iphone7',999)";

        //拼接字段部分获得下表

        $fields = array_keys($data);

        $fields_list = array_map(function ($v){

            return '`'.$v.'`';

        },$fields);

        $fields_list = '('.implode(',',$fields_list).')';

        $sql.= $fields_list;

        //然后拼接vlues 部分

        $fields_value = array_values($data);

        //安全处理转义并包裹

        $fields_value = array_map(array($this->dao,"quote"),$fields_value);


        //转义并包裹
        $fields_value = 'VALUES('.implode(',',$fields_value).')';

        $sql.= $fields_value;

        //执行sql语句

        $this->dao->exec($sql);

        return $this->dao->lastInsertId();

    }

    //
    public function initFields(){

        $sql = "DESC $this->true_table";

        $result = $this->dao->fetchAll($sql);

        foreach ($result as $k=>$v){

            if($v['Key'] == 'PRI'){

                $this->pk = $v['Field'];

            }


        }

    }

    public  function  delete($data){

        if(is_array($data)){

            //'goods_name' => 'iphone7'

            $fields = array_values($data);
            $fields2= array_keys($data);
            $fields = array_map(array($this->dao,'quote'),$fields);


            foreach ($fields2 as $k=>$v){

                $result = $v.'='.$fields[$k];

            }



            $sql = "DELETE FROM $this->true_table WHERE $result";


            $result = $this->dao->exec($sql);



            echo '是数组';
        }else{

            $sql = "DELETE FROM $this->true_table WHERE $this->pk = $data";





            return $this->dao->exec($sql);

        }



    }


/*自动更新操作
参数1 ： 更新的字段和值的关系 例如 ：array('goods_name' = '诺基亚')

参数2 : 必须要有where 条件 例如 array('goods_id'=>100)

最终 UPDATE 表名    SET `goods_name` = '诺基亚',`shop_price` = 999 WHERE `goods_id` = 1



*/

public  function update($data,$where=null){
    //先判断是否有条件
    if(!$where){
        //如果没有条件直接停止

        return false;
    }else{

        foreach ($where as $k=>$v){
            $where_str = "WHERE `$k` = '$v'";
        }
    }



    $sql = "UPDATE $this->true_table SET";

    //字段列表 array{0 => `good_name`,1=>`shop_price`}

    $fields = array_keys($data);

    $fields = array_map(function ($v){

        return '`'.$v.'`';
    },$fields);


    //字段的值 array(0 = > iphone7 , 1 => 999)

    $fields_values = array_values($data);

    $fields_values = array_map(array($this->dao,"quote"),$fields_values);



    $str = '';

    foreach ($fields as $k=>$v){

        $str .= $v. '='.$fields_values[$k].',';
    }

    //删除最后一个,

    $str = substr($str,0,-1);

    $sql .= $str.$where_str;

    return $this->dao->exec($sql);










}

//自动查询

//1、参数1 查询的字段列表 $data = array('good_name','shop_price')
//查询条件$where = array('goods_id' =>1) //如果传递有where条件我就返回一条数据 如果没有传递where条件我就返回所有数据
public  function  find($where=array(),$data=array()){




    //先判断是否是由字段的

    if(!$data){
        //没有我就查询所有的字段
        $fields = '*';
    }else{
        $fields = array_map(function ($v){

            return '`'.$v.'`';


        },$data);


        $fields = implode(',',$fields);


    }


    //确定查询条件

    if(!$where){
        //没有我就查询所有的

        $sql= "SELECT $fields FROM $this->true_table";

        return $this->dao->fetchAll($sql);


    }else{

        //如果有我就拼接一下 where id = 1 我们用循环
        foreach ($where as $k=>$v){
            $where_str = $k.'='.$v;
        }


        $sql = "SELECT $fields FROM $this->true_table WHERE $where_str";


        return  $this->dao->fetchAll($sql);

    }









}




}