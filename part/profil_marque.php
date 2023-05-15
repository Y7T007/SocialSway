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
            grid-row: 2 / 6;
        }
        .parent {
  display: flex;
  flex-direction: row;
  align-items: center;
  margin-left: 100px;
  
  
    }
    .parent_f{
        display: flex;
        width: 100%;
        margin: 50px;
        flex-direction: column;

    }
    .div2 {
      margin-bottom: 20px;
    }

    .div2 img {
      width: 200px;
      height: 200px;
      border-radius: 50%;
    }

    .div3 {
      display: flex;
        margin-bottom: 10px;
        width: 80%;
        gap: 20px;

    }
    label {
      font-weight: bold;
    }

    a {
      color: blue;
      text-decoration: underline;
    }
    .rep{
        margin: 35px;
        border: 2px solid #000;
      padding: 10px; ;
    border-radius: 30px;}
    img{
    height: 200px;
    width: 200px;
    border-radius: 50%;
    }
    .btn{
      background-color: #4CAF50;
      border: none; 
      color: white;
      padding: 12px 24px; 
      text-align: center; 
      text-decoration: none; 
      display: inline-block;
      font-size: 16px; 
      cursor: pointer; 
      border-radius: 4px;
      width: 90px;
      margin-left: 70%;
      margin-top: 40px;
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
		
        <?php
$id = $_SESSION['id'];
$conn = new PDO("mysql:host=localhost;port=3308;dbname=projet","root","");
$sql = "SELECT * FROM marque WHERE id=:id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

?>
                        <div class='parent' >
                        <div class='div2'>
                        <img src='image/<?php echo $result["logo"]; ?>' width='100px'>          
                        </div>
                        <div class="parent_f">
                        <div class='div3'> 
                        <label>NOM :      </label> <p> <?php echo $result["nom"]; ?> </p>
                        </div>
                        <div class='div3'> 
                        <label>EMAIL :</label> <?php echo $result["email"]; ?>
                        </div>
                        <div class='div3'> 
                        <label>DATE DE CREATION :</label> <?php echo $result["datedecreation"]; ?>
                        </div>
                        <div class='div3'> 
                        <label>fax_tel :</label> <?php echo $result["fax_tel"]; ?>
                        </div>
                        <div class='div3'> 
                        <label>ADRESSE :</label> <?php echo $result["adresse"]; ?>
                        </div>
                        <div class='div3'> 
                        <label>DOMAINE :</label> <?php echo $result["domaine"]; ?>
                        </div>
                        <div class='div3'> 
                        <label>CHIFFRE D'AFFAIRE :</label> <?php echo $result["chiffredaffaire"]; ?>
                        </div>
                        <div class="rep">
                        <div class='div3'> 
                        <label>NOM DE REPRESENTANT :</label> <?php echo $result["nomderep"]; ?>
                        </div>
                        <div class='div3'> 
                        <label>PRENOM DE REPRESENTANT :</label> <?php echo $result["prenomderep"]; ?>
                        </div>
                        <div class='div3'> 
                        <label>EMAIL DE REPRESENTANT :</label> <?php echo $result["emailderep"]; ?>
                        </div>
                        <div class='div3'> 
                        <label>GSM DE REPRESENTANT :</label> <?php echo $result["gsm"]; ?>
                        </div>
              
</div>
<div class='div3'> 

<br> <a class="btn" href="edit_profil_marque.php">EDIT PROFIL</a> <br/>
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


