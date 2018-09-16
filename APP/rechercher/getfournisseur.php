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
`fournisseur`.`Nom_fourn`,
`fournisseur`.`Adr_fourn`,
`fournisseur`.`Description_fourn`
FROM
`fournisseur` where id_fourn = '".$q."'";
$result = mysqli_query($con,$sql);

echo "<table>
<tr>
<th>Nom</th>
<th>Adresse</th>
<th>Description</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['Nom_fourn'] . "</td>";
    echo "<td>" . $row['Adr_fourn'] . "</td>";
    echo "<td>" . $row['Description_fourn'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>