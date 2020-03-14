<?php
namespace app\modules\core\install\helpers;
use yii\base\Object;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/22
 * Time: 9:36
 */
class FileUtils extends Object
{
    /**
     * 获取文件权限
     * @param string $f 文件名
     * @return string|null  返回文件权限，数值格式，如0644
     */
    public static function getFilePermsOct($f) {
        if (!file_exists($f)) {
            return null;
        }
        return substr(sprintf('%o', fileperms($f)), -4);
    }

    /**
     * 获取文件权限
     * @param string $f 文件名
     * @return string|null  返回文件权限，字符表达格式，如-rw-r--r--
     */
    public static function getFilePerms($f) {
        if (!file_exists($f)) {
            return null;
        }

        $perms = fileperms($f);

        if (($perms & 0xC000) == 0xC000) {
            // Socket
            $info = 's';
        } elseif (($perms & 0xA000) == 0xA000) {
            // Symbolic Link
            $info = 'l';
        } elseif (($perms & 0x8000) == 0x8000) {
            // Regular
            $info = '-';
        } elseif (($perms & 0x6000) == 0x6000) {
            // Block special
            $info = 'b';
        } elseif (($perms & 0x4000) == 0x4000) {
            // Directory
            $info = 'd';
        } elseif (($perms & 0x2000) == 0x2000) {
            // Character special
            $info = 'c';
        } elseif (($perms & 0x1000) == 0x1000) {
            // FIFO pipe
            $info = 'p';
        } else {
            // Unknown
            $info = 'u';
        }

        // Owner
        $info .= (($perms & 0x0100) ? 'r' : '-');
        $info .= (($perms & 0x0080) ? 'w' : '-');
        $info .= (($perms & 0x0040) ? (($perms & 0x0800) ? 's' : 'x') : (($perms & 0x0800) ? 'S' : '-'));

        // Group
        $info .= (($perms & 0x0020) ? 'r' : '-');
        $info .= (($perms & 0x0010) ? 'w' : '-');
        $info .= (($perms & 0x0008) ? (($perms & 0x0400) ? 's' : 'x') : (($perms & 0x0400) ? 'S' : '-'));

        // Other
        $info .= (($perms & 0x0004) ? 'r' : '-');
        $info .= (($perms & 0x0002) ? 'w' : '-');
        $info .= (($perms & 0x0001) ? (($perms & 0x0200) ? 't' : 'x') : (($perms & 0x0200) ? 'T' : '-'));

        return $info;
    }
}