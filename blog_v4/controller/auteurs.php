<?php 

session_start();   

// -> For redirection page
function redirect($url) {
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    die();
}

function connection() {
    include './connection.php';
    if(isset($_POST["submit"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        include './connection_bdd.php';

        var_dump($password);
        //var_dump($row);
        // var_dump($row->mail . $row->password);

       
        //var_dump($count);

        if($count === 1) {
            $_SESSION['id'] = $row->id;
            $_SESSION['nom'] = $row->nom;
            $_SESSION['prenom'] = $row->prenom;
            redirect('./liste_article.php?id=' . $_SESSION['id']);
        } else {
            echo "e-mail or password is not correct";
        }
    }
}

function deconnection() {
    session_start();
    session_unset();
    session_destroy();
}
