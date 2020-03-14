<?php
namespace app\modules\general\activity\controllers;

use app\common\base\BaseController;
use app\modules\general\activity\models\ThemeSetting;

/**
 * Index controller for the activity module
 */
class IndexController extends BaseController
{

    public function init()
    {
        parent::init();
        $this->layout = false; //後台必備 將layout移除
    }

    public function actionIndex()
    {
        $this->layout = false;

        $list = ThemeSetting::getAll();

        return $this->render('index', ['list' => $list]);
    }

    //新增
    public function actionAdd()
    {
        $data['status'] = $this->getParam('status', '');
        $data['sort'] = $this->getParam('sort', '');
        $data['title'] = $this->getParam('title', '');
        $data['sub_title'] = $this->getParam('sub_title', '');
        $data['content'] = $this->getParam('content', '');
        $data['img_url'] = $this->getParam('img_url', '');

        $imgCheck = $this->imgCheck($data['img_url']);

        if ($imgCheck !== true) {
            return json_encode($imgCheck);
        }

        $fieldCheck = $this->fieldCheck($data);

        if ($fieldCheck === true) {
            $themeSetting = new ThemeSetting();
            $themeSetting->status = $data['status'] ? $data['status'] : 1;
            $themeSetting->sort = $data['sort'];
            $themeSetting->title = $data['title'];
            // $themeSetting->sub_title = $data['sub_title'];
            $themeSetting->content = $data['content'];
            $themeSetting->img_url = $data['img_url'];
            $themeSetting->type = 4;

            if ($themeSetting->save()) {
                return $this->out(true, '新增成功');
            } else {
                return $this->out(false, '新增失败');
            }
        } else {
            return json_encode($fieldCheck);
        }
    }

    //修改
    public function actionEdit()
    {
        $data['id'] = $this->getParam('id', -1000);
        $data['status'] = $this->getParam('status', '');
        $data['sort'] = $this->getParam('sort', '');
        $data['title'] = $this->getParam('title', '');
        $data['sub_title'] = $this->getParam('sub_title', '');
        $data['content'] = $this->getParam('content', '');
        $data['img_url'] = $this->getParam('img_url', '');

        $imgCheck = $this->imgCheck($data['img_url']);

        if ($imgCheck !== true) {
            return json_encode($imgCheck);
        }

        $fieldCheck = $this->fieldCheck($data);

        if ($fieldCheck === true) {
            $themeSetting = ThemeSetting::findOne(['id' => $data['id']]);

            if ($themeSetting) {
                $themeSetting->status = $data['status'] ? $data['status'] : 1;
                $themeSetting->sort = $data['sort'];
                $themeSetting->title = $data['title'];
                // $themeSetting->sub_title = $data['sub_title'];
                $themeSetting->content = $data['content'];
                $themeSetting->img_url = $data['img_url'];
                $themeSetting->type = 4;

                if ($themeSetting->save()) {
                    return $this->out(true , '修改成功');
                } else{
                    return $this->out(false , '修改失败');
                }
            }
        } else {
            return json_encode($fieldCheck);
        }
    }

    //刪除
    public function actionDelete()
    {
		$id = $this->getParam('id', -1000);
        $themeSetting = ThemeSetting::findOne(['id' => $id]);

        if ($themeSetting) {
			if ($themeSetting->delete()) {
				return $this->out(true , '删除成功');
			} else {
				return $this->out(false , '删除失败');
			}
        }
    }

    public function imgCheck($data)
    {
        $data = str_replace( 'https://', 'http://', $data);
        $img = @getimagesize($data);
        $img_type = @$img[2];

        if (!in_array($img_type, [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP])) {
            $result = ['msg' => '请勿使用非图片格式档案！！'];
            return $result;
        }

        return true;
    }

    public function fieldCheck($data)
    {
        if ($data['sort']) {
            if (!is_numeric($data['sort'])) {
                $result = ['msg' => '请输入正确的排序'];
                return $result;
            }
        } else {
            $result = ['msg' => '请输入排序'];
            return $result;
        }

        if (!$data['title']) {
            $result = ['msg' => '请输入标题'];
            return $result;
        }

        // if (!$data['sub_title']) {
        //     $result = ['msg' => '请输入副标'];
        //     return $result;
        // }

        if (!$data['content']) {
            $result = ['msg' => '请输入內容'];
            return $result;
        }

        return true;
    }
}
