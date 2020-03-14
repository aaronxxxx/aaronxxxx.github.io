<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
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
    </head>
    <?php echo empty($login_url) ? '登录失败，请稍后再试!' : ''; ?>   
    <body>
        <script type="text/javascript">
            window.top.location.href = '<?= $login_url ?>';
        </script>
    </body>
</html>
<?php $this->endPage() ?>