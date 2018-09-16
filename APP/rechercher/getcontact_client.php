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
`contact_client`.`nom_contact_client`,
`contact_client`.`Prenom_contact_client`,
`contact_client`.`Tel_contact_client`,
`contact_client`.`email_contact_client`,
`contact_client`.`adr_contact_client`,
`client`.`nom_client`
FROM
`contact_client` ,
`client`
WHERE
`contact_client`.`id_client` =  `client`.`id_client` and id_contact_client = '".$q."'";
$result = mysqli_query($con,$sql);

echo "<table>
<tr>
<th>Nom</th>
<th>Prenom</th>
<th>Téléphone</th>
<th>E_mail</th>
<th>Adresse</th>
<th>Client associé</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['nom_contact_client'] . "</td>";
    echo "<td>" . $row['prenom_contact_client'] . "</td>";
    echo "<td>" . $row['tel_contact_client'] . "</td>";
	echo "<td>" . $row['email_contact_client'] . "</td>";
    echo "<td>" . $row['adr_contact_client'] . "</td>";
    echo "<td>" . $row['nom_client'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>