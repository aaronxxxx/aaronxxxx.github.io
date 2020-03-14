<?php

namespace app\modules\lottery\modules\lzkl8;

use Yii;
use yii\base\Module;

class Kl8Module extends Module {
    private $_assetsUrl;
    
    /**
     * 获取assetsUrl
     * @return string
     */
    public function getAssetsUrl() {
        if ($this->_assetsUrl === null) {
            $this->_assetsUrl = Yii::$app
                    ->getAssetManager()
                    ->publish(Yii::getAlias('@kl8/assets'), [
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
}
