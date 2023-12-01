<?php
require_once '../models/students_model.php';
require_once '../models/credentials_model.php';

/*try{
  $db = new PDO('mysql:unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock;port=8889;dbname=studentregistrations;charset=utf8',
           'jules', 'root');
           $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  echo"success";
}catch(PDOException $e){
  echo "The user could not be added.<br>".$e->getMessage();
}*/

$message = "Please enter your login credentials";

$email = "";
$password = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $getvars = $_GET;
    if (isset($getvars["action"]) && $getvars["action"] == 'login') {
        $credentials_model = new CredentialsModel();
        $validLogin = $credentials_model->authenticate($_POST["email"], $_POST["password"]);
        echo $validLogin;
        if ($validLogin) {
            session_start();
            $_SESSION['id'] = $validLogin;
            header ('Location: student.php');
        } else {
            $message = "Entered email and/or password is invalid";
            $email = $_POST["email"];
            $password = $_POST["password"];
        }
        
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $getvars = $_GET;
    if (isset($getvars["action"]) && $getvars["action"] == 'logout') {

        session_start();
        $_SESSION = array();
        $email = "";
        $password = "";
        session_destroy();
        $message = "Logged out - Thank you!!";

    }
}

include '../views/login_view.php'

?>
