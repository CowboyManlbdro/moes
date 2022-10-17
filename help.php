<?php session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Помощь</title>
    <?php include('link.php') ?>

</head>

<body>
    <nav>
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
    </nav>
    <section class="about">
        <div class="container">
            <div class="about_text">
                <span>Как войти?</span>
                <br>
                <br>
                Для того чтобы погулять по нашему музею вам необходимо войти или зарегистрироваться. Для этого нажмите на главном экране на синюю кнопку <b>“Войти”</b>.
                <br>
                Если у вас уже есть профиль, то введите логин и пароль и нажмите кнопку <b>“Войти”</b>.
                <br>
                Если у вас нет профиля в нашем музее, то после нажатия на копку <b>“Войти”</b>, нажмите на кнопку <b>“Зарегистрироваться”</b>, появиться новое окошко для регистрации, заполните все поля и нажмите на кнопку <b>“Сохранить”</b> и добро пожаловать!
                <br>

            </div>
        </div>
        <img src="img/spaceman.svg" class="about_img" alt="">
    </section>


</body>

</html>