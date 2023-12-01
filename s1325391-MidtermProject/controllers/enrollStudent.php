<?php

require_once ('../models/students_model.php');
require_once ('../models/credentials_model.php');


$students_model = new StudentsModel();
$credentials_model = new CredentialsModel();

$message = '';

session_start();
if (!isset($_SESSION['id'])){
    //session is not set
    header('Location: login.php');
}
$id = "";
$first_name = "";
$last_name = "";
$classOf = "";
$email = "";
$password = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $getvars = $_GET;
    if (isset($getvars["action"]) && $getvars["action"] == 'add') {
        if ($credentials_model->email_taken($_POST['email'])) {
            $message = "Email is not available";

            $first_name = $_POST['first_name'];
            $email = $_POST['email'];
            $last_name = $_POST['last_name'];
            $password = $_POST['password'];
            $classOf = $_POST['classOf'];

        } else {
            $result = $students_model->add_new_students ($_POST['students_id'],$_POST['first_name'], $_POST['last_name'],
             $_POST['classOf'], $_POST['email'], $_POST['password']);
            if ($result) {
                $message = "Student Added ";
            } else {
                $message = "Failed";
            }
        }

    }
}

include '../views/enrollStudent_view.php'
?>
