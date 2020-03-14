<?php
namespace app\modules\general\event\controllers;

use Yii;
use app\common\data\Pagination;
use app\common\base\BaseController;
use app\modules\general\event\models\EventOfficial;
use app\modules\general\event\models\EventPlayer;
use app\modules\general\event\models\EventMultiple;
use app\modules\general\event\models\EventMultipleOdds;

/**
 * multiple controller for the event module
 */
class MultipleController extends BaseController
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

        $eventMultiple = EventMultiple::getAll($oid);

        $pages = new Pagination([
            'totalCount' => $eventMultiple->count(),
            'pageSize' => $this->pageSize
        ]);
        $list = $eventMultiple
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();

        return $this->render('index', [
            'oid' => $oid,
            'list' => $list,
            'pages' => $pages,
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
                    $dest = '_uploads/multiple' . $dateTime . '.' . $tempName[count($tempName) - 1];
                    move_uploaded_file($file, $dest);

                    //同步複製至前端資料夾位置
                    copy($dest, '../../frontend/web/' . $dest);
                    $data['img_url'] = '/' . $dest;
                }

                $eventMultiple = new EventMultiple();
                $eventMultiple->status = $data['status'] ? $data['status'] : 1;
                $eventMultiple->official_id = $data['official_id'];
                $eventMultiple->qishu = $data['qishu'];
                $eventMultiple->title = $data['title'];
                $eventMultiple->fs = $data['fs'];

                if ( !empty($data['img_url']) ) {
                    $eventMultiple->img_url = $data['img_url'];
                }

                $eventMultiple->summary = $data['summary'];
                $eventMultiple->remarks = $data['remarks'];
                $eventMultiple->create_time = date("Y-m-d H:i:s");

                if ($eventMultiple->save()) {
                    if (isset($data['newMulItem'])) {
                        foreach ($data['newMulItem']['status'] as $key => $val) {
                            $insert[$key]['official_id'] = $data['official_id'];
                            $insert[$key]['multiple_id'] = $eventMultiple->getPrimaryKey();
                            $insert[$key]['status'] = $val;
                        }
                        foreach ($data['newMulItem']['title'] as $key => $val) {
                            $insert[$key]['title'] = $val;
                        }
                        foreach ($data['newMulItem']['win_rate'] as $key => $val) {
                            $insert[$key]['win_rate'] = $val;
                        }
                        foreach ($data['newMulItem']['odds'] as $key => $val) {
                            $insert[$key]['odds'] = $val;
                        }

                        EventMultipleOdds::deleteAll('multiple_id ='.$eventMultiple->getPrimaryKey());
                        $column = ['official_id', 'multiple_id', 'status', 'title', 'win_rate', 'odds'];
                        $insertCount = Yii::$app->db->createCommand()
                            ->batchInsert('event_multiple_odds', $column, $insert)
                            ->execute();

                        if ($insertCount) {
                            Yii::$app->session->setFlash('success', "新增成功");

                            return $this->redirect('/#/event/multiple/index&oid=' . $data['official_id']);
                        }
                    }
                }

                Yii::$app->session->setFlash('error', "新增失敗");

                return $this->redirect('/#/event/multiple/index&oid=' . $data['official_id']);
            } else {
                Yii::$app->session->setFlash('error', $fieldCheck);

                return $this->redirect('/#/event/multiple/add');
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
                    $dest = '_uploads/multiple' . $dateTime . '.' . $tempName[count($tempName) - 1];
                    move_uploaded_file($file, $dest);

                    //同步複製至前端資料夾位置
                    copy($dest, '../../frontend/web/' . $dest);
                    $data['img_url'] = '/' . $dest;
                }

                $eventMultiple = EventMultiple::findOne(['id' => $data['editId']]);

                if ($eventMultiple) {
                    $eventMultiple->status = $data['status'] ? $data['status'] : 1;
                    $eventMultiple->official_id = $data['official_id'];
                    $eventMultiple->qishu = $data['qishu'];
                    $eventMultiple->title = $data['title'];
                    $eventMultiple->fs = $data['fs'];

                    if ( !empty($data['img_url']) ) {
                        $eventMultiple->img_url = $data['img_url'];
                    }

                    $eventMultiple->summary = $data['summary'];
                    $eventMultiple->remarks = $data['remarks'];
                    $eventMultiple->modify_time = date("Y-m-d H:i:s");

                    if ($eventMultiple->save()) {
                        if (isset($data['mulItem'])) {
                            foreach ($data['mulItem'] as $key => $val) {
                                $eventMultipleOdds = EventMultipleOdds::findOne(['id' => $key]);

                                if ($eventMultipleOdds) {
                                    $eventMultipleOdds->official_id = $data['official_id'];
                                    $eventMultipleOdds->status = $val['status'];
                                    $eventMultipleOdds->title = $val['title'];
                                    $eventMultipleOdds->win_rate = $val['win_rate'];
                                    $eventMultipleOdds->odds = $val['odds'];
                                    $eventMultipleOdds->save();
                                }
                            }

                            $keys = array_keys($data['mulItem']);
                            EventMultipleOdds::deleteAll([
                                'and',
                                'multiple_id =' . $data['editId'],
                                ['not in', 'id', $keys]
                            ]);
                        }

                        if (isset($data['newMulItem'])) {
                            foreach ($data['newMulItem']['status'] as $key => $val) {
                                $insert[$key]['official_id'] = $data['official_id'];
                                $insert[$key]['multiple_id'] = $data['editId'];
                                $insert[$key]['status'] = $val;
                            }
                            foreach ($data['newMulItem']['title'] as $key => $val) {
                                $insert[$key]['title'] = $val;
                            }
                            foreach ($data['newMulItem']['win_rate'] as $key => $val) {
                                $insert[$key]['win_rate'] = $val;
                            }
                            foreach ($data['newMulItem']['odds'] as $key => $val) {
                                $insert[$key]['odds'] = $val;
                            }

                            $mulItemCheck = $this->mulItemCheck($insert);

                            if ($mulItemCheck === true) {
                                $column = ['official_id', 'multiple_id', 'status', 'title', 'win_rate', 'odds'];
                                $insertCount = Yii::$app->db->createCommand()
                                    ->batchInsert('event_multiple_odds', $column, $insert)
                                    ->execute();

                                if (!$insertCount) {
                                    Yii::$app->session->setFlash('error', "修改失敗");

                                    return $this->redirect('/#/event/multiple/index&oid=' . $data['official_id']);
                                }
                            } else {
                                Yii::$app->session->setFlash('error', $mulItemCheck);

                                return $this->redirect('/#/event/multiple/edit&id='.$data['editId']);
                            }
                        }

                        Yii::$app->session->setFlash('success', "修改成功");

                        return $this->redirect('/#/event/multiple/index&oid=' . $data['official_id']);
                    }
                }

                Yii::$app->session->setFlash('error', "修改失敗");

                return $this->redirect('/#/event/multiple/index&oid=' . $data['official_id']);
            } else {
                Yii::$app->session->setFlash('error', $fieldCheck);

                return $this->redirect('/#/event/multiple/edit&id='.$data['editId']);
            }
        }

        $eventMultiple = EventMultiple::find()
            ->where(['id' => $id])
            ->asArray()
            ->one();
        $eventMultipleOdds = EventMultipleOdds::find()
            ->where(['multiple_id' => $id])
            ->orderBy(['title' => SORT_ASC])
            ->asArray()
            ->all();

        return $this->render('edit', [
            'data' => $eventMultiple,
            'mulItem' => $eventMultipleOdds,
            'player' => $this->eventPlayer,
            'official' => $this->eventOfficial
        ]);
    }

    //刪除
    public function actionDelete()
    {
		$id = $this->getParam('id', -1000);
        $eventMultiple = EventMultiple::findOne(['id' => $id]);

        if ($eventMultiple) {
            EventMultipleOdds::deleteAll('multiple_id ='.$id);

			if ($eventMultiple->delete()) {
				return $this->out(true , '删除成功');
			}
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

        if (!$data['title']) {
            $result = '请输入标题';
            return $result;
        }

        if ($data['fs']) {
            if (!is_numeric($data['fs'])) {
                $result = '请输入正确的反水';
                return $result;
            }
        } else {
            $result = '请输入反水';
            return $result;
        }

        return true;
    }

    public function mulItemCheck($data)
    {
        foreach ($data as $key => $val) {
            if (!$val['title']) {
                $result = '项目 ' . ($key + 1) . ' 请输入名称';
                return $result;
            }

            if ($val['win_rate']) {
                if (!is_numeric($val['win_rate'])) {
                    $result = '项目 ' . ($key + 1) . ' 请输入正确的胜率';
                    return $result;
                }
            } else {
                $result = '项目 ' . ($key + 1) . ' 请输入胜率';
                return $result;
            }
        }

        return true;
    }
}
