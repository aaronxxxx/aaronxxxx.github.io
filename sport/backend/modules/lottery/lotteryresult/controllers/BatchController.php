<?php
namespace app\modules\lottery\lotteryresult\controllers;

use Yii;
use app\common\data\Pagination;
use app\common\base\BaseController;
use app\modules\general\admin\models\ManageLog;
use app\modules\spsix\models\LotteryResultSplhc;
use app\modules\lottery\lotteryresult\model\LotteryResultCq;
use app\modules\lottery\lotteryresult\model\LotteryResultOrpk;
use app\modules\lottery\lotteryresult\model\LotteryResultSsrc;
use app\common\controllers\BatchAwardBuildController as BatchAwardBuild;
use app\common\controllers\SpsixBatchAwardBuildController as SpsixBatchAwardBuild;

class BatchController extends BaseController
{
    public $layout = false;
    public $configs;
    public $ballsName;
    public $ballsStyle;
    public $fields;

    public function init()
    {
        $this->configs = [
            'SPSIX' => [
                'name' => '极速六合彩',
                'startNumber' => 1,
                'endNumber' => 49,
                'awardBalls' => 7,
                'lottery_frequency' => 300,
                'last_qishu' => 216,  // 最後一期開獎期數
                'table' => 'lottery_result_splhc',
                'build_type' => 2,  // 開獎產生方式
            ],
            'ORPK' => [
                'name' => '老PK拾',
                'startNumber' => 1,
                'endNumber' => 10,
                'awardBalls' => 10,
                'lottery_frequency' => 300,
                'last_qishu' => '0168',  // 最後一期開獎期數
                'table' => 'lottery_result_orpk',
                'build_type' => 1  // 開獎產生方式
            ],
            'SSRC' => [
                'name' => '极速赛车',
                'startNumber' => 1,
                'endNumber' => 10,
                'awardBalls' => 10,
                'lottery_frequency' => 90,
                'last_qishu' => '0720',  // 最後一期開獎期數
                'table' => 'lottery_result_ssrc',
                'build_type' => 1,  // 開獎產生方式
            ],
            'TJ' => [
                'name' => '极速时时彩',
                'startNumber' => 0,
                'endNumber' => 9,
                'awardBalls' => 5,
                'lottery_frequency' => 108,
                'last_qishu' => 800,  // 最後一期開獎期數
                'table' => 'lottery_result_tj',
                'build_type' => 2  // 開獎產生方式
            ]
        ];

        $this->ballsName = [
            'SPSIX' => [
                '1' => '正码一',
                '2' => '正码二',
                '3' => '正码三',
                '4' => '正码四',
                '5' => '正码五',
                '6' => '正码六',
                '7' => '特别号'
            ],
            'ORPK' => [
                '1' => '冠军',
                '2' => '亚军',
                '3' => '第三名',
                '4' => '第四名',
                '5' => '第五名',
                '6' => '第六名',
                '7' => '第七名',
                '8' => '第八名',
                '9' => '第九名',
                '10' => '第十名'
            ],
            'TJ' => [
                '1' => '第一球',
                '2' => '第二球',
                '3' => '第三球',
                '4' => '第四球',
                '5' => '第五球'
            ]
        ];

        $this->ballsStyle = [
            'SPSIX' => [
                '/public/common/images/Lottery/lhc/'
            ],
            'ball_5' => [
                '/public/lottery/images/ball_5/'
            ],
            'ball_bjpk10' => [
                '/public/lottery/images/ball_bjpk10/'
            ]
        ];

        $this->fields = [
            '10' => [
                'qishu',
                'create_time',
                'datetime',
                'ball_1',
                'ball_2',
                'ball_3',
                'ball_4',
                'ball_5',
                'ball_6',
                'ball_7',
                'ball_8',
                'ball_9',
                'ball_10'
            ],
            '7' => [
                'qishu',
                'create_time',
                'datetime',
                'ball_1',
                'ball_2',
                'ball_3',
                'ball_4',
                'ball_5',
                'ball_6',
                'ball_7'
            ],
            '5' => [
                'qishu',
                'create_time',
                'datetime',
                'ball_1',
                'ball_2',
                'ball_3',
                'ball_4',
                'ball_5'
            ]
        ];
    }

