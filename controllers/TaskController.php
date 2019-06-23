<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Task;
use Yii;


class TaskController extends Controller
{
    /**
     * Отображение задачи
     * @return string
     */
    public function actionIndex($id = null)
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
        // Редактирование статуса
        if ($taskMod->load(\Yii::$app->request->post())){
            if (!empty($_POST['id']) && isset($_POST['Task']['status'])) {

                $taskEdit= Task::findOne($_POST['id']);
                $taskEdit->status = $_POST['Task']['status'];
                $taskEdit->save();
            }
        }
        //Выбор задачи по id
        if (empty($id))
        {
            $id= $_POST['id'];
        }
        $task= Task::findOne($id);

        //Выбор подзадачи
        $userId= Yii::$app->user->identity->id;
        $subtask = Task::find()->where('user_id=:user_id',[':user_id'=>$userId])->
        andWhere('parent_id=:parent_id',[':parent_id' => $task->id])->asArray()->all();

        return $this->render('index', compact('task','taskMod', 'subtask'));
    }

    /**
     * Создание задачи
     * @return string|\yii\web\Response
     */
    public function actionCreate()
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
        //Сохранение
        $taskMod = new Task();
        if($taskMod->load(\Yii::$app->request->post()) && $taskMod->validate())
        {
            $taskMod->user_id = $currentUser->id;
            $taskMod->parent_id = $_POST['Task']['parent_id'];
            if($taskMod->save())
            {
                return $this->goHome();
            }
        }

        //Получаем список всех задач
        $Arr=Task::find()->select(['id','name'])->asArray()->all();
        //Перестраиваем массив для формы
        foreach ($Arr as $value)
        {
            $taskArr[$value['id']]= $value['name'];
        }
        if (!empty($_POST['subtask']))
        {
            $subtask = $_POST['subtask'];
        }

        return $this->render('create', compact('taskMod','taskArr','subtask'));
    }

    /**
     * Редактирование задачи
     * @return string|\yii\web\Response
     */
    public function actionEdit()
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
        // При получении данных от редактирования
        if (!empty($_POST['Task']['name']))
        {
            if($taskMod->load(\Yii::$app->request->post()))
            {
                $taskEdit= Task::findOne($_POST['id']);
                $taskEdit->name = $_POST['Task']['name'];
                $taskEdit->description = $_POST['Task']['description'];
                $taskEdit->parent_id = $_POST['Task']['parent_id'];
                if($taskEdit->save())
                {
                    return $this->redirect(['task/index','id'=>$taskEdit->id]);
                }
            }
        }
        //Выбираем задачу по id
        $id= $_POST['id'];
        $taskMod= Task::findOne($id);
        //Получаем список всех задач
        $Arr=Task::find()->select(['id','name'])->asArray()->all();
        //Перестраиваем массив для формы
        foreach ($Arr as $value)
        {
            $taskArr[$value['id']]= $value['name'];
        }
        return $this->render('update', compact('taskMod','taskArr'));
    }

    /**
     * Удаление задачи
     * @return \yii\web\Response
     */
    public function actionDelete()
    {
        $id= $_POST['id'];
        $taskMod = new Task();
        //Редактируем подзадачи
        $taskMod->SubtaskEdit($id);

        $taskDel= Task::findOne($id);
        $taskDel->delete();
        return $this->goHome();
    }


}
