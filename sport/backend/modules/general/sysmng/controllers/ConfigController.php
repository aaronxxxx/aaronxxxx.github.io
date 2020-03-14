<?php

namespace app\modules\general\sysmng\controllers;

use app\common\base\BaseController;
use app\modules\general\sysmng\models\ar\SysConfig;
use YII;

/**
 * Index controller for the `sysmng` module
 */
class ConfigController extends BaseController
{

    public function init() {
        parent::init();
        $this->getView()->title = '系统配置';
        $this->layout = false;
    }

    public function actionIndex()
    {
        $this->layout=false;
        $sysconfig=SysConfig::find()->limit(1)->asArray()->one();
        return $this->render('index', [
            'sysconfig'=>$sysconfig,
        ]);
    }

    public function actionSave()
    {
        $postarr = YII::$app->getRequest()->post();

        $img_url = isset($postarr["app_qrcode"]) ? $postarr["app_qrcode"] : '';
        $img_urls = str_replace('https://', 'http://', $img_url);
        $img_chk = 'Y';

		if (!empty($img_urls)) {

			$a = @getimagesize($img_urls);
            $image_type = @$a[2];

			if (!in_array($image_type, array(IMAGETYPE_GIF, IMAGETYPE_JPEG,IMAGETYPE_PNG, IMAGETYPE_BMP))) {
				$img_chk = 'N';
			}
        }

        $flag = false;

		if ($img_chk == 'Y') {
            if (!empty($postarr)) {
                $sysconfig = SysConfig::find()->one();
                $sysconfig->close = $this->getParam('close', 0);
                $sysconfig->complain_email = $this->getParam('complain_email');
                $sysconfig->conf_www = $this->getParam('conf_www');
                $sysconfig->contact_tel = $this->getParam('contact_tel');
                $sysconfig->end_close_time = $this->getParam('end_close_time');
                $sysconfig->generalize_email = $this->getParam('generalize_email');
                $sysconfig->gunqiu_time_max = $this->getParam('gunqiu_time_max');
                $sysconfig->gunqiu_time_min = $this->getParam('gunqiu_time_min');
                $sysconfig->min_change_money = $this->getParam('min_change_money');
                $sysconfig->min_huikuan_money = $this->getParam('min_huikuan_money');
                $sysconfig->min_qukuan_money = $this->getParam('min_qukuan_money');
                $sysconfig->service_email = $this->getParam('service_email');
                $sysconfig->service_url = $this->getParam('service_url');
                $sysconfig->web_image = $this->getParam('web_image');
                $sysconfig->web_name = $this->getParam('web_name');
                $sysconfig->check_url1 = $this->getParam('check_url1');
                $sysconfig->check_url2 = $this->getParam('check_url2');
                $sysconfig->check_url3 = $this->getParam('check_url3');
                $sysconfig->check_url4 = $this->getParam('check_url4');
                $sysconfig->check_url5 = $this->getParam('check_url5');
                $sysconfig->check_url6 = $this->getParam('check_url6');
                $sysconfig->check_url7 = $this->getParam('check_url7');
                $sysconfig->check_url8 = $this->getParam('check_url8');
                $sysconfig->sport_show_row = $this->getParam('sport_show_row');
                $sysconfig->lhc_show_row = $this->getParam('lhc_show_row');
                $sysconfig->caipiao_show_row = $this->getParam('caipiao_show_row');
                $sysconfig->money_show_row = $this->getParam('money_show_row');
                //$sysconfig->add_pass = $this->getParam('add_pass');
                $sysconfig->lhc_auto = $this->getParam('lhc_auto');
                $sysconfig->lhc_auto_time = $this->getParam('lhc_auto_time');
                $sysconfig->ag_hall = $this->getParam('ag_hall');
                $sysconfig->hk_sxf = $this->getParam('hk_sxf');
                $sysconfig->caipiao_auto_time = $this->getParam('caipiao_auto_time');
                $sysconfig->sport_auto_time = $this->getParam('sport_auto_time');
                $sysconfig->caipiao_auto = $this->getParam('caipiao_auto');
                $sysconfig->sport_auto = $this->getParam('sport_auto');
                $sysconfig->register_phone = $this->getParam('register_phone');
                $sysconfig->register_qq = $this->getParam('register_qq');
                $sysconfig->register_email = $this->getParam('register_email');
                $sysconfig->register_name = $this->getParam('register_name');
                $sysconfig->service_qq = $this->getParam('service_qq');
                $sysconfig->app_qrcode = $this->getParam('app_qrcode');
                $sysconfig->in_rate = $this->getParam('in_rate');
                $sysconfig->out_rate = $this->getParam('out_rate');
                $sysconfig->ai_max_change = $this->getParam('ai_max_change');
                $flag = $sysconfig->save();
            }

            return $this->out(true);
        }

        if ($flag == true) {
            $data = ['code' => 0];
        } elseif ($img_chk == 'N') {
            $data = ['code' => 1,'msg' => '请勿使用非图片格式档案！！'];
        }

        return json_encode($data);
    }
}
