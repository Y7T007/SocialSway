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
        .form ,.profil{
          margin: 60px;
        }
        label,input{
          margin: 30px;
        }
        .forum{
          display: flex;
          gap: 60px;
          margin: 40px;
        }
        .submit,.btn{
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
        }
        .submit{
          margin-left: 80%;
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
  $conn = new PDO("mysql:host=localhost;port=3308;dbname=projet","root","");

$update =array();
$update_st = null;
$email_id=$_SESSION['email'];
$logo_name=null;
$fax_tel=null;
$chiffredaffaire=null;
$datedecreation=null;

if (isset($_POST['submit'])) {


              if ($_POST['nom']) {
                  $update[]=' nom = :nom';
                  $_SESSION['nom'] = $_POST['nom'];
              }
              if ($_POST['motdepasse']) {
              $update[]=' motdepasse =:motdepasse';
              $_SESSION['motdepasse'] = $_POST['motdepasse'];
              }

              if ($_POST['datedecreation']) {
              $update[]=' datedecreation=:datedecreation';
              $_SESSION['datedecreation'] = $_POST['datedecreation'];
              }  
                if ($_POST['email']) {
                  $update[]=' email = :email';
                  $_SESSION['email'] = $_POST['email'];
              }
              if ($_POST['fax_tel']) {
                $update[]='fax_tel =:fax_tel';
                $_SESSION['fax_tel'] = $_POST['fax_tel'];
                }
              if ($_POST['adresse']) {
                $update[]=' adresse =:adresse';
                $_SESSION['adresse'] = $_POST['adresse'];
                }
              
              if ($_POST['domaine']) {
                $update[]=' domaine =:domaine';
                $_SESSION['domaine'] = $_POST['domaine'];
                }
                if ($_POST['chiffredaffaire']) {
                $update[]=' chiffredaffaire =:chiffredaffaire';
                $_SESSION['chiffredaffaire'] = $_POST['chiffredaffaire'];
                }
                if ($_POST['nomderep']) {
                $update[]=' nomderep =:nomderep';
                $_SESSION['nomderep'] = $_POST['nomderep'];
                }
                if ($_POST['prenomderep']) {
                $update[]=' prenomderep =:prenomderep';
                $_SESSION['prenomderep'] = $_POST['prenomderep'];
                }
                if ($_POST['emailderep']) {
                $update[]=' emailderep =:emailderep';
                $_SESSION['emailderep'] = $_POST['emailderep'];
                }
                if ($_POST['gsm']) {
                $update[]=' gsm =:gsm';
                $_SESSION['gsm'] = $_POST['gsm'];
                }          
                  if (!empty($_FILES['logo']['tmp_name'])) {
                  $logo_name = $_FILES['logo']['name'];
                  $logo_tmp_name = $_FILES['logo']['tmp_name'];
                  move_uploaded_file($logo_tmp_name, "image/$logo_name");
                  $update[] = 'logo = :logo';
                  $_SESSION['logo'] = 'image/' .$logo_name; 

                }


              if (!empty($update)) {
                $update_st = $conn ->prepare ('UPDATE marque SET ' . implode(',', $update) . '  WHERE id=:id');
                $update_st->bindParam(':id',$_SESSION['id']);
                if ($_POST['nom']) {
                  $update_st ->bindParam('nom',$_POST['nom']);
                  }

                      if ($_POST['email']) {
                        $email = $_POST['email'];
                        $verify_query = $conn->prepare("SELECT * FROM marque WHERE email=?");
                        $verify_query->execute(array($email));

                        if ($verify_query->rowCount() > 0) {
                            echo "<p>This email is already used. Please use a different email.</p>";
                            $update_st =null;
                        $_SESSION['email'] = $email_id;

                        } else {
                            $update_st->bindParam('email', $_POST['email']);
                        }
                    }
                          
                    if ($_POST['motdepasse']) {
                  $update_st ->bindParam('motdepasse',$_POST['motdepasse']);
                      } 
                    if ($_POST['datedecreation']) {
                        $update_st ->bindParam('datedecreation',$_POST['datedecreation']);
                            }
                    if ($_POST['fax_tel']) {
                        $update_st ->bindParam('fax_tel',$_POST['fax_tel']);
                            }
                    if ($_POST['adresse']) {
                        $update_st ->bindParam('adresse',$_POST['adresse']);
                            }

                    if ($_POST['domaine']) {
                        $update_st ->bindParam('domaine',$_POST['domaine']);
                            }  
     
                           
                     if ($_POST['chiffredaffaire']) {
                         $update_st ->bindParam('chiffredaffaire',$_POST['chiffredaffaire']);
                             }
                    if ($_POST['nomderep']) {
                         $update_st ->bindParam('nomderep',$_POST['nomderep']);
                             }
                     if ($_POST['prenomderep']) {
                         $update_st ->bindParam('prenomderep',$_POST['prenomderep']);
                             }  

                      if ($_POST['emailderep']) {
                          $update_st ->bindParam('emailderep',$_POST['emailderep']);
                              }
                      if ($_POST['gsm']) {
                          $update_st ->bindParam('gsm',$_POST['gsm']);
                              }  
                                   
                      if ( $logo_name) {
                        $update_st->bindParam(':logo', $logo_name);
                      } 
                          
                      if ($update_st !=null && $update_st->execute()) {
                        echo 'good';
                        header('Location:profil_marque.php');
                      }else {
                        echo 'non';
                      }
                  }

                }
         
  ?>
                  
                <div class="form">


                        <h1>PROFILE</h1>
                    <h3>Make the changes you want</h3>
       
                   

                
                    <form action=""  method="POST" enctype="multipart/form-data" >
                      <div class="forum">

                      
                    <div class="marque">
                <label for="image">Entrez votre photo <span> *</span> : </label>
                <input type="file" name="logo" id="image" accept="image/*">
                <br>

                <label for="nom">Nom <span> *</span> :</label>
                <input type="text" name="nom"   placeholder="entrez votre Nom">
                <br>



                <label for="motdepasse">Mot de passe <span> *</span>:</label>
                <input type="password" name="motdepasse" id = "motdepasse"  placeholder="entrez votre mot de passe">
                <br>

                <label for="datedecreation">Date <span> *</span> :</label>
                <input type="date"   name="datedecreation">
                <br>


                <label for="email">Email <span> *</span> :</label>
                <input type="text" name="email" value=""  placeholder="entrez votre email">
                <br>

                <label for="fix">FAX TEL <span> *</span> :</label>
                <input type="text" name="fax_tel" value=""  placeholder="entrez votre email">
                <br>

                  <label for="adresse">Adresse <span> *</span> :</label>
                  <input type="text" name="adresse"   placeholder="entrez votre adresse">
                  <br>


                <label for="domaine">Domaine <span> *</span>:</label>

                <input type="text" name="domaine"  placeholder="entrez votre domaine">
                <br>


                <label for="chiffredaffaire">chiffre <span> *</span> :</label>
                <input type="text" name="chiffredaffaire" value=""  placeholder="entrez votre email">
                <br>
                </div>
                <div class="rep">
                <label for="nomderep">NOM DE REPRESENTANT <span> *</span> :</label>
                <input type="text" name="nomderep" value=""  placeholder="entrez votre email">
                <br>

                  <label for="prenomderep">PRENOM DE REPRESENTANT <span> *</span> :</label>
                  <input type="text" name="prenomderep"   placeholder="entrez votre adresse">
                  <br>


                <label for="emailderep">EMAIL DE REPRESENTANT <span> *</span>:</label>
                <input type="text" name="emailderep"  placeholder="entrez votre domaine">
                <br>


                <label for="gsm">GSM DE REPRESENTANT <span> *</span>:</label>
                <input type="text" name="gsm"  placeholder="entrez votre domaine">
                </div>
                </div>
               

                  <input class="submit" type="submit" value="upload" name="submit">
                </form>

                 
                  <a  href="profil_marque.php"> <button class="btn">return</button></a>



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


