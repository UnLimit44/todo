<?php



use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!-- Навбар -->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand и toggle сгруппированы для лучшего отображения на мобильных дисплеях -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="?r=site">ToDo</a>
        </div>
        <!-- Соберите навигационные ссылки, формы, и другой контент для переключения -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="?r=site/index">Активные</a></li>
                <li><a href="?r=filter/all">Все задачи</a></li>
                <li><a href="?r=filter/complete">Завершенные</a></li>
            </ul>
            <!-- Инф пользователя -->
            <ul class="nav navbar-nav navbar-right">
                <? if (Yii::$app->user->identity->name == 'admin'):;?>
                <li><a href="?r=user/index">Пользователи</a></li>
                <?endif?>
                <li><a href="?r=task/create">Новая задача</a></li>
                <li><a href="#"><?= 'Здравствуйте, '. Yii::$app->user->identity->name. '.';?></a></li>
                <li><a href="?r=site/logout">Выйти</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-6">
            <?= $content ?>
        </div>
        <div class="col-md-3">

        </div>
    </div>
</div>
<?php $this->endBody() ?>
<!-- Последняя компиляция и сжатый JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

</body>
</html>
<?php $this->endPage() ?>
