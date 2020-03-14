<?php

namespace app\modules\lottery\modules\lzgdsf;

use Yii;
use yii\base\Module;

class GdsfModule extends Module {
    private $_assetsUrl;
    
    /**
     * 获取assetsUrl
     * @return string
     */
    public function getAssetsUrl() {
        if ($this->_assetsUrl === null) {
            $this->_assetsUrl = Yii::$app
                    ->getAssetManager()
                    ->publish(Yii::getAlias('@gdsf/assets'), [
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
