<?php
namespace app\modules\agent\controllers;

use Yii;
use app\common\data\Pagination;
use app\common\base\BaseController;
use app\modules\agent\models\AgentsCash;
use app\modules\agent\models\AgentsList;

class CashController extends BaseController
{
    public $type = [];
    public $status = [];
    public $pageSize;
    private $_id;
    private $_name;
    private $_level;

    public function init()
    {
        parent::init();
        $this->_id = Yii::$app->session['S_AGENT_ID'];
        $this->_name = Yii::$app->session['S_USER_NAME'];
        $this->_level = Yii::$app->session['S_AGENT_LEVEL'];
        $this->layout = '@app/modules/agentht/views/layouts/main';

        if (empty(Yii::$app->session['S_AGENT_ID'])) {
            return $this->redirect('/?r=agentht/agent/index');
        }

        $this->pageSize = 20;

        $this->type = [
            '01' => '銀行1',
            '02' => '銀行2',
            '03' => '銀行3',
            '04' => 'USDT',
            '05' => 'ETH_USDT'
        ];

        $this->status = [
            0 => '未審核',
            1 => '已審核',
            2 => '已作废',
            3 => '转款中'
        ];
    }

    public function actionIndex()
    {
        $agentsCash = AgentsCash::find()->where(['agents_id' => $this->_id]);

        $agentsCash->orderBy([
            'order_num' => SORT_DESC
        ]);

        $pages = new Pagination([
            'totalCount' => $agentsCash->count(),
            'pageSize' => $this->pageSize
        ]);
        $list = $agentsCash
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();

        return $this->render('index', [
            'list' => $list,
            'pages' => $pages,
            'type' => $this->type,
            'status' => $this->status
        ]);
    }

    // 新增
    public function actionAdd()
    {
        $data = Yii::$app->request->post();

        if ($data) {
            $fieldCheck = $this->fieldCheck($data);

            if ($fieldCheck === true) {
                $agentsCash = new AgentsCash();
                $agentsCash->status = 0;
                $agentsCash->agents_id = $this->_id;
                $agentsCash->agents_name = $this->_name;
                $agentsCash->agent_level = $this->_level;
                $agentsCash->type = $data['type'];
                $agentsCash->account = $data['account'];
                $agentsCash->money = $data['money'];
                $agentsCash->create_time = date('Y-m-d H:i:s');

                if ($agentsCash->save()) {
                    // 再更新订单編號
                    $orderNum = date('Ymd') . $agentsCash->id;
                    $agentsCash = AgentsCash::findOne($agentsCash->id);
                    $agentsCash->order_num = $orderNum;
                    $agentsCash->save();

                    if ($agentsCash->save()) {
                        Yii::$app->session->setFlash('success', "新增成功");
                        return $this->redirect('/?r=agent/cash');
                    }
                }

                Yii::$app->session->setFlash('error', "新增失敗");
                return $this->redirect('/?r=agent/cash');
            } else {
                Yii::$app->session->setFlash('error', $fieldCheck);
                return $this->redirect('/?r=agent/cash/add');
            }
        }

        $agent = AgentsList::find()->where(['id' => $this->_id])->asArray()->one();

        return $this->render('add', [
            'agent' => $agent,
            'type' => $this->type
        ]);
    }

    // 作廢
    public function actionCancel()
    {
		$id = $this->getParam('id', -1000);
        $agentsCash = AgentsCash::findOne(['id' => $id]);

        if ($agentsCash) {
            $agentsCash->status = 2;

			if ($agentsCash->save()) {
				return $this->out(true , '作廢成功');
			}
        }

        return $this->out(false , '作廢失败');
    }

    // 刪除
    public function actionDelete()
    {
		$id = $this->getParam('id', -1000);
        $agentsCash = AgentsCash::findOne(['id' => $id]);

        if ($agentsCash) {
			if ($agentsCash->delete()) {
				return $this->out(true , '删除成功');
			}
        }

        return $this->out(false , '删除失败');
    }

    public function fieldCheck($data)
    {
        if (! $data['account']) {
            $result = '请输入交易帳號';
            return $result;
        }

        if (! $data['money']) {
            $result = '请输入交易金額';
            return $result;
        } else {
            if (! is_numeric($data['money'])) {
                $result = '请输入正确的交易金額';
                return $result;
            }

            $agent = AgentsList::find()->where(['id' => $this->_id])->asArray()->one();

            if ($data['money'] > $agent['money']) {
                $result = '交易金額大於當前餘額';
                return $result;
            }

            $sql = "SELECT SUM( money ) money "
                . "FROM agents_cash "
                . "WHERE agents_id = $this->_id AND status = 0";

            $rs = AgentsCash::findBySql($sql)->asArray()->one();

            if (($data['money'] + $rs['money']) > $data['ori_money']) {
                $result = '已申請請款金額大於當前餘額';
                return $result;
            }
        }

        return true;
    }
}
