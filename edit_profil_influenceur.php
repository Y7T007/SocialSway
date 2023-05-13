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
       $conn = new PDO("mysql:host=localhost;port=3308;dbname=projet","root","");

   $update =array();
   $update_st = null;
   $image_name=null;

   if (isset($_POST['submit'])) {
 

      if ($_POST['nom']) {
         $update[]=' nom = :nom';
      }
      if ($_POST['prenom']) {
        $update[]=' prénom =:prenom';
     }
      if ($_POST['email']) {
         $update[]=' email = :email';
      }

      if ($_POST['genre']) {
        $update[]=' genre =:genre';
     }

     if ($_POST['password']) {
      $update[]=' motdepasse =:password';
     }

     if ($_POST['gsm']) {
      $update[]=' gsm =:gsm';
     }
         if ($_POST['adresse']) {
      $update[]=' adresse =:adresse';
     }

     if ($_POST['datenaissance']) {
      $update[]=' datenaissance =:datenaissance';
     }
     if ($_POST['domaine']) {
      $update[]=' domaine =:domaine';
     }
     if ($_POST['langue']) {
        $update[]=' langue =:langue';
       }
       if ($_POST['continent']) {
        $update[]=' continent =:continent';
       }
     if (!empty($_FILES['image']['tmp_name'])) {
      $image_name = $_FILES['image']['name'];
      $image_tmp_name = $_FILES['image']['tmp_name'];
      move_uploaded_file($image_tmp_name, "image/$image_name");
      $update[] = 'imagee = :image';

  }


            if (!empty($update)) {
              $update_st = $conn ->prepare ('UPDATE influencer SET ' . implode(',', $update) . '  WHERE id=:id');
              $update_st->bindParam(':id',$_SESSION['id']);
              if ($_POST['nom']) {
               $update_st ->bindParam('nom',$_POST['nom']);
               }

              if ($_POST['prenom']) {
                $update_st ->bindParam('prenom',$_POST['prenom']);
              } 

                    if ($_POST['email']) {
                      $email = $_POST['email'];
                      $verify_query = $conn->prepare("SELECT * FROM influencer WHERE email=?");
                      $verify_query->execute(array($email));

                      if ($verify_query->rowCount() > 0) {
                          echo "<p>This email is already used. Please use a different email.</p>";
                          $update_st =null;
                          header('Location: profil_influenceur.php');

                      } else {
                          $update_st->bindParam('email', $_POST['email']);
                      }
                  }
                        
               if ($_POST['genre']) {
              $update_st ->bindParam('genre',$_POST['genre']);
                  } 
               if ($_POST['password']) {
                    $update_st ->bindParam('password',$_POST['password']);
                        }
               if ($_POST['gsm']) {
                    $update_st ->bindParam('gsm',$_POST['gsm']);
                        }
               if ($_POST['adresse']) {
                    $update_st ->bindParam('adresse',$_POST['adresse']);
                        }
               if ($_POST['datenaissance']) {
                    $update_st ->bindParam('datenaissance',$_POST['datenaissance']);
                        }
                if ($_POST['domaine']) {
                    $update_st ->bindParam('domaine',$_POST['domaine']);
                        }  
                if ($_POST['langue']) {
                    $update_st ->bindParam('langue',$_POST['langue']);
                        }  
                
                        if ($_POST['continent']) {
                            $update_st ->bindParam('continent',$_POST['continent']);
                                }  
                                        
              if ( $image_name) {
                $update_st->bindParam(':image', $image_name);
              } 
                  
             if ($update_st !=null && $update_st->execute()) {
               echo 'good';
               header('Location: profil_influenceur.php');
               exit();
               
              }else {
               echo 'non';
              }
            }
         }
        
            ?>

        <h1>PROFILE</h1>
    <h3>Make the changes you want</h3>
    <?php 
    $conn = new PDO("mysql:host=localhost;port=3308;dbname=projet","root","");
$id = $_SESSION['id'];
$sql = "SELECT * FROM influencer WHERE id=:id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

echo "welcome, ". $_SESSION['id'];echo "<br/>";
echo $result['email']; echo "<br/>";
echo $result['genre'];
echo $result['nom'];
echo "<br/>";
echo "<img src='image/" . $result['imagee'] . "' width='100px' >";
echo "<br/>";



?>
    <form action=""  method="POST" enctype="multipart/form-data" >

<label for="image">Entrez votre photo <span> *</span> : </label>
<!-- <input type="file" name="image" ><br> -->
<input type="file" name="image" id="image" accept="image/*">


<label for="nom">Nom <span> *</span> :</label>
<input type="text" name="nom"   placeholder="entrez votre Nom"><br>
<br>
<label for="prenom">Prénom <span> *</span> :</label>
<input type="text" name="prenom"   placeholder="entrez votre Prénom "><br>
<br>

<label for="password">Le mot de passe <span> *</span>:</label>
<input type="password" name="password" id = "password"  placeholder="entrez votre mot de passe">
<br>
<br>

<label for="date">Date <span> *</span> :</label>
<input type="date"   name="datenaissance"><br>
<br>

  
 <label for="email">Email <span> *</span> :</label>
 <input type="text" name="email" value=""  placeholder="entrez votre email"><br>

 <br>
 <label for="gsm">GSM <span> *</span> :</label>
 <select  name="country-code">
   <option value="+212">Morocco (+212)</option>
   <option value="+1">United States (+1)</option>
   <option value="+44">United Kingdom (+44)</option>
   <option value="+33">France (+33)</option>
 </select>
 <input type="text" name="gsm" id ="gsm"   placeholder="entrez votre telephone"><br>
  <br>
  <label for="adresse">Adresse <span> *</span> :</label>
  <input type="text" name="adresse"   placeholder="entrez votre adresse"><br>
 <br>
 <label for="langue">langue <span> *</span> :</label>
  <input type="text" name="langue"   placeholder="entrez votre langue">
  <label for="continent">continent <span> *</span> :</label>
  <input type="text" name="continent"   placeholder="entrez votre continent">
 <label for="genre">Genre:</label>
 <select  name="genre">
   <option value="F">F</option>
   <option value="M">M</option>
  </select><br><br>
 <label for="domaine">Domaine <span> *</span>:</label>

<input type="text" name="domaine"  placeholder="entrez votre domaine"><br><br>

  
<br><br>
 <br>
 <br><br>
  <input type="submit" value="upload" name="submit">
</form>

   <br/>
   <a href="profil_influenceur.php"> <button >return</button></a>



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


