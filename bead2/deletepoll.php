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
    ?>
    <body>

        <form  method='post' action='deletepollvalidate.php' novalidate>
            <h1>Szavazólap törlése</h1>
            <label>szavazolapok</label><br>
            
            <?php foreach($polls as $e):?>
                <input type="checkbox" id="<?=$e['id']?>" name="<?=$e['id']?>"> 
                <label for=""> <?=$e["id"]?></label><br>
            <?php endforeach;?>
            <input type="submit" value="törlés" id="gomb1">
            <br>
            <a href='index.php'>Vissza a főoldalra</a>
        </form>
    </body>
</html>
<script>

</script>