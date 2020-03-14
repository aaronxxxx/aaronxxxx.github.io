<?php
namespace app\modules\general\event\controllers;

use Yii;
use app\common\data\Pagination;
use app\common\base\BaseController;
use app\modules\general\event\models\EventPlayer;

/**
 * player controller for the event module
 */
class PlayerController extends BaseController
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
        $eventPlayer = EventPlayer::find()
            ->orderBy([
                'type' => SORT_ASC,
                'title' => SORT_ASC
            ]);

        $pages = new Pagination([
            'totalCount' => $eventPlayer->count(),
            'pageSize' => $this->pageSize
        ]);
        $list = $eventPlayer
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
                    $dest = '_uploads/team' . $dateTime . '.' . $tempName[count($tempName) - 1];
                    move_uploaded_file($file, $dest);

                    //同步複製至前端資料夾位置
                    copy($dest, '../../frontend/web/' . $dest);
                    $data['img_url'] = '/' . $dest;
                }

                $eventPlayer = new EventPlayer();
                $eventPlayer->status = $data['status'] ? $data['status'] : 1;
                $eventPlayer->title = $data['title'];
                $eventPlayer->type = $data['type'];

                if ( !empty($data['img_url']) ) {
                    $eventPlayer->img_url = $data['img_url'];
                }

                $eventPlayer->summary = $data['summary'];
                $eventPlayer->link1 = $data['link1'];
                $eventPlayer->link2 = $data['link2'];
                $eventPlayer->link3 = $data['link3'];
                $eventPlayer->create_time = date('Y-m-d H:i:s');

                if ( $eventPlayer->save(false) ) {
                    Yii::$app->session->setFlash('success', "新增成功");

                    return $this->redirect('/#/event/player');
                }

                Yii::$app->session->setFlash('error', "新增失敗");

                return $this->redirect('/#/event/player');
            } else {
                Yii::$app->session->setFlash('error', $fieldCheck);

                return $this->redirect('/#/event/player/add');
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
                $eventPlayer = EventPlayer::findOne(['id' => $data['editId']]);

                #啟動資料上傳動作，使用name = img， 預設路徑為 /_uploads/*
                if ( !empty($_FILES['img']['size']) ) {

                    $tempName = explode(".",$_FILES['img']['name']);
                    $file = $_FILES['img']['tmp_name'];
                    $dateTime = date('YmdHis');
                    $dest = '_uploads/team'.$dateTime.'.'.$tempName[count($tempName)-1];
                    move_uploaded_file($file, $dest);

                    //同步複製至前端資料夾位置
                    copy($dest, '../../frontend/web/'.$dest);
                    $data['img_url'] = '/'.$dest;

                }

                if ($eventPlayer) {
                    $eventPlayer->status = $data['status'] ? $data['status'] : 1;
                    $eventPlayer->title = $data['title'];
                    $eventPlayer->type = $data['type'];

                    if( !empty($data['img_url']) ){
                        $eventPlayer->img_url = $data['img_url'];
                    }

                    $eventPlayer->summary = $data['summary'];
                    $eventPlayer->link1 = $data['link1'];
                    $eventPlayer->link2 = $data['link2'];
                    $eventPlayer->link3 = $data['link3'];
                    $eventPlayer->modify_time = date("Y-m-d H:i:s");

                    if ($eventPlayer->save()) {
                        Yii::$app->session->setFlash('success', "修改成功");

                        return $this->redirect('/#/event/player');
                    }

                    Yii::$app->session->setFlash('error', "修改失敗");

                    return $this->redirect('/#/event/player');
                }
            } else {
                Yii::$app->session->setFlash('error', $fieldCheck);

                return $this->redirect('/#/event/player/edit&id='.$data['editId']);
            }
        }

        $eventPlayer = EventPlayer::find()
            ->where(['id' => $id])
            ->asArray()
            ->one();

        return $this->render('edit', [
            'data' => $eventPlayer,
            'type' => $this->type
        ]);
    }

    //刪除
    public function actionDelete()
    {
		$id = $this->getParam('id', -1000);
        $eventPlayer = EventPlayer::findOne(['id' => $id]);

        if ($eventPlayer) {
			if ($eventPlayer->delete()) {
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
        if (!$data['title']) {
            $result = '请输入名称';
            return $result;
        }

        return true;
    }
}
