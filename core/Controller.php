<?php

namespace app\core;

// include helper functions to be available in all controllers
require_once Application::$ROOT_DIR.'/core/helpers.php';

use app\core\Application;

/**
 * Classs Controller
 * @author Algorithmi
 * @package app\Core
 * 
 */

 class Controller {

      public function view($view, $params = [])
      {
          return Application::$app->router->render($view, $params);
      }

 }

 
 /* FOR TESTING

    echo "<pre>";
    echo var_dump($callback);
    echo "</pre>";
    die;

  */