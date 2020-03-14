<?php
namespace app\modules\spsix\controllers;

use app\common\base\BaseController;
use app\modules\general\admin\models\ManageLog;
use app\modules\spsix\models\SpsixLotteryOdds;
use app\modules\spsix\helpers\Zodiac;
use Yii;

/*
 * 极速六合彩赔率控制器
 */
class OddsController extends BaseController{
    public $layout=false;
    public $status = array();
	public $animal = array('鼠','牛','虎','兔','龙','蛇','马','羊','猴','鸡','狗','猪');
	
	public function init(){//初始化函数
		parent::init();

        //订单状态表示
        $this->status = array(0=>'未结算',1=>'已结算',2=>'重新结算',3=>'已作废','0,1,2,3'=>'全部注单');
		$this->layout = '@app/views/layouts/main2.php';
	}

    /*
     * 两面赔率
     */
    public function actionLiangmian(){
		$this -> layout =false;
		$params = Yii::$app->request->post();
		if(isset($params['sub_type']) && $params['sub_type'] && isset($params['aOdds']) && !empty($params['aOdds'])){
			$superpassword = isset($_POST["superpassword"]) ? $_POST["superpassword"] : "";
        	$spc = trim( file_get_contents(Yii::$app->basePath."/config/supperpassword") );
			if($superpassword!=$spc){
				return '修改权限密码错误';
			}
            foreach ($params['aOdds'] as $val){
                if($val<=0 && $params['sub_type'] != 'RATE'){
                    return '赔率不能小于0';
                }
            }
			$update = SpsixLotteryOdds::updateLiangmian($params['sub_type'],$params['aOdds'],'other');
			if($update){
				if($params['sub_type']=='RATE'){
					$str = '修改极速六合彩胜率至'.$params['aOdds']['h1']; 
					ManageLog::saveLog(Yii::$app->getSession()->get('S_USER_NAME'),$str,Yii::$app->getSession()->get('ssid'));
				}
				return "修改成功";
			}
			return "修改失败";
		}
		$zhengMa['N1'] = SpsixLotteryOdds::getOddsByBallType('N1','other');
		$zhengMa['N2'] = SpsixLotteryOdds::getOddsByBallType('N2','other');
		$zhengMa['N3'] = SpsixLotteryOdds::getOddsByBallType('N3','other');
		$zhengMa['N4'] = SpsixLotteryOdds::getOddsByBallType('N4','other');
		$zhengMa['N5'] = SpsixLotteryOdds::getOddsByBallType('N5','other');
		$zhengMa['N6'] = SpsixLotteryOdds::getOddsByBallType('N6','other');
		$zhengMa['SP'] = SpsixLotteryOdds::getOddsByBallType('SP','other');
		$zhengMa['NA'] = SpsixLotteryOdds::getOddsByBallType('NA','other');
		$zhengMa['RATE'] = SpsixLotteryOdds::getOddsByBallType('RATE','other');
        return $this->render('liangmian',array(
			'zhengMa'=>$zhengMa,
		));
    }

	/*
    * 正码过关赔率
    */
	public function actionZmgg(){
		$this -> layout =false;
		$params = Yii::$app->request->post();
		if(isset($params['sub_type']) && $params['sub_type'] && isset($params['aOdds']) && !empty($params['aOdds'])){
			$superpassword = isset($_POST["superpassword"]) ? $_POST["superpassword"] : "";
        	$spc = trim( file_get_contents(Yii::$app->basePath."/config/supperpassword") );
			if($superpassword!=$spc){
				return '修改权限密码错误';
			}
            foreach ($params['aOdds'] as $val){
                if($val<=0){
                    return '赔率不能小于0';
                }
            }
			$this->layout = false;
			$update = SpsixLotteryOdds::updateLiangmian($params['sub_type'],$params['aOdds']);
			if($update){
				return "修改成功";
			}
			return "修改失败";
		}
		$data['NAP1'] = SpsixLotteryOdds::getOddsByBallType('NAP1');
		$data['NAP2'] = SpsixLotteryOdds::getOddsByBallType('NAP2');
		$data['NAP3'] = SpsixLotteryOdds::getOddsByBallType('NAP3');
		$data['NAP4'] = SpsixLotteryOdds::getOddsByBallType('NAP4');
		$data['NAP5'] = SpsixLotteryOdds::getOddsByBallType('NAP5');
		$data['NAP6'] = SpsixLotteryOdds::getOddsByBallType('NAP6');

		return $this->render('zmgg',array(
			'data'=>$data,
		));
	}

