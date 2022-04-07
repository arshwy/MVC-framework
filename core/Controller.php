<?php

namespace app\core;

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
            return Application::$app->router->render($view, $params );
        }


 }


 
 /* FOR TESTING

  * echo "<pre>{}</pre>";

  * echo "<pre>";
    echo var_dump($callback);
    echo "</pre>";

  */