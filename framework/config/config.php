<?php
//框架的配置文件
return array(
    //数据库的配置信息
    'host'              =>  '127.0.0.1',
    'user'              =>  'root',
    'pass'              =>  'root',
    'dbname'            =>  'ask',
    'port'              =>  3306,
    'charset'           =>  'utf8',
    'table_prefix'      =>  'ask_',
    
    //smarty的配置
    'left_delimiter'    =>  '<{',
    'right_delimiter'   =>  '}>',
    
    //默认的模块（前台、后台）
    'default_module'    =>  'home',
    //默认的控制器（IndexController）
    'default_controller'=>  'Index',
    //默认的方法（indexAction）
    'default_action'    =>  'indexAction',
    //邮件服务器的配置
    'email_host'        =>   'smtp.qq.com',      //邮件服务器主机地址
    'sender'            =>   '674698095@qq.com', //发送者的邮箱
    'nickname'          =>   '我是胡浩，我是网站管理员',           //昵称
    'account'           =>   '674698095',         //发送者邮箱账号
    'token'             =>   'lhsabbckesinbcia',      //授权码
    'accountSid'        =>    '8a216da864da60ef0164df754c390250',
    'accountToken'      =>     '5907772cbfa6443487dc286dc536b66c',
    'appId'             =>   '8a216da864da60ef0164df754c920256',
    'serverIP'          =>     'app.cloopen.com',
    'serverPort'        =>      '8883',
    'softVersion'       => '2013-12-26',
    'expire_time'       =>10,
    'tempId'            =>1

    
);