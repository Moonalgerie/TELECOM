<?php
session_start();
include '../DBConfig.php';
//Insert or Update contact information
if(isset($_POST['action_type']))
{
	if ($_POST['action_typse'] == 'add' or $_POST['action_type'] == 'edit')
	{
		//Sanitize the data and assign to variables
		$id_fourn = mysqli_real_escape_string($link, strip_tags($_POST['ContactID']));
		$Nom_fourn = mysqli_real_escape_string($link, strip_tags($_POST['Nom_fourn']));
		$Adr_fourn = mysqli_real_escape_string($link, strip_tags($_POST['Adr_fourn']));
		$Description_fourn = mysqli_real_escape_string($link, strip_tags($_POST['Description_fourn']));
				
		if ($_POST['action_type'] == 'add')
		{
			$sql = "insert into fournisseur set 
					Nom_fourn = '$Nom_fourn',
					Adr_fourn = '$Adr_fourn',
					Description_fourn = '$Description_fourn'";
		}else{
			$sql = "update fournisseur set 
					Nom_fourn = '$Nom_fourn',
					Adr_fourn = '$Adr_fourn',
					Description_fourn = '$Description_fourn',
					where id_fourn = $id_fourn";
					
		}
		
		
		if (!mysqli_query($link, $sql))
		{
			echo 'Erreur d"/enrgistrement . ' . mysqli_error($link);
			exit();	
		}
	}
	header('Location: consulter_fourn.php');
	exit();
}
//End Insert or Update contact information

//Start of edit contact read
$gresult = ''; //declare global variable
if(isset($_POST["action"]) and $_POST["action"]=="edit"){
	$id = (isset($_POST["ci"])? $_POST["ci"] : '');
	$sql = "SELECT
`fournisseur`.`id_fourn`,
`fournisseur`.`Nom_fourn`,
`fournisseur`.`Adr_fourn`,
`fournisseur`.`Description_fourn`
FROM
`fournisseur`
 Where
 id_fourn = $id";

	$result = mysqli_query($link, $sql);

	if(!$result)
	{
		echo mysqli_error($link);
		exit();
	}
	
	$gresult = mysqli_fetch_array($result);
	
	include 'form_fourn.php';
	exit();
}
//end of edit contact read

//Start Delete Contact
if(isset($_POST["action"]) and $_POST["action"]=="delete"){
	$id = (isset($_POST["ci"])? $_POST["ci"] : '');
	$sql = "delete from fournisseur 
			where id_fourn = $id";

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
`fournisseur`.`id_fourn`,
`fournisseur`.`Nom_fourn`,
`fournisseur`.`Adr_fourn`,
`fournisseur`.`Description_fourn`
FROM
`fournisseur`";

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
	$contact_list[] = array('id_fourn' => $rows['id_fourn'], 
							'Nom_fourn' => $rows['Nom_fourn'],
							'Adr_fourn' => $rows['Adr_fourn'],
							'Description_fourn' => $rows['Description_fourn']);
						
}
include 'consulter_fourn.php';
exit();
?>