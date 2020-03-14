<?php
namespace app\modules\general\event\controllers;

use Yii;
use app\common\data\Pagination;
use app\common\base\BaseController;
use app\modules\general\event\models\EventOrder;
use app\modules\general\event\models\EventPlayer;
use app\modules\general\event\models\EventMultipleOdds;

/**
 * Order controller for the event module
 */
class OrderController extends BaseController
{
    public $gameType = [];
    public $status = [];
    public $eventPlayer = [];
    public $pageSize;

    public function init()
    {
        parent::init();
        $this->layout = false; //後台必備 將layout移除

        $this->pageSize = 20;

        $this->eventPlayer = EventPlayer::find()
            ->asArray()
            ->all();

        $this->gameType = [
            1 => '兩方',
            2 => '多項目'
        ];

        $this->status = [
            0 => '未结算',
            1 => '已结算',
            2 => '重新结算',
            3 => '已作废'
        ];
    }

    public function actionIndex()
    {
        $excludegroup =  $this->getParam('excludegroup', '');

        $data = Yii::$app->request->post();

        foreach ($this->eventPlayer as $key => $val) {
            $player[$val['id']] = $val['title'];
        }

		if ($excludegroup == '1') {
			$sql = "SELECT ul.user_id
			FROM user_list as ul
			INNER JOIN user_group as ug on ul.group_id= ug.group_id
			WHERE ug.group_name = '测试组会员'";
			$excludeids = Yii::$app->db->createCommand($sql)->queryAll(); //找出這個'测试组会员'會員組的所有id
		} else {
			$excludeids = null;
        }

        // $config = SysConfig::find()->select('lhc_auto,lhc_auto_time')->asArray()->one();
        // $reload = ($config['lhc_auto']==1)?$config['lhc_auto_time']:1000;
        if ($data) {
            $eventOrder = EventOrder::getAll($data['status'], $data['startTime'], $data['endTime'], $data['qishu'], $data['orderNum'], $data['userName']);
        } else {
            $eventOrder = EventOrder::getAll();
        }

        $pages = new Pagination([
            'totalCount' => $eventOrder->count(),
            'pageSize' => $this->pageSize
        ]);
        $list = $eventOrder
            ->orderBy([
                'bet_time' => SORT_DESC,
                'official_id' => SORT_DESC,
                'order_num' => SORT_DESC
            ])
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();

        foreach ($list as $key => $val) {
            if ($val['game_type'] == 1) {
                $list[$key]['game_item_id'] = $player[$val['game_item_id']];
            } else {
                $eventMultipleOdds = EventMultipleOdds::find()
                    ->where(['id' => $val['game_item_id']])
                    ->asArray()
                    ->one();

                $list[$key]['game_item_id'] = $eventMultipleOdds['title'];
            }
        }

        return $this->render('index', [
            'status' => $this->status,
            'gameType' => $this->gameType,
            'player' => $player,
            'pages' => $pages,
			'list' => $list,
            'postStatus' => isset($data['status']) ? $data['status'] : null,
			'startTime' => isset($data['startTime']) ? $data['startTime'] : null,
			'endTime' => isset($data['endTime']) ? $data['endTime'] : null,
			'qishu' => isset($data['qishu']) ? $data['qishu'] : null,
            'orderNum' => isset($data['orderNum']) ? $data['orderNum'] : null,
            'userName' => isset($data['userName']) ? $data['userName'] : null,
            'excludegroup' => $excludegroup,
            // 'reload'=>$reload
        ]);
    }
}
