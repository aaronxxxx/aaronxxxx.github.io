<?php
namespace app\modules\core\install\helpers;

use yii\base\Object;

/**
 * 数据库操作类
 * Class DBUtils
 * @package app\modules\core\install\helpers
 */
class DBUtils extends Object {

    public $version = '';
    private $db = null;
    public $dbname = null;

    /**
     * 连接数据库
     * @param array $array 数据库连接配置
     *              $array=array(
     *                  'dbmysql_server',
     *                  'dbmysql_username',
     *                  'dbmysql_password',
     *                  'dbmysql_name',
     *                  'dbmysql_port',
     *                  'persistent')
     * @return bool
     */
    public function Open($array) {
        $db = mysqli_init();
        if ($array[5] == true) {
            $array[0] = 'p:' . $array[0];
        }
        //mysqli_options($db,MYSQLI_READ_DEFAULT_GROUP,"max_allowed_packet=50M");
        if (@mysqli_real_connect($db, $array[0], $array[1], $array[2], $array[3], $array[4])) {

            $myver = mysqli_get_server_info($db);
            $this->version = substr($myver, 0, strpos($myver, "-"));
            if(version_compare($this->version, '5.5.3') >= 0){
                $u = "utf8mb4";
            }else{
                $u = "utf8";
            }
            if(mysqli_set_charset($db, $u) == false)
                mysqli_set_charset($db, "utf8");

            $this->db = $db;
            $this->dbname = $array[3];

            return true;
        }

        return false;
    }

    /**
     * 创建数据库
     * @param string $dbmysql_server
     * @param string $dbmysql_port
     * @param string $dbmysql_username
     * @param string $dbmysql_password
     * @param string $dbmysql_name
     * @return bool
     */
    public function CreateDB($dbmysql_server, $dbmysql_port, $dbmysql_username, $dbmysql_password, $dbmysql_name) {
        $db = mysqli_connect($dbmysql_server, $dbmysql_username, $dbmysql_password, null, $dbmysql_port);

        $myver = mysqli_get_server_info($db);
        $myver = substr($myver, 0, strpos($myver, "-"));
        if(version_compare($myver, '5.5.3') >= 0){
            $u = "utf8mb4";
        }else{
            $u = "utf8";
        }
        if(mysqli_set_charset($db, $u) == false)
            mysqli_set_charset($db, "utf8");

        $this->db = $db;
        $this->dbname = $dbmysql_name;
        $s = "SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME='$dbmysql_name'";
        $a = $this->Query($s);
        $c = 0;
        if (is_array($a)) {
            $b = current($a);
            if (is_array($b)) {
                $c = (int) current($b);
            }
        }
        if ($c == 0) {
            mysqli_query($this->db, 'CREATE DATABASE ' . $dbmysql_name);
            return true;
        }
    }

    /**
     * 关闭数据库连接
     */
    public function Close() {
        if (is_object($this->db)) {
            mysqli_close($this->db);
        }
    }

    /**
     * 执行多行SQL语句
     * @param string $s 以;号分隔的多条SQL语句
     * @return array
     */
    public function QueryMulti($s) {
        //$a=explode(';',str_replace('%pre%', $this->dbpre, $s));
        $a = explode(';', $s);
        foreach ($a as $s) {
            $s = trim($s);
            if ($s != '') {
                mysqli_query($this->db, $s);
            }
        }
    }

    /**
     * @param $query
     * @return array
     */
    public function Query($query) {
        //$query=str_replace('%pre%', $this->dbpre, $query);
        $results = mysqli_query($this->db, $query);
        if (mysqli_errno($this->db)) {
            trigger_error(mysqli_error($this->db), E_USER_NOTICE);
        }

        $data = array();
        if (is_object($results)) {
            while ($row = mysqli_fetch_assoc($results)) {
                $data[] = $row;
            }
        } else {
            $data[] = $results;
        }

        //if(true==true){
        if (true !== true) {
            $query = "EXPLAIN " . $query;
            $results2 = mysqli_query($this->db, $query);
            $explain = array();
            if ($results2) {
                while ($row = mysqli_fetch_assoc($results2)) {
                    $explain[] = $row;
                }
            }
            logs("\r\n" . $query . "\r\n" . var_export($explain, true));
        }

        return $data;
    }

    /**
     * @param $query
     * @return bool|mysqli_result
     */
    public function Update($query) {
        //$query=str_replace('%pre%', $this->dbpre, $query);
        return mysqli_query($this->db, $query);
    }

    /**
     * @param $query
     * @return bool|mysqli_result
     */
    public function Delete($query) {
        //$query=str_replace('%pre%', $this->dbpre, $query);
        return mysqli_query($this->db, $query);
    }

    /**
     * @param $query
     * @return int|string
     */
    public function Insert($query) {
        //$query=str_replace('%pre%', $this->dbpre, $query);
        mysqli_query($this->db, $query);

        return mysqli_insert_id($this->db);
    }

}
