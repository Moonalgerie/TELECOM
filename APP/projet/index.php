<?php
session_start();
include '../DBConfig.php';
//Insert or Update contact information
if(isset($_POST['action_type']))
{
	if ($_POST['action_type'] == 'add' or $_POST['action_type'] == 'edit')
	{
		//Sanitize the data and assign to variables
		$id_projet = mysqli_real_escape_string($link, strip_tags($_POST['id_projet']));
		$Design_projet = mysqli_real_escape_string($link, strip_tags($_POST['Design_projet']));
		$id_client = mysqli_real_escape_string($link, strip_tags($_POST['id_client']));
		$id_user = mysqli_real_escape_string($link, strip_tags($_POST['id_user']));
		$id_fourn = mysqli_real_escape_string($link, strip_tags($_POST['id_fourn']));
		$date_debut_projet = mysqli_real_escape_string($link, strip_tags($_POST['date_debut_projet']));
		$date_fin_projet = mysqli_real_escape_string($link, strip_tags($_POST['date_fin_projet']));
		$Description_projet = mysqli_real_escape_string($link, strip_tags($_POST['Description_projet']));
		
				
		if ($_POST['action_type'] == 'add')
		{
			$sql = "insert into projet set 
					Design_projet = '$Design_projet',
					id_client = '$id_client',
					id_user = '$id_user',
					date_debut_projet = '$date_debut_projet',
					date_fin_projet = '$date_fin_projet',
					Description_projet = '$Description_projet'";
//pour executer la 1er requetter 		  
mysqli_query($link, $sql);
//pour requepere l ID de 1er table et rajouter dans la 2eme table projet Founrisseur 
$sql2 = "insert into projet_fournisseur set 
					id_projet = '".mysqli_insert_id($link)."',
					id_fourn='$id_fourn'
					";
					

				
		}else{
			$sql = "update projet set 
					Design_projet = '$Design_projet',
					id_client = '$id_client',
					id_user = '$id_user',
					date_debut_projet = '$date_debut_projet',
					date_fin_projet = '$date_fin_projet',
					Description_projet = '$Description_projet'
					where id_projet = $id_projet";
		}
		
// pour executer la 1er requette 		
		mysqli_query($link, $sql);
//pour modifier la 2eme table 
		$sql2 = "update projet_fournisseur set 
					id_fourn='$id_fourn'
					where id_projet = $id_projet";
		
		if (!mysqli_query($link, $sql2))
		{

			//echo $sql; exit(); //pour test la requette dans mysql
			echo 'Erreur d"/enrgistrement . ' . mysqli_error($link);
			exit();	
		}
	}
	if ($_SESSION['id_fonction'] == '1')
	{
	header('Location: consulter_projet.php');
	exit();
	}  else 
	header('Location: ../consultation/afficher_projet.php');
	exit();
}
//End Insert or Update contact information

//Start of edit contact read
$gresult = ''; //declare global variable
if(isset($_POST["action"]) and $_POST["action"]=="edit"){
	$id = (isset($_POST["ci"])? $_POST["ci"] : '');
$sql = "SELECT
`projet`.`Design_projet`,
`projet`.`Description_projet`,
`projet`.`date_debut_projet`,
`projet`.`date_fin_projet`,
`client`.`nom_client`,
`client`.`Initials_client`,
`fournisseur`.`Nom_fourn`,
`user`.`Nom_user`,
`user`.`Prenom_user`,
`user`.`pseudo`,
`fournisseur`.`id_fourn`,
`projet`.`id_projet`,
`client`.`id_client`,
`user`.`id_user`
FROM
`fournisseur` ,
`projet` ,
`projet_fournisseur`,
`client` ,
`user`
WHERE
`projet`.`id_user` =  `user`.`id_user` AND
`projet`.`id_client` =  `client`.`id_client` and
`projet`.`id_projet` = `projet_fournisseur`.`id_projet`  AND
`projet_fournisseur`.`id_fourn` =  `fournisseur`.`id_fourn` and 
`projet`.`id_projet` = $id";

	$result = mysqli_query($link, $sql);

	if(!$result)
	{
		echo mysqli_error($link);
		exit();
	}
	
	$gresult = mysqli_fetch_array($result);
	
	include 'form_projet.php';
	exit();
}
//end of edit contact read

//Start Delete Contact
if(isset($_POST["action"]) and $_POST["action"]=="delete"){
	$id = (isset($_POST["ci"])? $_POST["ci"] : '');
	$sql = "delete from projet 
			where id_projet = $id";

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
`projet`.`id_projet`,
`fournisseur`.`Nom_fourn`,
`projet`.`Design_projet`,
`projet`.`date_debut_projet`,
`projet`.`date_fin_projet`,
`projet`.`Description_projet`,
`client`.`nom_client`,
`user`.`Nom_user`
FROM
`fournisseur` ,
`projet` ,
`projet_fournisseur`,
`client` ,
`user`
WHERE
`projet`.`id_user` =  `user`.`id_user` AND
`projet`.`id_client` =  `client`.`id_client` and
`projet_fournisseur`.`id_projet` =  `projet`.`id_projet` AND
`projet_fournisseur`.`id_fourn` =  `fournisseur`.`id_fourn`

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
	$contact_list[] = array( 'id_projet' => $rows['id_projet'],
	                         'Design_projet' => $rows['Design_projet'],
	                         'nom_client' => $rows['nom_client'],
							 'date_debut_projet' => $rows['date_debut_projet'],
							 'date_fin_projet' => $rows['date_fin_projet'],
							 'Nom_fourn' => $rows['Nom_fourn'],
							 'Nom_user' => $rows['Nom_user'],
						'Description_projet' => $rows['Description_projet']);
}
include 'consulter_projet.php';
exit();
?>