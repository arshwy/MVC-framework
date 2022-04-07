<?php

namespace app\core;


/**
 * Class Application
 * 
 * @author Algorithmi
 * @package app\core
 * 
 */

 class Application {

    public static string $ROOT_DIR;
    public Router $router; // a data type of class Router in (php>=7.4)
    public Request $request;
    public Response $response;
    public static Application $app;
    public static array $config = []; // the aliases/global classes
    public static array $aliases = []; // the aliases/global classes

    public function __construct($root_path)
    {
      self::$ROOT_DIR = $root_path; 
      self::$app = $this;
      self::$config =  require $root_path.'/config/app.php'; 
      self::$aliases = self::$config['aliases'];
      $this->request = new Request();
      $this->response = new Response();
      $this->router = new Router($this->request, $this->response);
    }

   //to run the get/post/put and other requests
    public function run()
    { 
       $this->router->resolve();
    }

    public function getLocale() {
      return self::$config['locale'];
    }

    public function setLocale($locale) {
      self::$config['locale'] = $locale;
    }

    public function getRootDir(){
      return self::$ROOT_DIR;
    }



 } // class end


 
 /* FOR TESTING

  * echo "<pre>{}</pre>";

  * echo "<pre>";
    echo var_dump($callback);
    echo "</pre>";

  */













  /* FOR TESTING

  * echo "<pre>{}</pre>";

  * echo "<pre>";
    echo var_dump($callback);
    echo "</pre>";

  */