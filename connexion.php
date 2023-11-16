<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$db = new PDO('mysql:host=' . $_ENV["DB_HOST"] . ';port=' . $_ENV["DB_PORT"] . ';dbname=' .  $_ENV['DB_DATABASE']  . ';charset=utf8', $_ENV['DB_NAME'], $_ENV['DB_PASSWORD']);

if(isset($_POST['envoi'])) {
    if(!empty($_POST['email']) && !empty($_POST['mdp'])) {

        $email = htmlspecialchars($_POST['email']);
        $mdp = sha1($_POST['mdp']);

        $recupUser = $db->prepare('SELECT * FROM utilisateurs WHERE email = ? && password = ?');
        $recupUser->execute(array($email, $mdp));


            if ($recupUser->rowCount() > 0) {

                if($email == 'admin@admin.com' && $mdp == $_ENV['ADMIN_PASSWORD']) {
                    $_SESSION['email'] = $email;
                    $_SESSION['mdp'] = $mdp;
                    $_SESSION['id'] = $recupUser->fetch()['id_utilisateur'];
                    header('Location: shopAdmin.php');

                } else {
                    $_SESSION['email'] = $email;
                    $_SESSION['mdp'] = $mdp;
                    $_SESSION['id'] = $recupUser->fetch()['id_utilisateur'];
                    header('Location: index.php');
                }

            } else {
                echo 'Mauvais identifiant ou mot de passe';
            }


    } else {
            echo 'Veuillez remplir tous les champs';
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="POST" action="">
    <input type="email" name="email" placeholder="email" autocomplete="off">
    <input type="password" name="mdp" placeholder="password" autocomplete="off">

    <input type="submit" name="envoi">
</form>
</body>
</html>