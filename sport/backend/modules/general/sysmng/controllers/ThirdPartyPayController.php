<?php

namespace app\modules\general\sysmng\controllers;

use app\common\helpers\LogUtils;
use YII;
use app\common\base\BaseController;
use app\modules\general\thirdpay\models\ThirdPaySet;
use app\modules\general\member\models\ar\UserGroup;

use yii\base\Exception;
use yii\data\Pagination;
/**
 * Index controller for the `sysmng` module
 */
class ThirdPartyPayController extends BaseController
{
	/**
	 * 初始化处理方法
	 */
	public function init() {
		// parent::init();
	
		$this->getView()->title = '代收支付账户管理';
		//$this->layout = false;
	}
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $this->layout=false;
        $rs=ThirdPaySet::find()->orderBy(['id'=>SORT_ASC])->asArray()->all();
    	return $this->render('index',['data'=>$rs]);
    }
    public function actionUpd($id)
    {
        try{
            $ThirdPaySet=ThirdPaySet::findone($id);
            if($ThirdPaySet->b_start==1){
                $ThirdPaySet->b_start=0;
            }else{
                $ThirdPaySet->b_start=1;
            }
            $flag=$ThirdPaySet->save();
            return $this->out(true, '更新成功');
        }catch (Exception $e) {
            LogUtils::error($e->getMessage());
            return $this->out(false, '更新失败');
        }
    }
    
    public function actionDel($id)
    {
        try{
            $ThirdPaySet=ThirdPaySet::findone($id);
            $affectrow=$ThirdPaySet->delete();
            return $this->out(true, '删除成功');
        }catch (Exception $e){
            LogUtils::error($e->getMessage());
            return $this->out(false, '删除失败');
        }
    }
    
    public function actionEdit($id)
    {
        $this->layout=false;
        $rs=ThirdPaySet::find()->where(['id'=>$id])->asArray()->one();
        // var_dump($rs); exit;
    	return $this->render('edit',['data'=>$rs]);
    }
    
    public function actionUpdedit()
    {
        $data=['code'=>'1','msg'=>'编辑更新失败'];
        $postarr = Yii::$app->getRequest()->post();
        $ThirdPaySet=ThirdPaySet::findone($postarr['id']);

        $ThirdPaySet->platform_name = $postarr['platform_name'];
        $ThirdPaySet->pay_type = $postarr['pay_type'];

        $ThirdPaySet->pay_domain = $postarr["pay_domain"];
        $ThirdPaySet->merchant_id = $postarr["merchant_id"];
        $ThirdPaySet->merchant_username = $postarr["merchant_username"];
        $ThirdPaySet->pay_key = $postarr["pay_key"];
        $ThirdPaySet->public_key = $postarr["public_key"];
        $ThirdPaySet->pay_secret = $postarr["pay_secret"];

        if($ThirdPaySet->save()){
            $data=['code'=>'0','msg'=>'编辑更新成功'];
        }
        return json_encode($data);
    }
    
    public function actionSave()
    {
        try{
            $postarr = Yii::$app->getRequest()->post();
            $ThirdPaySet=new ThirdPaySet();

            $ThirdPaySet->platform_name = $postarr['platform_name'];
            $ThirdPaySet->pay_type = $postarr['pay_type'];

            $ThirdPaySet->pay_domain = $postarr["pay_domain"];
            $ThirdPaySet->merchant_id = $postarr["merchant_id"];
            $ThirdPaySet->merchant_username = $postarr["merchant_username"];
            $ThirdPaySet->pay_key = $postarr["pay_key"];
            $ThirdPaySet->public_key = $postarr["public_key"];
            $ThirdPaySet->pay_secret = $postarr["pay_secret"];

            $ThirdPaySet->save();
            return $this->out(true, '添加成功');
        }catch (Exception $e) {
            LogUtils::error($e->getMessage());
            return $this->out(false, "添加失败");
        }
    }

}
