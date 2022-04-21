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

class User extends Model
{
    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';


    public function table(): string
    {
        return "users";
    }

    public function register(){
        echo "creatng a user";
    }

    public function rules(): array
    {
        return [
            "first_name" => ['required'],
            "last_name" => ['required'],
            "email" => ['required', 'email', ['unique' => 'users,email']],
            "password" => ['required', ['min' => 8], ['max' => 25]],
            "password_confirmation" => [['match' => 'password']],
        ];
    }

    

}