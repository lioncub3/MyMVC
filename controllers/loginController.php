<?php
require_once("db.config.php");
require_once("core/controller.php");
require_once("core/connection.php");

function hashPassword($password)
{
    return md5($password);
}

class loginController extends Controller
{
    function indexAction()
    {
        $db = DB::connect();

        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["name"]) && isset($_POST["password"]) && isset($_POST["g-recaptcha-response"]) &&
            !empty($_POST["name"]) && !empty($_POST["password"]) && !empty($_POST["g-recaptcha-response"])) {
                $response = $_POST["g-recaptcha-response"];
                $url = 'https://www.google.com/recaptcha/api/siteverify';
                $data = array(
                    'secret' => '6LeGXXMUAAAAAMlFB9kkCTWm8aNqr_Zu9ceKAYfG',
                    'response' => $_POST["g-recaptcha-response"]
                );
                $options = array(
                    'http' => array(
                        'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
                        "Content-Length: ".strlen(http_build_query($data))."\r\n".
                        "User-Agent:MyAgent/1.0\r\n",
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

                  
                    $login = $_POST["name"];
                    $password = md5($_POST["password"] ?? '');
                if (empty($login) || empty($password)) {
                    $messeg = "Username/Password con't be empty";
                } else {
                    $sql = "SELECT Name, Password, Admin FROM `users` WHERE Name=? AND 
                    Password=? ";
                    $query = $db->prepare($sql);
                    $query->execute(array($login, $password));

                    $user = $query->fetch();

                    if ($user) {
                        $_SESSION["user"] = $login;
                        $_SESSION["admin"] = $user->Admin;
                        $_SESSION["time_start_login"] = time();
                        header('Location: /');
                        exit;
                    } else {
                        $messeg = "Username/Password is wrong";
                    }
                }
                }
        }
        $this->renderView("index.php");
    }
}