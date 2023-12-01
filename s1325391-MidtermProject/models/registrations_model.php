<?php

class RegistrationsModel {
  public $registrations = array();
  private $db;

  function __construct() {

    try{
      $this->db = new PDO('mysql:unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock;port=8889;dbname=studentregistrations;charset=utf8',
               'jules', 'root');
               $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }catch(PDOException $e){
      echo "Error connecting to database.<br>".$e->getMessage();
    }
  }

  public function listRegistrations() {

    try {
      $query = 'SELECT r.id, r.courses_id, r.students_id,
      s.first_name, s.last_name,
      c.id, c.course_number, c.course_description
      FROM registrations r
      JOIN students s ON r.students_id = s.id
      JOIN courses c ON r.courses_id = c.id';
      //$query = $query . " ORDER BY id";
      $stmt = $this->db->query($query);

      $this->registrations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $ex) {
       var_dump($ex->getMessage());
     }

     return $this->registrations;

  }
  public function course_taken($courses_id, $students_id) {
   try {
    $stmt = $this->db->prepare('SELECT courses_id FROM registrations where courses_id=:courses_id and students_id=:students_id');
    $stmt->bindParam(':courses_id', $courses_id, PDO::PARAM_INT);
    $stmt->bindParam(':students_id', $students_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($result && sizeof($result)>0) {
        return true;
    } else {
        return false;
    }
   } catch(PDOException $ex) {
        var_dump($ex->getMessage());
   }
  }
public function add_new_registration ($courses_id, $students_id) {
   try {


    if (!empty($courses_id) && is_numeric($courses_id)) {
          $this->db->beginTransaction();
          $stmtRegistrations = $this->db->prepare("INSERT INTO registrations(courses_id, students_id) VALUES(:courses_id, :students_id)");
          $stmtRegistrations->execute(array(':courses_id' => $courses_id, ':students_id' => $students_id));
          $this->db->commit();

          return true; 
      } else {
          throw new Exception("Invalid courses_id value");
      }
   } catch (PDOException $ex) {
    $this->db->rollBack();
    echo "Database Error: " . $ex->getMessage();
    return false;
    }catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }

 }

}

?>
