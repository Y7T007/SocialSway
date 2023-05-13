<?php

$user_id = $_SESSION['id'];


// connect to the database
$pdo = new PDO("mysql:host=localhost;port=3308;dbname=projet","root","");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// select messages from the database


$sql = "SELECT * FROM influencer";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$infls = $stmt->fetchAll(PDO::FETCH_ASSOC);


$_SESSION['receiver']=$infls[0]['id'];
foreach ($infls as $infl) {
	if ($infl['id']!= $user_id){

	echo '<li class="listi" onclick="changeVariable('.$infl['id'].',\'inf\')"><div class="div1"> </div>
<div class="div2"> '.$infl['nom'].' '.$infl['prenom'].'  </div></li>';
	}
}
?>


