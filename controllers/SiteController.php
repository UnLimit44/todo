<?php

namespace app\controllers;

use app\models\RegistrationForm;
use app\models\User;
use app\models\Task;
use yii\web\Controller;
use Yii;
use app\models\LoginForm;



class SiteController extends Controller
{

    public function actionIndex($filter=null)
    {

        //Проверка пользователя
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        //Текущий пользователь
        $currentUser = Yii::$app->user->identity;

        //Если пользователь заблокирован
        if ($currentUser->status == 0) {
            return $this->redirect(['user/block']);
        }

        $taskMod = new Task();

        if ($filter == 'all'){
            $taskArr = $taskMod->all($currentUser->id,$currentUser->name);
        } elseif ($filter == 'complete'){
            $taskArr = $taskMod->complete($currentUser->id,$currentUser->name);
        } else {
            $taskArr = $taskMod->active($currentUser->id,$currentUser->name);
        }

        return $this->render('index', compact('taskArr'));
    }
    // Поиск
    public function actionSearch()
    {

        //Проверка пользователя
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }

        //Текущий пользователь
        $currentUser = Yii::$app->user->identity;

        //Если пользователь заблокирован
        if ($currentUser->status == 0) {
            return $this->redirect(['user/block']);
        }

        $taskMod = new Task();
        $choice='';
        if (!empty($_POST['all'])) {
            $choice = 'all';
        }
        if (!empty($_POST['complete'])) {
            $choice = 'complete';
        }
        if (!empty($_POST['active'])) {
            $choice = 'active';
        }
        $taskArr = $taskMod->search($currentUser->id,$currentUser->name,$choice);

        return $this->render('index', compact('taskArr'));
    }

    public function actionLogin()
    {
        //Устанавливаем лейаут
        $this->layout = 'login';
        //Проверка пользователя
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $loginMod = new LoginForm();
        if ($loginMod->load(Yii::$app->request->post()) && $loginMod->login()) {
            return $this->redirect(['site/index']);
        }

        return $this->render('login', [
            'loginMod' => $loginMod,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['site/login']);
    }

    public function actionRegistration()
    {
        //Устанавливаем лейаут
        $this->layout = 'login';
        // Проверка пользователя
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        //Регистрация
        $regForm = new RegistrationForm();
        if($regForm->load(\Yii::$app->request->post()) && $regForm->validate())
        {
            $user = new User();
            $user->name = $regForm->name;
            $user->password = \Yii::$app->security->generatePasswordHash($regForm->password);
            if($user->save())
            {
                return $this->goHome();
            }
        }

        return $this->render('registration', compact('regForm'));
    }
}
