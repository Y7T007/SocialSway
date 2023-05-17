<?php
session_start();

$_SESSION['receiver_id']=0;
// Check if the session variables are set
if (isset($_SESSION['receiver_type'],$_SESSION['id'])) {
	if ($_SESSION['receiver_type'] != 'mar') {
		if ($_SESSION['receiver_type'] == 'inf') {
			header("Location: dashboard_inf.php");
			exit;
		} else {
			echo '<script>
                    alert("Vous n\'etes pas encore connecte !! connectez vous afin d\'acceder a votre dashboard");
                    window.location.href = "login.php";
                </script>';
			exit;
		}
	}
} else {
	// Handle the case when the session variables are not set
	// Redirect or display an error message
	echo '<script>
                    alert("Vous n\'etes pas encore connecte !! connectez vous afin d\'acceder a votre dashboard");
            window.location.href = "login.php";
        </script>';
	exit;
}


$pdo = new PDO("mysql:host=localhost;port=3308;dbname=projet","root","");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$user_id = $_SESSION['id'];



$sql = "SELECT * FROM marque where id=".$user_id;
$stmt = $pdo->prepare($sql);
$stmt->execute();
$infls = $stmt->fetchAll(PDO::FETCH_ASSOC);
$infl=$infls[0];
$user_rank='';
if ($infl['points']<1000){
	$user_rank="🥉";
}elseif ($infl['points']>=1000 && $infl['points']<2500 ){
	$user_rank="🥈";
}elseif ($infl['points']>=2500 && $infl['points']<4000 ){
	$user_rank="🥇";
}elseif ($infl['points']>=4000 ){
	$user_rank="💎";
}

$sql="select * from data_user where id_user=".$user_id." and type='mar'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$datas_user = $stmt->fetchAll(PDO::FETCH_ASSOC);
$data_user = $datas_user[0];

?>

<!DOCTYPE html>

<html>
<head>
	<title>Chat</title>
	<link rel="stylesheet" type="text/css" href="chat.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
</head>
<body>
<div class="chat-container">

	<div class="chat">
		<div class="contacts">
			<div class="d_head">
				<div class="d_bell">
					<ion-icon name="notifications-outline"></ion-icon>
				</div>
				<div class="d_mail">
					<ion-icon name="mail-open-outline"></ion-icon>
				</div>
			</div>
			<div class="d_profil">
				<div class="d_profil_image">
					<img src="<?php echo $infls[0]['logo'] ?>"  alt="Img">
				</div>
				<div class="d_profil_name">
					<h2> <?php echo $infls[0]['nom'].' '.$user_rank; ?> </h2>

				</div>

			</div>

			<div class="d_list_cnts">
				<div class="rechercher_contact">
					<input name="srch" type="text" placeholder="Rechercher un contact" style="font-size: 10px" >
				</div>
				<br>
				<div class="all_ctcs">
					
				
				<div class="list_infl">
					<h4 align="center">Influenceurs</h4>
					<ul>
						<?php include("get_infl.php"); ?>

					</ul>
				</div>
				<div class="list_brands">
					<h4 align="center">Marques</h4>
					<ul>

						<?php include("get_brands.php"); ?>

					</ul>
				</div>
				</div>
					<div class="gradient"></div>
			</div>

		</div>
		<div class="discussion">
			<div class="messages" id="messages">
				<ul>
					<?php include("get_messages.php"); ?>
				</ul>
			</div>
			<div class="input">
				<form action="send_message.php" method="post">
					<input type="text" name="text" placeholder="Type your message" id="message-input" required>
					<input type="submit" id="send-button">
				</form>

			</div>
		</div>
	</div>
</div>
<form action="chat.php" method="post">
	<input type="text" id="type"  hidden>
	<input type="text" id="type" hidden>
</form>
<script>
	// Wait for the page to finish loading before scrolling
	window.onload = function() {
		// Get the messages div element
		const messagesDiv = document.getElementById("messages");
		// Set the scrollTop property to the maximum value
		messagesDiv.scrollTop = messagesDiv.scrollHeight;
	}
</script>
<script>
	function changeVariable( receiverId, type) {
		// Set the value of the session variable to the receiver id

		var form = document.createElement('form');
        form.method = 'POST';
        form.action = 'chat.php';

        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'receiver_id';
        input.value = receiverId;
        form.appendChild(input);

		var input2 = document.createElement('input');
        input2.type = 'hidden';
        input2.name = 'receiver_type';
        input2.value = type;
        form.appendChild(input2);

        document.body.appendChild(form);
        form.submit();

}

	// Get the input element and the list items
	const input = document.querySelector('input[name="srch"]');
	const listItems = document.querySelectorAll('.listi');
	// Listen for the input event
	input.addEventListener('input', function() {
		// Get the search term
		const searchTerm = this.value.trim().toLowerCase();
		// Loop through the list items
		listItems.forEach(item => {
			// Get the text content of the item
			const textContent = item.textContent.toLowerCase();
			// Check if the search term is found in the text content
			if (textContent.includes(searchTerm)) {
				// Show the item if the search term is found
				item.style.display = '';
			} else {
				// Hide the item if the search term is not found
				item.style.display = 'none';
			}
		});
	});

	var hasFocus = true;

	window.onfocus = function() {
		location.reload();
	}


</script>
<?php

//if (isset($_POST['changeVar'])) {
//	// Update the variable with the new value sent from the client
//	$_SESSION['receiver_id'] = $_POST['newValue'];
//}
//?>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>