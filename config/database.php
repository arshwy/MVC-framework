<?php

use app\core\Application;

// include helper functions to be available in all controllers
require_once Application::$ROOT_DIR.'/core/helpers.php';

return [

    /**
     * The used database systems (msql, etc...)
     */
    "database" => env('DATABASE', "mysql"),


    /**
     * The database name in your your database system
     */
    "name" => env('DB_NAME', "algorithmi_framework"),


    /**
     * The host name (localhost, etc...)
     */
    "host" => env('DB_HOST', "localhost"),


    /**
     * The used port of the database system (3306, etc ...)
     */
    "port" => env('DB_PORT', "3306"),

    
    /**
     * The user of the database (root, etc ...)
     */
    "user" => env('DB_USER', "root"),

    
    /**
     * The password of the user
     */
    "password" => env('DB_PASSWORD'),

];