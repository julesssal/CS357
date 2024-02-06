<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../models/members_model.php'; 
require_once '../models/credentials_model.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handlePostRequest();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    handleGetRequest();
}

function handlePostRequest() {
    $credentials_model = new CredentialsModel();

    if (isset($_POST["action"]) && $_POST["action"] == 'login') {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $validLogin = $credentials_model->authenticate($email, $password);

        if ($validLogin) {
            $_SESSION['id'] = $validLogin;
            header('Location: main_page.php'); 
        } else {
            $GLOBALS['email'] = $email;
            $GLOBALS['password'] = $password;
        }
    }
}

function handleGetRequest() {
    if (isset($_GET["action"]) && $_GET["action"] == 'logout') {
        $email = "";
        $password = "";
        session_unset();
        session_destroy();
        header("Location: ../controllers/login.php");
        exit();
    }
}

include '../views/login_view.php';
?>