<?php

function getAge($y, $m, $d)
{
    if ($m > date('m') || $m == date('m') && $d > date('d'))
        return (date('Y') - $y - 1);
    else
        return (date('Y') - $y);
}

if (isset($_POST["register"])) {
    $name = mysqli_real_escape_string($db->getConnection(), htmlspecialchars(trim($_POST['name'])));
    $surname = mysqli_real_escape_string($db->getConnection(), htmlspecialchars(trim($_POST['surname'])));
    $login = mysqli_real_escape_string($db->getConnection(), htmlspecialchars(trim($_POST['login'])));
    $gender = $_POST['gender'];
    $birth = $_POST['birth'];
    $email = mysqli_real_escape_string($db->getConnection(), htmlspecialchars(trim($_POST['email'])));
    $password = mysqli_real_escape_string($db->getConnection(), htmlspecialchars(trim($_POST['password'])));
    $confpass = mysqli_real_escape_string($db->getConnection(), htmlspecialchars(trim($_POST['confirmpassword'])));

    echo "<script>document.getElementById(\"error\").style.display = \"block\";</script>";
    if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z]{8,50}$/', $password)) {
        echo "<script>document.getElementById(\"error\").innerHTML=\"Проверьте вводимый пароль! Пароль вводится латиницей (не менее 8 символов) и содержит хотя бы одну цифру, одну букву в верхнем регистре и одну букву в нижнем регистре!\";</script>";
    } else if ($password != $confpass) {
        echo "<script>document.getElementById(\"error\").innerHTML=\"Пароли не совпадают!\";</script>";
    } else if ($db->selectRow("SELECT COUNT(`login`) as `count` FROM `users` WHERE `login` = {?}", array($login))['count'] != 0) {
        echo "<script>document.getElementById(\"error\").innerHTML=\"Данный логин уже занят. Выберите другой логин. \";</script>";
    } else if ($db->selectRow("SELECT COUNT(`email`) as `count` FROM `users` WHERE `email` = {?}", array($email))['count'] != 0) {
        echo "<script>document.getElementById(\"error\").innerHTML=\"Пользователь с данным email уже зарегистрирован на этом сайте. \";</script>";
    } else if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $email)) {
        echo "<script>document.getElementById(\"error\").innerHTML=\"Проверьте правильность введенного email.\";</script>";
    } else if (!preg_match('/^[a-zA-Z0-9]{8,20}$/', $login)) {
        echo "<script>document.getElementById(\"error\").innerHTML=\"Проверьте вводимый логин! Логин вводится вводится латинскими буквами. Допустимая длина логина от 8 до 20 букв!\";</script>";
    } else if (getAge((new DateTime($birth))->format('Y'), (new DateTime($birth))->format('m'), (new DateTime($birth))->format('d')) < 18) {
        echo "<script>document.getElementById(\"error\").innerHTML=\"На этом сайте могут регистрироваться только лица старше 18 лет!\";</script>";
    } else {
        $db->query("INSERT into `users` values (NULL,'" . $name . "','" . $surname . "','" . $login . "','" . $email . "','" . md5($password) . "','" . $gender . "','" . $birth . "')") or die ("Error" . mysqli_error($db->getConnection()));
        echo "<script>document.getElementById(\"error\").style.display = \"none\";</script>";
        echo "<script>document.getElementById(\"container\").innerHTML=\"Вы успешно зарегистрировались. Для входа в личный кабинет переходите к <a href='index.php'> форме авторизации. </a>\";</script>";
        $target_dir = "upload/";
        $imageFileType = strtolower(pathinfo($target_dir . basename($_FILES["userfile"]["name"]), PATHINFO_EXTENSION));
        $target_file = $target_dir . $db->selectRow("SELECT `id` from `users` WHERE `login`={?}", array($login))['id'].".".$imageFileType;
        $uploadOk = 1;

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"  && $imageFileType != "jpg" && $imageFileType != "gif" ) {
            echo "<script>document.getElementById(\"error\").innerHTML=\"Загружаемый файл не является изображением!\"</script>";
            $uploadOk = 0;
        }
        if($uploadOk) {
            move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file) or die("Файл не был загружен!");
        }
    }


}

?>