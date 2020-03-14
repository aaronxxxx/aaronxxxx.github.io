<?php

namespace app\modules\live;

use Yii;
use yii\base\Module;

class LiveModule extends Module {
    private $_assetsUrl;
    
    public function init() {
        parent::init();
        
        // Yii::configure($this, require(__DIR__ . '/config/config.php'));
        //var_dump(Yii::$classMap);exit;
    }
    
    /**
     * 获取assetsUrl
     * @return string
     */
    public function getAssetsUrl() {
        if ($this->_assetsUrl === null) {
            $this->_assetsUrl = Yii::$app
                    ->getAssetManager()
                    ->publish(Yii::getAlias('@live/assets'), [
                        'except' => [
                            'AppAsset.php',
                        ],
                        'forceCopy' => YII_DEBUG
                    ]);
        }
        
        return $this->_assetsUrl;
    }

    /**
     * 设置assetsUrl
     * @param string $val   值
     */
    public function setAssetsUrl($val) {
        $this->_assetsUrl = $val;
    }
    
    /* ============================ 华丽的分割线 =============================== */

}
