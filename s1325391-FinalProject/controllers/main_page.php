<?php
require_once '../models/equipment_model.php';
require_once '../models/members_model.php';

$model = new equipmentModel();
$members_model = new MembersModel();
session_start();
if (!isset($_SESSION['id'])){
    header('Location: ../controllers/login.php');
}


$logged_in_user_id = $_SESSION['id'];

$equipments_list = $model->listEquipment();
$members_list = $members_model->listMembers();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'borrow':
   
            $equipmentId = $_POST['equipmentId'] ?? null;
            $borrowerId = $_POST['borrowerId'] ?? null;

            if ($equipmentId && $borrowerId) {

                $success = $model->updateBorrower($equipmentId, $borrowerId);
                
                header('Content-Type: application/json');
                echo json_encode(['success' => $success]);
                exit;
            } else {
                echo json_encode(['error' => 'Invalid parameters']);
                exit;
            }
            break;

       
        case 'update':
           
            $equipmentId = $_POST['equipmentId'] ?? null;
            $borrowerId = $_POST['borrowerId'] ?? null;

            
            $success = $model->updateEquipmentStatus($equipmentId);

            
            header('Content-Type: application/json');
            echo json_encode(['success' => $success]);
            exit;

        default:
            echo json_encode(['error' => 'Invalid action']);
            exit;
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
require_once '../views/main_page_view.php';
?>