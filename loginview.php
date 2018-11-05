<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/loginstyle.css">
</head>
<body>

<div id="login_container">
    <div id="form_container">
        <p class="form-text">Авторизация</p>

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div id="error" style="display: none">
            </div>
            <input type="text" placeholder="Логин / Email" name="email" class="text_input" required/>
            <input type="password" placeholder="Пароль" name="password" class="text_input" required/>
            <button class="submit" name="login" id="login">Войти</button>
            <a class="submit" id="registration" href="registration.php">Регистрация</a>
        </form>
    </div>
</div>
</body>
</html>