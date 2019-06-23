<?

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form= ActiveForm::begin(['action' => ['task/create']]);

echo $form->field($taskMod, 'name')->textInput();
echo $form->field($taskMod, 'description')->textarea();

//Сделать чей то подзадачей
if (!empty($subtask))
{
    echo $form->field($taskMod, 'parent_id')->dropDownList($taskArr,['prompt' => 'Список','options' => ["$subtask" => ['Selected' => true]]]);
}
else
{
    echo $form->field($taskMod, 'parent_id')->dropDownList($taskArr,['prompt' => 'Список']);
}

echo Html::submitButton('Сохранить', ['class'=>"btn btn-success mb-2"]);

ActiveForm::end();