<?php

function register($db, $username, $password){

	$check = $db->prepare('SELECT * FROM users WHERE username = :username');
	$check->execute(array(
		':username'	=>	$username
	));

	if($userExist = $check->fetch() ){
		// Si la fonction renvoie true, c'est que l'utilisateur existe
		header('Location: index.php?msg=errorUserExist');
	}
	else{
		// Si la fonction ne renvoie rien, c'est que l'utilisateur n'existe pas
		// Comme l'utilisateur n'existe pas, on peut l'insérer en base de données
		$insert = $db->prepare('INSERT INTO users (username, password, created_at, last_login) 
			VALUES (:username, :password, :created_at, :last_login)');
		$insert->execute(array(
			':username'	=>	$username,
			':password'	=>	sha1($password),
			':created_at'	=>	date('Y-m-d H:i:s'),
			':last_login'	=>	date('Y-m-d H:i:s')
		));
		header('Location: index.php?msg=success');
	}

}

function login($db, $username, $password){
	$check = $db->prepare('SELECT * FROM users WHERE username = :username');
	
	$check->execute(array(
		':username'	=>	$username
	));

	if($userExist = $check->fetch() ){
		// Si la fonction renvoie true, c'est que l'utilisateur existe
		// On verifie désormais que le mot de passe correspond à la base de données
		if($userExist['password'] == sha1($password)){
			// L'utilisateur est connecté. On met à jour la colonne "last_login"
			$update = $db->prepare('UPDATE users SET last_login = :last_login WHERE id = :id');
			$update->execute(array(
				':last_login'	=>	date('Y-m-d H:i:s'),
				':id'			=>	$userExist['id']
			));
			// On crée desormais les sessions
			$_SESSION['id'] = $userExist['id'];
			$_SESSION['username'] = $userExist['username'];
			$_SESSION['created_at'] = $userExist['created_at'];
			$_SESSION['last_login'] = $userExist['last_login'];
		}
		else{
			// Les mots de passe ne correspondent pas
			header('Location: index.php?msg=errorConnexion');
		}
	}
	else{
		header('Location: index.php?msg=errorConnexion');
	}		
}