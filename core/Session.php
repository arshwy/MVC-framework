<?php 

namespace app\core;


/**
 * Class Session
 * 
 * @author Algorithmi
 * @package app\core
 * 
 */


 class Session 
 {

    protected const FLASH_KEY = "1_2_flash_3_messages_4_5";
    protected const ERROR_KEY = "1_2_error_3_messages_4_5";
    protected const MODEL_DATA_KEY = "1_2_model_3_Data_4_messages_5_6";

    function __construct()
    {
        # starting the session
        $_SESSION[self::FLASH_KEY] = [];
        $_SESSION[self::ERROR_KEY] = [];
        session_start();
        $all = $_SESSION[self::FLASH_KEY] ?? [];
        // the & is by ref instead of $all[flash]['remove']
        foreach ($all as &$flash) { 
            # mark to be removed
            $flash['remove'] = true;
        }
        $_SESSION[self::FLASH_KEY] = $all;

        $all = $_SESSION[self::ERROR_KEY] ?? [];
        foreach ($all as &$e) { 
            if(is_array($e)) $e['remove'] = true;
        }
        $_SESSION[self::ERROR_KEY] = $all;

        $all = $_SESSION[self::MODEL_DATA_KEY] ?? [];
        foreach ($all as &$e) { 
            if(is_array($e)) $e['remove'] = true;
        }
        $_SESSION[self::MODEL_DATA_KEY] = $all;
    }

    /**
     * Setting a flash message inside the global session array
     * The flash message will auto cleared after the next http request
     * The flash message has a on-request live-time
     */
    public function setFlash(string $key, string $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'value' => $message,
            'remove'=> false
        ];
    }

    public function addToFlash(string $key, string $message)
    {
        $_SESSION[self::FLASH_KEY][$key]['value'] .= $message;
    }

    public function getFlash($key): string|null
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? null;
    }

    /**
     * Setting an error message inside the global session
     */
    public function setError(string $key, string $error)
    {
        $_SESSION[self::ERROR_KEY][$key] = [
            'value' => [$error],
            'remove'=> false
        ];
        //$_SESSION[self::ERROR_KEY][$key]= '';
    }

    public function addToError(string $key, string $error)
    {
        /* echo "<pre>";
        echo var_dump("add error");
        echo "</pre>"; */
        //$_SESSION[self::ERROR_KEY][$key]['value'] = '';
        $old =  $_SESSION[self::ERROR_KEY][$key]['value'];
        if(!in_array($error, $old)) $old[] = $error;
        //$_SESSION[self::ERROR_KEY][$key]= '';
    }

    public function getError($key): string|null
    {
        /* echo "<pre>";
        echo var_dump($_SESSION[self::ERROR_KEY][$key]);
        echo "</pre>"; */
        //die;
        //$_SESSION[self::ERROR_KEY][$key] = '';
        $e = $_SESSION[self::ERROR_KEY][$key] ?? null;
        if($e && is_array($e['value']) && count($e['value']))
            return implode(", ", $e['value']) ?? null;
        return null;
    }

    public function setModelData(string $key, string $data){
        $_SESSION[self::MODEL_DATA_KEY][$key] = [
            'value' => $data,
            'remove'=> false
        ];
        //$_SESSION[self::MODEL_DATA_KEY] = $old;
    }

    public function getModelData($key): string|null
    {
        return $_SESSION[self::MODEL_DATA_KEY][$key]['value'] ?? null;
        //return $_SESSION[self::MODEL_DATA_KEY];
    }

    public static function put(string $key, string $message)
    {
        $_SESSION[$key] = $message;
    }

    public static function get(string $key): string|null
    {
        return $_SESSION[$key] ?? null;
    }

    
    function __destruct()
    {
        // destructon the flash message
        $all = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($all as $key => $flash) {
            if($flash['remove'] == true) {
                unset($all[$key]);
            }
        }
        $_SESSION[self::FLASH_KEY] = $all;

        // destructon the error message
        $all = $_SESSION[self::ERROR_KEY] ?? [];
        foreach ($all as $key => $e) {
            if(is_array($e) && $e['remove'] == true) {
                unset($all[$key]);
            }
        }
        $_SESSION[self::ERROR_KEY] = $all;

        // destructon the old data
        $all = $_SESSION[self::MODEL_DATA_KEY] ?? [];
        foreach ($all as $key => $d) {
            if(is_array($d) && $d['remove'] == true) {
                unset($all[$key]);
            }
        }
        $_SESSION[self::MODEL_DATA_KEY] = $all;
    }




 }// class end