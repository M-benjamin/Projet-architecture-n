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

    $sql = 'SELECT * FROM article where auteur_id= ?';
    $stmt = $dbCon->prepare($sql);
    $stmt->execute(array($_SESSION['id']));
    $row = $stmt->fetchAll(PDO::FETCH_OBJ);

    // var_dump($row);

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

<body>
    <div id="liste">
        <div class="container">

            <div class="py-5 text-center">
                <i class="fab fa-cloudversify fa-5x"></i>
                <h2>Welcome <?php echo $_SESSION['nom'] . ' ' . $_SESSION['prenom'] ?></h2>
                <a href="./deconnection.php" class="btn btn-danger">Déconnection</a>

            </div>

            <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
                <div class="col-md-6 px-0">
                    <h1 class="display-4 font-italic">blog for TP</h1>
                    <a href="./ajouter_article.php?id=<?php echo $_SESSION['id'] ?>" class="btn btn-primary">Ajouter article</a>
                </div>
            </div>

             <?php foreach($row as $r) :?>
            <div class="row mb-2">
                <div class="col-md-6">
                    <div class="card flex-md-row mb-4 box-shadow h-md-250">
                        <div class="card-body d-flex flex-column align-items-start">
                            <h3 class="mb-0">
                                <a class="text-dark" href="#"><?php echo $r->titre ?></a>
                            </h3>
                            <div class="mb-1 text-muted"><?php echo $r->datecreate ?></div>
                            <p class="card-text mb-auto"><?php echo $r->description ?></p>
                        </div>
                    </div>
                </div>

            </div>
            <?php endforeach;?>
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
