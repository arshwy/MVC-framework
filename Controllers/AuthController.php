<?php 

/** User: Algorithmi ... */

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;

/**
 * Class AuthController
 * 
 * @author Algorithmi
 * @package app\controllers
 */

 class AuthController  extends Controller
 {

    public function login()
    {
        return $this->view('login', [
            'title' => "Login to your account"
        ]);
    }

    public function check(Request $request)
    {
        echo "check user";
    }


    public function register()
    {
        return $this->view('register', [
            'title' => "Create new account"
        ]);
    }

    public function create(Request $request)
    {
        $registerModel = new RegisterModel();
        $registerModel->loadData($request->getData());

        if($registerModel->validate() && $registerModel->register()){
            return "Sucess!";
        }

        return $this->view('register', [
            'title' => "Create new account",
            'old' => $request->getData(),
            'errors' => $registerModel->getErrors(),
        ]);
    }


 }


 
 /* FOR TESTING
  * echo "<pre>{}</pre>";
  * echo "<pre>";
    echo var_dump($callback);
    echo "</pre>";
    die;
  */