<?php
if (isset($_POST["login"])) {
    $login = mysqli_real_escape_string($db->getConnection(), htmlspecialchars(trim($_POST['email'])));
    $password = mysqli_real_escape_string($db->getConnection(), htmlspecialchars(trim($_POST['password'])));
    $success = true;
    if(($db->selectRow("SELECT COUNT(`login`) as `count` FROM `users` WHERE `login` = {?}", array($login))['count'] == 0) &&
        $db->selectRow("SELECT COUNT(`login`) as `count` FROM `users` WHERE `email` = {?}", array($login))['count'] == 0){
        $success = false;
    }
    $arr=$db->select("SELECT `id` FROM `users` WHERE (`login` = {?} OR `email` = {?}) AND `password` = {?}",array($login, $login, md5($password)));
   if(count($arr) > 0){
        $_SESSION["USER_ID"] = $arr[0]["id"];
        echo "<script type=\"text/javascript\">window.location = \"mypage.php\"</script>";
    } else {
        echo "<script>document.getElementById(\"error\").innerHTML=\"Неверный логин или пароль\";</script>";
        echo "<script>document.getElementById(\"error\").style.display = \"block\";</script>";
    }
}