<?php
require_once '../models/courses_model.php';

$model = new CoursesModel();

session_start();

if (!isset($_SESSION['id'])){
    //session is not set
    header('Location: login.php');
}

$logged_in_user_id = $_SESSION['id'];

$courses_list = $model->listCourses();




require_once '../views/courses_view.php';
?>
