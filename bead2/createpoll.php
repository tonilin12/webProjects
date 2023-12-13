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
        $file=file_get_contents('users.json');
        $users=json_decode($file,true);
?>
<body>
  <form  method='post' action='createpollvalidate.php' novalidate>
        <h1>Új szavazólap</h1>
        <label for="">kérdés</label><br>
        <textarea name="kerdes" id="" cols="30" rows="5"></textarea><br>

        <label for="">Lehet-e több lehetőséget kiválasztani?</label><br>
        <input type="radio" id="true" name="multichoice" value="true">
        <label for="">igen</label><br>
        <input type="radio" id="multichoice" name="multichoice" value="false">
        <label for="">nem</label><br>

        <label for="">válasz:(soronként 1 válasz)</label><br>
        <textarea name="valasz" id="" cols="40" rows="10"></textarea><br>
               
        <label>Lejárati dátum</label><br> <input type="date" name="deadline"> <br><br>
        <input type="submit" value="Küldés">
        <br>
        <a href='index.php'>Vissza a főoldalra</a>
    </form>
</body>
</html>

<script>


</script>