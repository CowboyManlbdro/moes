<?php session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Залы</title>
    <?php include('link.php') ?>

</head>

<body>
    <nav>
        <?php include('header.php'); ?>
    </nav>

    <section class="halls">
        <? $firstMath = getIdFirstExhibit($db, 1);
        $firstAstro = getIdFirstExhibit($db, 4);
        $firstBio = getIdFirstExhibit($db, 3);
        $firstPhy = getIdFirstExhibit($db, 2);
        $firstHistory = getIdFirstExhibit($db, 5);
        ?>
        <div class="halls_wrap">
            <a class="hall_item physics" href="exhibits.php?hall=physics&id=<? echo $firstPhy['id_exh'] ?>">
                <div class="phy_bg"><img src="img/halls/physics.svg" alt=""></div>
                <img src="img/halls/mounth.svg" class="mounth" alt="">
            </a>
            <a class="hall_item bio" href="exhibits.php?hall=biology&id=<? echo $firstBio['id_exh'] ?>"></a>
        </div>
        <div class="halls_wrap">
            <a class="hall_item math" href="exhibits.php?hall=math&id=<? echo $firstMath['id_exh'] ?>"></a>
        </div>
        <div class="halls_wrap">
            <a class="hall_item astronomy" href="exhibits.php?hall=astronomy&id=<? echo $firstAstro['id_exh'] ?>">
                <div class="astr_bg"><img src="img/halls/astronomy.svg" alt=""></div>
                <img src="img/halls/ufo.svg" class="ufo" alt="">
            </a>
            <a class="hall_item history" href="exhibits.php?hall=history&id=<? echo $firstHistory['id_exh'] ?>"></a>
        </div>

    </section>

</body>

</html>