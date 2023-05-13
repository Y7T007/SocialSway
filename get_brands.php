<?php

// connect to the database
$pdo = new PDO("mysql:host=localhost;port=3308;dbname=projet","root","");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// select messages from the database

$sql = "SELECT * FROM marque";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$marques = $stmt->fetchAll(PDO::FETCH_ASSOC);


// loop through messages and print each in a new line
foreach ($marques as $mar) {

	echo '<li class="listi" onclick="changeVariable('.$mar['id'].',\'mar\')"><div class="div1"> </div>
<div class="div2"> '.$mar['nom'].'   </div>
<div class="div3"> </div> </li>';}
?>


