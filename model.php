<?php

$servername = "localhost";
$dbname = "formulaire";
$username = "root";
$password = "";

try{
  $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

  $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  die('erreur :'.$e->getMessage());
}
//créer table si non existante
$query = "CREATE TABLE IF NOT EXISTS `Service` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `mail` VARCHAR(50) NOT NULL ,
  `password` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM;
)";

$request = $dB->prepare($query);
$request->execute();
$request->closeCursor();



function insertUser($email, $password){
  $servername = "localhost";
  $dbname = "formulaire";
  $username = "root";
  $password = "";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    die('erreur :'.$e->getMessage());
  }
  $query = "SELECT `email` FROM `user`";
  $request = $dB->prepare($query);
  $request->execute();

  $result = emailExist($email);

    if($result != 0){
      return 'Votre email est déjà existant, veuillez vous connecter.';
      $request->closeCursor();
    }else{
      $query = "INSERT INTO `user`(`email`, `password`) VALUES (:mail, :password)";
      $password = password_hash($password, PASSWORD_DEFAULT);
      $arrayValue = [
        ':mail'=>$email,
        ':password'=>$password
      ];
      $request = $dB->prepare($query);
      if($request->execute($arrayValue)){
        return 'ok';
      }else{
        return 'pas ok';
      }
      $request->closeCursor();
    }
  }


function emailExist($email){
  $servername = "localhost";
  $dbname = "formulaire";
  $username = "root";
  $password = "";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    die('erreur :'.$e->getMessage());
  }
  $query = "SELECT `email` FROM `user` WHERE `email`=:mail";
  $request = $dB->prepare($query);
  $arrayValue = [
    ':mail'=>$email
    ];
  $request->execute($arrayValue);
  $nb_presence = count($request->fetchAll());
  $request->closeCursor();
  return $nb_presence;
}

function connectUser($email, $password){
  $servername = "localhost";
  $dbname = "formulaire";
  $username = "root";
  $password = "";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    die('erreur :'.$e->getMessage());
  }
  $query = "SELECT `password` FROM `user` WHERE `email`=:mail";
  $request = $dB->prepare($query);
  $arrayValue = [
    ':mail'=>$email
    ];
    if($request->execute($arrayValue)){
      $donnees = $request->fetch();
      if(password_verify($password,$donnees['password'])){
        return 1;
      }else{
        return 2;
      }
      $request->closeCursor();
    }
  }
?>
