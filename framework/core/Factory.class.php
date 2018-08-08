<?php
namespace framework\core;
/*
 * 工厂类，功能是根据用户传递的模型类，返回单例的模型对象
 */
class Factory
{
    //定义公共的静态的方法
    //参数：模型类名
    public static function M($modelName)
    {

        //先判断模型中是不是有Model关键字 GoodsModel
        if(substr($modelName,-5) != 'Model'){
            $modelName .= 'Model';
        }

        //模型中是不是含有命名空间最后一次出现的位置
        if(!strchr($modelName,'\\')){
            //如果没有找到命名空间：admin\model\GoodModel
            $modelName = MODEL . '\model\\'.$modelName;


    }

        static $model_list = array();
        if(!isset($model_list[$modelName])){           
            $model_list[$modelName] = new $modelName;
        }
        return $model_list[$modelName];
    }


    //生成伪静态地址
    //Factory::U('admin/topic/add)  --> localhost/admin/topic/add.html;

    //参数1 传递MCA值
    //参数2 传递额外的参数可以没有比如array('id'=>3)

    public static function U($mca,$params=array()){

        //先获得项目的根目录，获得当前脚本的所在地址绝对地址
        $root = $_SERVER['SCRIPT_NAME']; //  /localhost/index.php

        //将index.php去掉
        $root = str_replace('index.php','',$root);

        //3、把mca拼接到根目录下面
        $root = $root.$mca;
        
        //4、在判断我们是不是额外传递了参数
        if(!empty($params)){
            //如果不为空就是传递了参数了
            foreach ($params as $k=>$v) {

                $root .= '/'.$k.'/'.$v;
                
            }

            $root.='.htm';
        }

        return $root;
    }
}


