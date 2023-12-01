<?php
require_once '../models/students_model.php';

$model = new StudentsModel();

session_start();

if (!isset($_SESSION['id'])){
    //session is not set
    header('Location: login.php');
}

$logged_in_user_id = $_SESSION['id'];

$students_list = $model->listStudents();




require_once '../views/student_view.php';
?>
