<?php

namespace app\modules\general\sysmng\controllers;
use app\modules\general\sysmng\models\ThemeSetting;
use app\common\base\BaseController;


/**
 * Index controller for the sysmng module
 */
class BannerController extends BaseController
{
 public function init() { //建構子
  parent::init();
  $this->layout = false; //後台必備 將layout移除
 }

    public function actionIndex() { //手機輪播圖首頁
        $this->layout=false;
        
        $banner_type = $this->getParam('type');
            if($banner_type=="手機輪播圖"){
                $result = ThemeSetting::getBannerID('1');
            }elseif($banner_type=="優惠活動"){
                 $result = ThemeSetting::getBannerID('2');  
            }

        return $this->render('index', ['banner' => $result ,'banner_type' => $banner_type ]);
    }

    public function actionNewinformation() { //手機輪播圖新增

		$title = $this->getParam('title','');
        $sub_title = $this->getParam('sub_title','');
        $sort = $this->getParam('sort',0);
        $img_url = $this->getParam('img_url','');
        $content = $this->getParam('content','');
        $type = $this->getParam('type','');
  
       
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
        $themesetting=new ThemeSetting();
        $themesetting->title = $title;
        $themesetting->sub_title = $sub_title;
        $themesetting->sort = $sort;
        $themesetting->content = $content;
        $themesetting->img_url = $img_url;
        $themesetting->type = $type;

        if($themesetting->save()){
			return $this->out(true , '新增成功');
		}
		else{
			return $this->out(false , '新增失败');
        }
    }
    if($flag==true){
        $data=['code'=>0];
    } else if ( $img_chk == 'N') {
        $data=['code'=>1,'msg'=>'请勿使用非图片格式档案！！'];
    }
    return json_encode($data);    
    }

	public function actionUpdateBanner() {	//手機輪播圖修改
		$title = $this->getParam('title','');
        $sub_title = $this->getParam('sub_title','');
        $sort = $this->getParam('sort',0);
        $img_url = $this->getParam('img_url','');
        $content = $this->getParam('content','');
        $type = $this->getParam('type','');
        $id = $this->getParam('id',-1000);

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
		$themesetting = ThemeSetting::findOne(array('id'=>$id));
        if($themesetting){
            $themesetting->title = $title;
            $themesetting->sub_title = $sub_title;
            $themesetting->sort = $sort;
            $themesetting->content = $content;
            $themesetting->img_url = $img_url;
            $themesetting->type = $type;
			if($themesetting->save()){
				return $this->out(true , '修改成功');
			}
			else{
				return $this->out(false , '修改失败');
			}
        }

    }
        if($flag==true){
            $data=['code'=>0];
        } else if ( $img_chk == 'N') {
            $data=['code'=>1,'msg'=>'请勿使用非图片格式档案！！'];
        }
        return json_encode($data);    
    }

	public function actionDeleteBanner() {	//手機輪播圖刪除
		$id = $this->getParam('id',-1000);
		$theme_setting = ThemeSetting::findOne(array('id'=>$id));
        if($theme_setting){
			if($theme_setting->delete()){
				return $this->out(true , '删除成功');
			}
			else{
				return $this->out(false , '删除失败');
			}
        }
	}
    
}
