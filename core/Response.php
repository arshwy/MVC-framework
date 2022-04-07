<?php

namespace app\core;

/**
 * 
 */

 class Response {

    public function setStatus(int $status)
    {
        // set the response code of the server
        http_response_code($status);
    }
 }


 
 /* FOR TESTING

  * echo "<pre>{}</pre>";

  * echo "<pre>";
    echo var_dump($callback);
    echo "</pre>";

  */