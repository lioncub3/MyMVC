<?php
require_once("db.config.php");
require_once("core/controller.php");

class registrationController extends Controller
{
    function indexAction()
    {
        $this->renderView("index.php");

        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["name"]) && isset($_POST["password"]) && isset($_POST["email"]) && 
        !empty($_POST["name"]) && !empty($_POST["password"]) && !empty($_POST["email"])) {
            try {
                $dbh = new PDO('mysql:host=' . servername . ';dbname=' . database . '', username, password);
                $sql = "INSERT INTO `users`(`Name`, `Email`, `Password`) VALUES (?, ?, ?)";
                $stmt = $dbh->prepare($sql);
                $stmt->execute([$_POST["name"], $_POST["email"], hashPassword($_POST["password"])]);
                $dbh = null;
                header("location: /login/index");
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
        }
    }
}

function hashPassword($password)
{
    return md5($password);
}