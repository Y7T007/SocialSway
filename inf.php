<?php
// creation de base de donnnee
/*try {
  $pdo = new PDO("mysql:host=localhost;dbname=projet1;port=3308","root","");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_CONNECTION_STATUS, true);

  $sql ="CREATE DATABASE projet1";
  $pdo->exec($sql);
} catch(PDOException $e){
  die("error : " . $e->getMessage());
}*/
try {
  $pdo = new PDO("mysql:host=localhost;dbname=projet1;port=3308","root","");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_CONNECTION_STATUS, true);
}catch(PDOException $e){
  die("error: could not connect" . $e->getMessage());
}
//creation de tableau d'influencer 
 /*try{
  $sql ="CREATE TABLE influencer ( 
     id int NOT NULL primary key  AUTO_INCREMENT,
     nom VARCHAR(30) NOT NULL,
     prénom varchar(30) NOT NULL,
     datenaissance date NOT NULL,
     email varchar(200) NOT NULL,
     gsm int NOT NULL,
     adresse varchar(100) NOT NULL,
     genre varchar(1) NOT NULL,
     domaine varchar(120) NOT NULL,
     socialmedia varchar(100) NOT NULL,
     username varchar(40) NOT NULL,
     motdepasse varchar(20) NOT NULL,
     imagee varchar(100)
  )" ;
  $pdo->exec($sql);
}catch(PDOException $e){
  die("error :not created" . $e->getMessage());}
*/
if ( isset($_POST['email'])) {
  $password = $_POST['password'];
 
  $email = $_POST['email'];
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $stmt = $pdo->prepare("SELECT * FROM influencer WHERE email=?");
      $stmt->execute(array($email));
      
    
          if ($stmt->rowCount() > 0) {
              echo "<script>confirm(\"Cet e-mail est déjà pris. Veuillez utiliser une adresse e-mail différente!!!\");</script>";
          } else {
              try {
                  $filename = $_FILES["image"]["name"];
                  $tempname = $_FILES["image"]["tmp_name"];
                  $folder = "./image/" . $filename;
                  move_uploaded_file($tempname, $folder);
                  
                  $sql = "INSERT INTO influencer (imagee, nom, prénom, datenaissance, email, gsm, adresse, genre,Langue,Contient,followers, domaine, socialmedia, username, motdepasse) 
                          VALUES (:imagee, :nom, :prenom, :datenaissance, :email, :gsm, :adresse, :genre,:Langue, :Contient ,:followers , :domaine, :socialmedia, :username, :motdepasse)";
                  
                  $st = $pdo->prepare($sql);
                  $st->bindParam(':imagee', $filename);
                  $st->bindParam(':nom', $_POST['nom']);
                  $st->bindParam(':prenom', $_POST['prenom']);
                  $st->bindParam(':datenaissance', $_POST['datenaissance']);
                  $st->bindParam(':email', $_POST['email']);
                  $st->bindParam(':gsm', $_POST['gsm']);
                  $st->bindParam(':adresse', $_POST['adresse']);
                  $st->bindParam(':genre', $_POST['genre']);
                  $st->bindParam(':Langue', $_POST['Langue']);
                  $st->bindParam(':Contient', $_POST['Contient']);
                  $st->bindParam(':followers', $_POST['followers']);
                  $st->bindParam(':domaine', $_POST['domaine']);
                  $socialmedia = json_encode($_POST['socialmedia']);
                  $username = json_encode($_POST['username']);
                  $st->bindParam(':socialmedia', $socialmedia);
                  $st->bindParam(':username', $username);
                  $st->bindParam(':motdepasse', $password);
                  $st->execute();
                  
                  header("Location: login.php");
                  exit();
              } catch (PDOException $e) {
                  echo "Error: " . $e->getMessage();
              }
          }
  
  }
}


?>
 
