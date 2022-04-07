<?php

namespace app\core;

use validationServices;

/** NOT USED YET !!!!!!!!
 * Class Validator
 * 
 * @author Algorithmi
 * @package app\core
 * 
 */

 class Validator {
    use validationServices;

    private static $validation;
    public static $data = null;
    public static $files = null;
    public static $status = true;
    public static $errors = null;

    public function __construct()
    {
        $locale = Application::$app->getLocale();
        self::$validation = 
            require Application::$ROOT_DIR."/langs/{$locale}/validation.php";
        self::$data = null;
        self::$files = null;
        self::$status = null;
        self::$errors = null;
    }

    public static function make(array $data, array $rules, $messages = [])
    {
        self::$data = $data;
        $errors = [];
        $rules = self::explodeRulesToArrays($rules);
        $files = [];
        $conditionInputsResults = [];
        $conditionFilesResults = [];
        if ($data['____FILES____'] && is_array($data['____FILES____'])) {
            self::$files = $files = $data['____FILES____'];
            unset($data['____FILES____']);
        }
        foreach($data as $input => $value) {
            $conditionInputResults[$input] = self::applyInputConditions($input, $value, $rules, self::$validation);
        }
        foreach ($files as $file => $value) {
            $conditionFilesResults[$file] = self::applyFileConditions($file, $value, $rules, self::$validation);
        }
        $errors = [];
        if (count($conditionInputsResults)) {
            $errors = self::buildSpecialErrors($conditionInputsResults, $messages);
        }
        if (count($conditionFilesResults)) {
            $errors = array_merge(
                $errors,
                self::buildSpecialErrors($conditionFilesResults, $messages)
            );
        }
        if (count($errors)) {
            self::$status = false;
            self::$errors = $errors;
        }
        else{
            self::$status = true;
            self::$errors = null;
        }
    }



 }