<?php
namespace app\models;

use Symfony\Component\VarDumper\VarDumper;
use Yii;
use yii\base\Model;


class RegisterForm extends Model
{
    public string $name = '';
    public string $surname = '';
    public string $patronymic = '';
    public string $login = '';
    public string $email = '';
    public string $phone = '';
    public string $password = '';
    public string $password_repeat = '';
    public bool $rules = false;


    public function rules()
    {
        return [
            [['name', 'surname', 'login', 'email', 'phone', 'password', 'password_repeat'], 'required'],
            [['name', 'surname', 'patronymic', 'login', 'email', 'phone', 'password', 'password_repeat'], 'string', 'max' => 255],
            // [['name', 'surname', 'patronymic'], 'match', 'pattern' => '/^[а-яА-ЯёЁ\s\-]+$/u'],
            [['name', 'surname', 'patronymic'], 'match', 'pattern' => '/^[а-яё\s\-]+$/ui', 'message' => 'Только кириллица, пробел, тире'],
            // [['login'], 'match', 'pattern' => '/^[a-zA-Z\d\-]+$/'],
            // [['login'], 'match', 'pattern' => '/^[a-zA-Z0-9\-]+$/u'],
            [['login'], 'match', 'pattern' => '/^[a-z0-9\-]+$/ui', 'message' => 'Только латиница, тире, цифры'],
            ['email', 'email'],
            ['password', 'string', 'min' => 6],
            [['password'], 'match', 'pattern' => '/^[a-z0-9]+$/i', 'message' => 'Только латиница, цифры'],            
            // [['password', 'password_repeat'], 'match', 'pattern' => '/^[a-z0-9]{6,}$/ui', 'message' => 'не менее 6-ти символов, латиница, цифры'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            ['rules', 'required', 'requiredValue' => 1, 'message' => 'Необходимо согласиться с правилами регистрации'],

            //  +7(XXX)-XXX-XX-XX
            // +7 \( [0-9]{3} \) \- [0-9]{3} \- [0-9]{2} \- [0-9]{2}
            // +7 \( [\d]{3}  \) \- [\d]{3} (\- [\d]{2}){2} 
            // ['phone', 'match', 'pattern' => '/^\+7\([0-9]{3}\)\-[0-9]{3}\-[0-9]{2}\-[0-9]{2}$/'],
            ['phone', 'match', 'pattern' => '/^\+7\([\d]{3}\)\-[\d]{3}(\-[\d]{2}){2}$/'],
            [['login'], 'unique', 'targetClass' => User::class],

            //+7(999)-999-9_-__
            //+7(999)-999-99-99

            // ext b + 1b 
            // 000000000000000000000000111 - O 
            // 111 - O 

            // 
            //пароль (обязательное присутствие хотя бы одной цифры и буквы в верхнем и нижнем регистре)
            ['password', 'match', 'pattern' => "/^(?=.*[\d])(?=.*[A-ZА-ЯЁ])(?=.*[a-zа-яё]).+$/u"];
            //пароль (обязательное присутствие хотя бы одной цифры и буквы в верхнем и нижнем регистре, только латинкие символы и цифры)
            ['password', 'match', 'pattern' => "/^(?=.*[\d])(?=.*[A-Z])(?=.*[a-z])[a-zA-Z\d]{3,}$/"];
           
        ];
    }


    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'login' => 'Логин',
            'email' => 'Email',
            'phone' => 'Телефон',
            'password' => 'Пароль',
            'password_repeat' => 'Повтор пароля',
            'rules' => 'Согласие с правилами регистрации',
        ];
    }


    public function register(): object|bool
    {
        if ($this->validate()) {
            $user = new User();
            // $user->name = $this->name;
            // $user->surname = $this->surname;
            // $user->login = $this->login;
            
            // $user->load($this->attributes, '');

            $user->attributes = $this->attributes;
            $user->role_id = Role::getRoleId('user');
            // $user->password = Yii::$app->security->generatePasswordHash($this->password);
            $user->password = Yii::$app->security->generatePasswordHash($user->password);
            $user->auth_key = Yii::$app->security->generateRandomString();

            if (! $user->save()) {
                VarDumper::dump($user->errors); die;    
            }

            // VarDumper::dump($user); die;
        } else {
            // VarDumper::dump($this->errors); die;
        }

        return $user ?? false;
    }

}
