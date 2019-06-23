<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 19.06.2019
 * Time: 22:24
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?$form= ActiveForm::begin(['action' => ['user/index']]);?>
<table>
    <tr>
        <th>Пользователь</th>
        <th>Блокировка</th>
        <th></th>
    </tr>
    <?foreach ($userArr as $value):?>
        <tr>
            <td>
                <?=$value['name'];?>
            </td>
            <td>
                <? if ($value['status'] == 1) {
                    echo Html::submitbutton('Заблокировать', ['name'=> 'block', 'value'=>$value['id'],'class' => 'btn btn-danger btn-sm ',
                        'data' => ['confirm' => 'Вы действительно хотите заблокировать пользователя?']]);
                } else {
                    echo Html::submitbutton('Разблокировать', ['name'=> 'unblock','value'=>$value['id'],'class' => 'btn btn-success btn-sm ',
                        'data' => ['confirm' => 'Вы действительно хотите разблокировать пользователя?']]);
                } ?>
            </td>
            <td>
                <?=Html::submitButton('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>', ['name'=> 'remove','value'=>$value['id'],'class' => 'btn btn-link',
                'data' => ['confirm' => 'Вы действительно хотите разблокировать пользователя?']]);?>
            </td>
        </tr>
    <?endforeach;?>
</table>
<? ActiveForm::end();?>