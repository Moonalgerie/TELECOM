<?php
session_start();
include '../DBConfig.php';
//Insert or Update contact information
if(isset($_POST['action_type']))
{
	if ($_POST['action_type'] == 'add' or $_POST['action_type'] == 'edit')
	{
		//Sanitize the data and assign to variables
		$id_contact_client = mysqli_real_escape_string($link, strip_tags($_POST['ContactID']));
		$nom_contact_client = mysqli_real_escape_string($link, strip_tags($_POST['nom_contact_client']));
		$prenom_contact_client= mysqli_real_escape_string($link, strip_tags($_POST['prenom_contact_client']));
		$email_contact_client = mysqli_real_escape_string($link, strip_tags($_POST['email_contact_client']));
		$adr_contact_client = mysqli_real_escape_string($link, strip_tags($_POST['adr_contact_client']));
		$id_client = mysqli_real_escape_string($link, strip_tags($_POST['id_client']));
		$tel_contact_client = mysqli_real_escape_string($link, strip_tags($_POST['tel_contact_client']));
		
				
		if ($_POST['action_type'] == 'add')
		{
			$sql = "insert into contact_client set 
					nom_contact_client = '$nom_contact_client',
					prenom_contact_client = '$prenom_contact_client',
					email_contact_client = '$email_contact_client',
					adr_contact_client = '$adr_contact_client',
					tel_contact_client = '$tel_contact_client',
					id_client = '$id_client'";
		}else{
			$sql = "update contact_client set 
					nom_contact_client = '$nom_contact_client',
					prenom_contact_client = '$prenom_contact_client',
					email_contact_client = '$email_contact_client',
					adr_contact_client = '$adr_contact_client',
					tel_contact_client = '$tel_contact_client',
					id_client = '$id_client'
					where id_contact_client = $id_contact_client";
					
		}
		
		
		if (!mysqli_query($link, $sql))
		{
			echo 'Erreur d"/enrgistrement . ' . mysqli_error($link);
			exit();	
		}
	}
	header('Location: consulter_contact_client.php');
	exit();
}
//End Insert or Update contact information

//Start of edit contact read
$gresult = ''; //declare global variable
if(isset($_POST["action"]) and $_POST["action"]=="edit"){
	$id = (isset($_POST["ci"])? $_POST["ci"] : '');
	$sql = "SELECT
`contact_client`.`id_contact_client`,
`contact_client`.`nom_contact_client`,
`contact_client`.`prenom_contact_client`,
`contact_client`.`email_contact_client`,
`contact_client`.`adr_contact_client`,
`contact_client`.`tel_contact_client`,
`client`.`nom_client`,
`client`.`id_client`
FROM
`contact_client` ,
`client`
WHERE
`contact_client`.`id_client` =  `client`.`id_client` 
and id_contact_client = $id";

	$result = mysqli_query($link, $sql);

	if(!$result)
	{
		echo mysqli_error($link);
		exit();
	}
	
	$gresult = mysqli_fetch_array($result);
	
	include 'form_contact_client.php';
	exit();
}
//end of edit contact read

//Start Delete Contact
if(isset($_POST["action"]) and $_POST["action"]=="delete"){
	$id = (isset($_POST["ci"])? $_POST["ci"] : '');
	$sql = "delete from contact_client 
			where id_contact_client = $id";

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

`contact_client`.`id_contact_client`,
`contact_client`.`adr_contact_client`,
`contact_client`.`tel_contact_client`,
`client`.`nom_client`,
`contact_client`.`nom_contact_client`,
`contact_client`.`prenom_contact_client`,
`contact_client`.`email_contact_client`
FROM
`contact_client` ,
`client`
WHERE
`contact_client`.`id_client` =  `client`.`id_client`";

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
	$contact_list[] = array('id_contact_client' => $rows['id_contact_client'],
	                        'nom_contact_client' => $rows['nom_contact_client'], 
							'prenom_contact_client' => $rows['prenom_contact_client'],
							'email_contact_client' => $rows['email_contact_client'],
							'adr_contact_client' => $rows['adr_contact_client'],
							'nom_client' => $rows['nom_client'],
							'tel_contact_client' => $rows['tel_contact_client'],
							'nom_client' => $rows['nom_client']);
}
include 'consulter_contact_client.php';
exit();
?>