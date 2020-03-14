<?php
namespace app\modules\general\mobile;
use Yii;
use yii\base\Module;
class MobileModule extends Module {
    private $_assetsUrl;  
	public function init()
    {
        parent::init();
        Yii::$app->params['sport_et_time'] = time() -1 * 12 * 3600;
    }
    /**
     * 获取assetsUrl
     * @return string
     */
    public function getAssetsUrl() {
        if ($this->_assetsUrl === null) {
            $this->_assetsUrl = Yii::$app
                    ->getAssetManager()
                    ->publish(Yii::getAlias('@mobile/assets'), [
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
