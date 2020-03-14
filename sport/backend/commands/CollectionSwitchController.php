<?php
/**
 * @auth ada
 * @date 2017-11-14 18:41
 * @descript Data Collection To Server
 */

namespace app\commands;

use Yii;
use yii\console\Controller;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CollectionSwitchController extends Controller
{
    public function actionIndex()
    {
        $collection_switch = file_get_contents(Yii::$app->basePath."/config/collection_switch");
		
        if((string)$collection_switch != '-1'){
            echo '210';
        }
        else {
            echo '234';
        }
    }
    public function actionSwitch($switch)
    {
        if($switch == '210')
        {
            file_put_contents(Yii::$app->basePath."/config/collection_switch", 0);
			echo '210 sucess';
        }else{
            file_put_contents(Yii::$app->basePath."/config/collection_switch", -1);
			echo '234 sucess';
        }
		
    }
}
