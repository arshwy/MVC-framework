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
 * Configrations
 */
$ROOT_DIR = dirname(__DIR__);
// Loading the .env files to $_$ENV by vlucas/phpdotenv package that we installed by composer
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable($ROOT_DIR);
$dotenv->load();







/**
 * AAPPLICATION USES
 */
use app\core\Application;


/**
 * APPLICATION INSTANCE
 */
$app = new Application($ROOT_DIR);


/**
 * APPLICATION REQUIREMENTS
 */
require_once $ROOT_DIR.'/routes/web.php';


/**
 * RUNNING THE APPLICATION
 */
$app->run();