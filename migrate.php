<?php

namespace app;

/**
 * 
 * @author Algorithmi
 * @package app\core
 * 
 */

require_once __DIR__.'/vendor/autoload.php';

/**
 * For loading the .env database variables
 */
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


/**
 * Run the app\core\Darabase from the Application
 */
use app\core\Application;
$app = new Application(__DIR__);
$app->db->applyMigrations();