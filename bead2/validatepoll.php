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
        session_start();
        echo ("felhasználó: ".$_SESSION['user']);

        $file=file_get_contents('polls.json');
        $polls=json_decode($file,true);
        $file=file_get_contents('users.json');
        $users=json_decode($file,true);
        $adat = $polls[$_SESSION['pollid']];

        $v = false;
?>
<body>
    <?php
            foreach($adat['answers'] as $key=>$value)
            {
              if (isset($_POST['choices'])&&$_POST['choices']===$key) {
                $adat['answers'][$key] += 1;
               array_push($adat['voted'], $_SESSION['user']);

              }
              if (isset($_POST[$key])&&$_POST[$key]===$key) {
                $adat['answers'][$key] += 1;
                array_push($adat['voted'], $_SESSION['user']);
                $v = true;
              }
            }
            foreach ($polls as $e) {
                if ($adat['id']===$e['id']) {
                    $polls[$e['id']] = $adat;
                }
            }
            $newjson=json_encode($polls,JSON_PRETTY_PRINT);
            file_put_contents('polls.json',$newjson);


    ?>
    <?php  if (isset($_POST['choices']) || $v) :?>

        <h1>Sikeres hozzáadás! 😍</h1>
        <a href='index.php'>Vissza a főoldalra</a>
    <?php else:?>
        <h1>Nincs megadva választás</h1>
        <a href='szavazolap.php'>szavazás újra</a><br>
        <a href='index.php'>Vissza a főoldalra</a>
    <?php endif;?>
</body>
</html>