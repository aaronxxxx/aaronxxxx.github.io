<?php
namespace app\modules\general\event\controllers;

use Yii;
use app\common\data\Pagination;
use app\common\base\BaseController;
use app\modules\general\event\models\EventOfficial;
use app\modules\general\event\models\EventPlayer;
use app\modules\general\event\models\EventTwopk;
use app\modules\general\event\models\EventTwopkOdds;

/**
 * Twopk controller for the event module
 */
class TwopkController extends BaseController
{
    public $type = [];
    public $eventPlayer = [];
    public $eventOfficial = [];
    public $pageSize;

    public function init()
    {
        parent::init();
        $this->layout = false; //後台必備 將layout移除

        $this->pageSize = 20;

        $this->eventPlayer = EventPlayer::find()
            ->where(['status' => 1])
            ->asArray()
            ->all();

        $this->eventOfficial = EventOfficial::find()
            ->where(['status' => 1])
            ->asArray()
            ->all();

        $this->type = [
            '01' => '足球',
            '02' => '籃球',
            '03' => '棒球',
            '04' => '排球',
            '05' => '冰球',
            '06' => '桌球',
            '07' => '網球',
            '08' => '手球',
            '09' => '美足',
            '10' => '羽毛球',
            '11' => '其他'
        ];
    }

    public function actionIndex()
    {
        $oid = $this->getParam('oid', '');

        $eventTwopk = EventTwopk::getAll($oid);

        $pages = new Pagination([
            'totalCount' => $eventTwopk->count(),
            'pageSize' => $this->pageSize
        ]);
        $list = $eventTwopk
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();

        foreach ($this->eventPlayer as $key => $val) {
            $player[$val['id']] = $val['title'];
        }

        return $this->render('index', [
            'oid' => $oid,
            'list' => $list,
            'pages' => $pages,
            'player' => $player,
            'type' => $this->type
        ]);
    }

    //新增
    public function actionAdd()
    {
        $oid = $this->getParam('oid', '');
        $data = Yii::$app->request->post();

        if ($data) {
            $fieldCheck = $this->fieldCheck($data);

            if ($fieldCheck === true) {
                #啟動資料上傳動作，使用name = img， 預設路徑為 /_uploads/*
                if ( !empty($_FILES['img']['size']) ) {
                    $tempName = explode(".", $_FILES['img']['name']);
                    $file = $_FILES['img']['tmp_name'];
                    $dateTime = date('YmdHis');
                    $dest = '_uploads/twopk' . $dateTime . '.' . $tempName[count($tempName) - 1];
                    move_uploaded_file($file, $dest);

                    //同步複製至前端資料夾位置
                    copy($dest, '../../frontend/web/' . $dest);
                    $data['img_url'] = '/' . $dest;
                }

                $eventTwopk = new EventTwopk();
                $eventTwopk->status = $data['status'] ? $data['status'] : 1;
                $eventTwopk->official_id = $data['official_id'];
                $eventTwopk->qishu = $data['qishu'];
                $eventTwopk->player1 = $data['player1'];
                $eventTwopk->player2 = $data['player2'];
                $eventTwopk->player1_status = $data['player1_status'];
                $eventTwopk->player2_status = $data['player2_status'];
                $eventTwopk->player1_handicap = $data['player1_handicap'];
                $eventTwopk->player2_handicap = $data['player2_handicap'];

                if ( !empty($data['img_url']) ) {
                    $eventTwopk->img_url = $data['img_url'];
                }

                $eventTwopk->summary = $data['summary'];
                $eventTwopk->remarks = $data['remarks'];
                $eventTwopk->create_time = date("Y-m-d H:i:s");

                if ($eventTwopk->save()) {
                    $eventTwopkOdds = new EventTwopkOdds();
                    $eventTwopkOdds->official_id = $data['official_id'];
                    $eventTwopkOdds->twopk_id = $eventTwopk->getPrimaryKey();
                    $eventTwopkOdds->player1_odds = $data['player1_odds'];
                    $eventTwopkOdds->player2_odds = $data['player2_odds'];
                    $eventTwopkOdds->adj_basic = $data['adj_basic'];
                    $eventTwopkOdds->start_amount = $data['start_amount'];
                    $eventTwopkOdds->create_time = date("Y-m-d H:i:s");

                    if ($eventTwopkOdds->save()) {
                        Yii::$app->session->setFlash('success', "新增成功");

                        return $this->redirect('/#/event/twopk/index&oid='.$data['official_id']);
                    }
                }

                Yii::$app->session->setFlash('error', "新增失敗");

                return $this->redirect('/#/event/twopk/index&oid='.$data['official_id']);
            } else {
                Yii::$app->session->setFlash('error', $fieldCheck);

                return $this->redirect('/#/event/twopk/add&oid='.$data['official_id']);
            }
        }

        return $this->render('add',  [
            'oid' => $oid,
            'player' => $this->eventPlayer,
            'official' => $this->eventOfficial
        ]);
    }

