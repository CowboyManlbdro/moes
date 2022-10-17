<?php

function addUser ($db, $l, $f, $i, $o, $email, $pass, $role, $act){
	$sql= "INSERT INTO users (login,f,i,o,email,password,role,activation) VALUES(:login,:f,:i,:o,:email,:password,:role,:activation)
	";

	$stmt=$db->prepare($sql);
	$stmt->bindValue(':login',$l,PDO::PARAM_STR);
	// $stmt->bindValue(':hash',$h,PDO::PARAM_STR);
	$stmt->bindValue(':f',$f,PDO::PARAM_STR);
	$stmt->bindValue(':i',$i,PDO::PARAM_STR);
	$stmt->bindValue(':o',$o,PDO::PARAM_STR);
    $stmt->bindValue(':email',$email,PDO::PARAM_STR);
    $stmt->bindValue(':password',$pass,PDO::PARAM_STR);
	$stmt->bindValue(':role',$role,PDO::PARAM_STR);
	$stmt->bindValue(':activation',$act,PDO::PARAM_INT);

	$stmt->execute();
}


function CountAchieve ($db) {
	$sql = "SELECT COUNT(*) as count FROM achievements";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row;
}


function CountExhibitOnHall ($db, $idh) {
	$sql = "SELECT COUNT(*) as count FROM exhibits
	WHERE id_h='$idh'";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row;
}

function UserUpdate ($db, $l, $f, $i, $o,$mail){
	$sql= "UPDATE users SET f=:f, i=:i, o=:o, email=:email
		WHERE login=:login 
		";
	
		$stmt=$db->prepare($sql);
		$stmt->bindValue(':login',$l,PDO::PARAM_STR);
		$stmt->bindValue (':email',$mail, PDO::PARAM_STR);
		$stmt->bindValue(':f',$f,PDO::PARAM_STR);
		$stmt->bindValue(':i',$i,PDO::PARAM_STR);
		$stmt->bindValue(':o',$o,PDO::PARAM_STR);
		$stmt->execute();
	}

function addAnswerOnExhibit ($db, $id, $l, $ans, $r, $type){
	$sql= "INSERT INTO answer_on_exhibits (id_exh,login,answer,raiting,type) VALUES(:id_exh,:login,:answer,:raiting,:type)
	";

	$stmt=$db->prepare($sql);
	$stmt->bindValue(':id_exh',$id,PDO::PARAM_INT);
	$stmt->bindValue(':login',$l,PDO::PARAM_STR);
	$stmt->bindValue(':answer',$ans,PDO::PARAM_STR);
	$stmt->bindValue(':raiting',$r,PDO::PARAM_INT);
	$stmt->bindValue(':type',$type,PDO::PARAM_INT);
	$stmt->execute();
}

function addUserAchieve($db, $l, $id){
	$sql= "INSERT INTO user_achieve (login,id_ach) VALUES(:login,:id_ach)
	";

	$stmt=$db->prepare($sql);
	$stmt->bindValue(':login',$l,PDO::PARAM_STR);
	$stmt->bindValue(':id_ach',$id,PDO::PARAM_INT);
	$stmt->execute();
}

function getUser ($db,$login) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT * FROM users
	WHERE login='$login'
	";
	$stmt= $db->prepare($sql);

	$res=$stmt->execute();

	$row=$stmt->fetch(PDO::FETCH_ASSOC); 

	 	$result=$row;


	 return $result;
}

function getHall ($db,$t) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT * FROM halls
	WHERE title='$t'
	";
	$stmt= $db->prepare($sql);

	$res=$stmt->execute();

	$row=$stmt->fetch(PDO::FETCH_ASSOC); 

	 	$result=$row;


	 return $result;
}

function getHallById ($db,$id) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT * FROM halls
	WHERE id_h='$id'
	";
	$stmt= $db->prepare($sql);

	$res=$stmt->execute();

	$row=$stmt->fetch(PDO::FETCH_ASSOC); 

	 	$result=$row;


	 return $result;
}

function getExhibit ($db,$id,$idh) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT * FROM exhibits
	WHERE id_exh='$id' AND id_h='$idh'
	";
	$stmt= $db->prepare($sql);

	$res=$stmt->execute();

	$row=$stmt->fetch(PDO::FETCH_ASSOC); 

	 	$result=$row;


	 return $result;
}

function getIdFirstExhibit ($db,$idh) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT id_exh FROM exhibits
	WHERE id_h='$idh' LIMIT 1
	";
	$stmt= $db->prepare($sql);

	$res=$stmt->execute();

	$row=$stmt->fetch(PDO::FETCH_ASSOC); 

	 	$result=$row;


	 return $result;
}

function getPrevExhibit ($db,$id,$idh) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT id_exh FROM exhibits
	WHERE id_exh<'$id' AND id_h='$idh' ORDER BY id_exh DESC LIMIT 1
	";
	$stmt= $db->prepare($sql);

	$res=$stmt->execute();

	$row=$stmt->fetch(PDO::FETCH_ASSOC); 

	 	$result=$row;


	 return $result;
}

function getNextExhibit ($db,$id,$idh) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT id_exh FROM exhibits
	WHERE id_exh>'$id' AND id_h='$idh' LIMIT 1
	";
	$stmt= $db->prepare($sql);

	$res=$stmt->execute();

	$row=$stmt->fetch(PDO::FETCH_ASSOC); 

	 	$result=$row;


	 return $result;
}

