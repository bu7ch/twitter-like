<?php

function getPDO(array $config){
	try{
		return $db = new PDO('mysql:host='.$config['host'].';dbname='.$config['database'], $config['username'], $config['password'], array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')); 	

	}
	catch(Exception $e)
	{
		/* Envoyez vous un message par mail en cas de problèmes sur votre site */
		mail('dutchr@live.fr', 'Erreur sur le site NUL', $e->getMessage());
		/* Redirection vers la page 404 que vous devrez créer et designer à votre goût */
		header('Location: 404.html');
	}
}
