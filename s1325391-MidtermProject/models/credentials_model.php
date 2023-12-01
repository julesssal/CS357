<?php

class CredentialsModel {
  public $emails = array();
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

  public function email_taken($email) {
   try {
    $stmt = $this->db->prepare('SELECT email FROM credentials where email=:email');
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
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

  public function authenticate($email, $password) {
    try {
     $stmt = $this->db->prepare('SELECT students_id FROM credentials where email=:email and password=PASSWORD(:password)');
     $stmt->bindParam(':email', $email, PDO::PARAM_STR);
     $stmt->bindParam(':password', $password, PDO::PARAM_STR);
     $stmt->execute();
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
     if ($result && sizeof($result)>0) {
         return $result[0]['students_id'];
     } else {
         return false;
     }
    } catch(PDOException $ex) {
         var_dump($ex->getMessage());
    }
   }


}

?>
