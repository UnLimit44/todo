<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<?
$form= ActiveForm::begin(['action' => ['site/login']]);

echo $form->field($loginMod, 'name')->textInput();
echo $form->field($loginMod, 'password')->passwordInput();
echo Html::submitButton('Войти', ['class'=>"btn btn-success mb-2"]);

ActiveForm::end();

?>
Новый пользователь? <a href="?r=site/registration">Регистрация</a>