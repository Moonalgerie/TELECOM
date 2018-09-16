<?php
session_start();
//connexion a la base de données
include('../DBConfig.php');
//pour le jrnal d'utilasateur
$pseudo=$_SESSION['pseudo'];
// la date actuale en algerie
date_default_timezone_set("Africa/Algiers");



//requette recuprer les données pour notification
$sql_lu = "SELECT
`activite`.`id_activite`,
`activite`.`Design_activite`,
`activite`.`priorite_activite`,
`activite`.`date_debut_activite`,
`activite`.`date_fin_activite`,
`user`.`Nom_user`,
`user`.`Prenom_user`,
`user`.`pseudo`,
`fonction`.`Design_fonction`
FROM
`activite` ,
`fonction` ,
`user`
WHERE
`activite`.`id_user` =  `user`.`id_user` AND
`user`.`id_fonction` =  `fonction`.`id_fonction`AND
`user`.`pseudo` =  '".$pseudo."' 
";

$result_notif = mysqli_query($link, $sql_lu);  

//requette recuprer les données pour la page 
$sql_lu = "SELECT
`user`.`id_user`,
`user`.`Nom_user`,
`user`.`Prenom_user`,
`user`.`Tel_user`,
`user`.`Email_user`,
`user`.`pseudo`,
`user`.`password`,
`user`.`id_fonction`,
`fonction`.`Design_fonction`
FROM
`fonction` ,
`user`
WHERE
`user`.`id_fonction` =  `fonction`.`id_fonction`AND
`user`.`pseudo` =  '".$pseudo."'
";  

// excuetion la requette 
$result_lu = mysqli_query($link, $sql_lu);


// l'affichage 
if(!$result_lu)
{
echo mysqli_error($link);
	exit();
}

$rows = mysqli_fetch_array($result_lu)

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DDA | ALGERIE TELECOM</title>

    <!-- Bootstrap core CSS -->

    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <link href="../fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="../css/custom.css" rel="stylesheet">
    <link href="../css/icheck/flat/green.css" rel="stylesheet">

    <script src="../js/jquery.min.js"></script>

    <!--[if lt IE 9]>
      <script src="../assets/js/ie8-responsive-file-warning.js"></script>
    <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>


  <body class="nav-md">

    <div class="container body">


      <div class="main_container">

        <?php 
include_once '../MENU.php';
?>
 <!-- top navigation -->
            <?php 
include_once '../Menu_Vert.php';?>
 <!-- Fin top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left"> USER</div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                 
                </div>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="height:600px;">
                  <div class="x_title">
                    <h2>User</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li>
                          <a href="#" onclick="document.forms['test'].submit(); return false;">Modifier</a>
                          <form name="test" method="post" action="../user/index.php">
                        <input type="hidden" name="ci" 
							value="<?php echo $rows["id_user"]; ?>" />
                        <input type="hidden" name="action" value="edit" /></form>   
                          </li>
                          <li><a href="#"></a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                    
                  </div>
                   <div class="x_content">
               <table width="500" height="450" border="0">
  <tr>
    <th height="87" scope="col"><h2> Nom:</h2></th>
    <th scope="col"> <?php echo $rows['Nom_user'];?></strong></th>
  </tr>
      <tr>
    <td>  <h2>Prenom :</h2></td>
    <td><strong> <?php echo $rows['Prenom_user'];?></strong></td>
  </tr>
  <tr>
    <td> <h2>Numéros de Téléphone :</h2></td>
    <td> <?php echo $rows['Tel_user'];?></td>
  </tr>
  <tr>
    <td>  <h2>Adresse email :</h2></td>
    <td> <?php echo $rows['Email_user'];?></td>
  </tr>
</table>
                 
                
  </div>
                </div>
                
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
    Département Développement d'Affaire | ALGERIE TELECOM
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
      <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group"></ul>
      <div class="clearfix"></div>
      <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="../js/bootstrap.min.js"></script>

    <!-- bootstrap progress js -->
    <script src="../js/progressbar/bootstrap-progressbar.min.js"></script>
    <!-- icheck -->
    <script src="../js/icheck/icheck.min.js"></script>

    <script src="../js/custom.js"></script>

    <!-- pace -->
    <script src="../js/pace/pace.min.js"></script>
  </body>
</html>