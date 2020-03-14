<?php
namespace app\modules\general\deploy\models;

use function Hprose\Future\all;
use yii;
/**
 * 功能描述:数据备份+还原操作
 * @Author:
 * @date:
*/
class MysqlBack {
    private $content;
    const DIR_SEP = DIRECTORY_SEPARATOR; //操作系统的目录分隔符

    /*
    * 备份文件
    * @access private
    */
    private function setFile(){
        $recognize = "D:/backend/mysqlbak/increment/".date('Ymd').'/';
        $fileName = $this->trimPath($recognize.date('YmdHis').'.sql');
        $path = $this->setPath($fileName);
        if($path !== true){
            $this->throwException("无法创建备份目录目录 '$path'");
        }else if(!file_put_contents($fileName, $this->content, LOCK_EX)){
            $this->throwException('写入文件失败,请检查磁盘空间或者权限!');
        }else{
            return $fileName;
        }
    }

    /*
    * 将路径修正为适合操作系统的形式
    * @param  string $path 路径名称
    * @return string
    */
    public function trimPath($path){
        return str_replace(array('/', '\\', '//', '\\\\'), self::DIR_SEP, $path);
    }

    /*
    * 设置并创建目录
    * @param $fileName 路径
    * @return mixed
    * @access private
    */
    private function setPath($fileName){
        $dirs = explode(self::DIR_SEP, dirname($fileName));
        $tmp = '';
        foreach ($dirs as $dir){
            $tmp .= $dir . self::DIR_SEP;
            if(!file_exists($tmp) && !@mkdir($tmp, 0777))
            return $tmp;
        }
        return true;
    }

    function dir_size($dir) {
        $dh = @opendir ( $dir ); // 打开目录，返回一个目录流
        $return = array ();
        while ( $file = @readdir ( $dh ) ) { // 循环读取目录下的文件
            if ($file != '.' and $file != '..') {
                $path = $dir . '/' . $file; // 设置目录，用于含有子目录的情况
                if (is_dir ( $path )) {
                } elseif (is_file ( $path )) {
                    $filetime [] = date ( "Y-m-d H:i:s", filemtime ( $path ) ); // 获取文件最近修改日期
                    $return [] = $file;
                }
            }
        }
        @closedir ( $dh ); // 关闭目录流
        array_multisort($filetime,SORT_DESC,SORT_STRING, $return);//按时间排序
        return $filetime[0]; // 返回文件
    }

    /**
    * 备份
    *
    * @access public
    */
    public function backup(){
        $connection = Yii::$app->db;
        $tables = ['money_log','order_lottery','order_lottery_sub','six_lottery_order','six_lottery_order_sub','k_bet','k_bet_cg','k_bet_cg_group'];
        $mysqlContent = [];
        $filePath = $this->trimPath(Yii::$app->getBasePath().'/web/increment.json');
        if(!file_exists($filePath)){
            foreach ($tables as $table){
                $lastId = $connection->createCommand("SELECT id FROM ".$table." order by id DESC limit 1")->queryScalar();
                if($lastId==''){
                    $lastId = "0";
                }
                $mysqlContent[$table] = $lastId;
                $mysqlContent['user_list'] = "0";
            }
            $mysqlContent = json_encode($mysqlContent);
            file_put_contents($filePath,$mysqlContent,LOCK_EX);
        }else{
            $json_string = file_get_contents($filePath);
            $data = json_decode($json_string, true);
            foreach ($data as $key => $val){
                $lastId = $connection->createCommand("SELECT id FROM ".$key." order by id DESC limit 1")->queryScalar();
                if($lastId==''){
                    $lastId = "0";
                }
                $mysqlContent[$key] = $lastId;
                $mysqlContent['user_list'] = "0";
                $tableOne = $connection->createCommand("SELECT * FROM ".$key." where id>".$val);
                $tableInfo = $tableOne->queryAll();
                $count = count($tableInfo);
                for($i=0;$i<$count;$i++){
                    $row = array_values($tableInfo[$i]);
                    $arr = '';
                    foreach ($row as $val){
                        if($val == 'null'){
                            $arr .= "null,";
                        }else{
                            $arr .= "'".$val."',";
                        }
                    }
                    $arr = rtrim($arr, ',');
                    $this->content .= 'INSERT INTO '.$key.' VALUES ('.$arr.');'."\r\n";
                }
            }
            $mysqlContent = json_encode($mysqlContent);
            file_put_contents($filePath,$mysqlContent,LOCK_EX);
            /*删除昨天文件*/
            $tempdir = "D:/backend/mysqlbak/increment/".date("Ymd",strtotime("-1 day"));
            if(is_dir($tempdir)){
                $this->deldir($tempdir);
            }
        }
        if(!empty($this->content)){
            $filename = $this->setFile();
            return $filename;
        }
    }
    /*删除昨天文件*/
    private function deldir($tempdir) {
        //先删除目录下的文件：
        $dh=opendir($tempdir);
        while ($file=readdir($dh)) {
            if($file!="." && $file!="..") {
                $fullpath=$tempdir."/".$file;
                if(!is_dir($fullpath)) {
                    unlink($fullpath);
                } else {
                    deldir($fullpath);
                }
            }
        }
        closedir($dh);
        //删除当前文件夹：
        if(rmdir($tempdir)) {
            return true;
        } else {
            return false;
        }
    }
    /**
    * @抛出异常信息
    */
    private function throwException($error){
        error_log($error);
    }
}