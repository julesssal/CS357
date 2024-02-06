<?php
require_once '../models/equipment_model.php';
require_once '../models/members_model.php';


$equipments_model = new EquipmentModel();
$members_model = new MembersModel();
session_start();

if (!isset($_SESSION['id'])){
    header('Location: ../controllers/login.php');
}

$members_list = $members_model->listMembers();

$logged_in_user_id = $_SESSION['id'];

function saveUploadedFile() {
    $target_dir = "../uploads/";
    $upload = true;
    $target_file = $target_dir . basename($_FILES["documentFile"]["name"]);


    if ($upload) {
        if (move_uploaded_file($_FILES["documentFile"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["documentFile"]["name"])).
                    " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $getvars = $_GET;
    if ($_FILES['documentFile']['tmp_name'] != "") {
        $uploadedFile = $_FILES['documentFile']['name'];
        saveUploadedFile();
    } else {
        echo "File Name Taken";
    }

    if (isset($getvars["action"]) && $getvars["action"] == 'upload') {

       
        $picture = "../uploads/" . $_FILES['documentFile']['name'];
        $equipment_name = isset($_POST['equipment_name']) ? $_POST['equipment_name'] : 'Default Name';

      $result = $equipments_model->add_new_equipment ($picture, $logged_in_user_id, $equipment_name);
      if ($result) {
        echo 'Equipment Added';
    } else {
        echo 'Failed' .$result;
    }

    }
}else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET["action"]) && $_GET["action"] == 'logout') {
        $email = "";
        $password = "";
        session_unset();
        session_destroy();
        
        header("Location: ../controllers/login.php");
        exit();
    }

}




require_once '../views/addEquipment_view.php';
 ?>
