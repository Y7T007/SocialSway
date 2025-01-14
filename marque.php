<?php

try {


    $pdo = new PDO("mysql:host=localhost;dbname=projet1;port=3308","root","");

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_CONNECTION_STATUS, true);
}catch(PDOException $e){
    die("error: could not connect" . $e->getMessage());
}
/*try{
    $sql ="CREATE TABLE Marque (
        id int(11) NOT NULL primary key AUTO_INCREMENT,
        logo Varchar(100);
        nom varchar(40) NOT NULL,
        motdepasse varchar(50) NOT NULL ,
        datedecreation date NOT NULL,
        email varchar(100) NOT NULL,
        fax_tel varchar(50) NOT NULL,
        adresse varchar(150) NOT NULL,
        domaine varchar(200) NOT NULL,
        chiffredaffaire int(11) NOT NULL,
        nomderep varchar(30) NOT NULL,
        prenomderep varchar(30) NOT NULL,
        emailderep varchar(150) NOT NULL,
        gsm int(11) NOT NULL
      )" ;
     $pdo->exec($sql);
      }catch(PDOException $e){
      die("error :not created" . $e->getMessage());}*/
      if (isset($_POST['email'])) {
        $password = $_POST['password'];
        $email = $_POST['email'];
    
      
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try {
                    $stmt = $pdo->prepare("SELECT * FROM influencer WHERE EMAIL=?");
                    $stmt->execute(array($email));
    
                    if ($stmt->rowCount() > 0) {
                        echo "<script>confirm(\"Cet e-mail est déjà pris. Veuillez utiliser une adresse e-mail différente!!!\");</script>";
                    } else {
                        $filename = $_FILES["logo"]["name"];
                        $tempname = $_FILES["logo"]["tmp_name"];
                        $folder = "./image/" . $filename;
                        move_uploaded_file($tempname, $folder);
    
                        $sql = "INSERT INTO Marque (logo, nom, motdepasse, datedecreation, email, fax_tel, adresse, domaine, chiffredaffaire, nomderep, prenomderep, emailderep, gsm)
                                VALUES (:logo, :nom, :motdepasse, :datedecreation, :email, :fax_tel, :adresse, :domaine, :chiffre, :nomr, :prenomr, :emailr, :gsmr)";
    
                        $st = $pdo->prepare($sql);
                        $st->bindParam(':logo', $filename);
                        $st->bindParam(':nom', $_REQUEST['nom']);
                        $st->bindParam(':motdepasse', $_REQUEST['password']);
                        $st->bindParam(':datedecreation', $_REQUEST['datecr']);
                        $st->bindParam(':email', $_REQUEST['email']);
                        $st->bindParam(':fax_tel', $_REQUEST['Tel']);
                        $st->bindParam(':adresse', $_REQUEST['adresse']);
                        $st->bindParam(':domaine', $_REQUEST['domaine']);
                        $st->bindParam(':chiffre', $_REQUEST['chiffreda']);
                        $st->bindParam(':nomr', $_REQUEST['nomrp']);
                        $st->bindParam(':prenomr', $_REQUEST['prenom']);
                        $st->bindParam(':emailr', $_REQUEST['emailrp']);
                        $st->bindParam(':gsmr', $_REQUEST['gsm']);
                        $st->execute();
    
                        header("Location: login.php");
                        exit();
                    }
                } catch (PDOException $e) {
                    die("Error: " . $e->getMessage());
                }
            }
       
    }
    
 
  




?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <link rel="stylesheet" href="marque.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <title>Document</title>
</head>

<body>
 <div class="container"> 
       <form action="marque.php" method="post" enctype="multipart/form-data">
                 
               
                   <div class="parent" >
                        <div class="div1"><h1 align="center">Inscription</h1>
                        </div>
                        <div class="div2">  
                            <label for="logo">Logo  <span> *</span>:</label>
                            <input type="file" name="logo" required> 
                        </div>
                        <div class="div3"> 
                            <label for="nom">Nom <span> *</span>:</label>
                            <input type="text" name="nom" required placeholder="entrez le Nom de votre marque">
                        </div>
                        <div class="div4"> 
                            <label for="email">Email <span> *</span>:</label>
                            <input type="email" name="email"   required  placeholder="entrez votre email">
                        </div>
                        <div class="div5"> 
                            <label for="tel">Fax/Tel <span> *</span>:</label>
                            <input type="text" name="Tel" required placeholder="entrez votre téléphone">
                        </div>
                        <div class="div6"> 
                            <label for="datecr">Date de création:</label>
                            <input type="date" name="datecr">
                        </div>
                        <div class="div7"> 
                            <label for="adresse">Adresse:</label>
                            <input type="text" name="adresse" placeholder="entrez votre adresse">
                       </div>
                       <div class="div8"> 
                            <label for="password">le mot de passe  <span> *</span>:</label>
                            <input type="password" name="password" id="password"  required placeholder="entrez votre mot de passe">
                            <i class="far fa-eye" id="togglePassword"></i>
                        </div>
                        <div class="div9">    
                            <label for="passwordconfr">confirmer<span> *</span>:</label>
                            <input type="password"  id="passwordconfr" name="passwordconfr" required placeholder="confirmer votre mt de passe ">
                            <i class="far fa-eye" id="toggleConfirmPassword"></i>
                        </div>
                        <div class="div10"> 
                            <label for="domaine">Domaine <span> *</span>:</label>
                            <input type="text" name="domaine" required placeholder="entrez votre domaine">
                        </div>
                        <div class="div11"> 
                            <label for="chiffreda">Chiffre d'affaires:</label>
                            <input type="text" name="chiffreda">
                        </div>
                        
                            
                                
                                    <div class="div12">
                                       <h3 align="center">  Fiche de représentant</h3> 
                                    </div>
                                    <div class="div13"> 
                                            <label for="nomrp">Nom:</label>
                                            <input type="text" name="nomrp" placeholder="entrez votre nom">
                                    </div>
                                    <div class="div14"> 
                                            <label for="prenom">Prénom:</label>
                                            <input type="text" name="prenom" placeholder="entrez votre prénom">
                                    </div>
                                    <div class="div15"> 
                                            <label for="emailrp">Email <span> *</span>:</label>
                                            <input type="email" name="emailrp" required placeholder="entrez votre email">
                                    </div>
                                    <div class="div16"> 
                                            <label for="gsm">GSM <span> *</span>:</label>
                                            <select name="country-code">
                                                <option value="+212">Morocco (+212)</option>
                                                <option value="+1">United States (+1)</option>
                                                <option value="+44">United Kingdom (+44)</option>
                                                <option value="+33">France (+33)</option>
                                            </select>
                                           <input type="text" name="gsm" id="gsm" required placeholder="entrez votre téléphone">
                                   </div>
                                
                            
                
                       <div class="div17"> 
                          <input type="submit" value="     s'inscrire" class="btn" name="upload"> 
                        </div>
                        <a href="login.php"> Vous avez déjà un compte? </a>
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
   
