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
        session_destroy();
    ?>
                <div id="auth" class="window_bg">
                    <div class="window good">
                    <img src="img/good.svg" alt="" class="auth_img">
                    <div class="auth_header">Вы успешно вышли из аккаунта!</div>
                        <button type="button" class="window_btn" onclick="window.location.href='index.php'">Хорошо
                        </button>
                    </div>
                </div>

</body>

</html>