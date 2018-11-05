<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/mypagestyle.css">
</head>
<div class="container" id="container">
    <div>
    <?
    $arr = $db->selectRow("SELECT * FROM `users` WHERE `id` = {?}", array($_SESSION["USER_ID"]));
    ?>
    <?
    $fname = "upload/" . $arr['id'];
    if (file_exists($fname . ".png")) {
        $ext = ".png";
    } else if (file_exists($fname . ".jpeg")) {
        $ext = ".jpeg";
    } else if (file_exists($fname . ".jpg")) {
        $ext = ".jpg";
    } else if (file_exists($fname . ".gif")) {
        $ext = ".gif";
    } else {
        $ext = "";
    }
    if ($ext != "") {
        echo "<img id=\"avatar\" src=\"" . $fname . $ext . "\">";
    } else {
        echo "<img id=\"avatar\" src=\"upload/no_photo.png    \">";
    }
    ?>
    <div id="logout">
        <div id="username"><?php echo $arr['login'] ?></div>
        <a id="logoutbutton" href="?exit">Выйти</a>
    </div>
    <div id="other_info">
        <div>
            <label class="label-text">Фамилия: </label>
            <label class="label-info"><?php echo $arr['surname'] ?></label>
        </div>
        <div>
            <label class="label-text">Имя: </label>
            <label class="label-info"><?php echo $arr['name'] ?></label>
        </div>
        <div>
            <label class="label-text">Пол: </label>
            <label class="label-info"><?php echo $arr['gender']; ?></label>
        </div>
        <div>
            <label class="label-text">Дата рождения: </label>
            <label class="label-info"><?php echo (new DateTime($arr['birth']))->format('d.m.Y'); ?></label>
        </div>
        <div>
            <label class="label-text">Email: </label>
            <label class="label-info"><?php echo $arr['email'] ?></label>
        </div>
    </div>
</div>

</html>