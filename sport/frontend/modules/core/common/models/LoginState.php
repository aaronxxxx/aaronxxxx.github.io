<?php
namespace app\modules\core\common\models;
 
use Yii;
use yii\base\Model;
use yii\web\Cookie;

class LoginState extends Model{
	public function init(){
		parent::init();
	}
	public static function Check(){
		if(Yii::$app->session->has(Yii::$app->params['S_USER_ID'])){
			return true;
		}else{//session不存在
			$cookies = Yii::$app->request->cookies;
			if($cookies->has('uid')&&$cookies->has('oid')){//调用cookie
                $uid=$cookies->getValue('uid');
                $oid=$cookies->getValue('oid');
				if(self::_ok($uid,$oid)){
					self::flash($uid,$oid);
					return true;
				}else{
					self::delete();
				}
			}
		}
		return false;
	}
	public static function add($uid,$oid){//设置登录信息
        Yii::$app->session[Yii::$app->params['S_USER_ID']] = $uid;
        Yii::$app->session[Yii::$app->params['S_USER_OID']] = $oid;
		$cookies = Yii::$app->response->cookies;
		$cookies->add(new Cookie([
			'name' => 'uid',
			'value' => $uid,
			'expire'=>0
		]));
		$cookies->add(new Cookie([
			'name' => 'oid',
			'value' => $oid,
			'expire'=>0
		]));
	}
	public static function delete(){//清除登录信息
		Yii::$app->session->remove(Yii::$app->params['S_USER_ID']);
		Yii::$app->session->remove(Yii::$app->params['S_USER_OID']);
		$cookies=Yii::$app->response->cookies;
		$cookies->remove('uid');
		$cookies->remove('oid');
	}
	public static function flash($uid,$oid){//刷新session生命周期
        Yii::$app->session[Yii::$app->params['S_USER_ID']] = $uid;
        Yii::$app->session[Yii::$app->params['S_USER_OID']] = $oid;
	}
	//-----辅组函数---------------------------------------------
	private static function  _ok($uid,$oid){//验证登录信息
       $user=UserList::find()
	         ->select('Oid')
             ->where(['user_id' =>$uid,'Oid'=>$oid])
			 ->asArray()
             ->one();
		if(!empty($user['Oid'])){
			return $user['Oid'];
		}else{
			return '';
		}
	}
}