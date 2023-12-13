<!DOCTYPE html>
<html lang="en">

<?php 
    session_start();
    echo ("felhasználó: ".$_SESSION['user']);

    $file=file_get_contents('polls.json');
    $polls=json_decode($file,true);
    $file=file_get_contents('users.json');
    $users=json_decode($file,true);

    $adat;
    foreach ($polls as $elem) {
        if (isset($_POST[$elem['id']])) {
            $_SESSION['pollid'] = $elem['id'];
        }
    }
    $adat = $polls[$_SESSION['pollid']];
    $alreadyvoted = false;
    foreach ($adat['voted'] as $e) {
        if ($e==$_SESSION['id']) {
            $alreadyvoted = true;
        }
    }
    $_SESSION['voted'] = $alreadyvoted;
?>
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/elte-fi/www-assets@19.10.16/styles/mdss.min.css">
  <link rel="stylesheet" href="style.css">
  <title>Document</title>
</head>
<body>
    <h1>Szavazólap</h1>
    <form  method='post' action='validatepoll.php' novalidate>
        <p><?=$adat['question']?></p>
        <?php foreach($adat['options'] as $elem):?>
            <?php if($adat['isMultiple']):?>
                    <input type="checkbox" id="<?=$elem?>" name="<?=$elem?>" value="<?=$elem?>">
                    <label for="<?=$elem?>"><?=$elem?></label><br>
                <?php else:?>
                    <input type="radio" id="<?=$elem?>" name="choices" value="<?=$elem?>">
                    <label for="<?=$elem?>"><?=$elem?></label><br>
            <?php endif;?>

        <?php endforeach;?>

        <br>
        <input type="submit" name=" <?=$adat['id']?>" value="Küldés">
        <p>létrehozás dátuma: <?=$adat['createdAt']?>   -  -  -  határidő: <?=$adat['deadline']?></p>
        <a href='index.php'>Vissza a főoldalra</a>
      <form>
</body>
</html>