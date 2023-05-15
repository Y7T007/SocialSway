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
	<link rel="stylesheet" href="make.css">
	<title>Influencer|Dashboard</title>
	
 
          <script>
	function addInput() {
		var container = document.getElementById("inputContainer");
		var inputCount = container.getElementsByTagName("input").length + 1;
		var label = document.createElement("label");
		label.textContent = "Term " + inputCount + ": ";
		container.appendChild(label);
		var input = document.createElement("input");
		input.type = "text";
		input.name = "myInputs[]";
		container.appendChild(input);
		container.appendChild(document.createElement("br"));
	}
 

  const dateDebutInput = document.getElementById("date_debut");
  const dateFinInput = document.getElementById("date_fin");

  dateDebutInput.addEventListener("change", () => {
    dateFinInput.min = dateDebutInput.value;
  });

</script>
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
	<?php
		$conn = new PDO("mysql:host=localhost;dbname=projet; port=3308","root","");
        if (isset($_GET['id_inf']) && isset($_SESSION['id'])) {
    
            $stm = $conn->prepare('SELECT * FROM marque WHERE id = :id');
            $stm->bindParam(":id",$_SESSION['id']);
            $stm->execute();
            $row_m = $stm->fetch(PDO::FETCH_ASSOC);

            $result = $conn->prepare("SELECT * FROM influencer where id = :id");
            $result->bindParam(":id", $_GET['id_inf']);
            $result->execute();
            $row_inf = $result->fetch(PDO::FETCH_ASSOC);

        }
	?>



<h1>CONTRAT</h1>

<div class="images">
    <div>
<label for="">MARQUE</label>
<label for="">NOM :<?php echo $row_m['nom']; ?></label>
<img class="photo" src="image/<?php echo $row_m['logo']; ?>"  width="100px">
        
    </div>
    <br>
    <div>
<label for="">Influencer</label>
<label for="">NOM :<?php echo $row_inf['nom']; ?></label>
<?php 
if ( $row_inf['imagee'] == '') {

	echo "<img class='photo' src='img/businessman-icon-vector-male-avatar-profile-image-profile-businessman-icon-vector-male-avatar-profile-image-182095609.jpg' width='100px'> ";

}else{
	echo "<img class='photo' src='image/" . $row_inf["imagee"] . "' width='100px'>";
}
?>
</div>

</div>

<p>Cet accord établit les modalités et conditions de collaboration entre la Marque et l'Influenceur, qui travailleront ensemble pour promouvoir les produits ou services de la Marque via les plateformes de médias sociaux, les articles de blog, ou tout autre canal en ligne convenu mutuellement par les deux parties. <br>
    

La Marque reconnaît la capacité de l'Influenceur à atteindre un public cible spécifique et à créer un contenu attractif qui résonne avec leurs abonnés. L'Influenceur reconnaît l'engagement de la Marque à fournir des produits ou services de qualité qui correspondent à leur image de marque personnelle et à leurs valeurs.<br>

Les deux parties conviennent de travailler en collaboration pour atteindre les objectifs de ce partenariat, dans le but ultime d'augmenter la visibilité, l'engagement et les ventes de la Marque. Les modalités et conditions énoncées dans cet accord sont contraignantes pour les deux parties et sont destinées à régir l'ensemble de la relation entre la Marque et l'Influenceur pour la durée de cette collaboration.</p> 



                  <form action=""  method="post" enctype="multipart/form-data" >
                    <div class="date_inp">

                 
                        <div class="input-box">
                          <label for="date">Date DEBUT <span> *</span> :</label>
                          <input type="date" required  name="date_debut" id="date_debut">
                        </div>
                        <div class="input-box">
                          <label for="date">Date FIN <span> *</span> :</label>
                          <input type="date" required  name="date_fin" id="date_fin" min="" onchange="setMinDate()">
                        </div>
                        <div class="input-box">
                           <label for="salaire">Salaire <span> *</span> :</label>
                           <input type="text" name="salaire" required  placeholder="entrez votre salaire"><br>
                       </div>

                       </div>          
                            <div  id="inputContainer"class="term add">
                             <label>Term 1: </label>
                                <input class="term" type="text" name="myInputs[]">
                            <br>
                             </div>
                            <button type="button" class="input_term" onclick="addInput()">Add Input</button>
                        <div class="input-box add">

                             <label for="signature">Entrez votre signature marque: <span> *</span> : </label><br>
                              <input type="file" name="signature_marque" required>
                         </div>

                     

                         <input class="submit" type="submit" value="submit" name="submit">

                </form>
     </div>
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


<?php

try {
  $pdo = new PDO("mysql:host=localhost;dbname=projet; port=3308","root","");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_CONNECTION_STATUS, true);
}catch(PDOException $e){
  die("error: could not connect" . $e->getMessage());
}

if (isset($_POST['submit'])) {
  $id_marque=$_SESSION['id'];
  $id_influenceur=$_GET['id_inf'];
 
          $sign_marque = $_FILES["signature_marque"]["name"];
          $tempname_marque = $_FILES["signature_marque"]["tmp_name"];
          $folder_m = "./image/" . $sign_marque;


          $sql = "INSERT INTO contrat (id_marque,id_influenceur,signature_marque, date_debut, date_fin, salaire, term) 
                  VALUES (:id_marque,:id_influenceur,:signature_marque, :date_debut, :date_fin, :salaire,:term)";

          $st = $pdo->prepare($sql);
          $st->bindParam(':id_marque', $id_marque);
          $st->bindParam(':id_influenceur', $id_influenceur);
          $st->bindParam(':signature_marque', $sign_marque);
          $st->bindParam(':date_debut', $_POST['date_debut']);
          $st->bindParam(':date_fin', $_POST['date_fin']);
          $st->bindParam(':salaire', $_POST['salaire']);

   
          $terms = $_POST["myInputs"];
          $serialized_terms = serialize($terms);
          $st->bindParam(':term', $serialized_terms);

            $st->execute();

          if (move_uploaded_file($tempname_marque, $folder_m)) {
            
            echo "Inscription réussie!";
            header('Location:mareketPlace_marque.php');

            exit();
          }
        }


?>