    // 批量開獎
    public function actionIndex()
    {
        $lottery_type = $_GET['type'];
        $batch = isset($_GET['batch']) ? ($_GET['batch'] <= 30) ? $_GET['batch'] : 30 : 10;
        $rows = [];

        switch ($lottery_type) {
            case '极速六合彩':
                $gType = 'SPSIX';
                $config = $this->configs[$gType];
                $ballName = $this->ballsName[$gType];
                $ballStyle = $this->ballsStyle[$gType];
                $url = '/#/spsix/index/result';

                break;
            case '老PK拾':
                $gType = 'ORPK';
                $config = $this->configs[$gType];
                $ballName = $this->ballsName[$gType];
                $ballStyle = $this->ballsStyle['ball_bjpk10'];
                $url = '/#/lotteryresult/orpk/list&status=0&type=' . $config['name'];

                break;
            case '极速赛车':
                $gType = 'SSRC';
                $config = $this->configs[$gType];
                $ballName = $this->ballsName['ORPK'];
                $ballStyle = $this->ballsStyle['ball_bjpk10'];
                $url = '/#/lotteryresult/ssrc/list&status=0&type=' . $config['name'];

                break;
            case '极速时时彩':
                $gType = 'TJ';
                $config = $this->configs[$gType];
                $ballName = $this->ballsName[$gType];
                $ballStyle = $this->ballsStyle['ball_5'];
                $url = '/#/lotteryresult/ssc/list&status=0&type=' . $config['name'];

                break;
            default:
                echo "
                    <script>
                        alert('未设定的彩种');
                        location.href='/#/lotteryresult/ssc/list&status=0&type=极速时时彩';
                    </script>";
                die;

                break;
        }

        if ($gType == 'SPSIX') {
            $rows = SpsixBatchAwardBuild::awardBuild($gType, $config, $batch);
        } else {
            $rows = BatchAwardBuild::awardBuild($gType, $config, $batch);
        }

        if (count($rows) <= 0) {
            echo "
                <script>
                    alert('彩种尚未开盘');
                    location.href='" . $url . "';
                </script>";
            die;
        }

        return $this->render('index', [
            'ballName' => $ballName,
            'ballStyle' => $ballStyle,
            'lottery_type' => $config['name'],
            'startNumber' => $config['startNumber'],
            'endNumber' => $config['endNumber'],
            'awardBalls' => $config['awardBalls'],
            'rows' => $rows
        ]);
    }

