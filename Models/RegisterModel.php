<?php

namespace app\models;

use app\core\Model;

/**
 * Class RegisterModel
 * @author Algorithmi
 * @package app\models
 * The class must contain properties of all used data in the form
 * All properties must be exact names of their html names 
 */

class RegisterModel extends Model
{
    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';



    public function register(){
        echo "creatng a user";
    }

    public function rules(): array
    {
        return [
            "first_name" => [self::RULE_REQUIRED],
            "last_name" => [self::RULE_REQUIRED],
            "email" => [self::RULE_REQUIRED, self::RULE_EMAIL],
            "password" => [
                self::RULE_REQUIRED, 
                [self::RULE_MIN => 8], 
                [self::RULE_MAX => 25]
            ],
            "password_confirmation" => [
                [self::RULE_MATCH => 'password']
            ],
        ];
    }

    

}