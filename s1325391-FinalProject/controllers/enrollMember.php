<?php
require_once '../models/members_model.php';
require_once '../models/credentials_model.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handlePostRequest();
}

function handlePostRequest() {
    $members_model = new MembersModel();
    $credentials_model = new CredentialsModel();

    if (isset($_POST["action"]) && $_POST["action"] == 'enroll') {
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        if ($credentials_model->email_taken($_POST['email'])) {
            echo "Email Taken";
        }else{
       
            $member_id = $members_model->add_new_members($first_name, $last_name, $email, $password);
        }
        if ($member_id) {
            
            $_SESSION['id'] = $member_id;
            header('Location: login.php'); 
        } else {
            
            $GLOBALS['registration_error'] = "Registration failed. Please try again.";
        }
    }
}

include '../views/enrollMember_view.php';
?>