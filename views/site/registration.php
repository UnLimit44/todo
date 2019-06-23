<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 10.06.2019
 * Time: 0:19
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form= ActiveForm::begin(['action' => ['site/registration']]);

echo $form->field($regForm, 'name')->textInput();
echo $form->field($regForm, 'password')->textInput();
echo $form->field($regForm, 'passwordRep')->textInput();
echo  $form->field($regForm, 'reCaptcha')->widget(
    \himiklab\yii2\recaptcha\ReCaptcha2::className(),
    [
        'siteKey' => '6Ldg26cUAAAAADEKwh5oDSgYzxTsTzG99OazIStR', // unnecessary is reCaptcha component was set up
    ]
);

echo Html::submitButton('Ок', ['class'=>"btn btn-success mb-2"]);

ActiveForm::end();