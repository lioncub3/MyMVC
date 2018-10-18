<?php
const defController = "home";
const defAction = "index";

define('ROOT', __DIR__);

error_reporting(E_ALL);
ini_set('display_errors', 1);

$urlInfo = explode("/", strtolower($_SERVER["REQUEST_URI"]));

$controller = (isset($urlInfo[1]) && !empty($urlInfo[1]) ? $urlInfo[1] : defController) . "Controller";
$action = (isset($urlInfo[2]) ? $urlInfo[2] : defAction) . "Action";

$controllerPath = "controllers/" . $controller . ".php";

// echo $controllerPath;

try {
    if (file_exists($controllerPath)) {
        //including controller file
        require_once($controllerPath);

        if (class_exists($controller)) {
            //creating contoller
            $ctrl = new $controller();

            if (method_exists($ctrl, $action)) {
                //call action function
                echo call_user_func(array($ctrl, $action));
            } else {
                throw new Exception("404 action not found");
            }
        } else {
            throw new Exception("404 controller not found");
        }
    } else {
        throw new Exception("404 file not found");
    }
} catch (Exception $ex) {
    $error = $ex->getMessage();
    require_once("views/_shared/error.php");
}