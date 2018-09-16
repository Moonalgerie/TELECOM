<?php
session_start();
include '../DBConfig.php';
//Insert or Update contact information
if(isset($_POST['action_type']))
{
	if ($_POST['action_type'] == 'add' or $_POST['action_type'] == 'edit')
	{
		//Sanitize the data and assign to variables
		$id_tache_projet = mysqli_real_escape_string($link, strip_tags($_POST['id_tache_projet']));
		$id_tache = mysqli_real_escape_string($link, strip_tags($_POST['id_tache']));
		$id_projet = mysqli_real_escape_string($link, strip_tags($_POST['id_projet']));
		$date_debut_tache = mysqli_real_escape_string($link, strip_tags($_POST['date_debut_tache']));
		$date_fin_tache = mysqli_real_escape_string($link, strip_tags($_POST['date_fin_tache']));
		$Priorite_tache = mysqli_real_escape_string($link, strip_tags($_POST['Priorite_tache']));
		
				
		if ($_POST['action_type'] == 'add')
		{
			$sql = "insert into tache_projet set 
					id_tache = '$id_tache',
					id_projet = '$id_projet',
					date_debut_tache = '$date_debut_tache',
					date_fin_tache = '$date_fin_tache',
					Priorite_tache = '$Priorite_tache'";
					
					
		}else{
			$sql = "update tache_projet set 
					id_tache = '$id_tache',
					id_projet = '$id_projet',
					date_debut_tache = '$date_debut_tache',
					date_fin_tache = '$date_fin_tache',
					Priorite_tache = '$Priorite_tache'
					where id_tache_projet = $id_tache_projet";
					
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
	header('Location: consulter_tache.php');
	exit();
	}  else 
	header('Location: ../consultation/afficher_tache.php');
	exit();
}
//End Insert or Update contact information

//Start of edit contact read
$gresult = ''; //declare global variable
if(isset($_POST["action"]) and $_POST["action"]=="edit"){
	$id = (isset($_POST["ci"])? $_POST["ci"] : '');
	$sql = "SELECT
`tache_projet`.`id_tache_projet`,
`tache_projet`.`id_tache`,
`tache_projet`.`id_projet`,	
`tache_predifinie`.`Design_tache`,
`tache_projet`.`Priorite_tache`,
`tache_projet`.`date_debut_tache`,
`tache_projet`.`date_fin_tache`,
`projet`.`Design_projet`
FROM
`tache_projet` ,
`projet` ,
`tache_predifinie` 
WHERE
`tache_projet`.`id_tache` =  `tache_predifinie`.`id_tache` AND
`tache_projet`.`id_projet` =  `projet`.`id_projet`
and id_tache_projet = $id";

	$result = mysqli_query($link, $sql);

	if(!$result)
	{
		echo mysqli_error($link);
		exit();
	}
	
	$gresult = mysqli_fetch_array($result);
	
	include 'form_tache.php';
	exit();
}
//end of edit contact read

//Start Delete Contact
if(isset($_POST["action"]) and $_POST["action"]=="delete"){
	$id = (isset($_POST["ci"])? $_POST["ci"] : '');
	$sql = "delete from tache_projet 
			where id_tache_projet = $id";

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
`tache_projet`.`id_tache_projet`,
`tache_projet`.`id_tache`,
	
`tache_predifinie`.`Design_tache`,
`tache_projet`.`Priorite_tache`,
`tache_projet`.`date_debut_tache`,
`tache_projet`.`date_fin_tache`,
`projet`.`Design_projet`
FROM
`tache_projet` ,
`projet` ,
`tache_predifinie` 
WHERE
`tache_projet`.`id_tache` =  `tache_predifinie`.`id_tache` AND
`tache_projet`.`id_projet` =  `projet`.`id_projet`";

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
	$contact_list[] = array( 'id_tache_projet' => $rows['id_tache_projet'],
	                         'Design_tache' => $rows['Design_tache'],
	                         'Design_projet' => $rows['Design_projet'],
							 'date_debut_tache' => $rows['date_debut_tache'],
							 'date_fin_tache' => $rows['date_fin_tache'],
							 'Priorite_tache' => $rows['Priorite_tache']);
}
include 'consulter_tache.php';
exit();
?>