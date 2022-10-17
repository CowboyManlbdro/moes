<?php session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Регистрация</title>
    <?php include('link.php') ?>

</head>

<body>
    <nav>
        <?php include('header.php'); ?>
    </nav>
    <?php
    if (isset($_POST['login']) && $_POST['pass'] && $_POST['f'] && $_POST['i'] && $_POST['o'] && $_POST['email'] != '') {
        $l = $_POST['login'];
        if (LoginFree($db, $l)) {
            $pass = $_POST['pass'];
            $p = password_hash($pass, PASSWORD_DEFAULT);
            $hash = md5($l . time());
            $f = $_POST['f'];
            $i = $_POST['i'];
            $o = $_POST['o'];
            $email = $_POST['email'];
            $role = "user";
            $activation = 0;
            addUser($db, $l, $f, $i, $o, $email, $p, $role, $activation);
            session_destroy();
    ?>
            <div id="auth" class="window_bg">
                <div class="window good">
                <img src="img/good.svg" alt="" class="auth_img">
                    <div class="auth_header">Вы успешно зарегистрировались!</div>
                    <button type="button" class="window_btn" onclick="window.location.href='lk.php'">Хорошо
                    </button>
                </div>
            </div>
        <?php
        } else {
            session_destroy(); ?>
            <div id="auth" class="window_bg">
                <div class="window error">
                <img src="img/error.svg" alt="" class="auth_img">
                    <div class="auth_header">Такой логин уже есть!</div>
                    <button type="button" class="window_btn" onclick="window.location.href='index.php#registration'">Хорошо
                    </button>
                </div>
            </div>
        <?php
        }
    } else {
        session_destroy(); ?>
        <div id="auth" class="window_bg">
            <div class="window error">
            <img src="img/error.svg" alt="" class="auth_img">
                <div class="auth_header">Заполните все поля!</div>
                <button type="button" class="window_btn" onclick="window.location.href='index.php#registration'">Хорошо
                </button>
            </div>
        </div>
    <?php }
    ?>

</body>

</html>