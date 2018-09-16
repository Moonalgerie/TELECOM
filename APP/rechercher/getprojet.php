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
`projet`.`Design_projet`,
`projet`.`Date_debut`,
`projet`.`Date_fin`,
`projet`.`Description_projet`,
`projet`.`id_client`,
`projet`.`id_user`,
`client`.`id_client`,
`user`.`id_user`
FROM
`projet` ,
`user` ,
`client`
WHERE
`projet`.`id_client` =  `client`.`id_client` AND
`projet`.`id_user` =  `user`.`id_user` AND
id_projet = '".$q."'";
$result = mysqli_query($con,$sql);

echo "<table>
<tr>
<th>Designation</th>
<th>Date debut</th>
<th>Date fin</th>
<th>Client concerne</th>
<th>Responsable</th>
<th>Description du projet</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['Design_projet'] . "</td>";
    echo "<td>" . $row['Date_debut'] . "</td>";
    echo "<td>" . $row['Date_fin'] . "</td>";
	echo "<td>" . $row['id_client'] . "</td>";
	echo "<td>" . $row['id_user'] . "</td>";
    echo "<td>" . $row['Description_projet'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>