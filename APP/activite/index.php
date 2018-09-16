<?php
session_start(); 
include '../DBConfig.php';
//Insert or Update contact information
if(isset($_POST['action_type']))
{
	if ($_POST['action_type'] == 'add' or $_POST['action_type'] == 'edit')
	{
		//Sanitize the data and assign to variables
		$id_activite = mysqli_real_escape_string($link, strip_tags($_POST['id_activite']));
		$Design_activite = mysqli_real_escape_string($link, strip_tags($_POST['Design_activite']));
		$id_user = mysqli_real_escape_string($link, strip_tags($_POST['id_user']));
		$date_debut_activite = mysqli_real_escape_string($link, strip_tags($_POST['date_debut_activite']));
		$date_fin_activite = mysqli_real_escape_string($link, strip_tags($_POST['date_fin_activite']));
		$priorite_activite = mysqli_real_escape_string($link, strip_tags($_POST['priorite_activite']));
		
				
		if ($_POST['action_type'] == 'add')
		{
			$sql = "insert into activite set 
					id_user = '$id_user',
					Design_activite = '$Design_activite',
				    date_debut_activite = '$date_debut_activite',
					date_fin_activite = '$date_fin_activite',
					priorite_activite = '$priorite_activite'";
					
					
		}else{
			$sql = "update activite set 
					id_user = '$id_user',
					Design_activite = '$Design_activite',
					date_debut_activite = '$date_debut_activite',
					date_fin_activite = '$date_fin_activite',
					priorite_activite = '$priorite_activite'
					where id_activite = $id_activite";
					
		}
		
		
		if (!mysqli_query($link, $sql))
		{
			//echo $sql; exit(); //pour test la requette dans mysql
			echo 'Erreur d"/enrgistrement . ' . mysqli_error($link);
			exit();	
		}
	}
	if ($_SESSION['id_fonction'] == '1')
	{
	header('Location: consulter_activite.php');
	exit();
	}  else 
	header('Location: ../consultation/afficher_activite.php');
	exit();
}
//End Insert or Update contact information

//Start of edit contact read
$gresult = ''; //declare global variable
if(isset($_POST["action"]) and $_POST["action"]=="edit"){
	$id = (isset($_POST["ci"])? $_POST["ci"] : '');
	$sql = "SELECT
`activite`.`id_activite`,
`activite`.`Design_activite`,
`activite`.`date_debut_activite`,
`activite`.`date_fin_activite`,
`activite`.`priorite_activite`,
`user`.`Nom_user`,
`user`.`id_user`
FROM
`activite` ,
`user` 
WHERE
`activite`.`id_user` =  `user`.`id_user` AND
 id_activite = $id";

	$result = mysqli_query($link, $sql);

	if(!$result)
	{
		echo mysqli_error($link);
		exit();
	}
	
	$gresult = mysqli_fetch_array($result);
	
	include 'form_activite.php';
	exit();
}
//end of edit contact read

//Start Delete Contact
if(isset($_POST["action"]) and $_POST["action"]=="delete"){
	$id = (isset($_POST["ci"])? $_POST["ci"] : '');
	$sql = "delete from activite 
			where id_activite = $id";

	$result = mysqli_query($link, $sql);

	if(!$result)
	{
		echo mysqli_error($link);
		exit();
	}
	
}
//End Delete Contact

//Read contact information from database
$sql = "SELECT
`activite`.`id_activite`,
`activite`.`Design_activite`,
`activite`.`date_debut_activite`,
`activite`.`date_fin_activite`,
`activite`.`priorite_activite`,
`user`.`Nom_user`
FROM
`activite` ,
`user` 
WHERE
`activite`.`id_user` =  `user`.`id_user`
";


$result = mysqli_query($link, $sql);

if(!$result)
{
	echo mysqli_error($link);
	exit();
}

$contact_list = array();
//Loo through each row on array and store the data to $contact_list[]
while($rows = mysqli_fetch_array($result))
{
	$contact_list[] = array( 'id_activite' => $rows['id_activite'],
	                         'Design_activite' => $rows['Design_activite'],
							 'Nom_user' => $rows['Nom_user'],
							 'date_debut_activite' => $rows['date_debut_activite'],
							 'date_fin_activite' => $rows['date_fin_activite'],
							 'priorite_activite' => $rows['priorite_activite']);
}
include 'consulter_activite.php';
exit();
?>