<?php

# do not use namespace

/**
 * Helpers functions for the controllers
 * This file is included in the aap\core\Controllers
 */

use app\core\Application;
use app\core\Config;
use app\core\Model;
use app\core\Response;
use app\core\Session;

/**
 * To render a view page
 */
function view($view, $params = [])
{
    return Application::$app->router->render($view, $params);
}

/**
 * To get a value from a config file
 * Returns true if the value found without key
 */
function config(string $path, $alt = null)
{
    $path = explode(".", $path);
    if(!file_exists(Application::$ROOT_DIR."/config/{$path[0]}.php")) return null;
    $file = Config::$cache[$path[0]]; // get the file array from the cache
    $var = is_array($file)? $file : null;
    unset($path[0]);
    foreach ($path as $value) {
        if (is_array($var)) {
            if (!in_array($value, $var) && !array_key_exists($value, $var)) {
                return $alt;
            }
            $var = $var[$value] ?? true;
        }
        else {
            if($var !== $value) {
                return $alt;
            }
            return true;
        }
    }
    return $var;
}

/**
 * Same as config() but,
 * the value considered not exists if not paired key+value
 */
function configExact(string $path, $alt = null)
{
    $path = explode(".", $path);
    if(!file_exists(Application::$ROOT_DIR."/config/{$path[0]}.php")) return null;
    $file = Config::$cache[$path[0]]; // get the file array from the cache
    $var = is_array($file)? $file : null;
    unset($path[0]);
    foreach ($path as $value) {
        if (is_array($var)) {
            if (!in_array($value, $var) && !array_key_exists($value, $var)) {
                return $alt;
            }
            $var = $var[$value] ?? $alt;
        }
        else {
            return $alt;
        }
    }
    return $var;
}



/**
 * Getting the old value of an input if any
 */
function old($input)
{
    //return Application::$app->session->getErrorData($input) ?? null; // from session
/*     echo "<pre>";
    echo var_dump("hi", Application::$app->session->getModelData()[$input]);
    echo "</pre>"; 
    die; */
    return Application::$app->session->getModelData($input) ?? null;
}

/**
 * Getting the validation error if any
 * @param string $input
 * @return string the required saved message
 * @return null if the required saved message not found
 */
function error(string $input): string|null
{
   /*  echo "<pre>";
    echo var_dump(Application::$app->session->getError($input), " here ");
    echo "</pre>"; 
    die; */
    //return "hi";
    return Application::$app->session->getError($input) ?? null; // from session
    //return Model::errors()[$input] ?? null ; // from error bag
}

/**
 * Get validation errors from error bag
 * @return string $error for an input if you used the @param $input
 * @return array of all errors in the error bag if not used the @param $input
 */
function errorBag(string $input = null): array|string|null
{
    // return only one input error if any
    if($input) { 
        return Model::errors()[$input] ?? null ;
    }
    // return the whole error bag array if any
    else { 
        return Model::errors() ?? [] ;
    }
}

/**
 * Returning an instance of the Application
 * To be used in all framework controllers and views
 */
function app()
{
    return Application::$app;
}

/**
 * Get the current locale language
 */
function locale()
{
    return Application::$app->getLocale();
}

/**
 * returns requiered items from an array
 */
function onlyFrom(array $required_keys, array $all)
{
    $result = [];
    foreach ($required_keys as  $key) {
        if ($all[$key]) {
            $result[$key] = $all[$key];
        }
    }
    return $result;
}

/**
 * Hashing a password
 */
 function passwordHash(string $password): string
 {
    return password_hash(
        $password, 
        configExact("auth.password_hash", PASSWORD_DEFAULT)
    );
 }


 /**
  * Languages function
  */
  function __(string $path): string
  {
    $path = explode(".", $path);
    $locale = Application::$app->getLocale();
    $file = $path[0];
    unset($path[0]);
    $string = implode(" ", $path);
    $file = Application::$ROOT_DIR."/lang/{$locale}/{$file}.php";
    if(!file_exists($file)) return $string;
    $file = require $file; // the file returns an array
    if(!is_array($file)) return $string;
    $var = $file;
    foreach ($path as $value) {
        if (is_array($var)) {
            echo "is array";
            if (!in_array($value, $var) && !array_key_exists($value, $var)) {
                return $alt;
            }
            $var = $var[$value] ?? $value;
        }
        else {
            return $string;
        }
    }
    return $var;
  }

/**
 * @param string $env
 * @param string $alt if not found
 * @return string .env variable from .env file
 */
function env(string $env, string $alt = null): string
{
    return $_ENV[$env] ?? $alt;
}

/**
 * @return string the required saved message
 * @return null if the required saved message not found
 * @return bool true if demanded to save message
 */
function session(string $key, string $message = null): string|null|bool
{
    if ($message) {
        Session::put($key, $message);
        return true;
    }
    return Session::get($key) ?? null;
}

/**
 * @return string the required saved message
 * @return null if the required saved message not found
 * @return bool true if demanded to save message
 */
function flash(string $key, string $message = null): string|null|bool
{
    if ($message) {
        Application::$app->session->setFlash($key, $message);
        return true;
    }
    return Application::$app->session->getFlash($key) ?? null;
}

/**
 * Redirect to another path
 * @param string $path
 * @return Response
 */
function redirect(string $path = null): Response
{
    $path? Application::$app->response->redirect($path) : null;
    return Application::$app->response;
}



/* 
    echo "<pre>";
    echo var_dump($var);
    echo "</pre>"; 
    die;
*/

