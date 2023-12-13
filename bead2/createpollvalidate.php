<!DOCTYPE html>
<html lang="en">
<head>
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
    $errors = [];
    $datum=date('Y-m-d');

    function validate($a)
    {
        return isset($a) && strlen(trim($a))>0;
    }
    if (!validate($_POST['kerdes'])) {
        $errors['kerdes']="add meg a kérdést";
    }
    if (!validate($_POST['valasz'])) {
        $errors['valasz']="add meg a válaszokat";
    }
    if (!isset($_POST['multichoice'])) {
        $errors['multichoice']="add meg a multichoice értéket";
    }
    if (!validate($_POST['deadline'])) {
        $errors['deadline']="add meg a kitöltési határidőt";
    }
    if (!$errors) {
    $pollcount = count($polls)+1;
    $pollid = "poll" . $pollcount;
    $options = explode(PHP_EOL, $_POST['valasz']);
    $ismultichoice = ($_POST['multichoice'] === 'true');
    $answers = [];
    foreach ($options as $e) {

        $answers[$e] = 0;
    }
        $new = [
                'id' => $pollid,
                'question' => $_POST['kerdes'],
                'options' => $options,
                'isMultiple' => $ismultichoice,
                'createdAt' => $datum,
                'deadline' => $_POST['deadline'],
                'answers' => $answers,
                'voted' => []
              ];
        $polls[$pollid] = $new;
        $newjson=json_encode($polls,JSON_PRETTY_PRINT);
        file_put_contents('polls.json',$newjson);
    }

    

?>
<body>

<?php if($errors):?>
        <!-- Ez pedig, ha nem valid -->
        <h1>Sikertelen hozzáadás! 😢😭</h1>
        <a href='index.php'>Vissza a főoldalra</a>
        <a href='createpoll.php'>Új hozzzáadása</a>
    <?php else:?>
        <!-- Ez jelenjen meg, ha valid -->
        <h1>Sikeres hozzáadás! 😍</h1>
        <a href='index.php'>Vissza a főoldalra</a><br>
        <a href='createpoll.php'>Új hozzzáadása</a>
<?php endif;?>
<?php if ($errors) : ?>
        <ul style="font-size: 25px;color: red;">
        <?php foreach($errors as $error) : ?>
            <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
<?php endif; ?>
</body>
</html>