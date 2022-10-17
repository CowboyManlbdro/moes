<?php session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Конец зала</title>
    <?php include('link.php') ?>

</head>

<body>
    <nav>
        <?php include('header.php'); ?>
    </nav>
    <?php
    $id = $_GET['id'];
    $hall_info = getHallById($db, $id);
    ?>
    <section class="end_hall">
        <div class="container">
            <div class="hall_header"><? echo $hall_info['name'] ?></div>
            <div class="wrap_end">
                <div class="end_header">Мои ответы</div>
                <div class="answers">
                    <?
                    $exhibits = getExhibitsByHall($db, $id);

                    foreach ($exhibits as $exhibit) {
                        $interactive = getInteractiveById($db, $exhibit['id_ia']);

                        if ($interactive['type'] != 5) {
                            $answer_user = getUserAnswerOnExhibit($db, $_SESSION['login'], $exhibit['id_exh']);
                            if ($answer_user['type'] == 1) { ?>
                                <div class="answer_item">
                                    <div class="name_exhibit"><? echo $exhibit['name'] ?></div>
                                    <div class="img_answer"><img src="<? echo $answer_user['answer'] ?>" alt=""></div>
                                </div>
                            <? } else { ?>
                                <div class="answer_item">
                                    <div class="name_exhibit"><? echo $exhibit['name'] ?></div>
                                    <div class="block_answer">
                                        <div class="ans"><? echo $answer_user['answer'] ?></div>
                                    </div>
                                </div>
                    <? }
                        }
                    }

                    ?>
                </div>
            </div>
            <div class="end_header">Ответы других пользователей:</div>
            <?
            $first_exhibit = getIdFirstExhibit($db, $id);
            $users = getUsersAnswerOnExhibit($db, $first_exhibit['id_exh'], $_SESSION['login']);
            foreach ($users as $user) { ?>
                <div class="wrap_end">
                    <div class="end_header"><? echo $user['login'] ?></div>
                    <div class="answers">
                        <?

                        foreach ($exhibits as $exhibit) {
                            $interactive = getInteractiveById($db, $exhibit['id_ia']);

                            if ($interactive['type'] != 5) {
                                $answer_user = getUserAnswerOnExhibit($db, $user['login'], $exhibit['id_exh']);
                                if ($answer_user['type'] == 1) { ?>
                                    <div class="answer_item">
                                        <div class="name_exhibit"><? echo $exhibit['name'] ?></div>
                                        <div class="img_answer"><img src="<? echo $answer_user['answer'] ?>" alt=""></div>
                                        <div class="likes">
                                            <div class="like"><img class="l" id="like" src="img/likes/like.svg" alt=""></div>
                                            <div class="dislike"><img class="dl" id="dislike" src="img/likes/dislike.svg" alt=""></div>
                                        </div>
                                    </div>
                                <? } else { ?>
                                    <div class="answer_item">
                                        <div class="name_exhibit"><? echo $exhibit['name'] ?></div>
                                        <div class="block_answer">
                                            <div class="ans"><? echo $answer_user['answer'] ?></div>
                                        </div>
                                        <div class="likes">
                                            <div class="like"><img class="l" id="like" src="img/likes/like.svg" alt=""></div>
                                            <div class="dislike"><img class="dl" id="dislike" src="img/likes/dislike.svg" alt=""></div>
                                        </div>
                                    </div>
                        <? }
                            }
                        }
                        ?>
                    </div>
                </div>

            <?
            }
            ?>



        </div>
    </section>


    <script>
        $(".l").click(function(e) {
            e.preventDefault();
            if ($(this).attr('src') == "img/likes/like.svg") {
                $(this).attr("src", "img/likes/like_active.svg");
            } else {
                $(this).attr("src", "img/likes/like.svg");
            }
        });

        $(".dl").click(function(e) {
            e.preventDefault();
            if ($(this).attr('src') == "img/likes/dislike.svg") {
                $(this).attr("src", "img/likes/dislike_active.svg");
            } else {
                $(this).attr("src", "img/likes/dislike.svg");
            }
        });
    </script>

</body>

</html>