<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<!-- Поиск -->
<?= Html::beginForm(['site/search'], 'post',['class' => ['navbar-form navbar-left']]) ?>
<div class="btn-group btn-group-sm btn-group-toggle" data-toggle="buttons">
    <label class="btn btn-default ">
        <?= Html::radio('active', false, ['label' => 'в активных','class'=>'btn-success']) ?>
    </label>
    <label class="btn btn-default active">
        <?= Html::radio('all', true, ['label' => 'во всех','class'=>'btn-success']) ?>
    </label>
    <label class="btn btn-default">
        <?= Html::radio('complete', false, ['label' => 'в завершенных','class'=>'btn-success']) ?>
    </label>
</div>
<div class="form-group">
    <?= Html::input('text', 'search','',['class'=>'form-control']) ?>
</div>
<?= Html::submitButton('Поиск', ['class' => 'btn btn-default']) ?>
<?= Html::endForm() ?>
<!-- Таблица -->
<?$form= ActiveForm::begin(['action' => ['task/index']]);?>
<table>
    <tr>
        <th>Название</th>
        <th>Статус</th>
    </tr>
    <?foreach ($taskArr as $value):?>
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
    <? ActiveForm::end();?>
</table>
<a href="?r=task/create"><?= Html::button('Новая задача ', ['class'=>"btn btn-success mb-2"]) ?></a>







