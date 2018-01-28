<?php

require('../config/database.php')

class Chat {

  private $mysqli;

  //Establish a connection to the database
  function __construct(){
    $this-mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
  }

  //close database connection
  function __destruct(){
    $this->mysqli->close();
  }

   //Delete messages
   //not sure about this one
   public function deleteAllMessages(){
     $query = 'TRUNCATE TABLE chats';
     $result = $this->mysqli->query($query);
   }

    //Post messages
    public function postNewMessage($sent_by, $message, $sent_to) {
      $sent_by = $this->mysqli->real_escape_string($sent_by);
      $message = $this->mysqli->real_escape_string($message);
      $sent_to = $this->mysqli->real_escape_string($sent_to);
      $query =  'INSERT INTO chats (sent_on, sent_to, sent_by, message)
                VALUES (NOW(), "'.$sent_by.'", "'.$sent_to.'", "'.$message.'")';
      $result = $this->mysqli->query($query);
    }

    //Get new messages
    public function getNewMessages($id=0) {
      $id = $this->mysqli->real_escape_string($id);
      if($id>0) {
        $query = 'SELECT DATE_FORMAT(sent_on, "%H:%i:%s"), sent_to, sent_by, message
                  AS sent_on
                  FROM chats
                  WHERE message_id > '.$id.'
                  ';
      }
    }
}

?>
