<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 16.06.2019
 * Time: 14:19
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form= ActiveForm::begin(['action' => ['task/edit']]);

echo Html::hiddenInput('id', $taskMod->id);
echo $form->field($taskMod, 'name')->textInput();
echo $form->field($taskMod, 'description')->textarea();
//echo $form->field($taskMod, 'parent_id')->textInput();

echo $form->field($taskMod, 'parent_id')->dropDownList($taskArr,['prompt' => 'Список']);


echo Html::submitButton('Сохранить', ['class'=>"btn btn-success mb-2"]);

ActiveForm::end();