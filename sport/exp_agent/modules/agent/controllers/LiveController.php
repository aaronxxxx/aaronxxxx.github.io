<?php
namespace app\modules\agent\controllers;

use Yii;
use app\common\data\Pagination;
use app\common\base\BaseController;
use app\modules\agent\models\UserList;
use app\modules\agent\models\LiveOrder;


class LiveController extends BaseController {
    public $page =20;//真人分頁，需要*6(對應6種平台)ps:存在真人平台數的細微差別

    public function init() {//初始化函數
        parent::init();
        $this->layout = false;
        $this->enableCsrfValidation = false;                                                //關閉表單驗證
    }
    /**
     * live 詳細報表信息
     * @return type
     */
    public function actionIndex(){
        $getNews = Yii::$app->request->get();
        $time['s_time'] = $this->getParam('s_time', date('Y-m-d 00:00:00'));
        $time['e_time'] = $this->getParam('e_time', date('Y-m-d H:i:s'));
        $all['money'] = $all['sy'] = $live_list = $pages = 0;
        $order_id_arr = LiveOrder::getOrderIdLive($getNews['s_time'], $getNews['e_time'], $getNews['user_id']);
        $user_name = UserList::getUserNameByUserId($getNews['user_id']);
        $all['user_name'] = $user_name['user_name'];
        if($order_id_arr){
            foreach ($order_id_arr as $key => $value) {
                $arr_id[$key] = $value['id'];
            }
            $live_arr = LiveOrder::getOrderDelailLive($arr_id);
            $pages = new Pagination(['totalCount' => $live_arr->count(), 'pageSize' => $this->page*6]);
            $live_list = $live_arr->offset($pages->offset)->limit($pages->limit)->asArray()->all();
            foreach ($live_list as $key => $value) {
                $all['money'] += $value['bet_money'];
                $all['sy'] -= $value['live_win'];
            }
        }
        return $this->render('index', [
                    'time' => $time,
                    'all'=>$all,
                    'user_id'=>$getNews['user_id'],
                    'live_list'=>$live_list,
                    'pages'=>$pages,
                        ]
        );
    }
}