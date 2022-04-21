<?php


/**
 * Support services for Validator class
 */


trait validationServices {


    /** -----------------------------------------------------------------
     * Manipulating the inputs grouping
     * ------------------------------------------------------------------
     */


    public function explodeRulesToArrays($rules)
    {
        foreach($rules as $key => $inputRules)
        {
            if(!is_array($inputRules)) {
                $inputRules = explode("|", $inputRules);
                foreach($inputRules as $rule) {
                    if (strpos($rule, ":") !== false) {
                        $rule = explode(":", $rule); 
                        //i[0] = rule & i[1] = rule number
                        $rule[1] = intval($rule[1]);
                    }
                }
            }
        }
        return $rules;
    }

    public function applyInputConditions($input, $value, $inputRules, $validation)
    {
        $results = [];
        foreach($inputRules as $rule) {
            //if $rule is not in format rule:number like max:3
            $flag = false; 
            if (!is_array($rule)) {
                switch ($rule) {
                    case 'required': $this->isEmpty($value) ? $flag = true : '';
                        break;
                    case "string": !$this->isString($value) ? $flag = true : '';
                        break;
                    case "email": !$this->isEmail($value) ? $flag = true : '';
                        break;
                    case "int": !$this->isInt($value) ? $flag = true : '';
                        break;
                    case "numeric": !$this->isNumeric($value) ? $flag = true : '';
                        break;
                    default : break;
                }
                if ($flag) {
                    $results[$input][$rule] = $this->applyMessage( 
                        $validation[$rule], 
                        [":attribute" => $input] 
                    );
                }
            }
            // if $rule is in format rule:number like max:3
            else { 
                if (is_string($value))
                {
                    switch ($rule[0]) 
                    {
                        case "max": strlen($value) > $rule[1] ?
                            $results[$input][$rule] = $this->applyMessage( 
                                $validation[$rule[0]]['string'], 
                                [":attribute" => $input, ":max" => $rule[1]] 
                            ) : '';
                            break;
                        case "min": strlen($value) < $rule[1] ?
                            $results[$input][$rule] = $this->applyMessage( 
                                $validation[$rule[0]]['string'], 
                                [":attribute" => $input, ":min" => $rule[1]] 
                            ) : '';
                            break;
                        default: break;
                    }
                }
                elseif(is_int($value) || is_numeric($value))
                {
                    switch ($rule[0]) 
                    {
                        case "max": $value > $rule[1] ?
                            $results[$input][$rule] = $this->applyMessage( 
                                $validation[$rule[0]]['numeric'], 
                                [":attribute" => $input, ":max" => $rule[1]] 
                            ) : '';
                            break;
                        case "min": $value < $rule[1] ?
                            $results[$input][$rule] = $this->applyMessage( 
                                $validation[$rule[0]]['numeric'], 
                                [":attribute" => $input, ":min" => $rule[1]] 
                            ) : '';
                            break;
                        default: break;
                    }
                }
            }
        }
        return $results;
    }

    public function applyFileConditions($file, $value, $fileRules, $validation)
    {
        $results = [];
        foreach($fileRules as $rule) {
            //if $rule is not in format rule:number like max:3
            $flag = false; 
            if (!is_array($rule)) {
                switch ($rule) {
                    case 'required': $this->isFileEmpty($value) ? $flag = true : '';
                        break;
                    default : break;
                }
                if ($flag) {
                    $results[$file][$rule] = $this->applyMessage( 
                        $validation[$rule], 
                        [":attribute" => $file] 
                    );
                }
            }
            // if $rule is in format rule:number like max:3
            else { 
                switch ($rule[0])
                {
                    case "max": $value["size"] > $rule[1] ?
                        $results[$file][$rule] = $this->applyMessage( 
                            $validation[$rule[0]]['file'], 
                            [":attribute" => $file, ":max" => $rule[1]] 
                        ) : '';
                        break;
                    case "min": $value["size"] < $rule[1] ?
                        $results[$file][$rule] = $this->applyMessage( 
                            $validation[$rule[0]]['file'], 
                            [":attribute" => $file, ":min" => $rule[1]] 
                        ) : '';
                        break;
                    default: break;
                }
            }
        }
        return $results;
    }

    /**
     * This function takes a string and replace seached words 
     * by corresponding words ia the assoc array
     */
    public function applyMessage($message, array $replaceWords)
    {
        foreach ($replaceWords as $key => $word) {
            $message = str_replace($message, $key, $word);
            $message = str_replace($message, "-", " ");
            $message = str_replace($message, "_", " ");
        }
        return $message;
    }

    private static function buildSpecialErrors($conditionReults, $messages = [])
    {
        // $message = "email.email" => "invalid email"
        $errors = [];
        foreach ($conditionReults as $input => $failed_rules) {
            foreach ($failed_rules as $failed_rule) {
                if(array_key_exists("$input.$failed_rule", $messages)){
                    $errors[$input][$failed_rule] = $messages["$input.$failed_rule"];
                }
            }
        }
        return $errors;
    }




    
    /** -----------------------------------------------------------------------------
     * Validation rules grouping
     * -------------------------------------------------------------------------------
     */

    public function isEmpty($input)
    {
        if (!$input || $input === '' || $input === null) {
            return true;
        }
        return false;
    }

    public function isFileEmpty(array $input)
    {
        if (!$input || $input["tmp_name"] === false || $input === '' || $input === null) {
            return true;
        }
        return false;
    }

    public function isEmail($input)
    {
        if (is_string($input) && (strpos($input, "@") === false)) {
            return true;
        }
        return false;
    }

    public function isString($input)
    {
        if (is_string($input)) {
            return true;
        }
        return false;
    }

    public function isInt($input)
    {
        if (is_int($input)) {
            return true;
        }
        return false;
    }

    public function isNumeric($input)
    {
        if (is_numeric($input)) {
            return true;
        }
        return false;
    }



}