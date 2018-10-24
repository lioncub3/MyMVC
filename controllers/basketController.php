<?php
require_once("core/controller.php");
require_once("core/connection.php");

class basketController extends Controller
{
    private function isLogin()
    {
        if (!$_SESSION["user"]?? false){
            header('Location: /login');
            exit;
        }
    }

    function indexAction()
    {
        $this->isLogin();

        $this->renderView("index.php");
    }
}