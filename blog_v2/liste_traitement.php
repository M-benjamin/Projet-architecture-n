<?php 
    // -> Start SESSION
    session_start();
    echo $_SESSION['id'];

    // -> Set default parameter for database connection 
    $host = 'localhost'; 
    $dbName = 'blog';   
    $username = 'root';  
    $password = '';
    
    $dbCon = new PDO("mysql:host=".$host.";dbname=".$dbName, $username, $password);

    // -> For redirection page
    function redirect($url) {
        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();
    }   

    $sql = 'SELECT * FROM article where auteur_id= ?';
    $stmt = $dbCon->prepare($sql);
    $stmt->execute(array($_SESSION['id']));
    $row = $stmt->fetchAll(PDO::FETCH_OBJ);

    // var_dump($_SESSION['id']);
    include './liste_article.php';
    
?>