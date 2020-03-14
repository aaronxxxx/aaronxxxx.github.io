<?php

namespace app\modules\general\member\models;

use Yii;
use yii\db\ActiveRecord;
use app\common\data\Pagination;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "lottery_build_add".
 */

class LotteryBuildAdd extends ActiveRecord
{
    public static function tableName()
    {
        return 'lottery_build_add';
    }

    public static function get_lotterybuildadd_list($arr=NULL)
    {
        $condition=array(//初始化参数
			'user_group'=>0,	// 用户所属的分组
			'type'=>'user_name',// 搜索类型值得 （用户名，ip等）
			'key'=>'',			// 搜索关键词
			'cpage'=>1,			// 当前第几个分页
			'online'=>'',		// 用户是否在线
	    	'status'=>'',		// 账户是否异常或禁用
	    	'havepay'=>'',		// 判断用户是否曾经充值过
        );
        if(is_array($arr)){//填充条件
            $condition=array_merge($condition,$arr);
        }
        $lba_list=LotteryBuildAdd::find()
        ->select("*")
        ->from("lottery_build_add lba")
        ->leftJoin("user_list u","lba.user_id=u.user_id")
        ->leftJoin("user_group b","u.group_id=b.group_id");

        if(!empty($condition['user_group'])){
			$lba_list=$lba_list->andwhere(['u.group_id'=>$condition['user_group']]);
		}
		if(!empty($condition['key'])){
			$lba_list=$lba_list->andWhere(['like','u.'.$condition['type'],$condition['key']]);
		}
		if(!empty($condition['online'])){
			$lba_list=$lba_list->andWhere(['or',['u.online'=>1],['!=','u.Oid',null]]);
		}
		if(!empty($condition['status'])){
			$lba_list=$lba_list->andWhere(['u.status'=>$condition['status']]);
		}

		if(!empty($condition['overage'])){
			$lba_list->orderBy(['money'=>SORT_DESC]);
		}else{
			$lba_list->orderBy(['regtime'=>SORT_DESC]);
		}

        $count=$lba_list->count();  // 统计总记录数
        $pagination = new Pagination(['totalCount' => $count,'pagesize'=>50]);//分页：总数,每页条数
        $users=$lba_list
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->asArray()
            ->all();
        return ['users'=>$users,'pagination'=>$pagination];
        
    }
}
