<?php
session_start();
include('../connexion.php');
//pour le jrnal d'utilasateur
$pseudo=$_SESSION['pseudo'];
date_default_timezone_set("Africa/Algiers");
 
$date_act = date("Y-m-d"); 
$heure_act = date("H:i:s");

 ?>
 
<html>
<head>
<script>
function showFourn(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","getfournisseur.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
</head>
<body>

<form>

<?php $req="SELECT * FROM fournisseur ;";
$result=mysql_query($req);?>
  <select name="Fourn" onChange="showFourn(this.value)">
          <option value="">.........S&eacute;lectionnez .........</option>
          <?php 
      while ($row = mysql_fetch_array($result))
{ ?>
          <option value="<?php echo $row["id_fourn"];?>"><?php echo $row["Nom_fourn"];?> </option>
          <?php
}
?>
        </select>
</form>
<br>
<div id="txtHint"><b>Person info will be listed here...</b></div>

</body>
</html>