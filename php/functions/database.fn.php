<?php 

function getPDO(array $config){
  try {
    return $db = new PDO('mysql:host='.$config['host'].';dbname='.$config['database'], $config['username'], $config['password'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  } catch (Exception $e) {
    //envoie-moi un message par mail en cas de probleme
    mail('dutchr@live.fr', "Erreur sur le site de la mort qui tue", $e->getMessage());
    header("Location: 404.html");
  }
}
