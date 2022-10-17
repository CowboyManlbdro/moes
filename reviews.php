<?php session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Отзывы</title>
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
                <li class="menu_item"><a href="help.php" class="menu_link"><div class="menu_descr">Помощь</div><img src="icons/menu/question.svg" alt="">
                        
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
    <?php

    ?>
    <section class="reviews">
        <div class="container">
            <div class="wrap_reviews">
                <? $reviews = getReviews($db);
                    foreach ($reviews as $review) {
                        $user = getUser($db,$review['login']);
                ?>
                <div class="review_item">
                    <img src="<? echo $user['photo'] ?>" alt="" class="photo_user_review">
                    <div class="login_user_review"><? echo $review['login'] ?></div>
                    <div class="text_review"><? echo $review['review'] ?></div>
                </div>

                <? } ?>

               
            </div>
        </div>
    </section>

</body>

</html>