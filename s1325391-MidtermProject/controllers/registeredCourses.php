<?php
require_once '../models/registrations_model.php';

$model = new RegistrationsModel();

session_start();

if (!isset($_SESSION['id'])){
    //session is not set
    header('Location: login.php');
}

$logged_in_user_id = $_SESSION['id'];

$registrations_list = $model->listRegistrations();





require_once '../views/registeredCourses_view.php';
?>
