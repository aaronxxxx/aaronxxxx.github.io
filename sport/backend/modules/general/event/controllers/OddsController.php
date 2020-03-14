<?php
namespace app\modules\general\event\controllers;

use Yii;
use app\common\base\BaseController;
use app\modules\general\event\models\EventOfficial;
use app\modules\general\event\models\EventPlayer;
use app\modules\general\event\models\EventMultipleOdds;
use app\modules\general\event\models\EventTwopkOdds;

/**
 * odds controller for the event module
 */
class OddsController extends BaseController
{
    public $eventPlayer = [];

    public function init()
    {
        parent::init();
        $this->layout = false; //後台必備 將layout移除

        $this->eventPlayer = EventPlayer::find()
            ->asArray()
            ->all();
    }

    public function actionIndex()
    {
        $id = $this->getParam('id', '');

        $eventOfficial = EventOfficial::find()
            ->where(['id' => $id])
            ->asArray()
            ->one();

        if (!$eventOfficial) {
            echo "
                <script>
                    $(function(){
                        alert('查无资讯');
                        location.href='/#/event/official/index';
                    })
                </script>";
            exit;
        }

        $twopk = EventTwopkOdds::getAllByOfficial($id);
        $multiple = EventMultipleOdds::getAllByOfficial($id);

        foreach ($this->eventPlayer as $key => $val) {
            $player[$val['id']] = $val['title'];
        }

        return $this->render('index', [
            'data' => $eventOfficial,
            'twopk' => $twopk,
            'multiple' => $multiple,
            'player' => $player
        ]);
    }

    //兩方比賽 單筆修改
    public function actionTwopkone()
    {
        $editId = $this->getParam('editId', '');

        if ($editId) {
            $data['player1_odds'] = $this->getParam('player1_odds', '');
            $data['player2_odds'] = $this->getParam('player2_odds', '');
            $data['adj_basic'] = $this->getParam('adj_basic', '');
            $data['start_amount'] = $this->getParam('start_amount', '');

            $fieldCheck = $this->fieldCheck($data);

            if ($fieldCheck === true) {
                $eventOdds = EventTwopkOdds::findOne(['id' => $editId]);

                if ($eventOdds) {
                    $eventOdds->player1_odds = $data['player1_odds'];
                    $eventOdds->player2_odds = $data['player2_odds'];
                    $eventOdds->adj_basic = $data['adj_basic'];
                    $eventOdds->start_amount = $data['start_amount'];
                    $eventOdds->modify_time = date("Y-m-d H:i:s");

                    if ($eventOdds->save()) {
                        return $this->out(true , '修改成功');
                    } else {
                        return $this->out(false , '修改失败');
                    }
                }
            } else {
                return $this->out(false , $fieldCheck);
            }
        }

        return $this->redirect('/#/event/official');
    }

    //兩方比賽 多筆修改
    public function actionTwopkall()
    {
        $data = Yii::$app->request->post();

        if ($data) {
            $fieldCheck = $this->fieldCheck($data);

            if ($fieldCheck === true) {
                foreach ($data as $key => $val) {
                    $array = explode("-", $key);
                    $update[$array[0]][$array[1]] = $val;
                }

                foreach ($update as $key => $val) {
                    try {
                        $eventOdds = EventTwopkOdds::findOne(['id' => $key]);

                        if ($eventOdds) {
                            $eventOdds->player1_odds = $val['player1_odds'];
                            $eventOdds->player2_odds = $val['player2_odds'];
                            $eventOdds->adj_basic = $val['adj_basic'];
                            $eventOdds->start_amount = $val['start_amount'];
                            $eventOdds->modify_time = date("Y-m-d H:i:s");

                            $eventOdds->save();
                        }
                    } catch (Exception $e) {
                        Yii::$app->session->setFlash('error', "修改失败");

                        return $this->redirect('/#/event/official');
                    }
                }

                Yii::$app->session->setFlash('success', "修改成功");

                return $this->redirect('/#/event/official');
            } else {
                Yii::$app->session->setFlash('error', $fieldCheck);

                return $this->redirect('/#/event/official');
            }
        }

        return $this->redirect('/#/event/official');
    }

    //多項目 單筆修改
    public function actionMultipleone()
    {
        $editId = $this->getParam('editId', '');

        if ($editId) {
            $data['win_rate'] = $this->getParam('win_rate', '');
            $data['odds'] = $this->getParam('odds', '');

            $fieldCheck = $this->fieldCheck($data);

            if ($fieldCheck === true) {
                $eventMultipleOdds = EventMultipleOdds::findOne(['id' => $editId]);

                if ($eventMultipleOdds) {
                    $eventMultipleOdds->win_rate = $data['win_rate'];
                    $eventMultipleOdds->odds = $data['odds'];

                    if ($eventMultipleOdds->save()) {
                        return $this->out(true , '修改成功');
                    } else {
                        return $this->out(false , '修改失败');
                    }
                }
            } else {
                return $this->out(false , $fieldCheck);
            }
        }

        return $this->redirect('/#/event/official');
    }

    //多項目 多筆修改
    public function actionMultipleall()
    {
        $data = Yii::$app->request->post();

        if ($data) {
            $fieldCheck = $this->fieldCheck($data);

            if ($fieldCheck === true) {
                foreach ($data as $key => $val) {
                    $array = explode("-", $key);
                    $update[$array[0]][$array[1]] = $val;
                }

                foreach ($update as $key => $val) {
                    try {
                        $eventMultipleOdds = EventMultipleOdds::findOne(['id' => $key]);

                        if ($eventMultipleOdds) {
                            $eventMultipleOdds->win_rate = $val['win_rate'];
                            $eventMultipleOdds->odds = $val['odds'];

                            $eventMultipleOdds->save();
                        }
                    } catch (Exception $e) {
                        Yii::$app->session->setFlash('error', "修改失败");

                        return $this->redirect('/#/event/official');
                    }
                }

                Yii::$app->session->setFlash('success', "修改成功");

                return $this->redirect('/#/event/official');
            } else {
                Yii::$app->session->setFlash('error', $fieldCheck);

                return $this->redirect('/#/event/official');
            }
        }

        return $this->redirect('/#/event/official');
    }

    public function fieldCheck($data)
    {
        foreach ($data as $key => $val) {
            if (!$val) {
                $result = '各栏位数值不能为空';
                return $result;
            }

            if (!is_numeric($val)) {
                $result = '请输入正确的数值';
                return $result;
            }
        }

        return true;
    }
}
