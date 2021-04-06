<?php 


function register($db, $username, $password){
  $check = $db->prepare("SELECT * FROM users WHERE username = :username");

  $check->execute(array(
    ':username' => $username
  ));


  if ($userExist = $check->fetch()){
    // si la function renvoie true c'est que l'utilisateur existe
    header('Location : index.php?msg=errorUserExist');
  }
  else{
    //si la function ne renvoie rien c'est que l'utilisateur n'existe pas
    // Comme l'utilisateur n'existe pas, on peut l'inserer dans la database

    $insert = $db->prepare("INSERT INTO users (username,password, created_at, last_login");
    $insert->execute(array(
      ':unsername' => $username,
      ':password'  => sha1($password),
      ':created_at' => date('Y-m-d H:i:s'),
      ':last_login' => date('Y-m-d H:i:s')
    ));
    header('Location:index.php?msg=success');
  }
}