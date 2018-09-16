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
`user`.`Nom_user`,
`user`.`Prenom_user`,
`user`.`Tel_user`,
`user`.`Email_user`,
`user`.`pseudo`,
`fonction`.`Design_fonction`
FROM
`user` ,
`fonction`
WHERE
`user`.`id_fonction` =  `fonction`.`id_fonction` and id_user = '".$q."'";
$result = mysqli_query($con,$sql);

echo "<table>
<tr>
<th>Nom</th>
<th>Prenom</th>
<th>Fonction</th>
<th>Tel</th>
<th>Email</th>
<th>pseudo</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['Nom_user'] . "</td>";
    echo "<td>" . $row['Prenom_user'] . "</td>";
    echo "<td>" . $row['Design_fonction'] . "</td>";
	echo "<td>" . $row['Tel_user'] . "</td>";
    echo "<td>" . $row['Email_user'] . "</td>";
    echo "<td>" . $row['pseudo'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>