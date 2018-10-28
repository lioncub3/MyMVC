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

        $db = DB::connect();
        if (isset($_POST["productsbasket"]) && !empty($_POST["productsbasket"]) && 
        isset($_POST["userid"]) && !empty($_POST["userid"])) {
            $sql = "INSERT INTO `orders` (`IDUser`) VALUES (?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$_POST["userid"]]);

            $idProducts = 

            $sql = "INSERT INTO `productsorders` (`IDProduct`, `IDOrder`) VALUES (?, ?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$_POST["userid"]]);
        }

        $this->renderView("index.php");
    }
}