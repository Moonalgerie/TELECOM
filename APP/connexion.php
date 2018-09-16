<?php

$host = "localhost";
$user = "root";
$pass = "azerty";

$bdd  = "gestion_pavc";

$link1 =  @mysql_connect($host,$user,$pass)

   or die(" Connection impossible");
@mysql_select_db($bdd, $link1)
   or die("Connection impossible à la base de données");
  mysql_query("SET NAMES UTF8");// il faut le rajouter pour  Convert les characters
  //il n'il a pas besoin de utilise utf8(); dans les row
    

?>
