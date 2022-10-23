<?php 
  $dsn = 'mysql:host=localhost;sbname=world';
  $username = 'root';

  try {
    $db = new PDO($dsn, $username);
  } catch (PDOException $err) {
    $error_message = 'Darabase Error:';
    $error_message .= $err->getMessage();
    echo $error_message;
    exit();
  }
?>