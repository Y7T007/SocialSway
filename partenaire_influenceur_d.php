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
        .contrat_1{
            grid-column: 3 / 9;
            grid-row: 2 / 5;
			overflow: auto;
        }
		.contrat_2{
            grid-column: 3 / 9;
			grid-row: 5/ 8;
			overflow: auto;
		}
		.contrat_3{
            grid-column: 3 / 9;
			grid-row: 8/ 12;
			overflow: auto;
		}
		
    table {
        border-collapse: collapse;
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }
    tr:hover {
        background-color: #f5f5f5;
    }
    img {
        max-width: 100%;
        height: auto;
    }
	h1{
text-align: center;
}
</style>
		
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


	
	
	

	<div class="contrat_1 block" >
		
					<h1>TOUT CONTRAT</h1>
				<?php
					$conn = new PDO("mysql:host=localhost;port=3308;dbname=projet","root","");
					$id = $_SESSION['id'];
				$stmt = $conn->prepare("SELECT c.id_contrat,m.*
										FROM marque m
										INNER JOIN contrat c ON m.id = c.id_marque
										WHERE c.id_influenceur = :id");
				$stmt->bindValue(':id', $_SESSION['id']);
				$stmt->execute();


				?>

				<table>
					<tr>
						<th>LOGO</th>
						<th>NAME</th>
						<th>EMAIL</th>
						<th>DOMAIN</th>
						<th>PARTENARIAT</th>
						<th>voir contrat</th>
					</tr>

					<?php while ($row = $stmt->fetch()): ?>
						<tr>
							<td><img src="image/<?php echo $row['logo']; ?>" width="100px"></td>
							<td><?php echo $row['nom']; ?></td>
							<td><?php echo $row['email']; ?></td>
							<td><?php echo $row['domaine']; ?></td>
							<td><a href="marque_profil_p.php?id=<?php echo $row['id']; ?>"><button>Profil</button></a></td>
							<td><a href="see_contrat_influenceur.php?id_contrat=<?php echo $row['id_contrat']; ?>"><button>contrat</button></a></td>
						</tr>
					<?php endwhile; ?>

				</table>

				<?php if ($stmt->rowCount() === 0): ?>
					<p>Aucune marque n'a envoyé de contrat pour le moment.</p>
				<?php endif; ?>

     </div>


	 <div class="contrat_2 block" >
		
		<h1>CONTRAT NON SIGNEE </h1>
	<?php
		$conn = new PDO("mysql:host=localhost;port=3308;dbname=projet","root","");
		$id = $_SESSION['id'];
	$stmt = $conn->prepare("SELECT c.id_contrat,m.*
							FROM marque m
							INNER JOIN contrat c ON m.id = c.id_marque
							WHERE c.id_influenceur = :id AND (c.signature_influenceur IS NULL OR c.signature_influenceur = '')");
	$stmt->bindValue(':id', $_SESSION['id']);
	$stmt->execute();


	?>

	<table>
		<tr>
			<th>LOGO</th>
			<th>NAME</th>
			<th>EMAIL</th>
			<th>DOMAIN</th>
			<th>PARTENARIAT</th>
			<th>voir contrat</th>
		</tr>

		<?php while ($row = $stmt->fetch()): ?>
			<tr>
				<td><img src="image/<?php echo $row['logo']; ?>" width="100px"></td>
				<td><?php echo $row['nom']; ?></td>
				<td><?php echo $row['email']; ?></td>
				<td><?php echo $row['domaine']; ?></td>
				<td><a href="marque_profil_p.php?id=<?php echo $row['id']; ?>"><button>Profil</button></a></td>
				<td><a href="see_contrat_inf.php?id_contrat=<?php echo $row['id_contrat'];?>"><button>contrat</button></a></td>
			</tr>
		<?php endwhile; ?>

	</table>

	<?php if ($stmt->rowCount() === 0): ?>
		<p>Aucune marque n'a envoyé de contrat pour le moment.</p>
	<?php endif; ?>

</div>

<div class="contrat_3 block" >
		
		<h1>CONTRAT NON SIGNEE </h1>
	<?php
		$conn = new PDO("mysql:host=localhost;port=3308;dbname=projet","root","");
		$id = $_SESSION['id'];
	$stmt = $conn->prepare("SELECT c.id_contrat,m.*
							FROM marque m
							INNER JOIN contrat c ON m.id = c.id_marque
							WHERE c.id_influenceur = :id AND c.signature_influenceur != '' ");	
							$stmt->bindValue(':id', $_SESSION['id']);
	$stmt->execute();


	?>

	<table>
		<tr>
			<th>LOGO</th>
			<th>NAME</th>
			<th>EMAIL</th>
			<th>DOMAIN</th>
			<th>PARTENARIAT</th>
			<th>voir contrat</th>
		</tr>

		<?php while ($row = $stmt->fetch()): ?>
			<tr>
				<td><img src="image/<?php echo $row['logo']; ?>" width="100px"></td>
				<td><?php echo $row['nom']; ?></td>
				<td><?php echo $row['email']; ?></td>
				<td><?php echo $row['domaine']; ?></td>
				<td><a href="marque_profil_p.php?id=<?php echo $row['id']; ?>"><button>Profil</button></a></td>
				<td><a href="see_contrat_inf.php?id_contrat=<?php echo $row['id_contrat']; ?>"><button>contrat</button></a></td>
			</tr>
		<?php endwhile; ?>

	</table>

	<?php if ($stmt->rowCount() === 0): ?>
		<p>Aucune marque n'a envoyé de contrat pour le moment.</p>
	<?php endif; ?>

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


