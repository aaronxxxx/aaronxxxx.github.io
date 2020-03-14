<?php
namespace app\modules\general\event\controllers;

use Yii;
use app\common\data\Pagination;
use app\common\base\BaseController;
use app\modules\general\event\models\EventOfficial;

/**
 * official controller for the event module
 */
class OfficialController extends BaseController
{
    public $type = [];
    public $pageSize;

    public function init()
    {
        parent::init();
        $this->layout = false; //後台必備 將layout移除

        $this->pageSize = 20;

        $this->type = [
            '01' => '足球',
            '02' => '篮球',
            '03' => '棒球',
            '04' => '排球',
            '05' => '冰球',
            '06' => '桌球',
            '07' => '网球',
            '08' => '手球',
            '09' => '美足',
            '10' => '羽毛球',
            '11' => '其他'
        ];
    }

    public function actionIndex()
    {
        $eventOfficial = EventOfficial::find()
            ->orderBy([
                'kaipan_time' => SORT_DESC,
                'type' => SORT_ASC,
                'title' => SORT_ASC
            ]);

        $pages = new Pagination([
            'totalCount' => $eventOfficial->count(),
            'pageSize' => $this->pageSize
        ]);
        $list = $eventOfficial
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();

        return $this->render('index', [
            'list' => $list,
            'pages' => $pages,
            'type' => $this->type
        ]);
    }

    //新增
    public function actionAdd()
    {
        $data = Yii::$app->request->post();

        if ($data) {
            $fieldCheck = $this->fieldCheck($data);

            if ($fieldCheck === true) {
                #啟動資料上傳動作，使用name = img， 預設路徑為 /_uploads/*
                if ( !empty($_FILES['img']['size']) ) {
                    $tempName = explode(".", $_FILES['img']['name']);
                    $file = $_FILES['img']['tmp_name'];
                    $dateTime = date('YmdHis');
                    $dest = '_uploads/official' . $dateTime . '.' . $tempName[count($tempName) - 1];
                    move_uploaded_file($file, $dest);

                    //同步複製至前端資料夾位置
                    copy($dest, '../../frontend/web/' . $dest);
                    $data['img_url'] = '/' . $dest;
                }

                $eventOfficial = new EventOfficial();
                $eventOfficial->status = $data['status'] ? $data['status'] : 1;
                $eventOfficial->qishu = $data['qishu'];
                $eventOfficial->title = $data['title'];
                $eventOfficial->type = $data['type'];
                $eventOfficial->kaipan_time = $data['kaipan_time'];
                $eventOfficial->fenpan_time = $data['fenpan_time'];
                $eventOfficial->kaijiang_time = $data['kaijiang_time'];

                if ( !empty($data['img_url']) ) {
                    $eventOfficial->img_url = $data['img_url'];
                }

                $eventOfficial->summary = $data['summary'];
                $eventOfficial->remarks = $data['remarks'];
                $eventOfficial->create_time = date("Y-m-d H:i:s");

                if ($eventOfficial->save()) {
                    Yii::$app->session->setFlash('success', "新增成功");

                    return $this->redirect('/#/event/official');
                }

                Yii::$app->session->setFlash('error', "新增失败");

                return $this->redirect('/#/event/official');
            } else {
                Yii::$app->session->setFlash('error', $fieldCheck);

                return $this->redirect('/#/event/official/add');
            }
        }

        return $this->render('add', ['type' => $this->type]);
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
                    $dest = '_uploads/official' . $dateTime . '.' . $tempName[count($tempName) - 1];
                    move_uploaded_file($file, $dest);

                    //同步複製至前端資料夾位置
                    copy($dest, '../../frontend/web/' . $dest);
                    $data['img_url'] = '/' . $dest;
                }

                $eventOfficial = EventOfficial::findOne(['id' => $data['editId']]);

                if ($eventOfficial) {
                    $eventOfficial->status = $data['status'] ? $data['status'] : 1;
                    $eventOfficial->qishu = $data['qishu'];
                    $eventOfficial->title = $data['title'];
                    $eventOfficial->type = $data['type'];
                    $eventOfficial->kaipan_time = $data['kaipan_time'];
                    $eventOfficial->fenpan_time = $data['fenpan_time'];
                    $eventOfficial->kaijiang_time = $data['kaijiang_time'];

                    if ( !empty($data['img_url']) ) {
                        $eventOfficial->img_url = $data['img_url'];
                    }

                    $eventOfficial->summary = $data['summary'];
                    $eventOfficial->remarks = $data['remarks'];
                    $eventOfficial->modify_time = date("Y-m-d H:i:s");

                    if ($eventOfficial->save()) {
                        Yii::$app->session->setFlash('success', "修改成功");

                        return $this->redirect('/#/event/official');
                    }

                    Yii::$app->session->setFlash('error', "修改失败");

                    return $this->redirect('/#/event/official');
                }
            } else {
                Yii::$app->session->setFlash('error', $fieldCheck);

                return $this->redirect('/#/event/official/edit&id='.$data['editId']);
            }
        }

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

        return $this->render('edit', [
            'data' => $eventOfficial,
            'type' => $this->type
        ]);
    }

    //刪除
    public function actionDelete()
    {
		$id = $this->getParam('id', -1000);
        $eventOfficial = EventOfficial::findOne(['id' => $id]);

        if ($eventOfficial) {
			if ($eventOfficial->delete()) {
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
            if (!preg_match("/^[A-Za-z0-9]+$/", $data['qishu'])) {
                $result = '请输入正确的期数';
                return $result;
            }

            if (isset($data['editId'])) {
                $eventOfficial = EventOfficial::find()
                    ->where(['qishu' => $data['qishu']])
                    ->andWhere(['<>', 'id', $data['editId']])
                    ->one();

                if ($eventOfficial) {
                    $result = '已重复的期数';
                    return $result;
                }
            }
        } else {
            $result = '请输入期数';
            return $result;
        }

        if (!$data['title']) {
            $result = '请输入名称';
            return $result;
        }

        if (!$data['kaipan_time']) {
            $result = '请输入开盘时间';
            return $result;
        }

        if (!$data['fenpan_time']) {
            $result = '请输入封盘时间';
            return $result;
        }

        if (!$data['kaijiang_time']) {
            $result = '请输入开奖时间';
            return $result;
        }

        if ($data['kaipan_time'] >= $data['fenpan_time']) {
            $result = '请输入正确的开封盘时间';
            return $result;
        }

        if ($data['fenpan_time'] >= $data['kaijiang_time']) {
            $result = '请输入正确的开奖时间';
            return $result;
        }

        return true;
    }
}
