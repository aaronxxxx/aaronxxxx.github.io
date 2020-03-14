<?php

namespace app\modules\general\member;

/**
 * member module definition class
 */
class MemberModule extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\general\member\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
		$this->defaultRoute='index';
        // custom initialization code goes here
    }
}
