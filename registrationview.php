<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/tcal.css"/>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/registrationstyle.css">
    <link rel="stylesheet" href="css/tooltipstyle.css">
    <script type="text/javascript" src="js/tcal.js"></script>
    <script type="text/javascript" src="js/jquery-3.0.0.min.js"></script>
    <script type="text/javascript" src="js/js.js"></script>
</head>
<body>
<div class="container" id="container">
    <p class="form-text" id="header_registration">Регистрация</p>
    <div id="error" style="display: none"></div>
    <form class="registration-form" method="POST" enctype="multipart/form-data"
          action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div>
            <label class="label-text">Имя</label>
            <input type="text" class="text_input" placeholder="Иван" name="name" value="<?= $_POST['name'] ?>" required>
        </div>
        <div>
            <label class="label-text">Фамилия</label>
            <input type="text" class="text_input" placeholder="Иванов" name="surname" value="<?= $_POST['surname'] ?>"
                   required>
        </div>
        <div>
            <label class="label-text">Логин</label>
            <input type="text" class="text_input" placeholder="IvanIvanov" name="login" value="<?= $_POST['login'] ?>"
                   required><a class="help" href="#"><img src="img/tooltip.png" alt="подсказка"/><span class="airhelp">Логин может содержать только латинские буквы и арабские цифры. Допустимая длина логина от 8 до 20 символов.</span></a>
        </div>
        <div>
            <label class="label-text">Пол</label>
            <label class="label-text radio-input">М<input type="radio" name="gender" value="male" checked></label>
            <label class="label-text radio-input">Ж<input type="radio" name="gender" value="female"></label>
        </div>
        <div>
            <label class="label-text">Дата рождения</label>
            <input type="text" class="tcal text_input" name="birth" value="<?= $_POST['birth'] ?>" required><a
                    class="help" href="#"><img src="img/tooltip.png" alt="подсказка"/><span class="airhelp">Обратите внимание, что на сайте могут регистрироваться только лица старше 18 лет</span></a>
        </div>
        <div>
            <label class="label-text">Email</label>
            <input type="email" class="text_input" placeholder="IvanIvanov@mail.ru" name="email"
                   value="<?= $_POST['email'] ?>" required>
        </div>
        <div>
            <label class="label-text">Пароль</label>
            <input type="password" class="text_input" name="password" value="<?= $_POST['password'] ?>" required><a
                    class="help" href="#"><img src="img/tooltip.png" alt="подсказка"/><span class="airhelp">Пароль может содержать только латинские буквы и арабские цифры. Пароль должен содержать хотя бы одну цифру, одну букву в верхнем регистре и одну букву в нижнем регистре. Допустимая длина пароля от 8 до 50 символов.</span></a>
        </div>
        <div class="confirmpassword">
            <label class="label-text">Подтверждение пароля</label>
            <input type="password" class="text_input" name="confirmpassword" value="<?= $_POST['confirmpassword'] ?>"
                   required>
        </div>
        <div>
            <label class="label-text">Фото</label>
            <input name="userfile" type="file" id="inputFile" accept="image/*"/>
        </div>
        <div>
            <img id="image_upload_preview" src="upload/no_photo.png" alt="your image"/>
        </div>
        <div>
            <button class="submit" name="register" id="registration">Зарегистрироваться</button>
            <a href="index.php" id="login">Авторизироваться</a>
        </div>
    </form>
</div>
</body>
</html>