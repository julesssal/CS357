<?php

class CoursesModel {
  public $courses = array();
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

  public function listCourses() {

    try {
      $query = 'SELECT c.id AS courses_id, c.course_number, c.course_description, c.semester,c.year
      FROM courses c';
      $query = $query . " ORDER BY c.id";
      $stmt = $this->db->query($query);

      $this->courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $ex) {
       var_dump($ex->getMessage());
     }

     return $this->courses;

  }
  public function course_exists($course_number,  $course_description)
  {
    try {
     $stmt = $this->db->prepare('SELECT id FROM courses where course_number=:course_number and course_description=:course_description');
     $stmt->bindParam(':course_number', $course_number, PDO::PARAM_STR);
     $stmt->bindParam(':course_description', $course_description, PDO::PARAM_STR);
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

  public function add_new_course($course_number, $course_description)
  {
    try {

     $this->db->beginTransaction();
     $stmtCourse = $this->db->prepare("INSERT INTO courses(course_number,course_description)
                       VALUES(:course_number,:course_description)");


     $stmtCourse->execute(array(':course_number' => $course_number, ':course_description' => $course_description ));

     $this->db->commit();

     return true;
    } catch (PDOException $ex) {
        $this->db->rollback();
        echo "Database Error: " . $ex->getMessage();
        return false;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
     
    }
  }

}

?>
