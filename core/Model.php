<?php

namespace app\core;


/**
 * Classs Model
 * @package app\Core
 * @author Algorithmi
 * Is abstract class to avoid creating a direct instance of this model
 * The child/sub class will only make instance to load this Model class
 */

 abstract class Model {

    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';

    public array $errors;

    public function loadData(array $data)
    {
      foreach ($data as $key => $value) {
        if(property_exists($this, $key)){
          $this->{$key} = $value;
        }
      }
    }

    /** 
     * A definition of the function
     * This function must be implemented inside the child class
     */
    abstract public function rules(): array;

    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
          $value = $this->{$attribute};
          foreach ($rules as $rule) {
            $ruleName = $rule;
            if(!is_string($ruleName) && is_array($ruleName) && !empty($ruleName)){
              $ruleName = key($ruleName);
            }
            if ($ruleName === self::RULE_REQUIRED && !$value) {
              $this->addError($attribute, self::RULE_REQUIRED);
            }
            if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
              $this->addError($attribute, self::RULE_EMAIL);
            }
            if ($ruleName === self::RULE_MIN && strlen($value) < reset($rule)) {
              $this->addError($attribute, self::RULE_MIN, $rule);
            }
            if ($ruleName === self::RULE_MAX && strlen($value) > reset($rule)) {
              $this->addError($attribute, self::RULE_MAX, $rule);
            }
            if ($ruleName === self::RULE_MATCH && $value !== $this->{reset($rule)}) {
              $this->addError($attribute, self::RULE_MATCH, $rule);
            }

          }
        }

        return empty($this->errors);
    }

    public function addError(string $attribute, string $rule, $params = [])
    {
      $message = $this->errorMessages()[$rule] ?? '';
      foreach ($params as $key => $value) {
        $message = str_replace("{{$key}}", $value, $message);
      }
      $this->errors[$attribute][] = $message;
    }

    public function errorMessages(){
      return [
        self::RULE_REQUIRED => 'This field is required',
        self::RULE_EMAIL => 'This field must be a valid email address',
        self::RULE_MIN => 'Minimum length of this field must be {min}',
        self::RULE_MAX => 'Maximum length of this field must be {max}',
        self::RULE_MATCH => 'This field must be same as field {match}',
      ];
    }


    public function getErrors(): array
    {
      $errors = [];
      foreach ($this->errors as $key1 => $fieldErrors) {
        $errors[$key1] = implode(", ", $fieldErrors).'.';
      }
      return $errors;
    }


 }


 
 /* FOR TESTING

  * echo "<pre>{}</pre>";

  * echo "<pre>";
    echo var_dump($callback);
    echo "</pre>";
    die;

  */