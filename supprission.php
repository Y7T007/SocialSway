<?php 
session_start();

try {
  $pdo = new PDO("mysql:host=localhost;dbname=projet;port=3308","root","");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_CONNECTION_STATUS, true);
}catch(PDOException $e){
  die("error: could not connect" . $e->getMessage());
}


// Vérifie si le nom d'utilisateur est présent dans la session
if(!isset($_SESSION['nom'])&&$_SESSION['id'])  {
    // Redirige l'utilisateur vers la page de connexion
    header("Location: login.php");
    // Arrête l'exécution du script actuel
    exit();
}

if (isset($_POST['Confirmer']) && $_POST['confirmation'] === 'oui' && isset($_POST['Demande'])) {
  $message = $_POST['Demande'];
  $id = $_SESSION['id'];
  $_SESSION['message'] = $message;
  echo "<script>alert('Votre demande a été soumise avec succès. Merci!');window.location.href='dashboard_inf.php'</script>";

  
  exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Supprimer </title>
</head>
<body>

<form action="supprission.php" method="POST">

  <h3><?php echo $_SESSION['nom']; ?> Êtes-vous SÛR DE VOULOIR supprimer votre compte ?</h3>

  <label for="oui">Oui</label>
  <input type="radio" name="confirmation" value="oui" id="oui">
  <label for="non">Non</label>
  <input type="radio" name="confirmation" value="non" id="non">
  
  <div id="message" style="display: none;">
    <label for="Demande">Veuillez saisir un message pour l'administrateur:</label>
    <textarea name="Demande" id="Demande"></textarea>
  </div>

  <script>
    const ouiRadio = document.getElementById("oui");
    const messageDiv = document.getElementById("message");
    const nonRadio = document.getElementById("non");
      
    ouiRadio.addEventListener("click", function() {
      messageDiv.style.display = "block";
    });

    nonRadio.addEventListener("click", function() {
      messageDiv.style.display = "none";
      window.location.href = "home.php";
    });
  </script>

   <input type="submit" name="Confirmer" value="Confirmer">
</form>




</body>
</html>
