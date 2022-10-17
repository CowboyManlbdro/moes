<?php session_start();
?>
<!DOCTYPE html>
<html>

<head>


    <?php include('link.php') ?>
    <title>Экспонаты</title>
</head>

<body>
    <nav>
        <?php include('header.php'); ?>
    </nav>
    <?

    $hall = $_GET['hall'];
    $hall_info = getHall($db, $hall); ?>

    <section class="exhibits">

        <img src="img/halls/<? echo $hall ?>_bg.svg" alt="" class="bg_hall">
        <img src="img/halls/<? echo $hall ?>_bg.svg" alt="" class="mirror">
        <div class="hall_header"><? echo $hall_info['name'] ?></div>
        <? $id = $_GET['id'];
        $exhibit = getExhibit($db, $id, $hall_info['id_h']);
        $exhibits_id = getIdsExhibits($db, $hall_info['id_h']);
        $exhibit_count = CountExhibitOnHall($db, $hall_info['id_h']); ?>
        <div class="pages">
            <? $i = 1;
            foreach ($exhibits_id as $exhibit_id) {
                if ($id == $exhibit_id['id_exh']) { ?>
                    <div class="pages_item page_<? echo $hall ?> page_active"><a class="page_link" href="exhibits.php?hall=<? echo $hall ?>&id=<? echo $exhibit_id['id_exh'] ?>"><? echo $i ?></a></div>
                <? $i++;
                } else { ?>
                    <div class="pages_item"><a class="page_link" href="exhibits.php?hall=<? echo $hall ?>&id=<? echo $exhibit_id['id_exh'] ?>"><? echo $i ?></a></div>

            <? $i++;
                }
            } ?>


        </div>
        <? if ($exhibit_count['count'] > 0) { ?>
            <div class="exhibit_header"><? echo $exhibit['name'] ?></div>
            <div class="wrap_exhibit">
                <? $prev_exh = getPrevExhibit($db, $id, $hall_info['id_h']);
                $next_exh = getNextExhibit($db, $id, $hall_info['id_h']);
                if (empty($prev_exh)) { ?>
                    <div class="previous"><img src="img/halls/prev_<? echo $hall ?>.svg" alt=""> </div>
                <? } else { ?>
                    <div class="previous"><a href="exhibits.php?hall=<? echo $hall ?>&id=<? echo $prev_exh['id_exh'] ?>"><img src="img/halls/prev_<? echo $hall ?>.svg" alt=""></a> </div>
                <? } ?>
                <div class="exhibit_descr"><? echo $exhibit['description'] ?></div>
                <? if (empty($next_exh)) { ?>
                    <div class="next"> <a href="endhall.php?id=<? echo $hall_info['id_h'] ?>"><img src="img/halls/next_<? echo $hall ?>.svg" alt=""></a> </div>
                <? } else { ?>
                    <div class="next"> <a href="exhibits.php?hall=<? echo $hall ?>&id=<? echo $next_exh['id_exh'] ?>"><img src="img/halls/next_<? echo $hall ?>.svg" alt=""></a> </div>
                <? } ?>
            </div>
            <hr class="exhibit_hr">

            <? $interactive = getInteractiveById($db, $exhibit['id_ia']);
            if ($interactive['type'] == 1) {
            ?>
                <div class="interactive">
                    <div class="interactive_descr"><? echo $interactive['ia_descr'] ?></div>
                    <canvas id="myCanvas" class="canvas" width="380" height="380">
                        Ваш браузер не поддерживает Canvas
                    </canvas>
                    <button id="img" class="action action_<? echo $hall ?>">отправить</button>
                    <? if (!empty($interactive['help'])) { ?>
                        <div class="help">
                            <a href="#" class="help_ia">Подсказка</a>
                        </div>
                    <? } ?>
                </div>
            <? }
            if ($interactive['type'] == 2) {
            ?>
                <div class="interactive">
                    <div class="interactive_descr"><? echo $interactive['ia_descr'] ?></div>
                    <input id="user_answer" type="text" name="user_enter" class="interactive_input">
                    <button id="formula" class="action action_<? echo $hall ?>">отправить</button>
                    <? if (!empty($interactive['help'])) { ?>
                        <div class="help">
                            <a href="#" class="help_ia">Подсказка</a>
                        </div>
                    <? } ?>
                </div>
            <? }
            if ($interactive['type'] == 3) { ?>
                <div class="interactive">
                    <div class="interactive_descr"><? echo $interactive['ia_descr'] ?></div>
                    <input id="user_enter" type="text" name="user_enter" class="interactive_input">
                    <button id="input" class="action action_<? echo $hall ?>">отправить</button>
                    <? if (!empty($interactive['help'])) { ?>
                        <div class="help">
                            <a href="#" class="help_ia">Подсказка</a>
                        </div>
                    <? } ?>
                </div>
            <? }
            if ($interactive['type'] == 4) {
            ?>
                <div class="interactive">
                    <div class="interactive_descr"><? echo $interactive['ia_descr'] ?></div>
                    <canvas id="myCanvas" class="canvas" width="380" height="380">
                        Ваш браузер не поддерживает Canvas
                    </canvas>
                    <input id="user_enter_name" type="text" name="user_enter" class="interactive_input" placeholder="Название">
                    <button id="img" class="action action_<? echo $hall ?>">отправить</button>
                    <? if (!empty($interactive['help'])) { ?>
                        <div class="help">
                            <a href="#" class="help_ia">Подсказка</a>
                        </div>
                    <? } ?>
                </div>
            <? }
            if ($interactive['type'] == 5) { ?>
                <div class="interactive">
                    <div class="interactive_descr"><? echo $interactive['ia_descr'] ?></div>
                    <div class="place_ia">

                    </div>
                </div>
            <? } ?>
        <? } else { ?>
            <div class="exhibit_header">Пока экспонаты не завезли</div>
        <? } ?>

        <div id="auth" class="window_bg">
            <div class="window good">
                <img src="img/good.svg" alt="" class="auth_img">
                <div class="auth_header">Ответ отправлен!</div>
                <button type="button" id="close_win" class="window_btn">Хорошо
                </button>
            </div>
        </div>

        <div id="right" class="window_bg">
            <div class="window good">
                <img src="img/good.svg" alt="" class="auth_img">
                <div class="auth_header">Молодец! Это правильный ответ!</div>
                <button type="button" id="close_win_good" class="window_btn">Хорошо
                </button>
            </div>
        </div>

        <div id="not_right" class="window_bg">
            <div class="window error">
                <img src="img/error.svg" alt="" class="auth_img">
                <div class="auth_header">Хорошая попытка! Но это не правильный ответ!</div>
                <button type="button" id="close_win_error" class="window_btn">Хорошо
                </button>
            </div>
        </div>

        <div id="help" class="window_bg">
            <div class="window help_window">
                <div class="help_header">Подсказка</div>
                <div class="help_descr"><? echo $interactive['help'] ?></div>
                <a href="#" class="close"><img src="icons/close.svg" alt=""></a>
            </div>
        </div>



        <div class="achieve_window">
            <div class="new_achive"> Новое достижение! </div>
            <? $achieve = getAchieveById($db, $interactive['id_ach']); ?>
            <div class="achieve_item achieve_bg">
                <div class="achieve_logo">
                    <img src="<? echo $achieve['logo'] ?>" alt="" class="achieve_img">
                </div>
                <div class="achieve_info">
                    <div class="achieve_name"><? echo $achieve['name'] ?></div>
                    <div class="achieve_descr"><? echo $achieve['description'] ?></div>
                </div>
            </div>
        </div>

    </section>



    <script>
        var test = <? echo $interactive['type'] ?>;
        if (test == 5) {
            $('.place_ia').load('interactives.html #<? echo $interactive['extra'] ?>');
        };
    </script>

    <script src="js/script_ia.js"></script>


    <script>
        $("#img").click(function(e) {
            e.preventDefault();
            var canvas = document.getElementById("myCanvas");
            var dataURL = canvas.toDataURL();
            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: {
                    type: 1,
                    img: dataURL,
                    login: "<?php echo $_SESSION['login'] ?>",
                    id: <?php echo $id ?>,
                    id_ach: <?php echo $interactive['id_ach'] ?>,
                },
            }).done(function(o) {
                have_ach = JSON.parse(o);
                $("#auth").fadeIn(200);
                $('html, body').animate({
                    scrollTop: $("#auth").offset().top // класс объекта к которому приезжаем
                }, 500);
                if (have_ach[1] == 0) {
                    $(".achieve_window").delay(1000).slideToggle(500).delay(5000).slideToggle(500);
                }
            });
        });

        $("#formula").click(function(e) {
            e.preventDefault();
            let f = new Function('x', 'return <? echo $interactive['extra'] ?>');
            $user_answer = $("#user_answer").val();
            var result = f($user_answer);
            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: {
                    type: 2,
                    res: result,
                    login: "<?php echo $_SESSION['login'] ?>",
                    id: <?php echo $id ?>,
                    id_ach: <?php echo $interactive['id_ach'] ?>,
                },
            }).done(function(o) {
                have_ach = JSON.parse(o);
                $("#auth").fadeIn(200);
                $('html, body').animate({
                    scrollTop: $("#auth").offset().top // класс объекта к которому приезжаем
                }, 500);
                if (have_ach[1] == 0) {
                    $(".achieve_window").delay(1000).slideToggle(500).delay(5000).slideToggle(500);
                }
            });
        });

        $("#input").click(function(e) {
            e.preventDefault();
            $user_answer = $("#user_enter").val();
            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: {
                    type: 3,
                    ua: $user_answer,
                    login: "<?php echo $_SESSION['login'] ?>",
                    id: <?php echo $id ?>,
                    id_ach: <?php echo $interactive['id_ach'] ?>,
                },
            }).done(function(o) {
                have_ach = JSON.parse(o);
                $("#auth").fadeIn(200);
                $('html, body').animate({
                    scrollTop: $("#auth").offset().top // класс объекта к которому приезжаем
                }, 500);
                if (have_ach[1] == 0) {
                    $(".achieve_window").delay(1000).slideToggle(500).delay(5000).slideToggle(500);
                }
            });
        });
    </script>

    <script>
        $("#open_ineractive").click(function(e) {
            e.preventDefault();
            $(".interactive").slideToggle("slow");
            $('html, body').animate({
                scrollTop: $(".interactive").offset().top // класс объекта к которому приезжаем
            }, 1000);
        });

        $("#close_win").click(function(e) {
            e.preventDefault();
            $("#auth").fadeOut(400);
        });

        $("#close_win_good").click(function(e) {
            e.preventDefault();
            $("#right").fadeOut(400);
        });

        $("#close_win_error").click(function(e) {
            e.preventDefault();
            $("#not_right").fadeOut(400);
        });

        $(".help_ia").click(function(e) {
            e.preventDefault();
            $("#help").fadeIn(200);
            $('html, body').animate({
                scrollTop: $("#help").offset().top // класс объекта к которому приезжаем
            }, 500);
        });

        $(".close").click(function(e) {
            e.preventDefault();
            $(".window_bg").fadeOut(400);
        });
    </script>

    <script>
        var canvas = document.getElementById("myCanvas"),
            context = canvas.getContext("2d"),
            w = canvas.width,
            h = canvas.height;

        var mouse = {
            x: 0,
            y: 0
        };
        var draw = false;

        canvas.addEventListener("mousedown", function(e) {
            mouse.x = e.pageX - this.offsetLeft;
            mouse.y = e.pageY - this.offsetTop;
            draw = true;
            context.beginPath();
            context.moveTo(mouse.x, mouse.y);
        });
        canvas.addEventListener("mousemove", function(e) {
            if (draw == true) {
                mouse.x = e.pageX - this.offsetLeft;
                mouse.y = e.pageY - this.offsetTop;
                context.lineTo(mouse.x, mouse.y);
                context.stroke();
            }
        });
        canvas.addEventListener("mouseup", function(e) {
            mouse.x = e.pageX - this.offsetLeft;
            mouse.y = e.pageY - this.offsetTop;
            context.lineTo(mouse.x, mouse.y);
            context.stroke();
            context.closePath();
            draw = false;
        });
    </script>
</body>

</html>