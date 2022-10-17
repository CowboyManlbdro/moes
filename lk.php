<?php session_start();
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <?php include('link.php'); ?>
</head>

<body>
    <nav>
        <?php include('header.php'); ?>
    </nav>
    <section class="lk">
        <img src="img/lk_bg_left.svg" alt="" class="lk_bg_left">
        <img src="img/lk_bg_right.svg" alt="" class="lk_bg_right">
        <div class="container">
            <div class="wrapper">
                <aside>
                    <ul>
                        <li class="lk_nav"><a href="#" id="nl1" class="lk_nav_link">Профиль <img id="nl1_img" src="icons/lk/person.svg" alt="" class="img_link"> </a></li>
                        <li class="lk_nav"><a href="#" id="nl3" class="lk_nav_link">Награды <img id="nl3_img" src="icons/lk/award.svg" alt="" class="img_link"></a></li>
                        <li class="lk_nav"><a href="#" id="nl4" class="lk_nav_link">Достижения <img id="nl4_img" src="icons/lk/check.svg" alt="" class="img_link"></a></li>
                        <li class="lk_nav exit"><a href="halls.php" id="nl2" class="lk_nav_link">Залы <img id="nl2_img" src="icons/lk/halls.svg" alt="" class="img_link"></a></li>
                        <li class="lk_nav"><a href="logout.php#auth" class="lk_nav_link_exit">Выход</a></li>
                    </ul>
                </aside>
                <div class="content">
                    <? $user = getUser($db, $_SESSION['login']); ?>
                    <div class="profile" id="content_nl1">

                        <div class="photo">
                            <? if ($user['photo'] == "no") { ?>
                            <? } else { ?>
                                <img class="photo_profile" src="<? echo $user['photo'] ?>" alt="">
                            <? } ?>
                        </div>
                        <a href="#" class="change_photo">+ Изменить фото</a>
                        <div class="achieve_header"><? echo $user['login'] ?></div>
                        <div class="wrap">
                            <label for="fio" class="label_input"><img src="icons/input/login.svg" alt=""></label>
                            <input name="fio" type="text" class="input" disabled value="<? echo $user['f'] . " " . $user['i'] . " " . $user['o'] ?>">
                            <label for="fio"><a class="edit" id="fio" href="#"><img src="icons/input/text.svg" alt=""></a></label>
                        </div>
                        <div class="edit_fio">
                            <div class="wrap">
                                <label for="f" class="label_input"><img src="icons/input/login.svg" alt=""></label>
                                <input name="f" type="text" class="input" disabled value="<? echo $user['f'] ?>">
                            </div>
                            <div class="wrap">
                                <label for="i" class="label_input"><img src="icons/input/login.svg" alt=""></label>
                                <input name="i" type="text" class="input" disabled value="<? echo $user['i'] ?>">
                            </div>
                            <div class="wrap">
                                <label for="o" class="label_input"><img src="icons/input/login.svg" alt=""></label>
                                <input name="o" type="text" class="input" disabled value="<? echo $user['o'] ?>">
                            </div>
                        </div>
                        <div class="wrap">
                            <label for="email" class="label_input"><img src="icons/input/mail.svg" alt=""></label>
                            <input name="email" type="text" class="input" disabled value="<? echo $user['email'] ?>">
                            <label for="email"><a class="edit" id="email" href="#"><img src="icons/input/text.svg" alt=""></a></label>
                        </div>
                        <button id="save_info" class="save_btn">Сохранить</button>
                        <a href="#" class="edit_pass">Изменить пароль</a>
                        <div class="password_change">
                            <div class="wrap">
                                <label for="old_pass" class="label_input"><img src="icons/input/password.svg" alt=""></label>
                                <input name="old_pass" type="password" class="input" placeholder="Введите старый пароль">
                            </div>
                            <div class="wrap">
                                <label for="new_pass" class="label_input"><img src="icons/input/password.svg" alt=""></label>
                                <input name="new_pass" type="password" class="input" placeholder="Введите новый пароль">
                            </div>
                            <button id="save_pass" class="save_btn">Сохранить</button>
                        </div>
                    </div>

                    <div class="awards" id="content_nl3">
                        <? $user_awards = getUserAwards($db,$_SESSION['login']);
                        foreach ($user_awards as $user_award) {
                            $award = getLevelsAndCupAwardById($db,$user_award['id_award']);
                            $img = getImgAwardByLevel($db,$user_award['level'],$user_award['id_award']);
                        ?>
                        <div class="ai">
                            <div class="awards_item">
                                <img src="<? echo $img['image'] ?>" alt="" class="awards_img">
                                <? if ($user_award['level'] == $award['levels']) {?>
                                <img src="<? echo $award['cup'] ?>" alt="" class="cup_award">
                                <? } ?>
                            </div>
                            <div class="award_level">
                                Пройдено <? echo $user_award['level'] ?> из <? echo $award['levels'] ?>
                            </div>
                        </div>
                        <? } ?>
                    </div>

                    <div class="achieve" id="content_nl4">
                        <? $count_achieve = CountAchieve($db);
                        $user_achieves = getUserAchieves($db, $_SESSION['login']);
                        ?>
                        <div class="progress">
                            <div class="received">
                                <img class="received_bg" src="img/line.svg" alt="">
                            </div>
                            <div class="unreceived"></div>
                        </div>
                        <div class="progress_info">получено <? echo count($user_achieves) ?> из 19 </div>
                        <!-- <? echo $count_achieve['count'] ?> -->
                        <div class="achieve_header">Мои достижения</div>
                        <div class="achieves">
                            <? foreach ($user_achieves as $user_achieve) {
                                $achieve = getAchieveById($db, $user_achieve['id_ach']);
                            ?>
                                    <div class="achieve_item">
                                        <div class="achieve_logo">
                                            <img src="<? echo $achieve['logo'] ?>" alt="" class="achieve_img">
                                        </div>
                                        <div class="achieve_info">
                                            <div class="achieve_name"><? echo $achieve['name'] ?></div>
                                            <div class="achieve_descr"><? echo $achieve['description'] ?></div>
                                        </div>
                                    </div>
                            <? 
                            } ?>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $("#save_info").click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: "update_profile.php",
                data: ({
                    login: '<? echo $_SESSION['login'] ?>',
                    f: $('input[name="f"]').val(),
                    i: $('input[name="i"]').val(),
                    o: $('input[name="o"]').val(),
                    email: $('input[name="email"]').val()
                }),
                success: function() {
                    location.reload();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var rec = <? echo count($user_achieves) ?>;
            var all = 19;
            // var all = <? echo $count_achieve['count'] ?>;
            var recprocent = (rec / all) * 100;
            var unrecprocent = 100 - recprocent;
            $('.unreceived').css({
                "width": unrecprocent + "%"
            });
            $('.received').css({
                "width": recprocent + "%"
            });
        });
    </script>

    <script>
        var i = "nl1";
        $(".lk_nav_link").click(function(e) {
            e.preventDefault();
            $("#" + i + "_img").removeClass('img_link_active');
            var navId = this.id;
            $("#" + navId + "_img").addClass('img_link_active');
            $("#content_" + i).slideToggle("slow");
            i = navId;
            $("#content_" + navId).slideToggle("slow");
        });
    </script>

    <script>
        $(".edit_pass").click(function(e) {
            e.preventDefault();
            $(".password_change").slideToggle("slow");
            $('html, body').animate({
                scrollTop: $(".password_change").offset().top // класс объекта к которому приезжаем
            }, 1000);
        });


        $("input").focus(function(e) {
            e.preventDefault();
            var val = this.value;
            this.value = '';
            this.value = val;
        });

        $("#log").click(function(e) {
            e.preventDefault();
            $('input[name="login"]').removeAttr('disabled');
            $('input[name="login"]').focus();
        });

        $("#fio").click(function(e) {
            e.preventDefault();
            $(".edit_fio").slideToggle("slow");
            $('html, body').animate({
                scrollTop: $(".edit_fio").offset().top // класс объекта к которому приезжаем
            }, 1000);
            $('.edit_fio input').removeAttr('disabled');
        });



        $("#email").click(function(e) {
            e.preventDefault();
            $('input[name="email"]').removeAttr('disabled');
            $('input[name="email"]').focus();

        });
    </script>
</body>

</html>