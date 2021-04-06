<?php /* AUTOLOAD.PHP */

session_start();

require('config.php');
require('functions/database.fn.php');
require('functions/user.fn.php');

// Connexion à la base de données
$db = getPDO($database);


