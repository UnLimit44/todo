<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 19.06.2019
 * Time: 22:17
 */

namespace app\controllers;


use app\models\User;
use yii\web\Controller;
use Yii;

class UserController extends Controller
{
    public function actionIndex()
    {
        // Проверка пользователя
        $userName = Yii::$app->user->identity->name;
        if($userName != 'admin')
        {
            return $this->redirect(['user/block']);
        }

        //Удаление пользователя
        if (!empty($_POST["remove"]))
        {
            $userMod= User::findOne($_POST["remove"]);
            $userMod->delete();
        }

        //Блокировка пользователя
        if (!empty($_POST["block"]))
        {
            $userMod= User::findOne($_POST["block"]);
            $userMod->status = 0;
            $userMod->save();
        }

        //Разблокировка пользователя
        if (!empty($_POST["unblock"]))
        {
            $userMod= User::findOne($_POST["unblock"]);
            $userMod->status = 1;
            $userMod->save();
        }

        $userArr = User::find()->where(['not',['name'=>'admin']])->asArray()->all();
        return $this->render('index',compact('userArr'));
    }

    public function actionBlock()
    {
        return $this->render('ups');
    }
}