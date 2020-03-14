<?php

namespace app\modules\general\sysmng\controllers;

use app\common\helpers\LogUtils;
use YII;
use app\common\base\BaseController;
use app\modules\general\sysmng\models\ar\PaySet;
use app\modules\general\member\models\ar\UserGroup;

use yii\base\Exception;
use yii\data\Pagination;
/**
 * Index controller for the `sysmng` module
 */
class PayController extends BaseController
{
	/**
	 * 初始化处理方法
	 */
	public function init() {
		parent::init();
	
		$this->getView()->title = '汇款账户管理';
		//$this->layout = false;
	}
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $this->layout=false;
        $rs=PaySet::find()->orderBy(['order_id'=>SORT_ASC])->asArray()->all();
        $group = UserGroup::find()->groupBy(array('group_id'))->asArray()->all();
    	return $this->render('index',['data'=>$rs,'group'=>$group]);
    }
    public function actionUpd($id)
    {
        try{
            $payset=PaySet::findone($id);
            if($payset->b_start==1){
                $payset->b_start=0;
            }else{
                $payset->b_start=1;
            }
            $flag=$payset->save();
            return $this->out(true, '更新成功');
        }catch (Exception $e) {
            LogUtils::error($e->getMessage());
            return $this->out(false, '更新失败');
        }
    }
    
    public function actionDel($id)
    {
        try{
            $payset=PaySet::findone($id);
            $affectrow=$payset->delete();
            return $this->out(true, '删除成功');
        }catch (Exception $e){
            LogUtils::error($e->getMessage());
            return $this->out(false, '删除失败');
        }
    }
    
    public function actionClear($id)
    {
        try{
            $payset=PaySet::findone($id);
            $payset->money_Already=0;
            $payset->save();
            return $this->out(true, '清除成功');
        }catch (Exception $e) {
            LogUtils::error($e->getMessage());
            return $this->out(false, '清除失败');
        }
    }
    
    public function actionEdit($id)
    {
        $this->layout=false;
        $rs=PaySet::find()->where(['id'=>$id])->asArray()->one();
        $hasGroup = explode('|', $rs['group_set']);
        $group = UserGroup::find()->groupBy(array('group_id'))->asArray()->all();
        //var_dump($group); exit;
    	return $this->render('edit',['data'=>$rs, 'group'=> $group, 'hasGroup'=>$hasGroup]);
    }
    
    public function actionUpdedit()
    {
        $data=['code'=>'1','msg'=>'编辑更新失败'];
        $postarr = Yii::$app->getRequest()->post();
        $payset=PaySet::findone($postarr['id']);
        $payset->order_id = $postarr['order_id'];
        $payset->platform_name = $postarr['platform_name'];
        $payset->pay_type = $postarr['pay_type'];
        $payset->submit_type = $postarr['submit_type'];
        $payset->pay_domain = $postarr["pay_domain"];
        $payset->merchant_id = $postarr["merchant_id"];
        $payset->merchant_userNO = $postarr["merchant_userNO"];
        $payset->merchant_username = $postarr["merchant_username"];
        $payset->money_limits = $postarr["money_limits"];
        $payset->money_Lowest = $postarr["money_Lowest"];
        $payset->pay_key = $postarr["pay_key"];
        $payset->public_key = $postarr["public_key"];
        $payset->first_code = $postarr["first_code"];
        $payset->f_url = $postarr["f_url"];
        $payset->group_set = '|'.implode('|',$postarr["group_set"]).'|';
        if($payset->save()){
            $data=['code'=>'0','msg'=>'编辑更新成功'];
        }
        return json_encode($data);
    }
    
    public function actionSave()
    {
        try{
            $postarr = Yii::$app->getRequest()->post();
            $payset=new PaySet();
            $payset->order_id = $postarr['order_id'];
            $payset->platform_name = $postarr['platform_name'];
            $payset->pay_type = $postarr['pay_type'];
            $payset->submit_type = $postarr['submit_type'];
            $payset->pay_domain = $postarr["pay_domain"];
            $payset->merchant_id = $postarr["merchant_id"];
            $payset->merchant_userNO = $postarr["merchant_userNO"];
            $payset->merchant_username = $postarr["merchant_username"];
            $payset->money_limits = $postarr["money_limits"];
            $payset->money_Lowest = $postarr["money_Lowest"];
            $payset->pay_key = $postarr["pay_key"];
            $payset->public_key = $postarr["public_key"];
            $payset->first_code = $postarr["first_code"];
            $payset->f_url = $postarr["f_url"];
            $payset->group_set = '|'.implode('|',$postarr["group_set"]).'|';
            $payset->save();
            return $this->out(true, '添加成功');
        }catch (Exception $e) {
            LogUtils::error($e->getMessage());
            return $this->out(false, "添加失败");
        }
    }

}
