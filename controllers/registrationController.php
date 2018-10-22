<?php
require_once("db.config.php");
require_once("core/controller.php");
require_once("core/connection.php");

class registrationController extends Controller
{
    function indexAction()
    {
        $db = DB::connect();
       
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["name"]) && isset($_POST["password"]) && isset($_POST["email"]) && 
        !empty($_POST["name"]) && !empty($_POST["password"]) && !empty($_POST["email"])) {
                $sql = "INSERT INTO `users`(`Name`, `Email`, `Password`) VALUES (?, ?, ?)";
                $stmt = $db->prepare($sql);
                $stmt->execute([$_POST["name"], $_POST["email"], hashPassword($_POST["password"])]);
                header('Location: /login');
        } else {
            $this->renderView("index.php");
        }
    }
}

function hashPassword($password)
{
    return md5($password);
}