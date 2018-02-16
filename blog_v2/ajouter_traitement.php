<?php 
    // -> Start SESSION
    session_start();
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

   
    include './ajouter_article.php';

    if(isset($_POST["submit"])) {
        $titre = $_POST['titre'];
        $desc = $_POST['description'];
        $date = date('Y-m-d H:i:s');
        $id =  $_SESSION['id'] ;

        // echo $titre . $desc . $date . $id;

        $sql = 'INSERT INTO article VALUES (DEFAULT, ?, ?, ?, ?)';
                
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($titre, $desc, $id, $date));
        
    }
?>