	/*
    * 连码赔率
    */
	public function actionLianMa(){
		$this -> layout =false;
		$params = Yii::$app->request->post();
		if(isset($params['sub_type']) && $params['sub_type'] && isset($params['aOdds']) && !empty($params['aOdds'])){
			$superpassword = isset($_POST["superpassword"]) ? $_POST["superpassword"] : "";
        	$spc = trim( file_get_contents(Yii::$app->basePath."/config/supperpassword") );
			if($superpassword!=$spc){
				return '修改权限密码错误';
			}
            foreach ($params['aOdds'] as $val){
                if($val<=0){
                    return '赔率不能小于0';
                }
            }
			$this->layout = false;
			$update = SpsixLotteryOdds::updateLiangmian($params['sub_type'],$params['aOdds']);
			if($update){
				return "修改成功";
			}
			return "修改失败";
		}
		$data['CH'] = SpsixLotteryOdds::getOddsByBallType('CH');//连码
		$data['NI'] = SpsixLotteryOdds::getOddsByBallType('NI');//自选不中

		return $this->render('lianma',array(
			'data'=>$data,
		));
	}
	/*
	* 连肖赔率
	*/
	public function actionLianXiao(){
		$this -> layout =false;
		$z = new Zodiac();
		$zodiacArr=$z->getArr();
		$params = Yii::$app->request->post();
		if(isset($params['sub_type']) && $params['sub_type'] && isset($params['aOdds']) && !empty($params['aOdds'])){
			$superpassword = isset($_POST["superpassword"]) ? $_POST["superpassword"] : "";
        	$spc = trim( file_get_contents(Yii::$app->basePath."/config/supperpassword") );
			if($superpassword!=$spc){
				return '修改权限密码错误';
			}
            foreach ($params['aOdds'] as $val){
                if($val<=0){
                    return '赔率不能小于0';
                }
            }
			$this->layout = false;
			$update = SpsixLotteryOdds::updateLiangmian($params['sub_type'],$params['aOdds']);
			if($update){
				return "修改成功";
			}
			return "修改失败";
		}
		$data['LX2'] = SpsixLotteryOdds::getOddsByBallType('LX2');//二连肖
		$data['LX3'] = SpsixLotteryOdds::getOddsByBallType('LX3');//三连肖
		$data['LX4'] = SpsixLotteryOdds::getOddsByBallType('LX4');//四连肖
		$data['LX5'] = SpsixLotteryOdds::getOddsByBallType('LX5');//五连肖

		return $this->render('lianxiao',array(
			'data'=>$data,
			'zodiacArr'=>$zodiacArr,
			'animal'=>$this->animal
		));
	}

	/*
	* 连尾赔率
	*/
	public function actionLianWei(){
		$this -> layout =false;
		$params = Yii::$app->request->post();
		if(isset($params['sub_type']) && $params['sub_type'] && isset($params['aOdds']) && !empty($params['aOdds'])){
			$superpassword = isset($_POST["superpassword"]) ? $_POST["superpassword"] : "";
        	$spc = trim( file_get_contents(Yii::$app->basePath."/config/supperpassword") );
			if($superpassword!=$spc){
				return '修改权限密码错误';
			}
            foreach ($params['aOdds'] as $val){
                if($val<=0){
                    return '赔率不能小于0';
                }
            }
			$this->layout = false;
			$update = SpsixLotteryOdds::updateLiangmian($params['sub_type'],$params['aOdds']);
			if($update){
				return "修改成功";
			}
			return "修改失败";
		}
		$data['LF2'] = SpsixLotteryOdds::getOddsByBallType('LF2');//二尾碰
		$data['LF3'] = SpsixLotteryOdds::getOddsByBallType('LF3');//三尾碰
		$data['LF4'] = SpsixLotteryOdds::getOddsByBallType('LF4');//四尾碰
		$data['LF5'] = SpsixLotteryOdds::getOddsByBallType('LF5');//五尾碰

		return $this->render('lianwei',array(
			'data'=>$data,
		));
	}

	/*
	* 生肖赔率
	*/
	public function actionShengXiao(){
		$this -> layout =false;
		$z = new Zodiac();
		$zodiacArr=$z->getArr();
		$params = Yii::$app->request->post();
		if(isset($params['sub_type']) && $params['sub_type'] && isset($params['aOdds']) && !empty($params['aOdds'])){
			$superpassword = isset($_POST["superpassword"]) ? $_POST["superpassword"] : "";
        	$spc = trim( file_get_contents(Yii::$app->basePath."/config/supperpassword") );
			if($superpassword!=$spc){
				return '修改权限密码错误';
			}
            foreach ($params['aOdds'] as $val){
                if($val<=0){
                    return '赔率不能小于0';
                }
            }
			$this->layout = false;
			$update = SpsixLotteryOdds::updateLiangmian($params['sub_type'],$params['aOdds']);
			if($update){
				return "修改成功";
			}
			return "修改失败";
		}
		$data['SPA'] = SpsixLotteryOdds::getOddsByBallType('SPA');//特码生肖
		$data['C7'] = SpsixLotteryOdds::getOddsByBallType('C7');//正肖
		$data['SPB'] = SpsixLotteryOdds::getOddsByBallType('SPB');//一肖、总肖
		$data['NX'] = SpsixLotteryOdds::getOddsByBallType('NX');//合肖

		return $this->render('shengxiao',array(
			'data'=>$data,
			'zodiacArr'=>$zodiacArr,
			'animal'=>$this->animal
		));
	}

