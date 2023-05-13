<?php
// Démarre ou reprend une session existante
session_start();



?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<!--    IMPORTATION DES FONTS UTILLISE  -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;1,100&display=swap" rel="stylesheet">
	<!--    CSS     -->
	<link rel="stylesheet" href="ressources/css/dycalendar.css"><!-- ce fichier est relative a la library dycalendar -->
	<link rel="stylesheet" href="ressources/css/dashboard_inf.css">
	<title>Influencer|Dashboard</title>
	
    <style>
        .revenus{
            grid-column: 3 / 9;
            grid-row: 2 / 8;
        }
    </style>
</head>
<body>

<div class="container">
	<div class="menu_lateral">
		<div class="ml_n">
				<img src="img/icons/notifications-outline%20(1).svg" alt="n">
		</div>
		<div class="ml_m">
				<img src="img/icons/mail-open-outline.svg" alt="m">
		</div>
		<div class="ml_profil">
			<img src="img/businessman-icon-vector-male-avatar-profile-image-profile-businessman-icon-vector-male-avatar-profile-image-182095609.jpg" alt="">

		</div>
		<div class="ml_name">
			<h2>Nom Prenom</h2>
		</div>
		<div class="ml_list">
			<ul>
				<li>
					<button>Dashboard</button>
				</li>
				<li>
					<button onclick="window.location.href='profil_influenceur.php'">Profil</button>
				</li>
				<li>
					<button onclick="window.location.href='chat.php'">Chat</button>
				</li>
				<li>
					<button onclick="window.location.href='see_contrat_inf.php'">Partenariat</button>
				</li>
				<li>
					<button onclick="window.location.href='marketPlace.php'">Decouvrir</button>
				</li>
				<li>
					<button>Cree...</button>
				</li>
				<li>
					<button>Parametres</button>
				</li>
				<li>
					<button>Deconnexion</button>
				</li>

			</ul>
		</div>
	</div>
	<div class="header block">
		LOGO
	</div>


	
	
	

	<div class="revenus block" >
		hello
        <?php
$id = $_SESSION['id'];
$conn = new PDO("mysql:host=localhost;port=3308;dbname=projet","root","");
$sql = "SELECT * FROM influencer WHERE id=:id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

?>
                        <div class='parent' >
                        <div class='div2'>
                        <img src='image/<?php echo $result["imagee"]; ?>' width='100px'>          
                        </div>
                        <div class='div3'> 
                        <label>NOM :</label> <?php echo $result["nom"]; ?>
                        </div>
                        <div class='div3'> 
                        <label>PRENOM :</label> <?php echo $result["prénom"]; ?>
                        </div>
                        <div class='div3'> 
                        <label>EMAIL :</label> <?php echo $result["email"]; ?>
                        </div>
                        <div class='div3'> 
                        <label>DATE DE NAISSANCE :</label> <?php echo $result["datenaissance"]; ?>
                        </div>
                        <div class='div3'> 
                        <label>GSM :</label> <?php echo $result["gsm"]; ?>
                        </div>
                        <div class='div3'> 
                        <label>ADRESSE :</label> <?php echo $result["adresse"]; ?>
                        </div>
                        <div class='div3'> 
                        <label>GENRE :</label> <?php echo $result["genre"]; ?>
                        </div>
                        <div class='div3'> 
                        <label>DOMAINE :</label> <?php echo $result["domaine"]; ?>
                        </div>
                        <div class='div3'> 
                        <label>CONTINENT :</label> <?php echo $result["continent"]; ?>
                        </div>
                        <div class='div3'> 
                        <label>LANGUE :</label> <?php echo $result["langue"]; ?>
                        </div>
                        <div class='div3'> 
                        <label>FOLLOWERS :</label> <?php echo $result["followers"]; ?>
                        </div>
                        <div class='div3'> 
                        <label>POINTS :</label> <?php echo $result["points"]; ?>
                        </div>

                        <div class='div3'> 
  <label for='socialmedia'>SOCIAL MEDIA :</label>

  <?php
    $socialmedia_values = json_decode($result['socialmedia'], true);
    $username_values = json_decode($result['username'], true);

    // Loop through each social media account and its corresponding username
    foreach ($socialmedia_values as $key => $socialmedia) {
      $username = isset($username_values[$key]) ? $username_values[$key] : '';

      // Display the social media account name and username in the desired format
      echo "<span class='account'>";
      echo $socialmedia . ' : ' . $username;
      echo "</span>";
    }
  ?>
      <br> <a href="edit_profil_influenceur.php">EDIT PROFIL</a> <br/>

</div>


</div>



<!--SCRIPTS-->
<!--nous nous servirons d'une library qui offre le dessin d'un calendrier qui s'appelle le 'dycalendar.js' -->
<!--cette library eat disponible sur "https://github.com/yusufshakeel/dyCalendarJS/blob/master/"-->
<script src="/project/ressources/js/dycalendar.js"></script>
<script src="/project/ressources/js/dycalendar.min.js"></script>
<script src="/project/ressources/js/default.js"></script>
<script>
	dycalendar.draw({
			target: '#dycalendar',
			type: 'month',
			highlighttargetdate:true,
			prevnextbutton:'show'
	})
</script>

<!--SCRIPT RELATIVE A L'IMPORTATION DES ICONS DEPUIS LA LIBRAIRIE DES ICONS "IONIC.IO"-->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>



</body>
</html>


