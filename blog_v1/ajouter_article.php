<?php
    // -> Start SESSION
    session_start();
    // -> Set default parameter for database connection
    $host = '192.168.128.11';
    $dbName = 'blog';
    $username = 'benjamen';
    $password = '';

    $dbCon = new PDO("mysql:host=".$host.";dbname=".$dbName, $username, $password);

    // -> For redirection page
    function redirect($url) {
        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- style -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="bg-light">
    <div id="ajout">
        <div class="container">
            <div class="py-5 text-center">
                <a href="./liste_article.php"><i class="fab fa-cloudversify fa-5x"></i></a>
                <h2>Nouveau Post:</h2>
            </div>

            <div class="row">

                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">Ajouter un nouveau post :</h4>
                    <form class="needs-validation" method="POST" action="" novalidate>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="title">Titre:</label>
                                <input type="text" class="form-control" name="titre" placeholder="titre de l'article" value="" required>
                                <div class="invalid-feedback">
                                   please enter an title
                                </div>
                            </div>
                        </div>


                        <div class="mb-3">
                            <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description de l'article:</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                            </div>
                        </div>

                        <hr class="mb-4">
                        <input class="btn btn-primary btn-lg btn-block" name="submit" type="submit" value="valider"/>
                    </form>
                    <?php
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
                </div>
            </div>

            <footer class="my-5 pt-5 text-muted text-center text-small">
                <p class="mb-1">&copy; 2017-2018 BLog Coorporation</p>
            </footer>
        </div>
    </div>

    <!-- SCRIPT
=================================================-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>