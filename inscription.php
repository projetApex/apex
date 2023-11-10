<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


    $db = new PDO('mysql:host=' . $_ENV["DB_HOST"] . ';port=' . $_ENV["DB_PORT"] . ';dbname=' .  $_ENV['DB_DATABASE']  . ';charset=utf8', $_ENV['DB_NAME'], $_ENV['DB_PASSWORD']);

    if(isset($_POST['envoi'])) {
        if(!empty($_POST['email']) && !empty($_POST['mdp'])) {

            $email  = htmlspecialchars($_POST['email']);
            $mdp = sha1($_POST['mdp']);

            $insertInventaire = $db -> prepare('SELECT * FROM inventaire ORDER BY id_inventaire DESC LIMIT 1');
            $insertInventaire -> execute();
            $inventaire = $insertInventaire -> fetch(PDO::FETCH_ASSOC);


            $totalInventairee = $inventaire['id_inventaire'] + 1;

            $insertInventaire = $db -> prepare('INSERT INTO inventaire(id_inventaire, id_items) VALUES(:totalInventaire, 1)');
            $insertInventaire -> bindParam(':totalInventaire', $totalInventairee, PDO::PARAM_INT);
            $insertInventaire -> execute();

            $insertUser = $db -> prepare('INSERT INTO utilisateurs(email, password, id_inventaire) VALUES(:email, :mdp, :totalInventaire)');
            $insertUser -> bindParam(':email', $email, PDO::PARAM_STR);
            $insertUser -> bindParam(':mdp', $mdp, PDO::PARAM_STR);
            $insertUser -> bindParam(':totalInventaire', $totalInventairee, PDO::PARAM_INT);
            $insertUser -> execute();

            $selectUser = $db -> prepare('SELECT * FROM utilisateurs WHERE email = ? && password = ?');
            $selectUser -> execute(array($email, $mdp));

            if($selectUser -> rowCount() > 0) {
                $_SESSION['email'] = $email;
                $_SESSION['mdp'] = $mdp;
                $_SESSION['id'] = $selectUser->fetch()['id_utilisateur'];
                header('Location: index.php');
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