<?php
require_once("db.config.php");
require_once("core/controller.php");

function hashPassword($password)
{
    return md5($password);
}

class loginController extends Controller
{
    function indexAction()
    {
        $this->renderView("index.php");

        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["name"]) && isset($_POST["password"]) && isset($_POST["g-recaptcha-response"]) &&
            !empty($_POST["name"]) && !empty($_POST["password"]) && !empty($_POST["g-recaptcha-response"])) {
            try {
                $response = $_POST["g-recaptcha-response"];
                $url = 'https://www.google.com/recaptcha/api/siteverify';
                $data = array(
                    'secret' => '6LeGXXMUAAAAAMlFB9kkCTWm8aNqr_Zu9ceKAYfG',
                    'response' => $_POST["g-recaptcha-response"]
                );
                $options = array(
                    'http' => array(
                        'method' => 'POST',
                        'content' => http_build_query($data)
                    )
                );
                $context = stream_context_create($options);
                $verify = file_get_contents($url, false, $context);
                $captcha_success = json_decode($verify);
                if ($captcha_success->success == false) {
                    echo "<p>You are a bot! Go away!</p>";
                } else if ($captcha_success->success == true) {
                    echo "<p>You are not not a bot!</p>";
                }
                $login = $_POST["name"];
                $password = md5($_POST["password"]);
                $dbh = new PDO('mysql:host=' . servername . ';dbname=' . database . '', username, password);
                if (empty($login) || empty($password)) {
                    $messeg = "Username/Password con't be empty";
                } else {
                    $sql = "SELECT Name, Password FROM Users WHERE Name=? AND 
                    Password=? ";
                    $query = $dbh->prepare($sql);
                    $query->execute(array($login, $password));

                    if ($query->rowCount() >= 1) {
                        $_SESSION['user'] = $login;
                        $_SESSION['time_start_login'] = time();
                        echo $_SESSION['user'];
                        header("Location: home");
                    } else {
                        $messeg = "Username/Password is wrong";
                    }
                }

                $dbh = null;
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
        }
    }
}