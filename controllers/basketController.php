<?php
require_once("core/controller.php");
require_once("core/connection.php");

class adminController extends Controller
{
    private function isAdmin()
    {
        if (!$_SESSION["admin"]?? false){
            header('Location: /login');
            exit;
        }
    }

    function indexAction()
    {
        $this->isAdmin();
        
        $db = DB::connect();
            if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["iddelete"]) && !empty($_POST["iddelete"])) {
                $sql = "DELETE FROM `products` WHERE IDProduct = ?";
                $stmt = $db->prepare($sql);
                $stmt->execute([$_POST["iddelete"]]);   
            }
        $this->renderView("index.php");
        
    }
}