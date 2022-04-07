<?php 


namespace app\core;

/**
 * Class Request
 * 
 * @author Algorithmi
 * @package app\core
 * 
 */



class Request {

    public function getPath()
    {
        // get the REQUEST_URI form the $_SERVER and return '/' if not found
        $path = $_SERVER['REQUEST_URI'] ?? '/';

        // get the '?' position in the $path string
        // gives false if no '?'
        $position = strpos($path, '?');
        if($position == false){
            return $path;
        }
        return substr($path, 0, $position);
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet()
    {
        return $this->getMethod() === 'get';
    }

    public function isPost()
    {
        return $this->getMethod() === 'post';
    }

    public function getData()
    {
        $data = [];
        if($this->getMethod() === 'get') {
            foreach($_GET as $key => $value){
                $data[$key] = filter_input(
                    INPUT_GET, 
                    $key,
                    FILTER_SANITIZE_SPECIAL_CHARS
                );
            }
        }
        elseif($this->getMethod() === 'post') {
            foreach($_POST as $key => $value){
                $data[$key] = filter_input(
                    INPUT_POST, 
                    $key,
                    FILTER_SANITIZE_SPECIAL_CHARS
                );
            }
        }
        foreach($_FILES as $key => $value) {
            $data['____FILES____'][$key] = $value;
        }
        return $data;
    }

}




 /* FOR TESTING

  * echo "<pre>{}</pre>";

  * echo "<pre>";
    echo var_dump($callback);
    echo "</pre>";

  */