<?php
session_start();

try {
  $pdo = new PDO("mysql:host=localhost;dbname=projet1;port=3308","root","");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_CONNECTION_STATUS, true);
}catch(PDOException $e){
  die("error: could not connect" . $e->getMessage());
}
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
   
    try { 
        $sql = "SELECT id, nom, password, prenom FROM admin WHERE email = :email";
        $st = $pdo->prepare($sql);
        $st->bindParam(':email', $email);                      
        $st->execute(); 
        $data = $st->fetch();
        
        if ($data) {
            if ($password === $data['password']) {
                $_SESSION['nom'] = $data['nom'];
                $_SESSION['id'] = $data['id'];
                $_SESSION['prenom'] = $data['prenom']; 
                
                header("Location: admin.php");
                exit();
            } else {
                // si le mot de passe est incorrect, afficher un message d'erreur
                echo "<script>confirm(\"Mot de passe incorrect. Veuillez réessayer!!!\");</script>";
            }
        } else {
            // utilisateur avec l'e-mail saisi introuvable dans la base de données, afficher un message d'erreur
            echo "<script>confirm(\"Utilisateur non trouvé. Veuillez d'abord vous inscrire!!!\");</script>";
        }
    } catch(PDOException $e) {
        die("Error: " . $e->getMessage());
    }
   

}


  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<link rel="stylesheet" href="login.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

<body>
	
 <div class="container">
       <div class="image">
           <div class="front-box">
              
              <form method="POST" action="adminlogin.php"> 
                     
                  <br>  <h2>Login</h2><br>
                  <div class="input-box">
                     <label for="email">Email : </label>
                     <input type="email" name="email" required>
                  </div> <br>
                  <div class="input-box">
                    <label for="password">Password : </label>
                    <input type="password" name="password" id="password" required >
                    <i class="far fa-eye" id="togglePassword" ></i>
                  </div>
                  
                     <button  class="btn">Se Connecter</button>
                      <div class="grp">    <a href="index.php">homepage  
                      </div>
              </form>
            </div>
        </div>
 </div>

</body>
</html>
<script>
const password = document.getElementById("password")
const togglePassword = document.querySelector('#togglePassword');

togglePassword.addEventListener('click', function (e) {
  // toggle the type attribute
  const passwordType = password.getAttribute('type') === 'password' ? 'text' : 'password';
  password.setAttribute('type', passwordType);
  // toggle the eye slash icon
  this.classList.toggle('fa-eye-slash');
});

</script>


