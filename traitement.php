<?php $errors = [];
session_start();
require('model.php');
echo "ici c'est le début";
echo "<br>";
if(isset($_POST['emailconn']) && isset($_POST['passwordconn'])){
  $email = $_POST['emailconn'];
  $password = $_POST['passwordconn'];
  $result = connectUser($email, $password);
  if($result == 1){
    echo 'connexion ok';
  }else{
    echo 'connexion pas ok';
    // header('location:connexion.php');
  }
}

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordVerif'])) {
if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['passwordVerif'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $passwordVerif = $_POST['passwordVerif'];
  $email = check($email);
  $password = check ($password);
  $passwordVerif = check($passwordVerif);

  $checkEmail = checkEmail($email);
  $checkPassword = checkPassword($password, $passwordVerif);

    if($checkEmail == 1 && $checkPassword == 1){
      $result = insertUser($email, $password);
      if($result == 'ok'){
      // header('location:index.php');
      echo "C'est ok roger";
      }else{
        $_SESSION['error'] = "La requête n'a pas pu aboutir.";
        echo "Email déjà connue, veuillez vous connecter.";
        // header('location:connexion.php')
      }
        // hachage mdp
        // insertion bdd
    } else {
      $errors = [$checkEmail, $checkPassword];
      $_SESSION['errors'] = $errors;
      echo 'pas 1';
      // header('location:subscribe.php');
    }
  }
}

function checkEmail($email){
  if (filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($email)<50) {
    return 1;
  }else{
    return 'Email non valide';
  }
}

function checkPassword($password, $passwordVerif){
  // if(preg_match('/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/', $password) && $password == $passwordVerif){
    return 1;
  // }else{
  //   return 'Mot de passe non valide';
  // }
}

function check($input){
  trim($input);
  stripslashes($input);
  htmlspecialchars($input);
  return $input;
}
?>
