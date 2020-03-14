<?php

namespace app\modules\general\sysmng\controllers;

use app\common\data\Pagination;
use YII;
use app\common\base\BaseController;
use app\modules\general\sysmng\models\ar\SysHuikuanList;
use app\modules\general\member\models\ar\UserGroup;

/**
 * Index controller for the `sysmng` module
 */
class AccountController extends BaseController
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
    	// 总记录条数
        $this->layout=false;
    	$sumrs=SysHuikuanList::countSyshklist();
    	$pagination = new Pagination(['totalCount' => $sumrs['count'],'pageSize'=>50]);
    	$rs=SysHuikuanList::findSyshklist($pagination->offset,$pagination->limit);
    	$data=['rs'=>$rs,'pagination'=>$pagination];
    	return $this->render('index',$data);
    }
    
    public function actionDetail($id)
    {
        $this->layout=false;
		$rs=SysHuikuanList::find()->where(['id'=>$id])->asArray()->one();
        $hasGroup = explode('|', $rs['group_set']);
		$group = UserGroup::find()->groupBy(array('group_id'))->asArray()->all();
    	$data=['rs'=>$rs,'group'=>$group,'hasGroup'=>$hasGroup];
    	return $this->render('detail',$data);
    }
    
    public function actionUpd()
    {
        $code = $this->getParam('code','');
        $id = $this->getParam('id','');
        $data=['code'=>1,'msg'=>'更新失败'];
        if($code==1){
            $rs=SysHuikuanList::find()->where(['id'=>$id])->one();
            $bank_status = $rs['bank_status'];
            if($bank_status == 0) $status =1;
            if($bank_status == 1) $status =0;
            $rs->bank_status = $status;
            $rs->save();
            $data=['code'=>0];
            return json_encode($data);
        }
    	@$postarr = YII::$app->getRequest()->post();
    	$id=$postarr["id"];
    	
    	$bank_name = $postarr["bankname"];
    	$bank_number = $postarr["banknum"];
    	$bank_xm = $postarr["bankxm"];
        $bank_city = $postarr["bankcity"];
		$bank_type = $postarr["bank_type"];
		$group_set = $postarr["group_set"];
		$img_url = $postarr["img_url"];
		$img_urls = str_replace( 'https://', 'http://', $img_url );
		$img_chk = 'Y';
		if (!empty($img_urls)){
			
			$a = @getimagesize($img_urls);

			$image_type = @$a[2];
			if(!in_array($image_type, array(IMAGETYPE_GIF, IMAGETYPE_JPEG,IMAGETYPE_PNG, IMAGETYPE_BMP))){
				$img_chk = 'N';
			}

	  }
		$flag = false;
		if( $img_chk =='Y' ){
		$account=SysHuikuanList::findOne(['id'=>$id]);
		$account->bank_name = $bank_name;
		$account->bank_number = $bank_number;
		$account->bank_xm = $bank_xm;
        $account->bank_city = $bank_city;
		$account->bank_type = $bank_type;
		$account->group_set = $group_set;
		$account->img_url = $img_url;
		$flag=$account->save();
		}

		if($flag==true){
			$data=['code'=>0];
		} else if ( $img_chk == 'N') {
			$data=['code'=>1,'msg'=>'请勿使用非图片格式档案！！'];
		}

		return json_encode($data);
    }
    
    public function actionDel($id)
    {
    	// 删除已有客户记录
    	$rs = SysHuikuanList::findOne($id);
    	$num=$rs->delete();
    	if($num>0){
    		$data=['code'=>0];
    	}else{
    		$data=['code'=>1,'msg'=>'删除失败'];
    	}
    	return json_encode($data);
    }
    
    public function actionAdd()
    {
        $this->layout=false;
    	@$postarr = YII::$app->getRequest()->post();
    	
    	if(empty($postarr)){
			$group = UserGroup::find()->groupBy(array('group_id'))->asArray()->all();
    		return $this->render('addhk',['group'=>$group]);
    	}else{
	    	$bank_name = $postarr["bankname"];
	    	$bank_number = $postarr["banknum"];
	    	$bank_xm = $postarr["bankxm"];
	    	$bank_city = $postarr["bankcity"];
			$bank_type = $postarr["bank_type"];
			$group_set = $postarr["group_set"];
			$img_url = $postarr["img_url"];
			$img_chk = 'Y';
			if (!empty($img_url)){
			
				$a = @getimagesize($img_url);
   
				$image_type = @$a[2];
				if(!in_array($image_type, array(IMAGETYPE_GIF, IMAGETYPE_JPEG,IMAGETYPE_PNG, IMAGETYPE_BMP))){
					$img_chk = 'N';
				}
  
		  }

			$flag = false;
			if( $img_chk =='Y' ){
				$account=new SysHuikuanList();
				$account->bank_name = $bank_name;
				$account->bank_number = $bank_number;
				$account->bank_xm = $bank_xm;
				$account->bank_city = $bank_city;
				$account->bank_type = $bank_type;
				$account->group_set = $group_set;
				$account->img_url = $img_url;
				$flag=$account->save();
			}

			if($flag==true){
				$data=['code'=>0,'msg'=>'新增成功'];
			} else if ( $img_chk == 'N') {
				$data=['code'=>1,'msg'=>'请勿使用非图片格式档案！！'];
			} else{
				$data=['code'=>1,'msg'=>'哪里出错了！！'];
			}

	    	return json_encode($data);
    	}

    	
    }
}
