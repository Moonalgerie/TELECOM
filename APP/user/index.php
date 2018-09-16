<?php
session_start();
include '../DBConfig.php';
//Insert or Update contact information
if(isset($_POST['action_type']))
{
	if ($_POST['action_type'] == 'add' or $_POST['action_type'] == 'edit')
	{
		//Sanitize the data and assign to variables
		$id_user = mysqli_real_escape_string($link, strip_tags($_POST['id_user']));
		$Nom_user = mysqli_real_escape_string($link, strip_tags($_POST['Nom_user']));
		$Prenom_user = mysqli_real_escape_string($link, strip_tags($_POST['Prenom_user']));
		$Tel_user = mysqli_real_escape_string($link, strip_tags($_POST['Tel_user']));
		$Email_user = mysqli_real_escape_string($link, strip_tags($_POST['Email_user']));
		$id_fonction = mysqli_real_escape_string($link, strip_tags($_POST['id_fonction']));
		$pseudo = mysqli_real_escape_string($link, strip_tags($_POST['pseudo']));
		$password = mysqli_real_escape_string($link, strip_tags($_POST['password']));
		$id_departement = mysqli_real_escape_string($link, strip_tags($_POST['id_departement']));
		
				
		if ($_POST['action_type'] == 'add')
		{
			$sql = "insert into user set 
					Nom_user = '$Nom_user',
					Prenom_user = '$Prenom_user',
					Tel_user = '$Tel_user',
					Email_user = '$Email_user',
					id_fonction = '$id_fonction',
					pseudo = '$pseudo',
					id_departement = '$id_departement',
					password = '$password'";
		}else{
			$sql = "update user set 
					Nom_user = '$Nom_user',
					Prenom_user = '$Prenom_user',
					Tel_user = '$Tel_user',
					Email_user = '$Email_user',
					id_fonction = '$id_fonction',
					pseudo = '$pseudo',
					password = '$password',
					id_departement = '$id_departement'
					where id_user = $id_user";
					
		}
		
		
		if (!mysqli_query($link, $sql))
		{
			echo 'Erreur d"/enrgistrement . ' . mysqli_error($link);
			exit();	
		}
	}
	if ($_SESSION['id_fonction'] == '1')
	{
	header('Location: consulter_user.php');
	exit();
	}  else {
	header('Location: ../profile/profile.php');
	exit(); }
}
//End Insert or Update contact information

//Start of edit contact read
$gresult = ''; //declare global variable
if(isset($_POST["action"]) and $_POST["action"]=="edit"){
	$id = (isset($_POST["ci"])? $_POST["ci"] : '');
	$sql = "SELECT
`user`.`id_user`,
`user`.`Nom_user`,
`user`.`Prenom_user`,
`user`.`Tel_user`,
`user`.`Email_user`,
`user`.`pseudo`,
`user`.`password`,
`fonction`.`Design_fonction`,
`fonction`.`id_fonction`,
`departement`.`Nom_departement`,
`departement`.`id_departement`
FROM
`user` ,
`fonction`,
`departement`
WHERE
`user`.`id_fonction` =  `fonction`.`id_fonction` 
and `user`.`id_departement` =  `departement`.`id_departement`
and id_user = $id";

	$result = mysqli_query($link, $sql);

	if(!$result)
	{
		echo mysqli_error($link);
		exit();
	}
	
	$gresult = mysqli_fetch_array($result);
	
	include 'form_user.php';
	exit();
}
//end of edit contact read

//Start Delete Contact
if(isset($_POST["action"]) and $_POST["action"]=="delete"){
	$id = (isset($_POST["ci"])? $_POST["ci"] : '');
	$sql = "delete from user 
			where id_user = $id";

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
id_user, CONCAT(Nom_user,' ' , Prenom_user) as contact_name ,
`user`.`Tel_user`,
`user`.`Email_user`,
`user`.`pseudo`,
`user`.`password`,
`fonction`.`Design_fonction`,
`fonction`.`id_fonction`,
`departement`.`Nom_departement`,
`departement`.`id_departement`
FROM
`user` ,
`fonction`,
`departement`
WHERE
`user`.`id_fonction` =  `fonction`.`id_fonction`
and `user`.`id_departement` =  `departement`.`id_departement` ";

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
	$contact_list[] = array('id_user' => $rows['id_user'], 
							'contact_name' => $rows['contact_name'],
							'Tel_user' => $rows['Tel_user'],
							'Email_user' => $rows['Email_user'],
							'id_fonction' => $rows['id_fonction'],
							'id_departement' => $rows['id_departement'],
							'Nom_departement' => $rows['Nom_departement'],
							'Design_fonction' => $rows['Design_fonction'],
							'pseudo' => $rows['pseudo'],
							'password' => $rows['password']);
}
include 'consulter_user.php';
exit();
?>