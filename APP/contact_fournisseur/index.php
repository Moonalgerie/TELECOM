<?php
session_start();
include '../DBConfig.php';
//Insert or Update contact information
if(isset($_POST['action_type']))
{
	if ($_POST['action_type'] == 'add' or $_POST['action_type'] == 'edit')
	{
		//Sanitize the data and assign to variables
		$id_contact_fournisseur = mysqli_real_escape_string($link, strip_tags($_POST['ContactID']));
		$nom_contact_fournisseur = mysqli_real_escape_string($link, strip_tags($_POST['nom_contact_fournisseur']));
		$prenom_contact_fournisseur = mysqli_real_escape_string($link, strip_tags($_POST['prenom_contact_fournisseur']));
		$email_contact_fournisseur = mysqli_real_escape_string($link, strip_tags($_POST['email_contact_fournisseur']));
		$adr_contact_fournisseur = mysqli_real_escape_string($link, strip_tags($_POST['adr_contact_fournisseur']));
		$id_fourn = mysqli_real_escape_string($link, strip_tags($_POST['id_fourn']));
		$tel_contact_fournisseur = mysqli_real_escape_string($link, strip_tags($_POST['tel_contact_fournisseur']));
		
				
		if ($_POST['action_type'] == 'add')
		{
			$sql = "insert into contact_fournisseur set 
					nom_contact_fournisseur = '$nom_contact_fournisseur',
					prenom_contact_fournisseur = '$prenom_contact_fournisseur',
					email_contact_fournisseur = '$email_contact_fournisseur',
					adr_contact_fournisseur = '$adr_contact_fournisseur',
					id_fourn = '$id_fourn',
					tel_contact_fournisseur = '$tel_contact_fournisseur'";
		}else{
			$sql = "update contact_fournisseur set 
					nom_contact_fournisseur = '$nom_contact_fournisseur',
					prenom_contact_fournisseur = '$prenom_contact_fournisseur',
					email_contact_fournisseur = '$email_contact_fournisseur',
					adr_contact_fournisseur = '$adr_contact_fournisseur',
					id_fourn = '$id_fourn',
					tel_contact_fournisseur = '$tel_contact_fournisseur'
					where id_contact_fournisseur = '$id_contact_fournisseur'";
					
		}
		
		
		if (!mysqli_query($link, $sql))
		{
			echo 'Erreur d"/enrgistrement . ' . mysqli_error($link);
			exit();	
		}
	}
	header('Location: consulter_contact_fourn.php');
	exit();
}
//End Insert or Update contact information

//Start of edit contact read
$gresult = ''; //declare global variable
if(isset($_POST["action"]) and $_POST["action"]=="edit"){
	$id = (isset($_POST["ci"])? $_POST["ci"] : '');
	$sql = "SELECT
`contact_fournisseur`.`id_contact_fournisseur`,
`contact_fournisseur`.`nom_contact_fournisseur`,
`contact_fournisseur`.`prenom_contact_fournisseur`,
`contact_fournisseur`.`email_contact_fournisseur`,
`contact_fournisseur`.`adr_contact_fournisseur`,
`contact_fournisseur`.`tel_contact_fournisseur`,
`fournisseur`.`Nom_fourn`,
`fournisseur`.`id_fourn`
FROM
`contact_fournisseur` ,
`fournisseur`
WHERE
`contact_fournisseur`.`id_fourn` =  `fournisseur`.`id_fourn` 
and id_contact_fournisseur = $id";

	$result = mysqli_query($link, $sql);

	if(!$result)
	{
		echo mysqli_error($link);
		exit();
	}
	
	$gresult = mysqli_fetch_array($result);
	
	include 'form_contact_fourn.php';
	exit();
}
//end of edit contact read

//Start Delete Contact
if(isset($_POST["action"]) and $_POST["action"]=="delete"){
	$id = (isset($_POST["ci"])? $_POST["ci"] : '');
	$sql = "delete from contact_fournisseur 
			where id_contact_fournisseur = $id";

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
`contact_fournisseur`.`nom_contact_fournisseur`,
`contact_fournisseur`.`prenom_contact_fournisseur`,
`contact_fournisseur`.`email_contact_fournisseur`,
`contact_fournisseur`.`adr_contact_fournisseur`,
`contact_fournisseur`.`tel_contact_fournisseur`,
`fournisseur`.`Nom_fourn`,
`contact_fournisseur`.`id_contact_fournisseur`
FROM
`contact_fournisseur` ,
`fournisseur`
WHERE
`contact_fournisseur`.`id_fourn` =  `fournisseur`.`id_fourn`
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
	$contact_list[] = array('id_contact_fournisseur' => $rows['id_contact_fournisseur'], 
							'nom_contact_fournisseur' => $rows['nom_contact_fournisseur'],
							'prenom_contact_fournisseur' => $rows['prenom_contact_fournisseur'],
							'email_contact_fournisseur' => $rows['email_contact_fournisseur'],
							'adr_contact_fournisseur' => $rows['adr_contact_fournisseur'],
							'Nom_fourn' => $rows['Nom_fourn'],
							'tel_contact_fournisseur' => $rows['tel_contact_fournisseur']);
}
include 'consulter_contact_fourn.php';
exit();
?>