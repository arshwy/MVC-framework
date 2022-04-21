<?php

namespace app\core;

/**
 * Gathering all functions that serve building the framework system
 */
trait systemServices 
{
    /**
     * @param string of $tableName
     * @return string of $className 
     * Ex: categories will be Category (ies to y + capitalize the first)
     * Ex: categorables will be Categorable (removing s + capitalize the first)
     * Ex: users will be User (removing s + capitalize the first)
     * Ex: about_words will be AboutWord (camel case + capitalize the first for all words)
     */
    public function getClassNameFromTableName(string $tableName)
    {
        $tableWords = explode('_', $tableName);
        foreach ($tableWords as $key => $word)
            $tableWords[$key] = ucfirst($word);
        $last = $tableWords[count($tableWords)-1];
        $chars = str_split($last);
        $i = count($chars)-3; 
        $e = count($chars)-2; 
        $s = count($chars)-1;
        if ($chars[$i] === 'i' && $chars[$e] === 'e' && $chars[$s] === 's') {
            unset($chars[$i]); 
            unset($chars[$e]); 
            unset($chars[$s]);
            $chars[] = 'y';
        }
        elseif($chars[$s] === 's')
            unset($chars[$s]);
        $tableWords[count($tableWords)-1] = implode('', $chars);
        return implode($tableWords);
    }


    /**
     * 
     */
    public function normalizeInputName(string $inputName): string
    {
        $inputName = str_replace("_", " ", $inputName);
        $inputName = str_replace("-", " ", $inputName);
        // later you need
        // to separate the camel case by spaces
        // to remove the extra space
        return $inputName;
    }



} // class end


 /* FOR TESTING
    echo "<pre>";
    echo var_dump($callback);
    echo "</pre>";
    die;
  */