	/*
	* 头尾数
	*/
	public function actionTouWei(){
		$this -> layout =false;
		$params = Yii::$app->request->post();
		if(isset($params['sub_type']) && $params['sub_type'] && isset($params['aOdds']) && !empty($params['aOdds'])){
			$superpassword = isset($_POST["superpassword"]) ? $_POST["superpassword"] : "";
        	$spc = trim( file_get_contents(Yii::$app->basePath."/config/supperpassword") );
			if($superpassword!=$spc){
				return '修改权限密码错误';
			}
            foreach ($params['aOdds'] as $val){
                if($val<=0){
                    return '赔率不能小于0';
                }
            }
			$this->layout = false;
			$update = SpsixLotteryOdds::updateLiangmian($params['sub_type'],$params['aOdds']);
			if($update){
				return "修改成功";
			}
			return "修改失败";
		}
		$data['SPA'] = SpsixLotteryOdds::getOddsByBallType('SPA');//头尾数
		$data['SPB'] = SpsixLotteryOdds::getOddsByBallType('SPB');//平特尾数

		return $this->render('touwei',array(
			'data'=>$data,
		));
	}

	/*
	* 色波
	*/
	public function actionSebo(){
		$this -> layout =false;
		$params = Yii::$app->request->post();
		if(isset($params['sub_type']) && $params['sub_type'] && isset($params['aOdds']) && !empty($params['aOdds'])){
			$superpassword = isset($_POST["superpassword"]) ? $_POST["superpassword"] : "";
        	$spc = trim( file_get_contents(Yii::$app->basePath."/config/supperpassword") );
			if($superpassword!=$spc){
				return '修改权限密码错误';
			}
            foreach ($params['aOdds'] as $val){
                if($val<=0){
                    return '赔率不能小于0';
                }
            }
			$this->layout = false;
			$ball_type = $params['sub_type']=='SP' ? 'other':null;
			$update = SpsixLotteryOdds::updateLiangmian($params['sub_type'],$params['aOdds'],$ball_type);
			if($update){
				return "修改成功";
			}
			return "修改失败";
		}
		$data['SP'] = SpsixLotteryOdds::getOddsByBallType('SP','other');//色波
		$data['HB'] = SpsixLotteryOdds::getOddsByBallType('HB');//半波/半半波
		$data['C7'] = SpsixLotteryOdds::getOddsByBallType('C7');//七色波

		return $this->render('sebo',array(
			'data'=>$data,
		));
	}

	/*
	* 正马特
	*/
	public function actionZhengMaTe(){
		$this -> layout =false;
		$params = Yii::$app->request->post();
		if(isset($params['sub_type']) && $params['sub_type'] && isset($params['aOdds']) && !empty($params['aOdds'])){
			$superpassword = isset($_POST["superpassword"]) ? $_POST["superpassword"] : "";
        	$spc = trim( file_get_contents(Yii::$app->basePath."/config/supperpassword") );
			if($superpassword!=$spc){
				return '修改权限密码错误';
			}
			$this->layout = false;
			//反水比例功能去除
			if(isset($params['fsMoney']) && $params['fsMoney']){
                if($params['fsMoney']<=0||$params['fsRate']<=0){
                    return '金额跟比列设置不能小于0';
                }
				$params['fsRate'] = $params['fsRate'] <0.01 ? 0.01 :$params['fsRate'];
				$fsUpdate = SpsixLotteryOdds::findOne(array('sub_type'=>'SP','ball_type'=>'fs'));
				if($fsUpdate){
					$fsUpdate->h1 = $params['fsMoney'];
					$fsUpdate->h2 = $params['fsRate'];
					$fsUpdate->save();
				}
			}
			$ball_type = $params['sub_type']=='SP' ? 'a_side':null;
			$params['sub_type'] = $params['sub_type']=='SPB' ? 'SP':$params['sub_type'];
            foreach ($params['aOdds'] as $val){
                if($val<=0){
                    return '赔率不能小于0';
                }
            }
			$update = SpsixLotteryOdds::updateLiangmian($params['sub_type'],$params['aOdds'],$ball_type);
			if($update){
				return "修改成功";
			}
			return "修改失败";
		}
		$data['SP'] = SpsixLotteryOdds::getOddsByBallType('SP','a_side');//特别面A
		$data['N1'] = SpsixLotteryOdds::getOddsByBallType('N1');//正码特一
		$data['N2'] = SpsixLotteryOdds::getOddsByBallType('N2');//正码特二
		$data['N3'] = SpsixLotteryOdds::getOddsByBallType('N3');//正码特三
		$data['N4'] = SpsixLotteryOdds::getOddsByBallType('N4');//正码特四
		$data['N5'] = SpsixLotteryOdds::getOddsByBallType('N5');//正码特五
		$data['N6'] = SpsixLotteryOdds::getOddsByBallType('N6');//正码特六
		$data['NA'] = SpsixLotteryOdds::getOddsByBallType('NA');//正码
		$data['SPB'] = SpsixLotteryOdds::getOddsByBallType('SP');//特别面B
		$fs = SpsixLotteryOdds::getOddsByBallType('SP','fs');//特别面A反水比例设置
		return $this->render('zhengmate',array(
			'data'=>$data,
			'fs'=>$fs
		));
	}
}

