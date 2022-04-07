<?php

/**
 * User: Algorithmi 
 * Date: 4/5/2022
 * Time: 3:43 PM
 */



 /** 
  * COMPOSER REFERENCE DIR
  * This helps to find the included controllers/classes from app\{....}
  */
require_once __DIR__.'/../vendor/autoload.php';


/** 
 * CONFIGRATIONS
 */
$ROOT_DIR = dirname(__DIR__);


/**
 * AAPPLICATION INSTANCE
 */

use app\core\Application;
$app = new Application($ROOT_DIR);


/**
 * APPLICATION ROUTES
 */
require_once  $ROOT_DIR.'/routes/web.php';


/**
 * RUNNING THE APPLICATION
 */
$app->run();