    //修改
    public function actionEdit()
    {
        $id = $this->getParam('id', '');
        $data = Yii::$app->request->post();

        if ($data) {
            $fieldCheck = $this->fieldCheck($data);

            if ($fieldCheck === true) {
                #啟動資料上傳動作，使用name = img， 預設路徑為 /_uploads/*
                if ( !empty($_FILES['img']['size']) ) {
                    $tempName = explode(".", $_FILES['img']['name']);
                    $file = $_FILES['img']['tmp_name'];
                    $dateTime = date('YmdHis');
                    $dest = '_uploads/twopk' . $dateTime . '.' . $tempName[count($tempName) - 1];
                    move_uploaded_file($file, $dest);

                    //同步複製至前端資料夾位置
                    copy($dest, '../../frontend/web/' . $dest);
                    $data['img_url'] = '/' . $dest;
                }

                $eventTwopk = EventTwopk::findOne(['id' => $data['editId']]);
                $eventTwopkOdds = EventTwopkOdds::findOne(['twopk_id' => $data['editId']]);

                if ($eventTwopk && $eventTwopkOdds) {
                    $eventTwopk->status = $data['status'] ? $data['status'] : 1;
                    $eventTwopk->official_id = $data['official_id'];
                    $eventTwopk->qishu = $data['qishu'];
                    $eventTwopk->player1 = $data['player1'];
                    $eventTwopk->player2 = $data['player2'];
                    $eventTwopk->player1_status = $data['player1_status'];
                    $eventTwopk->player2_status = $data['player2_status'];
                    $eventTwopk->player1_handicap = $data['player1_handicap'];
                    $eventTwopk->player2_handicap = $data['player2_handicap'];

                    if ( !empty($data['img_url']) ) {
                        $eventTwopk->img_url = $data['img_url'];
                    }

                    $eventTwopk->summary = $data['summary'];
                    $eventTwopk->remarks = $data['remarks'];
                    $eventTwopk->modify_time = date("Y-m-d H:i:s");

                    $eventTwopkOdds->official_id = $data['official_id'];
                    $eventTwopkOdds->player1_odds = $data['player1_odds'];
                    $eventTwopkOdds->player2_odds = $data['player2_odds'];
                    $eventTwopkOdds->adj_basic = $data['adj_basic'];
                    $eventTwopkOdds->start_amount = $data['start_amount'];
                    $eventTwopkOdds->modify_time = date("Y-m-d H:i:s");

                    if ($eventTwopk->save() && $eventTwopkOdds->save()) {
                        Yii::$app->session->setFlash('success', "修改成功");

                        return $this->redirect('/#/event/twopk/index&oid='.$data['official_id']);
                    }
                }

                Yii::$app->session->setFlash('error', "修改失敗");

                return $this->redirect('/#/event/twopk/index&oid='.$data['official_id']);
            } else {
                Yii::$app->session->setFlash('error', $fieldCheck);

                return $this->redirect('/#/event/twopk/edit&id='.$data['editId']);
            }
        }

        $eventTwopk = EventTwopk::find()
            ->where(['id' => $id])
            ->asArray()
            ->one();
        $eventTwopkOdds = EventTwopkOdds::find()
            ->where(['twopk_id' => $id])
            ->asArray()
            ->one();

        return $this->render('edit', [
            'data' => $eventTwopk,
            'odds' => $eventTwopkOdds,
            'player' => $this->eventPlayer,
            'official' => $this->eventOfficial
        ]);
    }

    //刪除
    public function actionDelete()
    {
		$id = $this->getParam('id', -1000);
        $eventTwopk = EventTwopk::findOne(['id' => $id]);
        $eventTwopkOdds = EventTwopkOdds::findOne(['twopk_id' => $id]);

        if ($eventTwopk->delete()) {
            if ($eventTwopkOdds) {
                $eventTwopkOdds->delete();
            }

            return $this->out(true , '删除成功');
        }

        return $this->out(false , '删除失败');
    }

    public function imgCheck($data)
    {
        $data = str_replace( 'https://', 'http://', $data);
        $img = @getimagesize($data);
        $img_type = @$img[2];

        if (!in_array($img_type, [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP])) {
            $result = '请勿使用非图片格式档案！！';
            return $result;
        }

        return true;
    }

    public function fieldCheck($data)
    {
        if ($data['qishu']) {
            if (!is_numeric($data['qishu'])) {
                $result = '请输入正确的期数';
                return $result;
            }
        } else {
            $result = '请输入期数';
            return $result;
        }

        if (!is_numeric($data['player1_handicap'])) {
            $result = '请输入正確的選手一讓分';
            return $result;
        }

        if (!is_numeric($data['player2_handicap'])) {
            $result = '请输入正確的選手二讓分';
            return $result;
        }

        if ($data['player1_handicap'] && $data['player2_handicap']) {
            $result = '请输入正確的讓分';
            return $result;
        }

        if ($data['player1_odds']) {
            if (!is_numeric($data['player1_odds'])) {
                $result = '请输入正确的主方赔率';
                return $result;
            }
        } else {
            $result = '请输入主方赔率';
            return $result;
        }

        if ($data['player2_odds']) {
            if (!is_numeric($data['player2_odds'])) {
                $result = '请输入正确的客方赔率';
                return $result;
            }
        } else {
            $result = '请输入客方赔率';
            return $result;
        }

        if ($data['adj_basic']) {
            if (!is_numeric($data['adj_basic'])) {
                $result = '请输入正确的调整基值';
                return $result;
            }
        } else {
            $result = '请输入调整基值';
            return $result;
        }

        if ($data['start_amount']) {
            if (!is_numeric($data['start_amount'])) {
                $result = '请输入正确的启动额';
                return $result;
            }
        } else {
            $result = '请输入启动额';
            return $result;
        }

        return true;
    }
}
