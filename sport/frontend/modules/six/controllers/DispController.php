<?php
namespace app\modules\six\controllers;

use app\common\base\BaseController;
//use app\models\User;
use app\modules\six\models\UserList;
use Yii;
use yii\web\Controller;
use app\modules\six\models\SixLotterySchedule;
use app\modules\six\models\LotteryResultLhc;
use app\modules\six\models\SixLotteryOdds;
use app\modules\six\models\CommonFc\CommonFc;
use app\modules\six\helpers\Zodiac;
use app\modules\six\models\UserGroup;

/**
 * 六合彩
 * IndexController
 */
class DispController extends BaseController  {

	public $layout=false;
	public $zodiacArr=array();
	public $commonFc;
	public $lastOne;
	public $arr;

    public function init() {
        parent::init();
        if(!Yii::$app->session[Yii::$app->params['S_USER_ID']]){         //验证登陆
            $this->redirect('/?r=mobile/disp/login');
        }
        $this->enableCsrfValidation = false;// 关闭csrf验证
        $this->getView()->title = '六合彩';
        $this->layout = 'main2';
		$zl=new Zodiac();
		if($zl){
			$this->zodiacArr=$zl->getArr();
		}
		$this->commonFc= new CommonFc();
		$userid = Yii::$app->session[Yii::$app->params['S_USER_ID']];
		$row = UserGroup::getLimitAndFsMoney($userid);
		$user = UserList::findOne(array('user_id'=>$userid));
		$this->arr=array(
			'lastOne'=>SixLotterySchedule::getNewestLottery(),
			'zodiacArr'=>$this->zodiacArr,
			'commonFc'=>new CommonFc(),
			'lowestMoney'=>$row['lhc_lower_bet'],
			'maxMoney'=>$row['lhc_max_bet'],
			'userMoney'=>$user['money'],
			'userId'=>$userid
			);
	}
	/**
	 * 六合彩
	 * 玩法 
	 * 自選不中 , 半波 , 半半波 , 七色波 -- 回首頁
	 */
	
	public function actionIndex(){//六合彩的主页面
		return $this->render('index',$this->arr);
	}
	
	public function actionTeMaA(){//特别号A面
		return $this->render('TeMaA',$this->arr);
	}
	public function actionTeMaB(){//特别号B面
		return $this->render('TeMaB',$this->arr);
	}
	public function actionLiangMian(){//两面
		return $this->render('LiangMian',$this->arr);
	}
	public function actionZhengMa(){//正码
		return $this->render('ZhengMa',$this->arr);
	}
	public function actionNas(){//正码特
		$this->layout = 'main2';
		$arr=array();
		for($i=1;$i<7;$i++){
			$arr[]=SixLotteryOdds::getOdds('N'.$i);
		}
		$this->arr['arr'] = $arr;
		return $this->render('nas',$this->arr);
	}
	public function actionZhengMaNo(){//正码1-6
		return $this->render('ZhengMaNo',$this->arr);
	}
	public function actionZhengMaGG(){//正码过关

		return $this->render('ZhengMaGG',$this->arr);
	}
	public function actionLianMa(){//连码
		return $this->render('LianMa',$this->arr);
	}
	public function actionLianXiao(){//连肖
		return $this->render('LianXiao',$this->arr);
	}
	public function actionLianWei(){//连尾
		return $this->render('LianWei',$this->arr);
	}
	public function actionNotIn(){//自选不中
		return $this->render('index',$this->arr);
		// return $this->render('notin',$this->arr);
	}
	public function actionTeMaSX(){//特码生肖
		return $this->render('TeMaSX',$this->arr);
	}
	public function actionZhengXiao(){//正肖
		return $this->render('ZhengXiao',$this->arr);
	}
	public function actionYiXiao(){//一肖
		return $this->render('YiXiao',$this->arr);
	}
	public function actionHeXiao(){//合肖
		return $this->render('HeXiao',$this->arr);
	}
	public function actionZongXiao(){//总肖
		return $this->render('ZongXiao',$this->arr);
	}
	public function actionSeBo(){//色波
		return $this->render('SeBo',$this->arr);
	}
	public function actionBanBo(){//半波
		return $this->render('index',$this->arr);
		// return $this->render('BanBo',$this->arr);
	}
	public function actionBanBanBo(){//半半波
		return $this->render('index',$this->arr);
		// return $this->render('BanBanBo',$this->arr);
	}
	public function actionQiSeBo(){//七色波
		return $this->render('index',$this->arr);
		// return $this->render('QiSeBo',$this->arr);
	}
	public function actionTouWeiShu(){//头尾数
		return $this->render('TouWeiShu',$this->arr);
	}
	public function actionZhengTeWeiShu(){//平特尾数
		return $this->render('ZhengTeWeiShu',$this->arr);
	}
	public function actionResult(){//结果
		$six_result = LotteryResultLhc::getSixResult();
		$this->arr['six_result'] = $six_result;
		return $this->render('result',$this->arr);
	}


}