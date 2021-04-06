<?php
include('config/autoload.php');

if(isset($_POST['inscription']) AND isset($_POST['username']) AND isset($_POST['password'])){
	register($db, $_POST['username'], $_POST['password']);
}

if(isset($_POST['connexion']) AND isset($_POST['username']) AND isset($_POST['password'])){
	login($db, $_POST['username'], $_POST['password']);
}

if(isset($_SESSION['id'])){
	header('Location: home.php');
}

?>
<h1>Twitter</h1>

<h2>Inscription</h2>
<form action="index.php" method="post">
	<input type="text" name="username" placeholder="Nom d'utilisateur">
	<input type="password" name="password" placeholder="Mot de passe">
	<input type="submit" name="inscription" value="Connexion">
</form>

<h2>Connexion</h2>
<form action="index.php" method="post">
	<input type="text" name="username" placeholder="Nom d'utilisateur">
	<input type="password" name="password" placeholder="Mot de passe">
	<input type="submit" name="connexion" value="Connexion">
</form>