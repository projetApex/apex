<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Récupérez le paramètre d'URL "id"
if (isset($_GET['id'])) {
    $characterId = $_GET['id'];

    $db = new PDO('mysql:host=' . $_ENV["DB_HOST"] . ';port=' . $_ENV["DB_PORT"] . ';dbname=' . $_ENV['DB_DATABASE'] . ';charset=utf8', $_ENV['DB_NAME'], $_ENV['DB_PASSWORD']);

    // Exécutez une requête SQL pour récupérer les informations du personnage en fonction de $characterId
    $sql = 'SELECT p.*, i.img_perso, s.passive AS passive_name, s.tactical AS tactical_name, s.ultime AS ultime_name, si.passive_img AS passive_img, si.tactical_img AS tactical_img, si.ultime_img AS ultime_img
                FROM personnages p
                JOIN img i ON p.id_img = i.id_img
                JOIN spell s ON p.id_spell = s.id_spell
                JOIN spell_img si ON p.id_spell_img = si.id_spell_img
                WHERE p.id_user = :characterId';

    $characterStatement = $db->prepare($sql);
    $characterStatement->bindParam(':characterId', $characterId, PDO::PARAM_INT);
    $characterStatement->execute();
    $characterData = $characterStatement->fetch(PDO::FETCH_ASSOC);


    $idinventaire = $_SESSION['id_inventaire'];

    $sql2 = 'SELECT * FROM inventaire WHERE id_inventaire = '.$idinventaire.'';
    $recipesStatement2 = $db->prepare($sql2);
    $recipesStatement2->execute();
    $recipes2 = $recipesStatement2->fetch(PDO::FETCH_ASSOC);


    $sql3 = 'SELECT * FROM items WHERE id_items = '.$recipes2['id_items1'].'';
    $recipesStatement3 = $db->prepare($sql3);
    $recipesStatement3->execute();
    $recipes3 = $recipesStatement3->fetch(PDO::FETCH_ASSOC);



    $imgSelect = $characterData['img_perso'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/charac.css">
    <title>Story</title>
</head>

<body>
    <h1 class="charac_title">
        <?php echo $characterData['name'] ?>
    </h1>

    <select class="image-selector global-selector">
        <?php
    for ($i = 1; $i < count($recipes2); $i++) {
        $items += 1;
        echo '<option value="' . $recipes3['skin'] . '">' . $recipes2['id_items' . $items] . '</option>';
    }
    ?>
    </select>


    <div class="charac_content">



        <img class="charac_perso" src="<?php echo $imgSelect  ?>" alt="">
        <div class="charac_story">
            <p>
                <?php echo $characterData['story'] ?>
            </p>
            <div class="charac_spell_title">
                <p>
                    <?php echo $characterData['passive_name'] ?>
                </p>
                <p>
                    <?php echo $characterData['tactical_name'] ?>
                </p>
                <p>
                    <?php echo $characterData['ultime_name'] ?>
                </p>
            </div>
            <div class="charac_spell">
                <img src="<?php echo $characterData['passive_img'] ?>" alt="">
                <img src="<?php echo $characterData['tactical_img'] ?>" alt="">
                <img src="<?php echo $characterData['ultime_img'] ?>" alt="">
            </div>
        </div>
    </div>

    <script>
    function updateImgSelect() {
        var select = document.querySelector('.image-selector');
        var selectedOption = select.options[select.selectedIndex];
        var imgSelect = selectedOption.value;

        // Mettez à jour l'image sur la page
        document.querySelector('.charac_perso').src = imgSelect;
    }

    // Attachez la fonction updateImgSelect au changement de la sélection
    document.querySelector('.image-selector').addEventListener('change', updateImgSelect);
    </script>
</body>


</html>