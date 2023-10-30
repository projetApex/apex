<?php
try
{
	$db = new PDO('mysql:host=localhost;dbname=apex;charset=utf8', 'root', '');

    $sql = 'SELECT * FROM img';
    $recipesStatement = $db->prepare($sql);
    $recipesStatement->execute();
    $recipes = $recipesStatement->fetchAll(PDO::FETCH_ASSOC);

    
    
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
    <link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>
<body>
    <div class="contains">
        <div class="box">
            <img class="wraith" src="<?php echo $recipes[0]['img_perso']?>" alt="">
            <div class="skill">
                
            </div>
        </div>
        <div class="box">
            <img class="octane" src="<?php echo $recipes[1]['img_perso']?>" alt="">
        </div>
        <div class="box">
            <img class="revenant" src="<?php echo $recipes[2]['img_perso']?>" alt="">
        </div>
        <div class="box">
            <img class="catalyst" src="<?php echo $recipes[3]['img_perso']?>" alt="">
        </div>
    </div>
</body>
</html>