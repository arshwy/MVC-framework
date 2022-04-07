<?php

namespace app\core;


/**
 * Class Auth
 * 
 * @author Algorithmi
 * @package app\core
 * 
 */

 class Auth {

    # this is the authenticated user
    private static $user = ["id"=>2, "name"=>"Ahmed"];

    public function __construct()
    {
        $this->user = ["id"=>2, "name"=>"Ahmed"];
    }

    public static function user()
    {
        return self::$user;
    }

    public function getUser()
    {
        return $this->user;
    }

 }