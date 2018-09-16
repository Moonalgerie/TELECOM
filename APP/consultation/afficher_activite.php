<?php
session_start();
//connexion a la base de données
include('../DBConfig.php');
//pour le jrnal d'utilasateur
$pseudo=$_SESSION['pseudo'];
// la date actuale en algerie
date_default_timezone_set("Africa/Algiers");

//$id='4';


// requette update etat projet
if (isset($_POST['action']) == 'edit') {
	
	$id = (isset($_POST["ci"])? $_POST["ci"] : '');
	
	
///ici	
$_SESSION['id']=$id;

//
	$sql = "update activite set 
					Etat_activite = '1'
					
					where id_activite = $id";
	$result = mysqli_query($link, $sql);
	
}


$id2=$_SESSION['id'];

 

//requette recuprer les données pour la page 
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
`user`.`pseudo` =  '".$pseudo."' AND
`activite`.`id_activite`='".$_SESSION['id']."'
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

  <link href="../js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <link href="../js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="../js/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="../js/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="../js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />

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
<?php include_once '../Menu_Vert.php';?>
      <!-- /top navigation -->


        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Nouvelle Activitée</h3>
              </div>

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
                    <h2>Activitée</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                                   <li>
                          
                          <form id="test" method="post" action="../activite/index.php">
                        <input type="hidden" name="ci" 
							value="<?php echo $rows["id_activite"]; ?>" />
                        <input type="hidden" name="action" value="edit" /> </form> 
                          <a href='#' onclick='document.getElementById("test").submit()'>Modifier</a>

                          </li>
                          

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
               <table width="500" height="490" border="0">
  <tr>
    <th height="87" scope="col"> <h2>Designation :</h2></th>
    <th scope="col"> <?php echo $rows['Design_activite'];?><strong><?php echo $rows['Design_activite'];?></strong></th>
  </tr>
      <tr>
    <td>  <h2>Priorité :</h2></td>
    <td><strong> <?php echo $rows['priorite_activite'];?></strong></td>
  </tr>
  <tr>
    <td> <h2>Date d'Expression du Besoin :</h2></td>
    <td> <?php echo $rows['date_debut_activite'];?></td>
  </tr>
  <tr>
    <td>  <h2>Date de Remise :</h2></td>
    <td> <?php echo $rows['date_fin_activite'];?></td>
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