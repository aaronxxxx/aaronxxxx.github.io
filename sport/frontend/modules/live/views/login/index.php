<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use app\common\helpers\MobileDetect;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <style>
            html,body {
                height:100%;
                margin: 0;
            }
        </style>
    </head>
    <body>
    <?php
        $mobile = new MobileDetect();
        if(!$mobile->isMobile()) {
            if(!empty($login_url)) {
                $https = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? true : false;
                if(!$https) {
                    ?>
                    <iframe src="<?= $login_url ?>" target="_blank" frameborder="0" scrolling="no" style="width:100%; height:100%;"></iframe>
                    <?php
                }
            }
        }
        header("Location:$login_url");
    ?>
    </body>
</html>
<?php $this->endPage() ?>