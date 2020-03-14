<?php
namespace app\modules\general\event\controllers;

use Yii;
use app\common\data\Pagination;
use app\common\base\BaseController;
use app\modules\general\event\models\EventOfficial;
use app\modules\general\event\models\EventResult;
use app\modules\general\event\models\EventResultPk;
use app\modules\general\event\models\EventResultMultiple;
use app\modules\general\event\models\EventPlayer;
use app\modules\general\event\models\EventTwopk;
use app\modules\general\event\models\EventMultiple;
use app\modules\general\event\models\EventMultipleOdds;
use app\modules\general\event\models\EventTwopkOdds;

/**
 * official controller for the event module
 */
class ResultController extends BaseController
{
    public $type = [];
    public $pageSize;

    public $eventPlayer = [];

    public function init()
    {
        parent::init();
        $this->layout = false; //後台必備 將layout移除

        $this->eventPlayer = EventPlayer::find()
            ->asArray()
            ->all();
    }


    public function actionIndex(){
        $qishu = $this->getParam('qishu',0);
		$update = 0;
		$schedule = EventResult::find();
		if($qishu){
			$schedule->where(array('title'=>$qishu));
        }
        //取出所有資訊
        $list = $schedule->orderBy(['datetime'=>SORT_DESC])->asArray()->all();

        //組合需顯示資料
        $showPK = array();
        $showMulti = array();
        foreach ( $list as $key => $val ) {
            $showPK[$key] = EventResultPk::getResultData( $val['official_id'] );            
            $showMulti[$key] = EventResultMultiple::getResultData($val['official_id']);      
        }

		return $this->render('index',array(
			'list'=> $list,
			'showPK'=> $showPK,
			'showMulti'=> $showMulti,
            'qishu' => $qishu
		));
    }


    public function actionAdd(){
        $qishu = $this->getParam('qishu', '');

        if( empty($qishu) ){
            echo "
            <script>
                $(function(){
                    alert('请输入赛事名称');
                    location.href='/#/event/result/index';
                })
            </script>";
            exit;
        }
        
        //根據標題 搜尋賽事資訊
        $eventOfficial = EventOfficial::find()
            ->where(['title' => $qishu])
            ->asArray()
            ->one();

        if( empty($eventOfficial) ){
            echo "
            <script>
                $(function(){
                    alert('查无资讯');
                    location.href='/#/event/result/index';
                })
            </script>";
            exit;
        }


        //取得賽事內PK參與者
        $pk = EventTwopk::find()->where(['official_id' => $eventOfficial['id']])->asArray()->all();
        $idArray = array();

        foreach( $pk as $key => $val ){
            if( !in_array( $val['player1'], $idArray ) ) {
                $idArray[] = $val['player1'];
            }
            if( !in_array( $val['player2'], $idArray ) ) {
                $idArray[] = $val['player2'];
            }
        }
        $player = EventPlayer::find()->where(['id' => $idArray ])->asArray()->all();

        //取得賽事內多項目上下層級
        $multi = EventMultiple::find()->where(['official_id' => $eventOfficial['id']])->asArray()->all();

        foreach( $multi as $key => $val ){
            $multi[$key]['items'] = EventMultipleOdds::find()->where(['official_id' => $eventOfficial['id'], 'multiple_id' => $val['id'] ])->asArray()->all();

        }

        return $this->render('add', [
            'data' => $eventOfficial,
            'multiple' => $multi,
            'player' => $player
        ]);
    
    }

    public function actionModifyResult(){

        $data = Yii::$app->request->post();

        if( empty($data['official_id']) ){
            return $this->redirect('/#/event/result/index');
        }

        //根據標題 搜尋賽事資訊
        $eventOfficial = EventOfficial::find()
        ->where(['id' => $data['official_id']])
        ->asArray()
        ->one();

        if( empty($eventOfficial) ){
            return $this->redirect('/#/event/result/index');
        }

        $officialID = $data['official_id'];
        $nowTime =  date('Y-m-d H:i:s');
        $playerScore = array(); //寫入資料庫用各隊分數array
        $playerCheck = array(); //驗證用array
        $multiItem = array();  //寫入資料庫用多項目array
        $multiCheck = array();  //驗證用array

        foreach( $data as $key => $val ) {
            $temp = explode('-',$key);
            if ( !empty($temp[1]) ) {
                if( $temp[1] == 'player_score' ){
                    $playerScore [] = [ $officialID, $temp[0], $val, $nowTime ];
                    $playerCheck[] = $temp[0];
                } else if ( $temp[1] == 'multiple' ) {
                    $multiItem [] = [ $officialID, $temp[0], $val, $nowTime ];
                    $multiCheck[] = $temp[0];
                }
            }
        }

        // var_dump($playerScore);exit;

        if(!empty($playerScore)){
            Yii::$app->db->createCommand()->batchInsert('event_result_pk', ['official_id', 'player', 'score', 'create_time'],  
            $playerScore )->execute(); 
        }
        if(!empty($multiItem)){
            Yii::$app->db->createCommand()->batchInsert('event_result_multiple', ['official_id', 'multiple_id', 'item_id', 'create_time'],  
            $multiItem )->execute(); 
        }

        Yii::$app->db->createCommand()->insert('event_result', [ 
            'official_id' => $eventOfficial['id'], 
            'title' => $eventOfficial['title'],
            'datetime' => $eventOfficial['kaipan_time'],
            'create_time' => $nowTime
        ])->execute(); 

            echo "
            <script>
                    alert('新增成功');
                    location.href='/#/event/result/index';
            </script>";
        exit;

        
        //暫不驗證--------------------------------------------
        // //取得賽事內PK參與者
        // $pk = EventTwopk::find()->where(['official_id' => $eventOfficial['id']])->asArray()->all();
        // $pkArray = array();

        // foreach( $pk as $key => $val ){
        //     if( !in_array( $val['player1'], $idArray ) ) {
        //         $idArray[] = $val['player1'];
        //     }
        //     if( !in_array( $val['player2'], $idArray ) ) {
        //         $idArray[] = $val['player2'];
        //     }
        // }

        // //取得賽事內多項目上下層級
        // $multi = EventMultiple::find()->where(['official_id' => $eventOfficial['id']])->asArray()->all();
        // $multiArray = array();

        // foreach( $multi as $key => $val ){
        //     if( !in_array( $val['player1'], $multiArray ) ) {
        //         $multiArray[] = $val['player1'];
        //     }
        //     if( !in_array( $val['player2'], $multiArray ) ) {
        //         $multiArray[] = $val['player2'];
        //     }
        // }



    }


}
