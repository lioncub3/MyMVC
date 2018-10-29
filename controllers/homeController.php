<?php
require_once("core/controller.php");

class homeController extends Controller
{
    function indexAction() 
    {
        $this->renderView("index.php");
    }

    function logoutAction()
    {
        if(isset($_SESSION["user"]))
        {
            unset($_SESSION['user']);
        }
        $this->renderView("logout.php");
    }
}