<?php 
session_start();

require("config.php");
require("functions/database.fn.php");
require("functions/user.fn.php");
// connexion à la database 
$db = getPDO($database);


