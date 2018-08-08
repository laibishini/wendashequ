<?php
/**
 * Created by PhpStorm.
 * User: Jne
 * Date: 2018/7/21
 * Time: 23:49
 */

namespace home\model;
use framework\core\model;

  //话题模型类负责话题数据的增删改查

class TopicModel extends Model{
        //查询热门话题
    protected $logic_table = 'topic';

    public function getHotTopics(){

        $sql = "DROP VIEW IF EXISTS `ask_hot_topics`;CREATE VIEW ask_hot_topics AS SELECT  t.topic_id,t.topic_title,t.topic_pic,count(qt.question_id) AS q_nums FROM ask_topic AS t LEFT JOIN ask_question_topic AS qt ON
 t.topic_id = qt.topic_id GROUP BY qt.topic_id";

        $this->dao->exec($sql);


    $sql = "SELECT h.*,count(ut.user_id) as user_nums FROM ask_hot_topics AS h LEFT JOIN ask_user_topic AS ut ON h.topic_id = ut.topic_id GROUP BY ut.topic_id ORDER BY h.q_nums DESC LIMIT 3";

        return $this->dao->fetchAll($sql);



    }

}
