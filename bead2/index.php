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
        $file=file_get_contents('polls.json');
        $polls=json_decode($file,true);
        $file=file_get_contents('users.json');
        $logged = false;
        $users=json_decode($file,true);
        if (isset($_SESSION['user']) &&$_SESSION['user']!=""&& isset($_SESSION['pw'])&&$_SESSION['pw']!="") {
            $logged = true;
             echo ("felhaszunáló: " . $_SESSION['user']);


        } else {
            echo ("jelentkezz be hogy tudj szavazni");
        }
        $action = $logged?'szavazolap.php':'login.php';
        function cmp($a, $b) {
            return strcmp($b['createdAt'], $a['createdAt']);
        }
        usort($polls, "cmp");

        $isadmin =isset($_SESSION['user'])&& $_SESSION['user']=="admin";
    ?>
<body>
        <form  method='post' action='<?=$action?>' novalidate>
        <h1>Fóoldal</h1>
        <p><b>aktuális szavazólapot</b></p>
        <?php foreach($polls as $elem): ?>

            <?php if($elem['deadline']>=date("Y-m-d")):?>
                <?php
                    $alreadyvoted = false;
                    foreach ($elem['voted'] as $e) {
                        if (isset($_SESSION['id'])&&$e==$_SESSION['id']) {
                            $alreadyvoted = true;
                        }
                    }
                ?>
                <p><b><?=$elem['id']?></b>
                    <br>
                    <label for="">létrehozás dátuma:<?=$elem['createdAt']?></label>
                    <br>
                    <label for="">lejárat dátum:<?=$elem['deadline']?></label>
                    <br>
                    <input type="submit" name="<?=$elem['id']?>" value="<?=$alreadyvoted?'szavazás frissités':'szavazás'?>">
                </p>
            <?php endif;?>
        <?php endforeach; ?>


        <p><b>lejárt szavazólapok</b></p>
        <?php foreach($polls as $elem): ?>
        <?php if($elem['deadline']<=date("Y-m-d")):?>
            <p><b><?=$elem['id']?></b>
                <br>
                     <label for="">létrehozás dátuma:<?=$elem['createdAt']?></label>
                <br>
                    <label for="">lejárat dátum:<?=$elem['deadline']?></label>
                <br>
                <label for="">Eredmények:</label>
                <br>
                <?php foreach($elem['answers'] as $key=>$value): ?>
           
                    <label for=""><?="-   ".$key?>=<?=$value?></label>
                    <br>
                <?php endforeach; ?>
            </p>
        <?php endif;?>

    <?php endforeach; ?>

    <p><a href='createpoll.php' style="<?= !$isadmin?'display:none':''?>">új szavazólap</a></p>
    <p><a href='deletepoll.php' style="<?= !$isadmin?'display:none':''?>">szavazólap törlés</a></p>
    <p><a href='login.php'><?= $logged?'Kijelentkezés':'Bejelentkezés'?></a></p>
    <p><a href='registrate.php 'style="<?= $logged?'display:none':''?>">Regisztráció</a></p>

</form>
</body>
</html>
