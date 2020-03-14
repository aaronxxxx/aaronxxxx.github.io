<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/9
 * Time: 14:21
 */
namespace app\common\services;

class DDosService {
    public static function run() {
        $ddos = require_once(__DIR__ . '/../../config/ddos.php');
        $ip = $_SERVER['REMOTE_ADDR'];
        if($ddos['enable']) {
            $blacklist = file_get_contents(__DIR__ . '/../../config/blacklist.txt');
            if(strpos($blacklist, $ip) === false) {
                $blacklist = $blacklist.$ip.',';
                file_put_contents(__DIR__ . '/../../config/blacklist.txt', $blacklist);
            }
            header("http/1.1 403 Forbidden");
            exit();
        }else{
            if($ddos['black']) {
                $blacklist = file_get_contents(__DIR__ . '/../../config/blacklist.txt');
                if(strpos($blacklist, $ip) || strpos($blacklist, $ip) === 0) {
                    header("http/1.1 403 Forbidden");
                    exit();
                }
            }
        }
    }
}