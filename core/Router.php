<?php

 namespace app\core;


 
/**
 * Class Router
 * 
 * @author Algorithmi
 * @package app\core
 * @param Request $request
 * @param Response $response
 * 
 */


 class Router {

    protected array $routes = [];
    public Request $request;
    public Response $response;
    public array $aliases = [];

    public function __construct(Request $request, Response $response)
    {
         $this->request = $request;
         $this->response = $response;
    }

     // this function is called in the routes file
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if($callback === false){ // if false then render 404 page
            $this->response->setStatus(404);
            $page_404 = $this->getView("404");
            if($page_404){
                echo $this->renderContent($page_404);
            }
            else {
                echo "<section>
                        <div style= \"
                            text-align: center;
                            margin: 30vh 0;
                            color: #666666;
                            font-weight: bold;
                            font-size: 1.3rem; \">
                            Server Error 404: Page Not Found!
                        </div>
                    </div>";
                }
        }
        elseif (is_string($callback)) { // if view file then render
            echo $this->render($callback);
        }
        elseif(is_array($callback)){ // if is an array composed of [class, function]
            $callback[0] = $callback[0] ? new $callback[0] : false;
            print call_user_func($callback, $this->request);
        }
    }

    // this function will execute the call back and return a string of the content
    public function render($view, $params = [])
    {
        $layoutContent =  $this->renderOnlyLayout();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{view}}', $viewContent, $layoutContent); 
    }

    protected function renderOnlyLayout()
    {
        ob_start(); // start output caching as buffer [nothing actually output on the browser]
        foreach(Application::$aliases as $aliase => $class){
             $$aliase = $class;
        }
        
        include_once Application::$ROOT_DIR."/views/layouts/index.php";
        return ob_get_clean(); // return the buffered content
    }

    protected function renderOnlyView($view, $params)
    {
        ob_start(); // start output caching [nothing actually output on the browser]
        extract($params); // convert the array elements into variables
        /* Another approach for the extract() is:
            foreach($params as $key => $value){
                $$key = $value;
            }
        */
        include_once Application::$ROOT_DIR."/views/{$view}.php";
        return ob_get_clean(); // return the buffered content
    }

    protected function renderContent($view){
        $layoutContent =  $this->renderOnlyLayout();
        return str_replace('{{view}}', $view, $layoutContent); 
    }


    // views folder is the root
    // $pagePathName, without extension
    protected function getView($pagePathName)
    {
        $page = Application::$ROOT_DIR."/views/{$pagePathName}.php";
        if( file_exists($page) ){
            ob_start(); // start output caching [nothing actually output on the browser]
            include_once Application::$ROOT_DIR."/views/{$pagePathName}.php";
            return ob_get_clean(); // return the buffered content
        } 
        else{
            return false;
        }
    }
     
 }


/* FOR TESTING

* echo "<pre>{}</pre>";

* echo "<pre>";
echo var_dump($callback);
echo "</pre>";

*/