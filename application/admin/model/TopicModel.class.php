<?php
/**
 * Created by PhpStorm.
 * User: Jne
 * Date: 2018/7/13
 * Time: 20:55
 */

namespace admin\model;


//话题模块 主要负责 后台添加话题、删除话题、修改话题、查询话题等等。



use framework\core\Model;

class TopicModel extends Model {

    protected $logic_table = 'topic';

}