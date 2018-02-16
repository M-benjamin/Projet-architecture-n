<?php
    // -> Start SESSION
    session_start();
    var_dump('Helle');
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

    <body class="text-center">

        <div id="connection">
            <form class="form-signin" method="POST" action="">
                <!-- <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->
                <i class="fab fa-cloudversify fa-5x"></i>
                <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                <label for="inputEmail" class="sr-only">Login</label>
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <input class="btn btn-lg btn-primary btn-block" type="submit" value="connection" name="submit" />
                <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
            </form>

            <?php


            if(isset($_POST["submit"])) {
                $email = $_POST['email'];
                $password = $_POST['password'];

                // var_dump($email . $password);
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
                    redirect('./liste_article.php?id=' . $_SESSION['id']);
                } else {
                    echo "e-mail or password is not correct";
                }
            }
        ?>
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
