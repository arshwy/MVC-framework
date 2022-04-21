<?php 

/** User: Algorithmi ... */

namespace app\controllers; # Mandatory
use app\core\Controller; # Mandatory
use app\core\Request; # Mandatory


use app\models\User;


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
        return view('register', [
            'title' => "Create new account"
        ]);
    }

    public function create(Request $request)
    {
        $user = new User();
        $user->loadData($request->getData());
        if($user->validate()){
            $stored_user = $user->create([
                "firstname" => $user->first_name,
                "lastname" => $user->last_name,
                "email" => $user->email,
                "password" => passwordHash($user->password),
            ]);
            redirect('/')->with('success', "You are successfully registered!");
        }
        else 
        {
            redirect()->back();
        }
    }



 }


 
 /* FOR TESTING
    echo "<pre>";
    echo var_dump($callback);
    echo "</pre>";
    die;
  */