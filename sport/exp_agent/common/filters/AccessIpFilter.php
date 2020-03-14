<?php

namespace app\common\filters;

use Yii;
use yii\base\ActionFilter;

/**
 * AccessIpFilter 访问ip过滤器
 */
class AccessIpFilter extends ActionFilter {

    public function beforeAction($action) {
        $whitelist = Yii::$app->params['whitelist'];
        if(!empty($whitelist) && count($whitelist) > 0) {
            $ip = Yii::$app->request->userIP;
            if(!in_array($ip, $whitelist)) {
                echo "403 Forbidden";
                return false;
            }
        }
        return parent::beforeAction($action);
    }

}

