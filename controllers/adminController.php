<?php
require_once("core/controller.php");
require_once("core/connection.php");
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

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

    function newCategoryAction()
    {
        $this->isAdmin();

        $db = DB::connect();
            if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["categoryname"]) && isset($_POST["parentcategory"])
            && !empty($_POST["categoryname"])) {
                $sql = "INSERT INTO `categorys`(`NameCategory`, `ParentCategory`) VALUES (?, ?)";
                $stmt = $db->prepare($sql);
                $stmt->execute([$_POST["categoryname"], $_POST["parentcategory"]]);
            }
        $this->renderView("newCategory.php");
    }

    function newProductAction()
    {
        $this->isAdmin();

        $db = DB::connect();
            if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["productname"]) && isset($_POST["productprice"]) && 
            isset($_POST["productdesc"]) && isset($_POST["productcategory"]) && isset($_POST["productcount"]) &&
            !empty($_POST["productname"]) && !empty($_POST["productprice"]) &&
            !empty($_POST["productdesc"]) && !empty($_POST["productcategory"]) && !empty($_POST["productcount"])
            ) {
                $sql = "INSERT INTO `products`(`Name`, `Price`, `Desc`, `Count`, `CategoryName`) VALUES (?, ?, ?, ?, ?)";
                $stmt = $db->prepare($sql);
                $stmt->execute([$_POST["productname"], $_POST["productprice"], $_POST["productdesc"], $_POST["productcount"],
                $_POST["productcategory"]]);
                $idpost = $db->lastInsertId();
                $sql = "INSERT INTO `photos`(`IDProduct`, `Path`) VALUES (?, ?)";
                $length = count($_FILES['photos']['name']);
                for ($i = 0; $i < $length; $i++) {
                    $randname = generateRandomString(10) . ".png";
                    $filepath = "photos/" . $randname;
                    move_uploaded_file($_FILES['photos']["tmp_name"][$i], $filepath);
                    chmod($filepath, 0777);
                    $stmt = $db->prepare($sql);
                    $stmt->execute([$idpost, $randname]);
                }
            }
            $categorys = $db->query("SELECT * FROM `categorys`")->fetchAll();
            $this->renderView("newProduct.php", ["categorys" => $categorys]);
    }

    function editProductAction()
    {
        $this->isAdmin();

        $db = DB::connect();
        $id = $_POST["idedit"] ?? 0;
        
        
        if($id){
            $product = $db->query("SELECT * FROM products WHERE IDProduct = " . $id)->fetch();
            $categorys = $db->query("SELECT * FROM `categorys`")->fetchAll();
            if(!$product)
                {
                    echo "Not found product";
                }
            $this->renderView("editProduct.php", ['p'=> $product, "categorys" => $categorys]);
        }
       
            if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["productname"]) && isset($_POST["productprice"]) && 
            isset($_POST["productdesc"]) && isset($_POST["productcategory"]) && 
            !empty($_POST["productname"]) && !empty($_POST["productprice"]) &&
            !empty($_POST["productdesc"]) && !empty($_POST["productcategory"])&& 
            isset($_POST["productid"]) && !empty($_POST["productid"]) &&
            isset($_POST["productcount"]) && !empty($_POST["productcount"])) {
                $sql = "UPDATE `products` SET `Name` = ?, `Price` = ?, `Desc` = ?, `Count` = ?, `CategoryName` = ? WHERE IDProduct = ?";
                $stmt = $db->prepare($sql);
                $stmt->execute([$_POST["productname"], $_POST["productprice"], $_POST["productdesc"], 
                $_POST["productcategory"], $_POST["productcount"], $_POST["productid"]]);
            }
    }
    
    function editUsersAction()
    {
        $this->isAdmin();

        $db = DB::connect();
        $users = $db->query("SELECT * FROM `users` WHERE Name != '" . $_SESSION["user"] . "'")->fetchAll();
        if (isset($_POST["permission"]) && isset($_POST["id"]) && !empty($_POST["id"])) {
            $sql = "UPDATE `users` SET `Admin` = ? WHERE IDUser = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$_POST["permission"], $_POST["id"]]);
        }
        $this->renderView("editUsers.php", ["users" => $users]);
    }

    function ordersAction()
    {
        $this->isAdmin();

        $db = DB::connect();
        $orders = $db->query("SELECT * FROM `orders`")->fetchAll();

        $this->renderView("orders.php", ["orders" => $orders]);
    }
}