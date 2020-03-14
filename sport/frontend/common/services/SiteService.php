<?php
namespace app\common\services;
session_start();

class SiteService
{
    public static function testagent()
    {
        if (isset($_GET['intr'])) {
			$_SESSION['S_AGENT_ID'] = intval($_GET['intr']);
        }
    }

    /**
     * site路由重定向
     */
    public static function redirect()
    {
        $requestUri = $_SERVER["REQUEST_URI"];

        if ($requestUri === "/") {
            // header("Location: /?r=passport/site");
            header("Location: /?r=site/index");
            exit;
        }

		if (!(strpos($requestUri, "/?intr=") === false)) {
            // header("Location: /?r=passport/site");
            header("Location: /?r=site/index");
            exit;
        }

        if (!(strpos($requestUri, "/?r=site") === false)) {
            if (!(strpos($requestUri, "captcha") === false)) {
                $requestUri = str_replace("site", "passport/site", $requestUri);
                header("Location: $requestUri");
                exit;
            }
        }
    }
}