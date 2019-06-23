<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 18.06.2019
 * Time: 20:50
 */

namespace app\controllers;


use yii\web\Controller;
use Yii;
use app\models\Task;

class FilterController extends Controller
{
    // Фильтр отображать все
    public function actionAll()
    {
        return $this->redirect(['site/index','filter'=>'all']);
    }
    // Фильтр отображать завершенные
    public function actionComplete()
    {
        return $this->redirect(['site/index','filter'=>'complete']);
    }
}