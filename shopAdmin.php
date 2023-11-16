<?php

session_start();

if(!isset($_SESSION['email'])) {
    header('Location: connexion.php');
}

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

try
{
    // $db = new PDO('mysql:host=localhost;dbname=apex;charset=utf8', 'root', 'root');
    $db = new PDO('mysql:host=' . $_ENV["DB_HOST"] . ';port=' . $_ENV["DB_PORT"] . ';dbname=' .  $_ENV['DB_DATABASE']  . ';charset=utf8', $_ENV['DB_NAME'], $_ENV['DB_PASSWORD']);

    $sql = 'SELECT * FROM items';
    $recipesStatement = $db->prepare($sql);
    $recipesStatement->execute();
    $recipes = $recipesStatement->fetchAll(PDO::FETCH_ASSOC);

    //delete item selon sont id
    if(isset($_POST['delete'])) {
        $id = $_POST['id'];
        $sql = 'DELETE FROM items WHERE id_items = ?';
        $deleteStatement = $db->prepare($sql);
        $deleteStatement->execute(array($id));
        header('Location: shopAdmin.php');
    }

    //Modifier un item
    if(isset($_POST['modifier'])) {
        $id = $_POST['id'];
        $prix = $_POST['prix'];
        $level = $_POST['level'];
        $skin = $_POST['skin'];

        $sql = 'UPDATE items SET prix = ?, level = ?, skin = ? WHERE id_items = ?';
        $updateStatement = $db->prepare($sql);
        $updateStatement->execute(array($prix, $level, $skin, $id));
        header('Location: shopAdmin.php');
    }


}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./style/shopAdmin.css">
    <title>Apex Legend</title>
</head>

<body>
    <div><a href="./deconnexion.php">
            <button class="btn">Deconnexion</button>
        </a>

        <form action="index.php">
            <button type="submit" class="btn">Menu principal</button>
        </form>
    </div>

    <h1>Shop Admin</h1>


    <div class="items">
        <?php
        for ($i = 1; $i < count($recipes); $i++) {        
            ?>

        <div class="cards">

            <img src="<?php echo $recipes[$i]['skin'] ?>" alt="">

            <div class="infosItems">

                <form method="POST" class="modifier">
                    <input type="hidden" name="id" value="<?php echo $recipes[$i]['id_items'] ?>">
                    <input type="hidden" name="skin" value="<?php echo $recipes[$i]['skin'] ?>">
                    <input type="text" name="prix" value="<?php echo $recipes[$i]['prix'] ?>">
                    <input type="text" name="level" value="<?php echo $recipes[$i]['level'] ?>">
                    <input type="submit" class="btn2" name="modifier" value="Modifier">
                </form>

                <form method="POST" class="delete">
                    <input type="hidden" name="id" value="<?php echo $recipes[$i]['id_items'] ?>">
                    <input type="submit" class="btn2" name="delete" value="Supprimer">
                </form>
            </div>



        </div>

        <?php
        }
        ?>
    </div>



</body>

</html>