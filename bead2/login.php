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
$_SESSION['user'] = "";
    $_SESSION['pw'] ="";
    $_SESSION['id'] ="";
    $file=file_get_contents('users.json');
    $users=json_decode($file,true);
    $b1 = isset($_POST['user']) && isset($_POST['pw']);

    $validuser = false;
    $nameinput;
    $pwinput;
    if ($b1) {
      $nameinput = $_POST['user'];
      $pwinput = $_POST['pw'];
      if ($nameinput==""&&$pwinput=="") {
         $b1 = false;
         echo ('<p style="color:red;">adj meg érvényes felhasználónevet és jelszó</p>');

      }
    }
    if ($b1) {
        foreach ($users as $e) {
            if ($e['username']===$nameinput && $e['password']===$pwinput) {

               $validuser = true;
               $_SESSION['id'] =$e['id'];
            }
        }
    }
    if ($validuser) {
      $_SESSION['user'] = $_POST['user'];
      $_SESSION['pw'] = $_POST['pw'];

    }
 
    $action = $validuser?'index.php':'login.php';
?>
<body>
  <?php

  if ($b1&&!$validuser) {
    echo ('<p style="color:red;">rossz felhasználónév vagy jelszó</p>');
  } 
  ?>
  <h1>Bejelentkezés felület</h1>
  <form method='post' id='form1' action='login.php'> 
    <label>Név</label> <br> 
    <input type="text" name="user"> <br><br>
    <label>Jelszó</label><br> <input type="password" name="pw"> <br><br>
    <input type="submit" value="Bejelentkezés">
    <p><a href='registrate.php'>Regisztráció</a></p>
    <p><a href='index.php'>Vissza a főoldalra</a></p>

  <form>
</body>

</html>

<script>
      var myvar = <?php echo json_encode($validuser); ?>;
      var form1=document.querySelector("#form1");
      if (myvar.toString()=="true") {
        form1.action="index.php";
         form1.submit();
      }
</script>


