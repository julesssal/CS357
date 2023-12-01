<?php
require_once ('../models/courses_model.php');
$courses_model = new CoursesModel();
$courses_list = $courses_model->listCourses();

session_start();
if (!isset($_SESSION['id'])){
    //session is not set
    header('Location: login.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $getvars = $_GET;
    if (isset($getvars["action"]) && $getvars["action"] == 'add') {
        if ($courses_model->course_exists($_POST['course_number'], $_POST['course_description'])) {
            $message = "Course Already Exists";

        } else {
            $result = $courses_model->add_new_course ($_POST['course_number'], $_POST['course_description']);
            if ($result) {
                $message = "Course Added ";
            } else {
                $message = "Failed";
            }
        }

    }
}

include '../views/newCourse_view.php'
 ?>
