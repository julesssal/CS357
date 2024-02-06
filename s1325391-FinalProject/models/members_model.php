<?php

class MembersModel {
  public $members = array();
  private $db;

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

public function listMembers() {

  try {
    $query = 'SELECT m.id, m.first_name, m.last_name,
    c.email
    FROM members m
    JOIN credentials c ON m.id=c.member_id';
    $query = $query . " ORDER BY id";
    $stmt = $this->db->query($query);

    $this->members = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch(PDOException $ex) {
     var_dump($ex->getMessage());
   }
   
   return $this->members;

}


  public function add_new_members ($first_name, $last_name, $email, $password) {
   try {

    $this->db->beginTransaction();
    $stmtMember = $this->db->prepare("INSERT INTO members(first_name,last_name)
                      VALUES(:first_name,:last_name)");

    $stmtCredential = $this->db->prepare("INSERT INTO credentials(email,password, member_id)
                      VALUES(:email,PASSWORD(:password),:member_id)");

    $stmtMember->execute(array(':first_name' => $first_name, ':last_name' => $last_name
                          ));
    $mid = $this->db->lastInsertId();

    $stmtCredential->execute(array(':email' => $email, ':password' => $password,':member_id' => $mid ));

    $this->db->commit();

    return $mid;

   } catch (PDOException $ex) {
    $this->db->rollback();
    return false;
   }

  }


}



?>
