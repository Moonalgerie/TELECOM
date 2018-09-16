<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$q = intval($_GET['q']);

$con = mysqli_connect('localhost','root','azerty');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"gestion_pavc");
$sql="SELECT
`contact_fournisseur`.`nom_contact_fournisseur`,
`contact_fournisseur`.`prenom_contact_fournisseur`,
`contact_fournisseur`.`tel_contact_fournisseur`,
`contact_fournisseur`.`email_contact_fournisseur`,
`contact_fournisseur`.`adr_contact_fournisseur`,
`fournisseur`.`Nom_fourn`
FROM
`contact_fournisseur` ,
`fournisseur`
WHERE
`contact_fournisseur`.`id_fourn` =  `fournisseur`.`id_fourn` and id_contact_fournisseur = '".$q."'";
$result = mysqli_query($con,$sql);

echo "<table>
<tr>
<th>Nom</th>
<th>Prenom</th>

<th>Tel</th>
<th>Email</th>
<th>Adresse</th>
<th>Fournisseur associé</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['Nom_contact_fournisseur'] . "</td>";
    echo "<td>" . $row['Prenom_contact_fournisseur'] . "</td>";
  
	echo "<td>" . $row['Tel_contact_fournisseur'] . "</td>";
    echo "<td>" . $row['email_contact_fournisseur'] . "</td>";
	  echo "<td>" . $row['adr_contact_fournisseur'] . "</td>";
	    echo "<td>" . $row['Nom_fourn'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>