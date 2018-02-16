<?php  
        // echo $titre . $desc . $date . $id;
        include './ajouter_bdd.php';
      
        if(isset($_POST["submit"])) {
        $titre = $_POST['titre'];
        $desc = $_POST['description'];
        $date = date('Y-m-d H:i:s');
        $id =  $_SESSION['id'];

        // echo $titre . $desc . $date . $id;
        include './ajouter_article.php';
        
    }
?>