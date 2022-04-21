<?php 

namespace app\core;

/**
 * Classs Config
 * @author Algorithmi
 * @package app\Core
 * 
 */

class Config {

    # cahcing config files in one array
    public static array $cache = [];
    # caching instance of this class at the first instant creating
    public static Config $obj;


    /**
     * Loading the config files
     * This is called on the Application constructor only
     * Application instance is being created in public/index.php
     */
    public static function load(){
        $config_files = scandir(Application::$ROOT_DIR.'/config'); 
        foreach ($config_files as $file) {
            if (in_array($file, ['.', '..']) ) continue;
            $file = pathinfo($file)["filename"];
            if(file_exists(Application::$ROOT_DIR."/config/{$file}.php"))
                self::$cache[$file] = include Application::$ROOT_DIR."/config/{$file}.php";
        }
    }

    // getting single cached file array
    public static function get($file)
    {
        return self::$cache[$file]?? null;
    }

    // getting single cached file array non static
    public function file($name)
    {
        return self::$cache[$name]?? null;
    }

}



/* FOR TESTING

    echo "<pre>";
    echo var_dump($callback);
    echo "</pre>";
    die;

*/