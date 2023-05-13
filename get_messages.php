<?php

// connect to the database
$pdo = new PDO("mysql:host=localhost;port=3308;dbname=projet","root","");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// select messages from the database

$user_id = $_SESSION['id'];
$receiver_id=$_SESSION['receiver_id'];

$sql = "SELECT * FROM MESSAGE WHERE (USER_ID=? and RECEVER_ID=?) or (USER_ID=? and RECEVER_ID=?)  ORDER BY timeDate ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id,$receiver_id,$receiver_id,$user_id]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql2= "select * from influencer";
$stmt2 = $pdo ->prepare($sql2);
$stmt2->execute();
$users=$stmt2->fetchAll(PDO::FETCH_ASSOC);

// loop through messages and print each in a new line
foreach ($messages as $message) {

			$sql3= "select * from influencer where id=?";
			$stmt3 = $pdo ->prepare($sql3);
			$stmt3->execute([$message['user_id']]);
			$message_sender=$stmt3->fetchAll(PDO::FETCH_ASSOC);
			if ($message_sender[0]['id']==$user_id){
//				cette section est reserve pour les messages envoyer par l'utilisateur
				echo "<li class='right_bubble' )\"><p>".$message['messagetext']."</p>"."</li>";
			} elseif($message_sender[0]['id']!=$user_id){
//				cette partie est consacre pour les msg recu par d'autres contacts
				echo "<li class='left_bubble' )\"><p>".$message['messagetext']."</p>".' '."</li>";
			}




}
?>


