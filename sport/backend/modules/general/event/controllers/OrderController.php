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
        $data['status'] = $this->getParam('status', '-1');
        $data['startTime'] = $this->getParam('startTime', '');
        $data['endTime'] = $this->getParam('endTime', '');
        $data['qishu'] = $this->getParam('qishu', '');
        $data['orderNum'] = $this->getParam('orderNum', '');
        $data['userName'] = $this->getParam('userName', '');

        foreach ($this->eventPlayer as $key => $val) {
            $player[$val['id']] = $val['title'];
        }

        $eventOrder = EventOrder::getAll($data['status'], $data['startTime'], $data['endTime'], $data['qishu'], $data['orderNum'], $data['userName']);

        $pages = new Pagination([
            'totalCount' => $eventOrder->count(),
            'pageSize' => $this->pageSize
        ]);
        $list = $eventOrder
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
            'postStatus' => $data['status'] > -1 ? $data['status'] : -1,
			'startTime' => $data['startTime'],
			'endTime' => $data['endTime'],
			'qishu' => $data['qishu'],
            'orderNum' => $data['orderNum'],
            'userName' => $data['userName']
        ]);
    }

	// 订单作废
    public function actionCancel()
    {
        $id = $this->getParam('id', '');

        $result = EventOrder::cancelOrder($id);

        if (!$result) {
            $data = '订单作废失败，请重新操作！';
            return $data;
        }

        $data = '订单作废成功！';
        return $data;
    }
}
