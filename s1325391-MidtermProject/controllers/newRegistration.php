<?php

require_once ('../models/registrations_model.php');
require_once ('../models/students_model.php');
require_once ('../models/courses_model.php');


$students_model = new StudentsModel();
$courses_model = new CoursesModel();
$model = new RegistrationsModel();

$courses_list = $courses_model->listCourses();
$students_list = $students_model->listStudents();
$registrations_list = $model->listRegistrations();




session_start();
if (!isset($_SESSION['id'])){
    //session is not set
    header('Location: login.php');
}

$logged_in_user_id = $_SESSION['id'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $getvars = $_GET;
        if (isset($getvars["action"]) && $getvars["action"] == 'add') {

          if ($model->course_taken($_POST['courses'], $logged_in_user_id))
          {
            $message = "Student already registered for this course";
          }else{

            if (isset($_POST['courses'])) {
                  $courses_id = intval($_POST['courses']);
                  $result = $model->add_new_registration($courses_id, $logged_in_user_id);
                  if ($result) {
                      $message = "Course added";
                  } else {
                      $message = "Course not added";
                  }
              } else {
                  $message = "Invalid POST data";
              }

          }

        }
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
    }
}

include '../views/newRegistration_view.php'
?>
