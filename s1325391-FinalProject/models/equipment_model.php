<?php

class EquipmentModel {
  public $equipments = array();
  private $db;
  private $errorMessage;
  function __construct() {

    try{
      $this->db = new PDO('mysql:unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock;port=8889;dbname=photographyclub;charset=utf8',
               'jules', 'root');
               $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }catch(PDOException $e){
      echo "Error connecting to database.<br>".$e->getMessage();
    }
  }

  public function listEquipment() {

    try {
      $query = 'SELECT e.id, e.picture, e.owner_id, e.equipment_name,
      m.first_name, m.last_name,
      s.borrower_id,
      s.equipment_id
        FROM equipment e
        JOIN members m ON e.owner_id = m.id
        LEFT JOIN statuses s ON e.id = s.equipment_id
        ORDER BY e.id;';

      $stmt = $this->db->query($query);
      $this->equipments = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
  } catch (PDOException $ex) {
      var_dump($ex->getMessage());
  }

  return $this->equipments;
}
  public function getErrorMessage() {
    return $this->errorMessage ?? 'Unknown error';
}


  public function add_new_equipment ($picture, $owner_id, $equipment_name) {
   if($equipment_name!= null){
    try {

    $this->db->beginTransaction();

    $stmtEquipment = $this->db->prepare("INSERT INTO equipment(picture, owner_id, equipment_name) VALUES(:picture, :owner_id, 
    :equipment_name)");


    $stmtEquipment->execute(array(':picture' => $picture, ':owner_id' => $owner_id, ':equipment_name' => $equipment_name
                          ));
    $this->db->commit();

    return true;

   } catch (PDOException $ex) {
    $this->db->rollback();
    error_log("Error during equipment insertion: " . $ex->getMessage());
    echo "Failed - Database Error: " . $ex->getMessage(); 
    return false;
   }
  }
  }

  public function updateEquipmentStatus($equipmentId) {
    try {

        $query = 'UPDATE statuses SET borrower_id = NULL WHERE equipment_id = :equipmentId';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':equipmentId', $equipmentId, PDO::PARAM_INT);
        $stmt->execute();

        return true; 
    } catch (PDOException $ex) {
        var_dump($ex->getMessage());
        return false; 
    }
}

public function updateBorrower($equipmentId, $borrowerId) {
  try {
      // Attempt to update the existing row
      $updateQuery = 'UPDATE statuses SET borrower_id = :borrowerId WHERE equipment_id = :equipmentId';
      $updateStmt = $this->db->prepare($updateQuery);
      $updateStmt->bindParam(':equipmentId', $equipmentId, PDO::PARAM_INT);
      $updateStmt->bindParam(':borrowerId', $borrowerId, PDO::PARAM_INT);
      $updateStmt->execute();

      // Check if the update affected any rows
      if ($updateStmt->rowCount() > 0) {
          return true; // Update successful
      }

      // If the update did not affect any rows, insert a new row
      $insertQuery = 'INSERT INTO statuses (equipment_id, borrower_id) VALUES (:equipmentId, :borrowerId)';
      $insertStmt = $this->db->prepare($insertQuery);
      $insertStmt->bindParam(':equipmentId', $equipmentId, PDO::PARAM_INT);
      $insertStmt->bindParam(':borrowerId', $borrowerId, PDO::PARAM_INT);
      $insertStmt->execute();

      return true; 
  } catch (PDOException $ex) {
      var_dump($ex->getMessage());
      return false; 
  }
}



}

?>
