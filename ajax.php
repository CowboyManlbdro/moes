<?php
	include 'bdconnect.php';
	include 'request.php';

    if ($_POST['type'] == 1){
        define('UPLOAD_DIR', 'img/answerUsers/');
        $img = $_POST['img'];
        $l = $_POST['login'];
        $id = $_POST['id'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = UPLOAD_DIR . $l .'exhibit'. $id .'.png';
        addAnswerOnExhibit($db,$id,$l,$file,0,1);
        $success = file_put_contents($file, $data);
        // print $success ? $file : 'Unable to save the file.';
        $id_ach = $_POST['id_ach'];
        if (AchieveHave($db,$l,$id_ach)){
            $HaveAchive = 1;
        }
        else {
            $HaveAchive = 0;
            addUserAchieve($db,$l,$id_ach);
        }
        echo json_encode(array("1" => $HaveAchive));
    }

    if ($_POST['type'] == 2){
        $result = $_POST['res'];
        $l = $_POST['login'];
        $id = $_POST['id'];
        addAnswerOnExhibit($db,$id,$l,$result,0,2);
        $id_ach = $_POST['id_ach'];
        if (AchieveHave($db,$l,$id_ach)){
            $HaveAchive = 1;
        }
        else {
            $HaveAchive = 0;
            addUserAchieve($db,$l,$id_ach);
        }
        echo json_encode(array("1" => $HaveAchive));
    }

    if ($_POST['type'] == 3){
        $user_answer = $_POST['ua'];
        $l = $_POST['login'];
        $id = $_POST['id'];
        addAnswerOnExhibit($db,$id,$l,$user_answer,0,3);
        $id_ach = $_POST['id_ach'];
        if (AchieveHave($db,$l,$id_ach)){
            $HaveAchive = 1;
        }
        else {
            $HaveAchive = 0;
            addUserAchieve($db,$l,$id_ach);
        }
        echo json_encode(array("1" => $HaveAchive));
    }
?>