<?php 

function trouver () {
    // -> Set default parameter for database connection 
  $host = 'localhost'; 
  $dbName = 'blog';   
  $username = 'root';  
  $password = '';
  
  $dbCon = new PDO("mysql:host=".$host.";dbname=".$dbName, $username, $password);

  $sql = 'SELECT * FROM article where auteur_id= ?';
  $stmt = $dbCon->prepare($sql);
  $stmt->execute(array($_SESSION['id']));
  $row = $stmt->fetchAll(PDO::FETCH_OBJ);

  return $row;

}