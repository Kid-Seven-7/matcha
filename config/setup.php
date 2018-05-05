<?php
  //AUTHOR : jngoma

  require_once ('database.php');

  //Deleting the database if it exists...
  try {
    $conn = new PDO('mysql:host=127.0.0.1', $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Preparing the query
    $stmt = $conn->prepare('DROP DATABASE Matcha');

    //executing the query
    $stmt->execute();
    echo "Database deleted <br/>";
    $found = 1;
  }catch (PDOException $e) {
    $found = 0;
    echo "Database not found<br/>";
  }

  //Re-creating the database
  try {
    $conn = new PDO('mysql:host=127.0.0.1', $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare('CREATE DATABASE Matcha');

    $stmt->execute();

    if ($found == 1) {
      echo "Re-creating database <br/>";
    }else {
      echo "Creating database <br/>";
    }
    echo "Done! <br/>";

    //Creating table users
    try {
      $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      //Preparing the query
      echo "Creating table : users <br/>";
      $stmt = $conn->prepare('CREATE TABLE users (
        id int(11) not null PRIMARY KEY AUTO_INCREMENT,
        online int(1) not null default 0,
        fame int(11) not null default 0,
        profilePic varchar(255) default "../uploads/undefined.png",
        user_name varchar(255) not null,
        first_name varchar(255),
        surname varchar(255),
        address varchar(255),
        bio varchar(500),
        age int(2),
        Tattoos int(1) default 0,
        Piercings int(1) default 0,
        Music int(1) default 0,
        Art int(1) default 0,
        Gaming int(1) default 0,
        Cooking int(1) default 0,
        Anime int(1) default 0,
        Cycling int(1) default 0,
        Sports int(1) default 0,
        Fitness int(1) default 0,
        Pets int(1) default 0,
        Nature int(1) default 0,
        gender varchar(255),
        preference varchar(255)not null default "both",
        email varchar(255) not null,
        passwd varchar(255) not null,
        lastseen timestamp(6) not null,
        active int(1) not null DEFAULT 0,
        con_code varchar(255) not null,
        noti int(1) not null DEFAULT 1
        );'
      );
      //executing the query
      $stmt->execute();
      echo "Table users created!<br/>";
      try {
        $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Preparing the query
        echo "Creating table : chats <br/>";
        $stmt = $conn->prepare('CREATE TABLE chats (
          message_id int(11) not null PRIMARY KEY AUTO_INCREMENT,
          sent_to varchar(255) not null,
          sent_by varchar(255) not null,
          message text not null,
          sent_on DateTime not null,
          opened varchar(255) not null,
          connection_id int(11) not null
          );'
        );
        //executing the query
        $stmt->execute();
        echo "Table chats created! <br/>";
        echo "Creating table : likes <br/>";

        $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare('CREATE TABLE likes (
          id int(11) not null PRIMARY KEY AUTO_INCREMENT,
          likee varchar(255) not null,
          liker varchar(255) not null,
          seen int(1) not null default 0
          );'
        );
        $stmt->execute();
        echo "Table likes created! <br/>";
        try {
          $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          //Preparing query
          echo "Creating table : pictures <br/>";
          $stmt = $conn->prepare('CREATE TABLE pictures (
            id int(11) not null PRIMARY KEY AUTO_INCREMENT,
            name varchar(255) not null,
            user varchar(255) not null,
            current int(1) not null
            );'
          );
          //executing the query
          $stmt->execute();
          echo "Table pictures created! <br/>";
        }catch(PDOException $e) {
          echo "Unable to create picture table";
          echo "ERROR: ".$e->getMessage()."<br/>";
        }
      }catch (PDOException $e) {
        echo "Unable to create table <br/>";
        echo "ERROR: ".$e->getMessage()."<br/>";
      }
    }catch (PDOException $e) {
      echo "Unable to create table <br/>";
      echo "ERROR: ".$e->getMessage()."<br/>";
    }
  }catch (PDOException $e) {
    echo "Unable to create database <br/>";
    echo "ERROR: ".$e->getMessage()."<br/>";
  }

  try {
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Creating table : connections <br/>";
    $stmt = $conn->prepare('CREATE TABLE connections (
      id int(11) not null PRIMARY KEY AUTO_INCREMENT,
      user1 varchar(255) not null,
      user2 varchar(255) not null,
      seen int(1) not null
      );'
    );
    //executing the query
    $stmt->execute();
    echo "Connections table created! <br/>";
  }catch(PDOException $e) {
    echo "Unable to create connections table";
    echo "ERROR: ".$e->getMessage()."<br/>";
  }

  try {
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Creating table : history <br/>";
    $stmt = $conn->prepare('CREATE TABLE history (
      id int(11) not null PRIMARY KEY AUTO_INCREMENT,
      viewer varchar(255) not null,
      view varchar(255) not null,
      seen int(1) not null
      );'
    );
    //executing the query
    $stmt->execute();
    echo "History table created! <br/>";
  }catch(PDOException $e) {
    echo "Unable to create history table";
    echo "ERROR: ".$e->getMessage()."<br/>";
  }
?>
