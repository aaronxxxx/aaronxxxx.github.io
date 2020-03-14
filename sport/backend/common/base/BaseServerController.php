<?php
namespace app\common\base;

use app\common\remote\RemoteServer;
use yii\web\Controller;

class BaseServerController extends Controller {

    public $server;

	public function init(){//初始化函数
		parent::init();
        $this->enableCsrfValidation = false;
        $this->server = new RemoteServer();
	}

	public function addService($service) {
        $this->server->addInstanceMethods($service);
    }

    public function publish() {
        $this->server->start();
    }
}
