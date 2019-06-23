<?use yii\helpers\Html;?>
<? use yii\widgets\ActiveForm;?>

<?$form= ActiveForm::begin(['action' => ['task/index']]);?>
<h3><?=$task->name?></h3>

<?= Html::hiddenInput('id', $task->id);?>

<?
echo $form->field($taskMod, 'status')->dropDownList(
['0'=>'в ожидании', '1'=>'в разработке', '2'=>'на тестировании', '3'=>'на проверке', '4'=>'выполнено'],
['onchange'=>'this.form.submit()','options' => [$task->status => ['Selected' => true]]]);
?>
<? ActiveForm::end();?>

<h5><b>Описание</b></h5>

<p>
    <?=$task['description'];?>
</p>
<h5><b>Подзадачи</b></h5>
<p>
    <?$form= ActiveForm::begin(['action' => ['task/index']]);?>
    <table>
    <?foreach ($subtask as $value):?>
            <tr>
                <td>
                    <button type="submit" name="id" class="btn btn-link" value="<?=$value['id'];?>"><?=$value['name'];?></button>
                </td>
                <td>
                    <? switch ($value['status'])
                    {
                        case 0:
                            echo "в ожидании";
                            break;
                        case 1:
                            echo "в разработке";
                            break;
                        case 2:
                            echo "на тестировании";
                            break;
                        case 3:
                            echo "на проверке";
                            break;
                        case 4:
                            echo "выполнено";
                            break;
                    } ?>
                </td>
            </tr>
    <?endforeach;?>
</table>
<? ActiveForm::end();?>
</p>
<div class="container">
<div class="row">
    <?$form= ActiveForm::begin(['action' => ['task/edit']]);?>
    <?= Html::hiddenInput('id', $task->id);?>
    <?= Html::submitButton('Редактировать', ['class'=>"btn btn-success mb-2"]);?>
    <? ActiveForm::end();?>

    <?$form= ActiveForm::begin(['action' => ['task/create']]);?>
    <?= Html::submitButton('Добавить подзадачу', ['name'=>'subtask','value'=>$task->id,'class'=>"btn btn-success mb-2"]);?>
    <? ActiveForm::end();?>

    <?$form= ActiveForm::begin(['action' => ['task/delete']]);?>
    <?= Html::hiddenInput('id', $task->id);?>
    <?= Html::submitButton('Удалить', ['class'=>"btn btn-danger",
        'data' => ['confirm' => 'Вы действительно хотите удалить?']]);?>
    <? ActiveForm::end();?>
</div>
</div>