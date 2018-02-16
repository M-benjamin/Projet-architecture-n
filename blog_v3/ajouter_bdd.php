<?php 
// -> Start SESSION
session_start();

// -> Connect to the database
function my_bdd(){   
    global $dbCon;

    $host = 'localhost'; 
    $dbName = 'blog';   
    $username = 'root';  
    $password = '';
    
    $dbCon = new PDO("mysql:host=".$host.";dbname=".$dbName, $username, $password);
    
    if (!$dbCon) {
        die('Erreur de connexion');
    }

    $sql = 'INSERT INTO article VALUES (DEFAULT, ?, ?, ?, ?)';
    
    $stmt = $dbCon->prepare($sql);
    $result = $stmt->execute(array($titre, $desc, $id, $date));

    return $result;
}






