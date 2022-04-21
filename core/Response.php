<?php

namespace app\core;

// include helper functions to be available in all controllers
require_once Application::$ROOT_DIR.'/core/helpers.php';

/**
 * 
 */

 class Response {

    public function setStatus(int $status)
    {
        // set the response code of the server
        http_response_code($status);
    }

    public function redirect(string $path): Response
    {
      header("Location:  $path");
      return Application::$app->response;
    }

    public function with(string $key, string $message): Response
    {
        flash($key, $message);
        return Application::$app->response;
    }

    public function back(): Response
    {
      header("Location:  {$_SERVER['HTTP_REFERER']}");
      return Application::$app->response;
    }


 }


 
 /* FOR TESTING

  * echo "<pre>{}</pre>";

  * echo "<pre>";
    echo var_dump($callback);
    echo "</pre>";

  */