# wendashequ
PHP问答项目第一个版本

1、mysql数据库

ask_category
ask_hot_topics
ask_message
ask_question
ask_quuestion_topic
ask_reply
ask_topic
ask_user
ask_user_topic


  /*递归查询所有分类信息
    1、参数1 查询的数组
    2、参数2 查询那个分类下面的子类，默认值是0 表示查询顶级分类下面的子类
    $p_id 它的父级id是什么
    */
    public  function getTreeCategory($cat_list,$p_id = 0,$level=0){
        static $arr = array();
        //遍历数组中的查询出来的数据
        foreach ($cat_list as $k=>$v){
            //谁的parent_id 是0 谁就是0 的子类
            if($v['parent_id'] == $p_id){
                //查询出来放到数组里面 就查询了第一层 在每个数组中的数据加一个数据
                $v['level'] = $level;
                $arr[] = $v;
                //再次查询所有分类下面的子类
                $this->getTreeCategory($cat_list,$v['cat_id'],++$level);
            }
        }
        return $arr;
    }
