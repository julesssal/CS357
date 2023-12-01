<?php

class StudentsModel {
  public $students = array();
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

public function listStudents() {

  try {
    $query = 'SELECT s.id, s.first_name, s.last_name, s.classOf,
    c.email
    FROM students s
    JOIN credentials c ON s.id=c.students_id';
    $query = $query . " ORDER BY id";
    $stmt = $this->db->query($query);

    $this->students = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch(PDOException $ex) {
     var_dump($ex->getMessage());
   }

   return $this->students;

}


  public function add_new_students ($students_id, $first_name, $last_name, $classOf, $email, $password) {
   try {

    $this->db->beginTransaction();
    $stmtStudent = $this->db->prepare("INSERT INTO students(first_name,last_name,classOf)
                      VALUES(:first_name,:last_name,:classOf)");

    $stmtCredential = $this->db->prepare("INSERT INTO credentials(email,password, students_id)
                      VALUES(:email,PASSWORD(:password),:students_id)");

    $stmtStudent->execute(array(':first_name' => $first_name, ':last_name' => $last_name,
                                ':classOf' => $classOf
                          ));
    $sid = $this->db->lastInsertId();

    $stmtCredential->execute(array(':email' => $email, ':password' => $password,':students_id' => $sid ));

    $this->db->commit();

    return $sid;

   } catch (PDOException $ex) {
    $this->db->rollback();
    return false;
   }

  }


}



?>