<!DOCTYPE html>
<html lang="en">
  <head>
  
      <style>
       
     
      </style>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="inf.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <title>Document</title>
    
  </head>
    
  <body> 
      
   <div class="container"> 
     <form action="inf.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">

     <div class="parent" >
            <div class="div1">
                 <h1 align="center">Inscription</h1>
            </div>
            <div class="div2">
              <label for="image">Entrez votre photo :</label>
              <input type="file" name="image" >
            </div>

            <div class="div3">
              <label for="nom">Nom <span>*</span> :</label>
              <input type="text" name="nom" required placeholder="entrez votre Nom">
            </div>
            <div class="div4">
              <label for="prenom">Prénom <span>*</span> :</label>
              <input type="text" name="prenom" required placeholder="entrez votre Prénom ">
            </div>

            <div class="div5">
              <label for="email">Email <span>*</span> :</label>
              <input type="email" name="email" required placeholder="entrez votre email">
            </div>

            <div class="div6">
              <label for="gsm">GSM <span>*</span> :</label>
              <select name="country-code" class="list">
                <option value="+212">Morocco (+212)</option>
                <option value="+1">United States (+1)</option>
                <option value="+44">United Kingdom (+44)</option>
                <option value="+33">France (+33)</option>
              </select>
              <input type="text" name="gsm" id="gsm" required placeholder="entrez votre telephone">
            </div>
            <div class="div7">
              <label for="adresse">Adresse <span>*</span> :</label>
              <input type="text" name="adresse" required placeholder="entrez votre adresse">
            </div>

            <div class="div8">
              <label for="date">Date <span>*</span> :</label>
              <input type="date" required name="datenaissance">
            </div>
    
    
            <div class="div9">
              <label for="genre">Genre:</label>
              <select name="genre" class="genre">
                <option value="F"><b>F</b></option>
                <option value="M"><b>M</b></option>
              </select>
            </div>
            <div class="div10">
              <label for="langue">Langue:</label>
              <input type="text" name="Langue" placeholder="Entrez votre langue">
            </div>
            <div class="div11">
              <label for="langue">Contient:</label>
              <select name="Contient" name="contient" class="list">
                <option value="l'Afrique">l'Afrique</option>
                <option value="l'Amérique">l'Amérique</option>
                <option value="l'Europe">l'Europe</option>
                <option value=" l'Océanie"> l'Océanie</option>
                <option value="l'Asie">l'Asie</option>
              </select>
            </div>
            
            <div class="div12">
              <label for="domaine">Domaine <span>*</span>:</label>
              <input type="text" name="domaine" required placeholder="entrez votre domaine">
            </div>
            <div class="div13">
              <label for="domaine">Followers:</label>
              <input type="text" name="followers" required placeholder="le nombre moyenne des followers">
            </div>
            <div class="div14">
              <label for="password">Le mot de passe <span>*</span>:</label>
              <input type="password" name="password" id="password" required placeholder="entrez votre mot de passe">
              <i class="far fa-eye" id="togglePassword"></i>
            </div>

            <div class="div15">
              <label for="passwordconfr">Confirmer <span>*</span>:</label>
              <input type="password" id="passwordconfr" name="passwordconfr" placeholder="confirmer votre mot de passe">
              <i class="far fa-eye" id="toggleConfirmPassword"></i>
            </div>
            <div class="div16">
             

                <div id="socialm">
                    <label for="socialmedia">Les réseaux sociaux :</label><br>
                    <div class="socialmediass">
                      <select name="socialmedia[]" class="list">
                        <option value="Instagram">Instagram</option>
                        <option value="Facebook">Facebook</option>
                        <option value="Twitter">Twitter</option>
                      </select>
                      <input type="text" name="username[]" placeholder="entrez votre username">
                      <input type="submit" id="ajoute_compte" value="   Ajouter">
                 </div>
              </div>
       
             </div>
              
            <div class="div17">
                <input type="submit" class="btn" id="submitBtn" value="    s'incrire" >
              
            </div>
            <a href="login.php">Vous avez déjà un compte?</a>
            
            
        </div>
    
      </form>
    </div>
  </body>
</html>
        
<script>
    let passwordInput = document.getElementById("password");

passwordInput.addEventListener("input", function() {
  let password = passwordInput.value;

  let length = password.length >= 8;
  let uppercase = /[A-Z]/.test(password);
  let lowercase = /[a-z]/.test(password);
  let number = /[0-9]/.test(password);

  if (length && uppercase && lowercase && number) {
    passwordInput.setCustomValidity("");
  } else {
    passwordInput.setCustomValidity("Le mot de passe doit comporter au moins 8 caractères, contenir au moins une lettre majuscule, une lettre minuscule et un chiffre");
  }
});
let numberinput = document.getElementById("gsm");
numberinput.addEventListener("input", function() {
let number = numberinput.value.length;
if (number ==9){
     numberinput.setCustomValidity("");
}else {
    numberinput.setCustomValidity("Le Numero doit comporter  9 Numeros ");
  }
});
const addBtn = document.getElementById("ajoute_compte");
     const socialAccounts = document.getElementById("socialm");
     // écouteur d'événement au bouton addBtn qui écoute un événement "clic" Lorsque le bouton est cliqué, la fonction à l'intérieur de l'écouteur d'événement est exécutée.

    addBtn.addEventListener("click", function() {
    //fonction creer un variable  "newaccount "  est affectée à un clone du dernier élément de socialm
    const newAccount = socialAccounts.lastElementChild.cloneNode(true);
    //la fonction ajoute le clone newAccount à la fin du conteneur socialm à l'aide de appendChild()
    socialAccounts.appendChild(newAccount);
  });
   var password = document.getElementById("password")
  , confirm_password = document.getElementById("passwordconfr");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;

const togglePassword = document.querySelector('#togglePassword');
const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');

togglePassword.addEventListener('click', function (e) {
  // toggle the type attribute
  const passwordType = password.getAttribute('type') === 'password' ? 'text' : 'password';
  password.setAttribute('type', passwordType);
  // toggle the eye slash icon
  this.classList.toggle('fa-eye-slash');
});

toggleConfirmPassword.addEventListener('click', function (e) {
  // toggle the type attribute
  const confirmPasswordType = confirm_password.getAttribute('type') === 'password' ? 'text' : 'password';
  confirm_password.setAttribute('type', confirmPasswordType);
  // toggle the eye slash icon
  this.classList.toggle('fa-eye-slash');
});
</script>




