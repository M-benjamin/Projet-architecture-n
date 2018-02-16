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

    if(isset($_POST["submit"])) {
        echo 'Connection';
        $email = $_POST['email'];
        $password = $_POST['password'];

        //var_dump($email . $password);
        // var_dump($row->mail . $row->password);

        $sql = 'SELECT * FROM autor where mail= ? AND password= ?';
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($email, $password));
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        $count = $stmt->rowCount(); 
        // var_dump($count);

        if($count === 1) {
            $_SESSION['id'] = $row->id;
            $_SESSION['nom'] = $row->nom;
            $_SESSION['prenom'] = $row->prenom;
            redirect('./liste_traitement.php?id=' . $_SESSION['id']);
        } else {
            echo "e-mail or password is not correct";
        }
    }

    include_once ('./connection.php');

