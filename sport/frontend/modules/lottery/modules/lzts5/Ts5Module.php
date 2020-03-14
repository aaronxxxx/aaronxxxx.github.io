<?php

namespace app\modules\lottery\modules\lzts5;

use Yii;
use yii\base\Module;

class Ts5Module extends Module {
    private $_assetsUrl;
    
    /**
     * 获取assetsUrl
     * @return string
     */
    public function getAssetsUrl() {
        if ($this->_assetsUrl === null) {
            $this->_assetsUrl = Yii::$app
                    ->getAssetManager()
                    ->publish(Yii::getAlias('@tjssc/assets'), [
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
