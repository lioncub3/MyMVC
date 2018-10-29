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

            $idorder = $db->lastInsertId();

            $products = json_decode($_POST["productsbasket"]);

            foreach ($products as $product) {
                $sql = "INSERT INTO `productsorders` (`IDOrder`, `IDProduct`) VALUES (?, ?)";
                $stmt = $db->prepare($sql);
                $stmt->execute([$idorder, $product->idproduct]);
            }
        }

        $this->renderView("index.php");
    }
}