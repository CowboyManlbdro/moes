<?php session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>О Музее</title>
    <?php include('link.php') ?>

</head>

<body>
    <nav>
        <?php
        if (!empty($_SESSION['login'])) {
            include('header.php');
        } else { ?>
            <?php include 'bdconnect.php';
            include 'request.php';
            ?>
            <div class="logo">
                <img src="img/logo.svg" alt="">
            </div>
            <div class="menu">
                <ul>
                    <li class="menu_item"><a href="help.php" class="menu_link">
                            <div class="menu_descr">Помощь</div><img src="icons/menu/question.svg" alt="">
                        </a></li>
                    <li class="menu_item"><a href="reviews.php" class="menu_link">
                            <div class="menu_descr">Отзывы</div><img src="icons/menu/like-dislike.svg" alt="">
                        </a></li>
                    <li class="menu_item"><a href="about.php" class="menu_link">
                            <div class="menu_descr">О Музее</div><img style="margin-bottom: 3px;" src="icons/menu/info.svg" alt="">
                        </a></li>
                    <li class="menu_item"><a href="index.php" class="menu_link">
                            <div class="menu_descr">На главную</div><img src="icons/menu/exit.svg" alt="">
                        </a></li>
                </ul>
            </div>
            <div class="line"></div>
        <? } ?>
    </nav>
    <section class="about">
        <div class="container">
            <div class="about_text">Музей занимательных наук был создан для развития интереса у детей и взрослых к разным наукам. Полезная информация подается в виде фактов и вопросов в развлекательной и игровой форме.
                <br>
                <br>
                Внутри нашего музея вы найдёте много всего интересного и познавательного, красивые картинки и изображения, интересные и захватывающие факты, а так же занимательные вопросы и достижения! Удачи!
            </div>
        </div>
        <img src="img/spaceman.svg" class="about_img" alt="">
    </section>


</body>

</html>