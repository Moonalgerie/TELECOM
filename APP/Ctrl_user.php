<?php
session_start(); 
$_POST["ok"]="1"; 
 
if (isset($_POST["ok"]))
{
	$ident=$_POST["ident"];
	$password=$_POST["pass"];

$host = "localhost";
$user = "root";
$pass = "azerty";

$bdd  = "gestion_pavc";
$link1 = @mysql_connect($host,$user,$pass)
   or die("Connection impossible");
@mysql_select_db($bdd, $link1)
   or die("Connection impossible à la base de données");


$requete = mysql_query("SELECT  `user`.*,`fonction`.`Design_fonction` FROM user ,`fonction` where pseudo='".$ident."' and password='".$password."' and `user`.`id_fonction` =  `fonction`.`id_fonction`")
 or die ("Erreur ".mysql_errno()." : " . mysql_error());
$row=mysql_fetch_array($requete);
$rows=mysql_affected_rows();

if ($rows > 0)
{
	@$_SESSION['Nom_user']=$row['Nom_user'];
	@$_SESSION['Prenom_user']=$row['Prenom_user'];
	@$_SESSION['pseudo']=$row['pseudo'];
	@$_SESSION['id_fonction']=$row['id_fonction'];
	@$_SESSION['Design_fonction']=$row['Design_fonction'];
	
  header('Location: /gestion_pavc/Accueil.php');
  exit();
}
else{
  header('Location: /gestion_pavc/index.php');
  exit();
}
}
else{
	
echo "Imbécile!!!!";

}

?> 
