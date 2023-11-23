<?php
session_start();


require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();



try {
    // $db = new PDO('mysql:host=localhost;dbname=apex;charset=utf8', 'root', 'root');
    $db = new PDO('mysql:host=' . $_ENV["DB_HOST"] . ';port=' . $_ENV["DB_PORT"] . ';dbname=' . $_ENV['DB_DATABASE'] . ';charset=utf8', $_ENV['DB_NAME'], $_ENV['DB_PASSWORD']);

    $sql = 'SELECT * FROM img';
    $recipesStatement = $db->prepare($sql);
    $recipesStatement->execute();
    $recipes = $recipesStatement->fetchAll(PDO::FETCH_ASSOC);

    $sql2 = 'SELECT * FROM spell_img';
    $recipesStatement2 = $db->prepare($sql2);
    $recipesStatement2->execute();
    $recipes2 = $recipesStatement2->fetchAll(PDO::FETCH_ASSOC);

    $sql3 = 'SELECT * FROM spell';
    $recipesStatement3 = $db->prepare($sql3);
    $recipesStatement3->execute();
    $recipes3 = $recipesStatement3->fetchAll(PDO::FETCH_ASSOC);

    $sql4 = 'SELECT * FROM personnages';
    $recipesStatement4 = $db->prepare($sql4);
    $recipesStatement4->execute();
    $recipes4 = $recipesStatement4->fetchAll(PDO::FETCH_ASSOC);

    $sql5 = 'SELECT * FROM items';
    $recipesStatement5 = $db->prepare($sql5);
    $recipesStatement5->execute();
    $recipes5 = $recipesStatement5->fetchAll(PDO::FETCH_ASSOC);

    $sql6 = 'SELECT * FROM utilisateurs';
    $recipesStatement6 = $db->prepare($sql6);
    $recipesStatement6->execute();
    $recipes6 = $recipesStatement6->fetchAll(PDO::FETCH_ASSOC);

    
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/shop.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Apex Legend</title>
</head>

<body>

    <div class="contains">

        <?php
        for ($i = 0; $i < count($recipes); $i++) {
            ?>

        <?php $UserID = $i + 1; ?>

        <div class="money">
            <p class="credit">
                <?php echo $_SESSION['credits']; ?> crédits
            </p>
        </div>

        <div class="box">
            <!-- <a href="character.php?id=1"> -->
            <img class="wraith" src="<?php echo $recipes5[3]['skin'] ?>" alt="">
            <div class="skill">
                <h3 class="perso">
                    <?php echo $recipes4[0]['name'] ?>
                </h3>
                <p class="buy"> Acheter cet item ?</p>
                <h4 class="prix">
                    <button class="buttonbuy">
                        <?php echo $recipes5[3]['prix'] ?> crédits
                    </button>
                </h4>
            </div>
            <!-- </a> -->
        </div>
        <div class="box">
            <!-- <a href="character.php?id=2"> -->
            <img class="octane" src="<?php echo $recipes5[6]['skin'] ?>" alt="">
            <div class="skill">
                <h3 class="perso">
                    <?php echo $recipes4[1]['name'] ?>
                </h3>
                <p class="buy"> Acheter cet item ?</p>
                <h4 class="prix">
                    <button class="buttonbuy">
                        <?php echo $recipes5[3]['prix'] ?> crédits
                    </button>
                </h4>
            </div>
            <!-- </a> -->
        </div>
        <div class="box">
            <img class="revenant" src="<?php echo $recipes5[9]['skin'] ?>" alt="">
            <div class="skill">
                <h3 class="perso">
                    <?php echo $recipes4[1]['name'] ?>
                </h3>
                <p class="buy"> Acheter cet item ?</p>
                <h4 class="prix">
                    <button class="buttonbuy">
                        <?php echo $recipes5[3]['prix'] ?> crédits
                    </button>
                </h4>
            </div>
        </div>
        <div class="box">
            <img class="catalyst" src="<?php echo $recipes5[12]['skin'] ?>" alt="">
            <div class="skill">
                <h3 class="perso">
                    <?php echo $recipes4[1]['name'] ?>
                </h3>
                <p class="buy"> Acheter cet item ?</p>
                <h4 class="prix">
                    <button class="buttonbuy">
                        <?php echo $recipes5[3]['prix'] ?> crédits
                    </button>
                </h4>
            </div>
        </div>
    </div>
    <?php
        }
        ?>
    </div>
    <form action="index.php">
        <button type="submit" class="boutique">Menu principal</button>
    </form>
    <script src="./js/index.js"></script>
</body>

</html>