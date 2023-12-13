<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/elte-fi/www-assets@19.10.16/styles/mdss.min.css">
        <link rel="stylesheet" href="style.css">
        <title>Document</title>
    </head>
    <?php 
        $file=file_get_contents('polls.json');
        $polls=json_decode($file,true);
        $delElements = [];
        foreach ($polls as $key => $value) {
           if (isset($_POST[$key])) {
                unset($polls[$key]);
                array_push($delElements, $key);
           }
        }
        $newjson=json_encode($polls,JSON_PRETTY_PRINT);
        file_put_contents('polls.json',$newjson);
    ?>
    <body>
        <?php if(count($delElements)==0):?>
            <h1>Nincs kijelölve szavazólap</h1>
        <?php else:?>
            <h1>Sikeres törlés 😍</h1>
            <label><b>törölt elemek</b></label><br>
            <?php 
            foreach ($delElements as $e) {
                echo ('<label>  - ' . $e . '<label><br>');
            }
        ?>
        <?php endif;?>
        <br>
        <a href='deletepoll.php'>Törlés újra</a><br>
        <a href='index.php'>Vissza a főoldalra</a>

    </body>
</html>