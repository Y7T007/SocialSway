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
        $sql = "SELECT id , nom, motdepasse, imagee FROM influencer WHERE email = :email "; 
        $st = $pdo->prepare($sql);
        $st->bindParam(':email', $email);                      
        $st->execute(); 
        $data = $st->fetch();
        
        if ($data) {
            if ($password === $data['motdepasse']) {
                $_SESSION['nom'] = $data['nom'];
                $_SESSION['id'] = $data['id'];
                $_SESSION['image'] = 'image/' . $data['imagee']; 
                
                header("Location: home.php");
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
   



// marque
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    try { 
        $sql = "SELECT nom, motdepasse,logo,id FROM marque WHERE email = :email "; 
        $st = $pdo->prepare($sql);
        $st->bindParam(':email', $email);            
        $st->execute(); 
        $data = $st->fetch();

        if ($data) {
            if ($password === $data['motdepasse']) {
                $_SESSION['nom'] = $data['nom'];
                $_SESSION['id'] = $data['id'];
                $_SESSION['email'] = $email;
                $_SESSION['logo'] = 'image/' . $data['logo']; 
                header("Location: homemarque.php");
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


<body>
	
 <div class="container">
       <div class="image">
           <div class="front-box">
              
              <form method="POST" action="login.php"> 
                     
                  <br>  <h2>Login</h2><br>
                  <div class="input-box">
                     <label for="email">Email : </label>
                     <input type="email" name="email" required>
                  </div> <br>
                  <div class="input-box">
                    <label for="password">Password : </label>
                    <input type="password" name="password" required >
                  </div>
                  
                 <button  class="btn">Se Connecter</button>
                      <div class="grp">
                         <a href="index.php">S'inscrir</a>
                         
                      </div>
              </form>
            </div>
        </div>
 </div>

</body>
</html>


