<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 12.06.2019
 * Time: 11:17
 */

namespace app\models;

use yii\db\ActiveRecord;
use Yii;


class Task extends ActiveRecord
{

    public function Active($userId,$userName)
    {
        if($userName == 'admin')
        {
            $taskArr=Task::find()->where(['parent_id' => null])->andWhere(['not',['status'=>'4']])->asArray()->all();
        } else {
            $taskArr=Task::find()->where('user_id=:user_id',[':user_id'=>$userId])->
            andWhere(['parent_id' => null])->andWhere(['not',['status'=>'4']])->asArray()->all();
        }
        return $taskArr;
    }

    public function All($userId,$userName)
    {
        if($userName == 'admin')
        {
            $taskArr=Task::find()->where(['parent_id' => null])->asArray()->all();
        } else {
            $taskArr=Task::find()->where('user_id=:user_id',[':user_id'=>$userId])->
            andWhere(['parent_id' => null])->asArray()->all();
        }
        return $taskArr;
    }

    public function Complete($userId,$userName)
    {
        if($userName == 'admin')
        {
            $taskArr=Task::find()->where(['parent_id' => null])->andWhere(['status'=>'4'])->asArray()->all();
        } else {
            $taskArr=Task::find()->where('user_id=:user_id',[':user_id'=>$userId])->
            andWhere(['parent_id' => null])->andWhere(['status'=>'4'])->asArray()->all();
        }
        return $taskArr;
    }

    public function Search($userId,$userName,$choice)
    {
        $taskArr = [];

        if($userName == 'admin')
        {
            if ($choice=='all') {
                $taskArr=Task::find()->where(['like', 'name', $_POST['search']])->asArray()->all();
            } elseif ($choice=='complete'){
                $taskArr=Task::find()->where(['like', 'name', $_POST['search']])->andWhere(['status'=>'4'])->asArray()->all();
            } elseif ($choice=='active') {
                $taskArr=Task::find()->where(['like', 'name', $_POST['search']])->andWhere(['not',['status'=>'4']])->asArray()->all();
            }
        } else {
            if ($choice=='all') {
                $taskArr=Task::find()->where(['like', 'name', $_POST['search']])->
                andWhere('user_id=:user_id',[':user_id'=>$userId])->asArray()->all();
            } elseif ($choice=='complete'){
                $taskArr=Task::find()->where(['like', 'name', $_POST['search']])->andWhere(['status'=>'4'])->
                andWhere('user_id=:user_id',[':user_id'=>$userId])->asArray()->all();
            } elseif ($choice=='active') {
                $taskArr=Task::find()->where(['like', 'name', $_POST['search']])->andWhere(['not',['status'=>'4']])->
                andWhere('user_id=:user_id',[':user_id'=>$userId])->asArray()->all();
            }
        }

        return $taskArr;
    }

    public function SubtaskEdit($id)
    {

            $taskArr=Task::find()->where(['parent_id' => $id])->asArray()->all();
            foreach ($taskArr as $value)
            {
                $taskEdit= Task::findOne($value['id']);
                $taskEdit->parent_id = null;
                $taskEdit->save();
            }

        return $taskArr;
    }



    public function attributeLabels()
    {
        return
            [
                'name'=>'Название',
                'description'=>'Описание',
                'parent_id'=>'Сделать подзадачей',
                'status'=>'Статус',
            ];
    }


    public function rules()
    {
        return [
            // username and password are both required
            ['name', 'required'],
            ['name', 'trim'],
        ];
    }

}