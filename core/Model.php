<?php

namespace app\core;

use app\core\systemServices as Services;

/**
 * Classs Model
 * @package app\Core
 * @author Algorithmi
 * Is abstract class to avoid creating a direct instance of this model
 * The child/sub class will only make instance to load this Model class
 */

 abstract class Model {

    use Services;

    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';

    public static array $errorsBag = []; # !! important init !!

    public function loadData(array $data)
    {
      foreach ($data as $key => $value) {
        if(property_exists($this, $key)){
          $this->{$key} = $value;
          Application::$app->session->setModelData($key, $value);
        }
      }
      
   /*    echo "<pre>";
      echo var_dump(Application::$app->session->getModelData(), "here");
      echo "</pre>";
      die; */
    }

    /** 
     * A definition of the function
     * This function must be implemented inside the child class
     */
    abstract public function rules(): array;

    public function validate()
    {
        // reset the errors bag if it has previous static errors
        self::$errorsBag = []; 
        foreach ($this->rules() as $attribute => $rules) {
          $value = $this->{$attribute};
          foreach ($rules as $rule) {
            $ruleName = $rule;
            // if the rule is array then extract the rule from this array
            if(is_array($ruleName) && !is_string($ruleName) && !empty($ruleName)){
              $ruleName = key($ruleName);
            }

            # Applying rules check
            if ($ruleName === self::RULE_REQUIRED && !$value) {
              $this->addError($attribute, self::RULE_REQUIRED, $value);
            }
            if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
              $this->addError($attribute, self::RULE_EMAIL, $value);
            }
            if ($ruleName === self::RULE_MIN && strlen($value) < reset($rule)) {
              $this->addError($attribute, self::RULE_MIN, $value, $rule);
            }
            if ($ruleName === self::RULE_MAX && strlen($value) > reset($rule)) {
              $this->addError($attribute, self::RULE_MAX, $value, $rule);
            }
            if ($ruleName === self::RULE_MATCH && $value !== $this->{reset($rule)}) {
              $this->addError($attribute, self::RULE_MATCH, $value, $rule);
            }
            if ($ruleName === self::RULE_UNIQUE) {
              if (is_array(self::RULE_UNIQUE)) {
                $info = implode(',', reset($rule));
                $table = $info[0] ?? $this->table();
                $column = $info[1] ?? $attribute;
              }
              else # is just "unique"
              {
                $table = $this->table();
                $column = $attribute;
              }
              //$className = $this->getClassNameFromTableName($table);
              $stmt = self::prepare("SELECT * FROM $table WHERE $column = :attr");
              $stmt->bindValue(":attr", $value);
              $stmt->execute();
              $row = $stmt->fetchObject();
              if($row)
                $this->addError($attribute, self::RULE_UNIQUE, $value, ['field'=>$attribute]);
            }
          }
        }
        return empty(self::$errorsBag);
    }

    public function addError(string $attribute, string $rule, $value, $params = [])
    {
      $error = $this->errorMessages()[$rule] ?? '';
      foreach ($params as $key => $value) {
        $error = str_replace("{{$key}}", $value, $error);
      }
      # Adding flash error
      $oldError = Application::$app->session->getError($attribute);
      if($oldError)
        Application::$app->session->addToError($attribute, $error);
       else  Application::$app->session->setError($attribute, $error);
      # Adding local error
      self::$errorsBag[$attribute][] = $error;
      /* echo "<pre>";
      echo var_dump(self::$errorsBag, Application::$app->session->getError($attribute));
      echo "</pre>";
      die; */
    }

    public function errorMessages(){
      return [
        self::RULE_REQUIRED => 'This field is required',
        self::RULE_EMAIL => 'This field must be a valid email address',
        self::RULE_MIN => 'Minimum length of this field must be {min}',
        self::RULE_MAX => 'Maximum length of this field must be {max}',
        self::RULE_MATCH => 'This field must be same as field {match}',
        self::RULE_UNIQUE => 'This {field} is already exists',
      ];
    }

    public function getErrors(): array
    {
        $errors = [];
        foreach (self::$errorsBag as $key1 => $fieldErrors) {
          $errors[$key1] = implode(", ", $fieldErrors).'.';
        }
        return $errors;
    }

    public static function errors()
    {
        $errors = [];
        foreach (self::$errorsBag as $key1 => $fieldErrors) {
          $errors[$key1] = implode(", ", $fieldErrors).'.';
        }
        return $errors;
    }


    /**
     * For mapping the child/sub model table
     * @return string $tableName
     */
    abstract public function table(): string;


    public function create(array $assoc_array_inputs_with_coresponding_values)
    {
        $table = $this->table();
        $arrayVlaues = $assoc_array_inputs_with_coresponding_values;
        $attributes = array_keys($arrayVlaues);
        $params = array_map(fn($item) => ":$item", $attributes);
        $sql = "INSERT INTO $table (".implode(",", $attributes).") VALUES(".implode(',', $params).")";
        $statement = self::prepare($sql);
        foreach ($attributes as $attribute) {
          $statement->bindValue(":$attribute", $arrayVlaues[$attribute]);
        }
        $statement->execute();
        return true;
        # should return the created row object
    }


    /**
     * Update database row
     */
    public function update(array $assoc_array_inputs_with_coresponding_values)
    {
        # code ...
    }

    /**
     * Find database row by id
     * @param mixed [int or string ] of $id
     * @return object of the row or null if not found
     */
    public function find(mixed $id)
    {
        # code ...
    }

    /**
     * Get all rows that matched
     * @param string $column_name
     * @param string $keyword
     * @return array $rows of objects or null if not found
     */
    public function get(string $column_name, string $keyword): array
    {
        # code ...
        return [];
    }

    /**
     * @param string of $sql command
     */
    public function write(string $sql)
    {
        # code ...
    }

    /**
     * @param string of $sql command
     * @return array $rows of objects or null if not found
     */
    public function read(string $sql): array
    {
        # code ...
        return [];
    }

    public static function prepare($sql)
    {
      return Application::$app->db->pdo->prepare($sql);
    }



 }


 
 /* FOR TESTING

  * echo "<pre>{}</pre>";

  * echo "<pre>";
    echo var_dump($callback);
    echo "</pre>";
    die;

  */