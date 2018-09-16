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
function showclient(str) {
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
        xmlhttp.open("GET","getclient.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>

<script>

function showResult(str) {
  if (str.length==0) { 
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","livesearch.php?q="+str,true);
  xmlhttp.send();
}
</script>
</head>
<body>

<form>

<?php $req="SELECT * FROM client ;";
$result=mysql_query($req);?>
  <select name="users" onChange="showclient(this.value)">
          <option value="">.........S&eacute;lectionnez .........</option>
          <?php 
      while ($row = mysql_fetch_array($result))
{ ?>
          <option value="<?php echo $row["id_client"];?>"><?php echo $row["Design_client"];?></option>
          <?php
}
?>
        </select>
        
        <input type="text" size="30" onkeyup="showResult(this.value)">
<div id="livesearch"></div>
</form>
<br>
<div id="txtHint"><b>Person info will be listed here...</b></div>

</body>
</html>