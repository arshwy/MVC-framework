<?php 

/** User: Algorithmi ... */

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

/**
 * Class SiteController
 * 
 * @author Algorithmi
 * @package app\controllers
 */

 class SiteController  extends Controller
 {

    public function home()
    {

        $title = 'Home page';
        return $this->view('home', compact("title"));
    }


    public function contact()
    {

        $title = 'Contact page';
        return $this->view('contact', compact("title"));
    }


    public function action(Request $request)
    {
        $data = $request->getData();
        echo "<pre>";
        echo var_dump($data);
        echo "</pre>";
        $title = 'Contact page';
       
    } 


 }


 
 /* FOR TESTING
  * echo "<pre>{}</pre>";
  * echo "<pre>";
    echo var_dump($callback);
    echo "</pre>";
  */