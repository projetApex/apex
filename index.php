<?php



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

} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style2.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Apex Legend</title>
</head>

<body>
    <div class="contains">
        <div class="box" id="wraith">
            <select id="wraithSelect" name="wraith_image">
                <option value="Image 1">Image 1</option>
                <option value="Image 2">Image 2</option>
                <option value="Image 3">Image 3</option>
            </select>
            <img class="wraith" id="wraithImage" src="<?php echo $recipes[0]['img_perso'] ?>" alt="">
            <div class="skill">
                <img class="spell" src="<?php echo $recipes2[0]['passive_img'] ?>" alt="">
                <p class="name">
                    <?php echo $recipes3[0]['passive'] ?>
                </p>
                <img class="spell" src="<?php echo $recipes2[0]['tactical_img'] ?>" alt="">
                <p class="name">
                    <?php echo $recipes3[0]['tactical'] ?>
                </p>
                <img class="spell" src="<?php echo $recipes2[0]['ultime_img'] ?>" alt="">
                <p class="name">
                    <?php echo $recipes3[0]['ultime'] ?>
                </p>
            </div>
        </div>
    </div>
    <div class="box" id="octane">
        <select id="octaneSelect" name="octane_image">
            <option value="Image 1">Image 1</option>
            <option value="Image 2">Image 2</option>
            <option value="Image 3">Image 3</option>
        </select>
        <img class="octane" id="octaneImage" src="<?php echo $recipes[1]['img_perso'] ?>" alt="">
        <div class="skill">
            <img class="spell" src="<?php echo $recipes2[1]['passive_img'] ?>" alt="">
            <p class="name">
                <?php echo $recipes3[1]['passive'] ?>
            </p>
            <img class="spell" src="<?php echo $recipes2[1]['tactical_img'] ?>" alt="">
            <p class="name">
                <?php echo $recipes3[1]['tactical'] ?>
            </p>
            <img class="spell" src="<?php echo $recipes2[1]['ultime_img'] ?>" alt="">
            <p class="name">
                <?php echo $recipes3[1]['ultime'] ?>
            </p>
        </div>
    </div>
    <div class="box" id="revenant">
        <select id="revenantSelect" name="revenant_image">
            <option value="Image 1">Image 1</option>
            <option value="Image 2">Image 2</option>
            <option value="Image 3">Image 3</option>
        </select>
        <img class="revenant" id="revenantImage" src="<?php echo $recipes[2]['img_perso'] ?>" alt="">
        <div class="skill">
            <img class="spell" src="<?php echo $recipes2[2]['passive_img'] ?>" alt="">
            <p class="name">
                <?php echo $recipes3[2]['passive'] ?>
            </p>
            <img class="spell" src="<?php echo $recipes2[2]['tactical_img'] ?>" alt="">
            <p class="name">
                <?php echo $recipes3[2]['tactical'] ?>
            </p>
            <img class="spell" src="<?php echo $recipes2[2]['ultime_img'] ?>" alt="">
            <p class="name">
                <?php echo $recipes3[2]['ultime'] ?>
            </p>
        </div>
    </div>

    <div class="box" id="catalyst">
        <select id="catalystSelect" name="catalyst_image">
            <option value="Image 1">Image 1</option>
            <option value="Image 2">Image 2</option>
            <option value="Image 3">Image 3</option>
        </select>
        <img class="catalyst" id="catalystImage" src="<?php echo $recipes[3]['img_perso'] ?>" alt="">
        <div class="skill">
            <img class="spell" src="<?php echo $recipes2[3]['passive_img'] ?>" alt="">
            <p class="name">
                <?php echo $recipes3[3]['passive'] ?>
            </p>
            <img class="spell" src="<?php echo $recipes2[3]['tactical_img'] ?>" alt="">
            <p class="name">
                <?php echo $recipes3[3]['tactical'] ?>
            </p>
            <img class="spell" src="<?php echo $recipes2[3]['ultime_img'] ?>" alt="">
            <p class="name">
                <?php echo $recipes3[3]['ultime'] ?>
            </p>
        </div>
    </div>
    </div>
    <script>

        const wraithSelect = document.getElementById('wraithSelect');
        const wraithImage = document.getElementById('wraithImage');

        wraithSelect.addEventListener('change', () => {
            const selectedImage = wraithSelect.value;

            if (selectedImage === 'Image 1') {
                wraith1Image.src = 'chemin_vers_image_1.jpg';
            } else if (selectedImage === 'Image 2') {
                wraithImage.src = 'chemin_vers_image_2.jpg';
            } else if (selectedImage === 'Image 3') {
                wraithImage.src = 'chemin_vers_image_3.jpg';
            }
        });

        const octaneSelect = document.getElementById('octaneSelect');
        const octaneImage = document.getElementById('octaneImage');

        octaneSelect.addEventListener('change', () => {
            const selectedImage = octaneSelect.value;

            if (selectedImage === 'Image 1') {
                octaneImage.src = 'chemin_vers_image_1.jpg';
            } else if (selectedImage === 'Image 2') {
                octaneImage.src = 'chemin_vers_image_2.jpg';
            } else if (selectedImage === 'Image 3') {
                octaneImage.src = 'chemin_vers_image_3.jpg';
            }
        });

        const revenantSelect = document.getElementById('revenantSelect');
        const revenantImage = document.getElementById('revenantImage');

        revenantSelect.addEventListener('change', () => {
            const selectedImage = revenantSelect.value;

            if (selectedImage === 'Image 1') {
                revenantImage.src = 'chemin_vers_image_1.jpg';
            } else if (selectedImage === 'Image 2') {
                revenantImage.src = 'chemin_vers_image_2.jpg';
            } else if (selectedImage === 'Image 3') {
                revenantImage.src = 'chemin_vers_image_3.jpg';
            }
        });

        const catalystSelect = document.getElementById('catalystSelect');
        const catalystImage = document.getElementById('catalystImage');

        catalystSelect.addEventListener('change', () => {
            const selectedImage = catalystSelect.value;

            if (selectedImage === 'Image 1') {
                catalystImage.src = 'chemin_vers_image_1.jpg';
            } else if (selectedImage === 'Image 2') {
                catalystImage.src = 'chemin_vers_image_2.jpg';
            } else if (selectedImage === 'Image 3') {
                catalystImage.src = 'chemin_vers_image_3.jpg';
            }
        });
    </script>
</body>

</html>