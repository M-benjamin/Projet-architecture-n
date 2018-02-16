<?php
 
 function my_bdd(){ 
 // -> Set default parameter for database connection 
 $host = 'localhost'; 
 $dbName = 'blog';   
 $username = 'root';  
 $password = '';
 
 $dbCon = new PDO("mysql:host=".$host.";dbname=".$dbName, $username, $password);
// -> query for get current user
 $sql = 'SELECT * FROM autor where mail= ? AND password= ?';
 $stmt = $dbCon->prepare($sql);
 $stmt->execute(array($email, $password));
 $row = $stmt->fetch(PDO::FETCH_OBJ);
 $count = $stmt->rowCount(); 

 return $count;
 }