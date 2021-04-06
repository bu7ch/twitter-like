<?php 
session_start();

require("config.php");
require("functions/database.fn.php");
// connexion à la database 
$db = getPDO($database);


