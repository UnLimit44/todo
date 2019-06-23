<?php

/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 09.06.2019
 * Time: 13:30
 */
namespace app\models;
use yii\base\Model;

class RegistrationForm extends Model{

    /**
     * Форма регистрации
     */

    public $name;
    public $password;
    public $passwordRep;
    public $reCaptcha;


    public function attributeLabels()
    {
        return
            [
                'name'=>'Имя пользователя',
                'password'=>'Пароль',
                'passwordRep'=>'Поторите пароль',
                'reCaptcha'=>'Валидация'
            ];
    }

    // Условия ввода
    public function rules()
    {
        return
            [
                [['name', 'password','passwordRep'], 'required', 'message' => 'Заполните поле'],
                [['name', 'password','passwordRep'], 'trim'],
                //Проверка на уникальность
                ['name', 'unique', 'targetClass' => User::className(),  'message' => 'Этот логин уже занят'],
                // Проверка на подтверждение пароля
                ['passwordRep', 'compare','compareAttribute' => 'password', 'operator' => '=='],
                // Капча
                [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6Ldg26cUAAAAAFdX34QXSFcSe29xT5WrgzuchY_0', 'uncheckedMessage' => 'Подвердите то, что вы не бот.'],
            ];
    }
}