function getInteractiveById ($db,$id) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT * FROM interactives
	WHERE id_ia='$id'
	";
	$stmt= $db->prepare($sql);

	$res=$stmt->execute();

	$row=$stmt->fetch(PDO::FETCH_ASSOC); 

	 	$result=$row;


	 return $result;
}

function getUserAnswerOnExhibit ($db,$login,$id) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT * FROM answer_on_exhibits
	WHERE login='$login' AND id_exh='$id'
	";
	$stmt= $db->prepare($sql);

	$res=$stmt->execute();

	$row=$stmt->fetch(PDO::FETCH_ASSOC); 

	 	$result=$row;


	 return $result;
}

function getIdsExhibits ($db,$idh) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT id_exh FROM exhibits
	WHERE id_h='$idh'
	";
	$result=array();
	$stmt = $db->prepare($sql);
	$stmt->execute();
	while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
	 	$result[$row['id_exh']]=$row;
	 }
	 return $result;
}

function getUserAwards ($db,$login) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT id_award,level FROM users_awards
	WHERE login='$login'
	";
	$result=array();
	$stmt = $db->prepare($sql);
	$stmt->execute();
	while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
	 	$result[$row['id_award']]=$row;
	 }
	 return $result;
}

function getLevelsAndCupAwardById ($db,$id) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT levels,cup FROM awards
	WHERE id_award='$id'
	";
	$stmt= $db->prepare($sql);

	$res=$stmt->execute();

	$row=$stmt->fetch(PDO::FETCH_ASSOC); 

	 	$result=$row;


	 return $result;
}

function getImgAwardByLevel ($db,$level,$id) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT image FROM levels_awards
	WHERE id_award='$id' AND level = '$level'
	";
	$stmt= $db->prepare($sql);

	$res=$stmt->execute();

	$row=$stmt->fetch(PDO::FETCH_ASSOC); 

	 	$result=$row;


	 return $result;
}

function getUserAchieves ($db,$login) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT id_ach FROM user_achieve
	WHERE login='$login'
	";
	$result=array();
	$stmt = $db->prepare($sql);
	$stmt->execute();
	while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
	 	$result[$row['id_ach']]=$row;
	 }
	 return $result;
}

function getUsersAnswerOnExhibit ($db,$id,$login) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT login FROM answer_on_exhibits
	WHERE id_exh=:id_exh AND login!=:login
	";
	$result=array();
	$stmt = $db->prepare($sql);
	$stmt->bindValue ('id_exh',$id, PDO::PARAM_INT);
	$stmt->bindValue ('login',$login, PDO::PARAM_STR);
	$stmt->execute();
	while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
	 	$result[$row['login']]=$row;
	 }
	 return $result;
}


function getUsersAnswerOnExhibitHall ($db,$id,$login) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT login FROM answer_on_exhibits
	WHERE id_exh=:id_exh AND login!=:login GROUP BY login
	";
	$result=array();
	$stmt = $db->prepare($sql);
	$stmt->bindValue ('id_exh',$id, PDO::PARAM_INT);
	$stmt->bindValue ('login',$login, PDO::PARAM_STR);
	$stmt->execute();
	while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
	 	$result[$row['login']]=$row;
	 }
	 return $result;
}



function getAllHalls ($db){
	$db->query( "SET CHARSET utf8" );

	$sql= "SELECT * FROM halls
	";

	$result=array();

	$stmt= $db->prepare($sql);

	$res=$stmt->execute();

	 while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
	 	$result[$row['id_h']]=$row;
	 }

	 return $result;
}

function getReviews ($db){
	$db->query( "SET CHARSET utf8" );

	$sql= "SELECT * FROM reviews
	";

	$result=array();

	$stmt= $db->prepare($sql);

	$res=$stmt->execute();

	 while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
	 	$result[$row['id_r']]=$row;
	 }

	 return $result;
}

function getExhibitsByHall ($db,$id) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT * FROM exhibits
	WHERE id_h=:id_h
	";
	$result=array();
	$stmt = $db->prepare($sql);
	$stmt->bindValue ('id_h',$id, PDO::PARAM_INT);
	$stmt->execute();
	while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
	 	$result[$row['id_exh']]=$row;
	 }
	 return $result;
}

function getAchieveById ($db,$id) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT * FROM achievements
	WHERE id_ach=:id_ach 
	";
	$stmt = $db->prepare($sql);
	$stmt->bindValue ('id_ach',$id, PDO::PARAM_INT);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row;
}

function AchieveHave ($db,$l,$id_ach) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT id_uach FROM user_achieve
	WHERE login='$l' AND id_ach='$id_ach'
	";
	$result=array();

	$stmt= $db->prepare($sql);

	$res=$stmt->execute();

	 while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
	 	$result[$row['id_uach']]=$row;
	 }
if (!empty($result)){
	return true;
}
else {
	return false;
}

}



function LoginFree ($db,$l) {
	$db->query( "SET CHARSET utf8" );
	$sql = "SELECT id_u,login FROM users
	WHERE login='$l' 
	";
	$result=array();

	$stmt= $db->prepare($sql);

	$res=$stmt->execute();

	 while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
	 	$result[$row['id_u']]=$row;
	 }
if (!empty($result)){
	return false;
}
else {
	return true;
}

}



?>