<?php
class user_basic {
    /*
     * 构造函数
     */
    function __construct() {

    }

    /*
     * getTotalInfo方法
     * 获取所有用户的所有信息（联查user_info表，带分页）
     * @author C860
     * @param $perpage int 每页显示条数
     * @param $curpage int 当前页码
     * @return array
     */
    static function getTotalInfo($perpage,$curpage) {
        global $db;
        try {
            $query = $db->prepare('select count(*) from user_basic as A,user_info as B where A.ID=B.user_id');
            $query->execute();
            $count = $query->fetch()[0];
            //获取页面总数
            $pagecount = ceil($count/$perpage);
            if($curpage>$pagecount) {
                $curpage = $pagecount;
            }
            else if($curpage<1) {
                $curpage = 1;
            }
            //获取当前页起始位置
            $pos = ($curpage-1)*$perpage;
            $query = $db->prepare('select * from user_basic as A,user_info as B where A.ID=B.user_id limit ?,?');
            $query->execute(array($pos,$pos+$perpage));
            $rs = $query->fetchAll();
            return $rs;
        } catch(PDOException $e) {
            echo $e;
        }
    }

    /*
     * setIsAdmin方法
     * 设置isAdmin字段（反转）
     * @author C860
     * @param $user_id int 用户ID
     * @return boolean
     */
    static function setIsAdmin($user_id) {
        global $db;
        $query = $db->prepare('update user_basic set isAdmin=isAdmin^1 where ID=?');
        if($query->execute(array($user_id))!=false) {
            return true;
        }
        else {
            return false;
        }
    }
}
