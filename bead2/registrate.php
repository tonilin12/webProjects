<!DOCTYPE html>
<html lang="en">

<?php
    session_start();
    $_SESSION['user'] = "";
    $_SESSION['pw'] ="";
    $_SESSION['id'] ="";


$b1 = isset($_POST['email']) && isset($_POST['user']) && isset($_POST['pw1']) && isset($_POST['pw2']);
$validateEmail=$b1&&filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$validatepw=$b1&&$_POST['pw1']==$_POST['pw2'];

$file=file_get_contents('users.json');
$users=json_decode($file,true);

$check=$validateEmail&& $validatepw;
$idnum = count($users)+1;
$id = "userid" . $idnum;

if ($check) {
      $_SESSION['user'] = $_POST['user'];
      $_SESSION['pw'] =$_POST['pw1'];
      $_SESSION['id'] =$id;

      $new = [
        'id' =>$id,
        'username' => $_POST['user'],
        'email' => $_POST['email'],
        'password' => $_POST['pw1'],
        'isAdmin'=>false
    ];
    $users[$_POST['user']] = $new;
    $newjson=json_encode($users,JSON_PRETTY_PRINT);
    file_put_contents('users.json',$newjson);
}
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
  <h1>Regisztráció felület</h1>
  <form method='post' id="form1" action='registrate.php'> 
    <label>Felhasználónév</label> <br> 
    <input type="text"  value="<?=$b1?$_POST['user']:""?>" name="user" required> 

    <br><br>

    <label>e-mail cím</label> <br> 
    <input  value="<?=$b1?$_POST['email']:""?>" type="text" name="email" required>
    <?php 
      if ($b1&&!$validateEmail) {
        echo('<label for="" style="color:red;">email nem érvényes</label>');
      }
    ?>
    <br><br>


    <label>Jelszó</label><br> <input  value="<?=$b1?$_POST['pw1']:""?>" type="password" name="pw1" required> <br><br>
    <label>Jelszó még egyszer</label><br> <input type="password" value="<?=$b1?$_POST['pw2']:""?>" name="pw2" required> 
    <?php 
      if ($b1&&!$validatepw) {
        echo('<label for="" style="color:red;">jelszó nem egyezik</label>');
      }
    ?>
    <br><br>
    <input type="submit" value="Küldés">
    <p><a href='index.php'>Vissza a főoldalra</a></p>

  <form>
</body>
</html>

<script>
      var myvar = <?php echo json_encode($check); ?>;
      var form1=document.querySelector("#form1");
      if (myvar.toString()=="true") {
        form1.action="index.php";
         form1.submit();
      }
</script>