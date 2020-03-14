<?php
namespace app\modules\six\models;

use yii\db\ActiveRecord;

/**
 * 用户组表
 * UserGroup is the model behind the user_group.
 */
class UserGroup extends ActiveRecord {
    /**
     * 获取用户的会员组信息,通过用户会员组ID
     * @param type $groupid  用户会员组ID
     */
    static public function getUserGroupByUserId($groupid){
        $usergroup = UserGroup::find()
                ->where('group_id=:group_id',[':group_id'=>$groupid])
                ->asArray()
                ->one();
        return $usergroup;
    }
    /**
     * 获取用户的数据信息
     * @param type $user_id 用户ID
     * @return type
     */
    static public function getLimitAndFsMoney($user_id){
//        $sql = "select g.*,u.user_name,u.logintime from user_group g,user_list u   where u.user_id='".$user_id."' and g.group_id=u.group_id limit 0,1";
//        $row = UserGroup::findBySql($sql)
//                ->one();
        $row = UserGroup::find()
            ->select('g.*,u.user_name,u.logintime')
            ->from('user_group g')
            ->innerJoin('user_list u','g.group_id=u.group_id')
            ->where('u.user_id=:user_id',[':user_id'=>$user_id])
            ->limit(1)
            ->asArray()
            ->one();
        return $row;
        
    }
}