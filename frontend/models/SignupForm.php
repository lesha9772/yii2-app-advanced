<?php
namespace frontend\models;

use yii\base\Model;
use common\models\UserDetails;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $user_name;
    public $email;
    public $password;
    public $skype;
    public $phone;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['user_name', 'trim'],
            ['user_name', 'required'],
            ['user_name', 'unique', 'targetClass' => '\common\models\UserDetails', 'message' => 'This username has already been taken.'],
            ['user_name', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\UserDetails', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            
            ['skype', 'required'],
            ['skype', 'string', 'min' => 6],
            
            ['phone', 'required'],
//            [['phone'], 'string', 'max' => 14, 'min' => 11],
            ['phone', 'filter', 'filter' => function ($value) {
              return preg_replace('~\D+~', '', $value);
            }],
        
            
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new UserDetails();
        $user->user_name = $this->user_name;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->skype = $this->skype;
        $user->phone = $this->phone;
        $user->is_active = 1;
        
        return $user->save() ? $user : null;
    }
}
