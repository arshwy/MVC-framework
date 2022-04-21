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

    public Database $db;
    public static string $ROOT_DIR ;
    public Router $router; // a data type of class Router in (php>=7.4)
    public Request $request;
    public Response $response;
    public Session $session;
    public static $config = [];

    // APPLICATION OBJECTS
    public static Application $app;
    

    public function __construct($root_path)
    {
      # loading the route
      self::$ROOT_DIR = $root_path;
      # Loading the congigartion files to the cache
      Config::load();
      self::$config = Config::get('app');
      $this->db = new Database(Config::get('database'));
      self::$app = $this;
      $this->request = new Request();
      $this->response = new Response();
      $this->session = new Session();
      $this->router = new Router($this->request, $this->response);
    }

    # to run the http requests
    public function run()
    {
       $this->router->resolve();
    }

    public function getLocale() 
    {
      if(self::$config['locale'])
          return self::$config['locale'];
      return false;
    }

    public function setLocale($locale) 
    {
      if(self::$config['locale'] && Config::$cache['app']['locale']){
        self::$config['locale'] = $locale;
        Config::$cache['app']['locale'] = $locale;
        return true;
      }
      return false;
    }

    public function root()
    {
      return self::$ROOT_DIR;
    }



 } // class end


 
 /* FOR TESTING

  * echo "<pre>{}</pre>";

  * echo "<pre>";
    echo var_dump($callback);
    echo "</pre>";
    die;
  */













  /* FOR TESTING

  * echo "<pre>{}</pre>";

  * echo "<pre>";
    echo var_dump($callback);
    echo "</pre>";

  */