<?php
require_once("core/controller.php");

class adminController extends Controller
{
    function indexAction()
    {
        $this->renderView("index.php");
        require_once("db.config.php");
        try {
            $dbh = new PDO('mysql:host=' . servername . ';dbname=' . database . '', username, password);
            if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["iddelete"]) && !empty($_POST["iddelete"])) {
                $sql = "DELETE FROM `products` WHERE IDProduct = ?";
                $stmt = $dbh->prepare($sql);
                $stmt->execute([$_POST["iddelete"]]);   
            }
            $dbh = null;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    function newCategoryAction()
    {
        $this->renderView("newCategory.php");
        require_once("db.config.php");
        try {
            $dbh = new PDO('mysql:host=' . servername . ';dbname=' . database . '', username, password);
            if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["categoryname"]) && isset($_POST["parentcategory"]) 
            && !empty($_POST["categoryname"]) && !empty($_POST["parentcategory"])) {
                $sql = "INSERT INTO `categorys`(`NameCategory`, `ParentCategory`) VALUES (?, ?)";
                $stmt = $dbh->prepare($sql);
                $stmt->execute([$_POST["categoryname"], $_POST["parentcategory"]]);
            }
            $dbh = null;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    function newProductAction()
    {
        $this->renderView("newProduct.php");
        require_once("db.config.php");
        try {
            $dbh = new PDO('mysql:host=' . servername . ';dbname=' . database . '', username, password);
            if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["productname"]) && isset($_POST["productprice"]) && 
            isset($_POST["productdesc"]) && isset($_POST["productcategory"]) && 
            !empty($_POST["productname"]) && !empty($_POST["productprice"]) &&
            !empty($_POST["productdesc"]) && !empty($_POST["productcategory"])) {
                $sql = "INSERT INTO `products`(`Name`, `Price`, `Desc`, `CategoryName`) VALUES (?, ?, ?, ?)";
                $stmt = $dbh->prepare($sql);
                $stmt->execute([$_POST["productname"], $_POST["productprice"], $_POST["productdesc"], 
                $_POST["productcategory"]]);
                $idpost = $dbh->lastInsertId();
                $sql = "INSERT INTO `photos`(`IDProduct`, `Path`) VALUES (?, ?)";
                $length = count($_FILES['photos']['name']);
                for ($i = 0; $i < $length; $i++) {
                    move_uploaded_file($_FILES['photos']["tmp_name"][$i], "photos/" . $_FILES['photos']["name"][$i]);
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute([$idpost, $_FILES["photos"]["name"][$i]]);
                }
            }
            $dbh = null;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}