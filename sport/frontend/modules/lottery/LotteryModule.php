<?php

namespace app\modules\lottery;

use Yii;
use yii\base\Module;

class LotteryModule extends Module {
    private $_assetsUrl;
    
    public function init()
    {
        parent::init();

        $this->modules = [
            'lzcqsf' => ['class' => 'app\modules\lottery\modules\lzcqsf\CqsfModule'],
            'lzcqssc' => ['class' => 'app\modules\lottery\modules\lzcqssc\CqsscModule'],
            'lzfc3d' => ['class' => 'app\modules\lottery\modules\lzfc3d\Fc3dModule'],
            'lzgd11' => ['class' => 'app\modules\lottery\modules\lzgd11\Gd11Module'],
            'lzgdsf' => ['class' => 'app\modules\lottery\modules\lzgdsf\GdsfModule'],
            'lzgxsf' => ['class' => 'app\modules\lottery\modules\lzgxsf\GxsfModule'],
            'lzkl8' => ['class' => 'app\modules\lottery\modules\lzkl8\Kl8Module'],
            'lzpk10' => ['class' => 'app\modules\lottery\modules\lzpk10\Pk10Module'],
            'lzpl3' => ['class' => 'app\modules\lottery\modules\lzpl3\Pl3Module'],
            'lzshssl' => ['class' => 'app\modules\lottery\modules\lzshssl\ShsslModule'],
            'lztjsf' => ['class' => 'app\modules\lottery\modules\lztjsf\TjsfModule'],
            'lztjssc' => ['class' => 'app\modules\lottery\modules\lztjssc\TjsscModule'], 
            'lzssrc' => ['class' => 'app\modules\lottery\modules\lzssrc\SsrcModule'],
            'lzmlaft' => ['class' => 'app\modules\lottery\modules\lzmlaft\MlaftModule'],
            'lzts5' => ['class' => 'app\modules\lottery\modules\lzts5\Ts5Module'],
            'lzorpk' => ['class' => 'app\modules\lottery\modules\lzorpk\OrpkModule'],
        ];
    }
    
    /**
     * 获取assetsUrl
     * @return string
     */
    public function getAssetsUrl() {
        if ($this->_assetsUrl === null) {
            $this->_assetsUrl = Yii::$app
                    ->getAssetManager()
                    ->publish(Yii::getAlias('@lottery/assets'), [
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
