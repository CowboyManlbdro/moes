<?php session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Авторизация</title>
    <?php include('link.php') ?>

</head>

<body>
    <nav>
        <?php include('header.php'); ?>
    </nav>
    <?php
    if (!empty($_POST)) {
        if ($_POST['login'] != '' && $_POST['pass'] != '') {
            $login = trim(strip_tags($_POST['login']));
            $password = trim(strip_tags($_POST['pass']));
            $user = getUser($db, $login);
            if (password_verify($password, $user['password'])) {
                $_SESSION['role'] = $user['role'];
                // $_SESSION['f'] = $user['f'];
                // $_SESSION['i'] = $user['i'];
                // $_SESSION['o'] = $user['o'];
                // $_SESSION['act'] = $user['activation'];
                // $_SESSION['email'] = $user['email'];
                $_SESSION['login'] = $user['login'];
    ?>
                <div id="auth" class="window_bg">
                    <div class="window good">
                    <img src="img/good.svg" alt="" class="auth_img">
                    <div class="auth_header">Вы успешно вошли!</div>
                        <button type="button" class="window_btn" onclick="window.location.href='lk.php'">Хорошо
                        </button>
                    </div>
                </div>

            <?php
            } else {
            ?>
                <div id="auth" class="window_bg">
                    <div class="window error">
                    <img src="img/error.svg" alt="" class="auth_img">
                    <div class="auth_header">Неправильно введен логин или пароль!</div>
                        <button type="button" class="window_btn" onclick="window.location.href='index.php#auth'">
                        Хорошо
                        </button>
                    </div>
                </div>
            <?php
            }
        } else {
            ?>
            <div id="auth" class="window_bg">
                <div class="window error">
                <img src="img/error.svg" alt="" class="auth_img">
                <div class="auth_header">Заполните все поля!</div>
                    <button type="button" class="window_btn" onclick="window.location.href='index.php#auth'">
                    Хорошо
                    </button>
                </div>
            </div>
    <?php
        }
    }

    ?>

</body>

</html>