    // 批量開獎寫入DB
    public function actionCreate()
    {
        $batch = $_POST['batch'];
        $lottery_type = $_POST['lottery_type'];
        $superpassword = isset($_POST["superpassword"]) ? $_POST["superpassword"] : "";
        $spc = trim(file_get_contents(Yii::$app->basePath . "/config/supperpassword"));

        if ($superpassword != $spc) {
            echo "
                <script>
                    alert('修改权限密码错误');
                    location.href='/#/lotteryresult/batch&type=" . $lottery_type . "';
                </script>";
            die;
        }

        if (count($batch) > 0) {
            $count = 0;
            $strQishu = '';

            switch ($lottery_type) {
                case '极速六合彩':
                    $gType = 'SPSIX';
                    $config = $this->configs[$gType];
                    $fieldArray = $this->fields[$config['awardBalls']];
                    $url = '/#/spsix/index/result';

                    break;
                case '老PK拾':
                    $gType = 'ORPK';
                    $config = $this->configs[$gType];
                    $fieldArray = $this->fields[$config['awardBalls']];
                    $url = '/#/lotteryresult/orpk/list&status=0&type=' . $config['name'];

                    break;
                case '极速赛车':
                    $gType = 'SSRC';
                    $config = $this->configs[$gType];
                    $fieldArray = $this->fields[$config['awardBalls']];
                    $url = '/#/lotteryresult/ssrc/list&status=0&type=' . $config['name'];

                    break;
                case '极速时时彩':
                    $gType = 'TJ';
                    $config = $this->configs[$gType];
                    $fieldArray = $this->fields[$config['awardBalls']];
                    $url = '/#/lotteryresult/ssc/list&status=0&type=' . $config['name'];

                    break;
                default:
                    echo "
                        <script>
                            alert('未设定的彩种');
                            location.href='/#/lotteryresult/ssc/list&status=0&type=极速时时彩';
                        </script>";
                    die;

                    break;
            }

            foreach ($batch as $key => $value) {
                // 檢查是否已開獎
                if ($config['name'] == '极速六合彩') {
                    $where['qishu'] = $value['qishu'];
                    $row = LotteryResultSplhc::find()
                        ->select('id')
                        ->where($where)
                        ->limit(1)
                        ->all();
                } elseif ($config['name'] == '老PK拾') {
                    $where['qishu'] = $value['qishu'];
                    $row = LotteryResultOrpk::Qishi($where);
                } elseif ($config['name'] == '极速赛车') {
                    $where['qishu'] = $value['qishu'];
                    $row = LotteryResultSsrc::Qishi($where);
                } elseif ($config['name'] == '极速时时彩') {
                    $row = LotteryResultCq::check_result('tj', $value['qishu']);
                }

                if ($row && $row['0']["id"]) {
                    echo "
                        <script>
                            alert('存在已开奖的彩票结果，请查询后再试！');
                            location.href='" . $url . "';
                        </script>";
                    die;
                }

                // 寫入DB
                if ($config['awardBalls'] == 10) {
                    $valueArray[] = [
                        'qishu' => $value['qishu'],
                        'create_time' => date('Y-m-d H:i:s'),
                        'datetime' => $value['kaijiang_time'],
                        'ball_1' => $value['ball_1'],
                        'ball_2' => $value['ball_2'],
                        'ball_3' => $value['ball_3'],
                        'ball_4' => $value['ball_4'],
                        'ball_5' => $value['ball_5'],
                        'ball_6' => $value['ball_6'],
                        'ball_7' => $value['ball_7'],
                        'ball_8' => $value['ball_8'],
                        'ball_9' => $value['ball_9'],
                        'ball_10' => $value['ball_10']
                    ];
                } elseif ($config['awardBalls'] == 7) {
                    $valueArray[] = [
                        'qishu' => $value['qishu'],
                        'create_time' => date('Y-m-d H:i:s'),
                        'datetime' => $value['kaijiang_time'],
                        'ball_1' => $value['ball_1'],
                        'ball_2' => $value['ball_2'],
                        'ball_3' => $value['ball_3'],
                        'ball_4' => $value['ball_4'],
                        'ball_5' => $value['ball_5'],
                        'ball_6' => $value['ball_6'],
                        'ball_7' => $value['ball_7']
                    ];
                } elseif ($config['awardBalls'] == 5) {
                    $valueArray[] = [
                        'qishu' => $value['qishu'],
                        'create_time' => date('Y-m-d H:i:s'),
                        'datetime' => $value['kaijiang_time'],
                        'ball_1' => $value['ball_1'],
                        'ball_2' => $value['ball_2'],
                        'ball_3' => $value['ball_3'],
                        'ball_4' => $value['ball_4'],
                        'ball_5' => $value['ball_5']
                    ];
                }

                $count++;
                $strQishu .= $value['qishu'] . ',';
            }

            try {
                $db = Yii::$app->db;
                $sql = $db->queryBuilder->batchInsert($config['table'], $fieldArray, $valueArray);
                $db->createCommand($sql)->execute();
            } catch (\Exception $e) {
                return $e;
            }

            $str = $config['name'] . '批量新增開獎' . $count . '期:' . $strQishu;
            ManageLog::saveLog(Yii::$app->getSession()->get('S_USER_NAME'), $str);
        }

        echo "
            <script>
                alert('发布成功');
                location.href='" . $url . "';
            </script>";
        die;
    }
}
