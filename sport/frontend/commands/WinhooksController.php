<?php

/**
 * 119 Frontend version
 * @date 2018-03-02 22:41
 */

namespace app\commands;

use Yii;
use yii\console\Controller;

class WinhooksController extends Controller
{
    public function actionIndex()
    {
		echo 'git frontend process...';
		exec('D: && cd D:\www\frontend && git fetch --all && git reset --hard origin/test 2>&1',$out);
		var_export($out);
	}
}
	//REFERENCE
	//https://gist.github.com/shalakolee/15a51ce96af8cbd73f81186fbbd96f2c

	//header("Content-Type:text/html; charset=gb2312");
	// 認證用
	//$valid_token = 'd49dfa7622681425fbcbdd687eb2ca59498ce852';
	//$valid_ip = array('220.133.89.162', '59.126.211.60', '103.97.32.171', '103.97.32.132', '127.0.0.1', '59.126.253.34', '36.234.10.227','182.16.24.29','114.26.15.173');

	//$client_token = $_GET['token'];
	//$client_token = $_SERVER['HTTP_X_GITLAB_TOKEN'];
	//$client_ip = $_SERVER['REMOTE_ADDR'];

	//$fs = fopen('./example_hook.log', 'a+');
	//fwrite($fs, 'Request on ['.date("Y-m-d H:i:s").'] from ['.$client_ip.']'.PHP_EOL);

	// 認證 token
	/*
	if ($client_token !== $valid_token)
	{
		echo "error 10001 ".$client_token. '  '.$valid_token;
		fwrite($fs, "Invalid token [{$client_token}]".PHP_EOL);
		exit(0);
	}


	// 認證 ip
	if ( ! in_array($client_ip, $valid_ip))
	{
		echo "error 10002 ".$client_ip;
		fwrite($fs, "Invalid ip [{$client_ip}]".PHP_EOL);
		exit(0);
	}

	$json = file_get_contents('php://input');
	$data = json_decode($json, true);
	fwrite($fs, 'Data: '.print_r($data, true).PHP_EOL);
	fwrite($fs, '======================================================================='.PHP_EOL);
	$fs and fclose($fs);

    echo 'Winhooks Test OK!';


	$l_git  = "c:\Program Files (x86)\Git\bin\git";
	$w_bash = "C:\\Program Files (x86)\\Git\\bin\\bash.exe";

	$l_cmd = "'cd /d/www/hook_test; "
		 . "\"$l_git\" pull origin master'";
	$exec = "\"$w_bash\" -c $l_cmd 2>&1";
	echo "Runnning...\n<br>";
	$t0 = microtime(true);
	echo "<pre>$exec</pre>";
	exec($exec, $result, $ret);
	$t = round(microtime(true) - $t0,3)*1000;
	echo "<br>Done: $t ms";
	echo '<pre>';
	print_r($result);
	print_r($ret);
	echo '</pre>';


	exit;
	*/

	/*
	error_reporting(7);
	define("WWW_ROOT", "D:\\www\\backend\\web");
	define("LOG_FILE", WWW_ROOT."\\git-hook.log");
	exec(WWW_ROOT."\\test.bat",$output,$ret);
	echo "output:";
	print_r($output);
	echo "ret:".$ret;
	$log = sprintf("[%s] %s %s\n", date('Y-m-d H:i:s', time()), $output,$ret);
	file_put_contents(LOG_FILE, $log, FILE_APPEND);
	exit;
	*/

	//exit;
	//exec('c:\WINDOWS\system32\cmd.exe /c START D:\www\backend\web\winhooks.bat');
	//system("cmd/c D:\www\backend\web\winhooks.bat", $Result);
	//exec('git.exe log', $Result);
	//$pwd = getcwd();


	//$pwd = 'D:\\www\\hook_test';
	//$command = 'c:\WINDOWS\system32\cmd.exe /c "D: && cd ' . str_replace('\\', '/\\', $pwd) . ' && git checkout -f && git pull 2>&1" ';
	//$command = 'cd ' . $pwd . ' && git checkout -f && git pull 2>&1';
	//echo shell_exec($command);
    //echo shell_exec($command);
	//exec('git status', $Result);
	//echo $command.php_EOL;
	//echo $pwd .PHP_EOL;
	//var_export($command);

	//exit;
	//$result = shell_exec('cmd /c "D: && cd D:\www\hook_test &git fetch origin &git pull origin master" ');
	//$result = exec("dir");
	//$result = exec('c:WINDOWSsystem32cmd.exe/c START D:\www\backend\web\winhooks.bat');

	//system("cmd/c D:\www\backend\web\winhooks.bat");
	//$result = exec('D:\www\backend\web\winhooks.bat');

	//exec('cd D:\www\hook_test');
    //exec('git pull 2>&1',$out);

	//exec('D: && cd D:\www\hook_test && git pull origin master 2>&1',$out);

	//exec('git clone git@git.iedo.com.tw:superada0923/hook_test.git D:\www\hook_test',$out);
    //var_export($out);

	//if(!$result){
	//	echo 'fail';
	//}
	//print_r($result);


	// 執行上面所述的 update.sh
	//$results = exec('sh update_test.sh');
	//print_r($results);
	//system('sh deploy.sh');
	//echo 'ggg';
	//echo shell_exec("whoami");

	//$www_folder = "/var/www/html/hook_test";
	//在?里?取到了用?提交的?容, 以及提交者等等, 可以??到?据?中供以后使用
	//$raw_json = file_get_contents('php://input');
	//print_r(json_decode($raw_json, true));
	//echo shell_exec(" cd $www_folder ; sudo git pull 2>&1");
?>