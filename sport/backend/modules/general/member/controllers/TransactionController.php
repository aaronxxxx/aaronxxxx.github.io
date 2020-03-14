<?php

namespace app\modules\general\member\controllers;

use app\common\base\BaseController;
use app\common\data\Pagination;
use app\modules\general\member\models\DepositCallback;
use Exception;
use Yii;

class TransactionController extends BaseController
{
    public $pageSize;

    public function init()
    {
        parent::init();

        $this->layout = false;

        $this->pageSize = 20;

    }

    public function actionDepositLog()
    {   
        $data['startTime'] = $this->getParam('startTime', '');
        $data['endTime'] = $this->getParam('endTime', '');
        $data['orderNum'] = $this->getParam('orderNum', '');

        $requestLog = DepositCallback::getAll($data['startTime'], $data['endTime'], $data['orderNum']);
        
        $pages = new Pagination([
            'totalCount' => $requestLog->count(),
            'pageSize' => $this->pageSize
        ]);

        $list = $requestLog
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();

        return $this->render('deposit-log', [
            'pages' => $pages,
			'list' => $list,
			'startTime' => $data['startTime'],
			'endTime' => $data['endTime'],
            'orderNum' => $data['orderNum']
        ]);

    }
}