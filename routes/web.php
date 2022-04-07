<?php 


/**
 * THE APPLICATION INCLUDES
 */

use app\controllers\SiteController;
use app\controllers\AuthController;




/**
 * THE APPLICATION ROUTES
 */


$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'action']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/check', [AuthController::class, 'check']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/create', [AuthController::class, 'create']);

