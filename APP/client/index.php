<?php
session_start();
include '../DBConfig.php';
//Insert or Update contact information
if(isset($_POST['action_type']))
{
	if ($_POST['action_type'] == 'add' or $_POST['action_type'] == 'edit')
	{
		//Sanitize the data and assign to variables
		$id_client = mysqli_real_escape_string($link, strip_tags($_POST['ContactID']));
		$nom_client = mysqli_real_escape_string($link, strip_tags($_POST['nom_client']));
		$Adr_client = mysqli_real_escape_string($link, strip_tags($_POST['Adr_client']));
	    $Initials_client = mysqli_real_escape_string($link, strip_tags($_POST['Initials_client']));
		$Description_client = mysqli_real_escape_string($link, strip_tags($_POST['Description_client']));
		$id_departement = mysqli_real_escape_string($link, strip_tags($_POST['id_departement']));
		$id_user = mysqli_real_escape_string($link, strip_tags($_POST['id_user']));
		
				
		if ($_POST['action_type'] == 'add')
		{
			$sql = "insert into client set 
					nom_client = '$nom_client',
					Adr_client = '$Adr_client',
					Initials_client = '$Initials_client',
					Description_client = '$Description_client',
					id_user = '$id_user',
				    id_departement = '$id_departement'";
				
		}else{
			$sql = "update client set 
					nom_client = '$nom_client',
					Adr_client = '$Adr_client',
	      			Initials_client = '$Initials_client',
					Description_client = '$Description_client',
					id_departement = '$id_departement',
					id_user = '$id_user',
					where id_client = $id_client";
					
		}
		
		
		if (!mysqli_query($link, $sql))
		{
			echo 'Erreur d"/enrgistrement . ' . mysqli_error($link);
			exit();	
		}
	}
	header('Location: consulter_client.php');
	exit();
}
//End Insert or Update contact information

//Start of edit contact read
$gresult = ''; //declare global variable
if(isset($_POST["action"]) and $_POST["action"]=="edit"){
	$id = (isset($_POST["ci"])? $_POST["ci"] : '');
	$sql = " SELECT
`departement`.`Nom_departement`,
`user`.`Nom_user`,
`client`.`nom_client`,
`client`.`Adr_client`,
`client`.`Description_client`,
`client`.`Initials_client`
FROM
`client` ,
`user` ,
`departement`
WHERE
`client`.`id_departement` =  `departement`.`id_departement` AND
`client`.`id_user` =  `user`.`id_user` and id_client = $id";

	$result = mysqli_query($link, $sql);

	if(!$result)
	{
		echo mysqli_error($link);
		exit();
	}
	
	$gresult = mysqli_fetch_array($result);
	
	include 'form_client.php';
	exit();
}
//end of edit contact read

//Start Delete Contact
if(isset($_POST["action"]) and $_POST["action"]=="delete"){
	$id = (isset($_POST["ci"])? $_POST["ci"] : '');
	$sql = "delete from client 
			where id_client = $id";

	$result = mysqli_query($link, $sql);

	if(!$result)
	{
		echo mysqli_error($link);
		exit();
	}
	
}
//End Delete Contact

//Read contact information from database
$sql ="SELECT
`departement`.`Nom_departement`,
`user`.`Nom_user`,
`client`.`nom_client`,
`client`.`Adr_client`,
`client`.`Description_client`,
`client`.`Initials_client`,
`departement`.`id_departement`,
`client`.`id_client`
FROM
`client` ,
`user` ,
`departement`
WHERE
`client`.`id_departement` =  `departement`.`id_departement` AND
`client`.`id_user` =  `user`.`id_user`
" ;
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
	$contact_list[] = array('id_client' => $rows['id_client'], 
							'nom_client' => $rows['nom_client'],
							'Adr_client' => $rows['Adr_client'],
							'id_departement' => $rows['id_departement'],
							'Nom_departement' => $rows['Nom_departement'],
							'Initials_client' => $rows['Initials_client'],
							'Nom_user' => $rows['Nom_user'],
							'Description_client' => $rows['Description_client']);
}
include 'consulter_client.php';
exit();
?>