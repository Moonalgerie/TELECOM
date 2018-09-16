<?php 
session_start();

//connexion a la base de données
include('../DBConfig.php');
//pour le jrnal d'utilasateur
$pseudo = $_SESSION['pseudo'];
// la date actuale en algerie
date_default_timezone_set("Africa/Algiers");

//requette afficher le nombre
 $sql2 = "SELECT
Count(`projet`.`Etat_projet`) AS `Nbr`
FROM
`projet` ,
`user`
WHERE
`projet`.`Etat_projet` =  '0' AND
`projet`.`id_user` =  `user`.`id_user` AND
`user`.`pseudo` =  '".$pseudo."'
 ";
 $result2 = mysqli_query($link, $sql2);
$rows2 = mysqli_fetch_array($result2);

//requette recuprer les données
$sql_nonlu = "SELECT
`projet`.`id_projet`,
`projet`.`Design_projet`,
`projet`.`date_debut_projet`,
`projet`.`date_fin_projet`,
`projet`.`Description_projet`,
`client`.`nom_client`,
`fournisseur`.`Nom_fourn`,
`fournisseur`.`Adr_fourn`,
`client`.`Initials_client`,
`client`.`Adr_client`,
`user`.`Nom_user`,
`user`.`Prenom_user`,
`user`.`pseudo`,
`fonction`.`Design_fonction`
FROM
`projet` ,
`client` ,
`user` ,
`projet_fournisseur` ,
`fournisseur` ,
`fonction`
WHERE
`projet`.`id_user` =  `user`.`id_user` AND
`projet`.`id_client` =  `client`.`id_client` AND
`projet_fournisseur`.`id_projet` =  `projet`.`id_projet` AND
`projet_fournisseur`.`id_fourn` =  `fournisseur`.`id_fourn` and
`projet_fournisseur`.`id_projet` =  `projet`.`id_projet` AND
`user`.`id_fonction`= `fonction`.`id_fonction` AND
`projet`.`Etat_projet`=0  AND  
`user`.`pseudo` =  '".$pseudo."'
";

// excuetion la requette 

$result_nonlu = mysqli_query($link, $sql_nonlu);
$result_notif = mysqli_query($link, $sql_nonlu);

// l'affichage 

if(!$result_nonlu)
{
echo mysqli_error($link);
	exit();
}
$list_Projet = array();


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
              <h3>Nouveau Projet<small> </small>
              </h3>
            </div>

            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Nouveau Projet</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
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
             
                  
                  
                  
                  <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                       <?php echo $pseudo; ?> 
                        <th>Désignation</th>
                        <th>Client /Organisme</th>
                        <th>Fournisseur</th>
                        <th>Date d'Expression du Besoin</th>
                        <th>Date de Remise</th>
                        <th>Description du projet</th>
                        <th>Consulter</th>
                      </tr>
                    </thead>


                    <tbody>

 <?php
	while($Row_Projet = mysqli_fetch_array($result_nonlu))
{					
 ?>
                      <tr>
                     <td><?php echo $Row_Projet["Design_projet"]; ?></td>    
                    <td><?php echo $Row_Projet["nom_client"]; ?></td>
                    <td><?php echo $Row_Projet["Nom_fourn"]; ?></td>
                        <td class="center"><?php echo $Row_Projet["date_debut_projet"]; ?></td>
                         <td><?php echo $Row_Projet["date_fin_projet"]; ?></td>
                           <td><?php echo $Row_Projet["Description_projet"]; ?></td>
                           
            <form method="post" action="../consultation/afficher_projet.php">
                              <td>
				<input type="hidden" name="ci" 
			value="<?php echo $Row_Projet["id_projet"]; ?>" />
			<input type="hidden" name="action" value="edit" />
				<input type="submit" value="Consulter" />
                               </td>
                             </form>
                               
                      </tr>
                       <?php } ?>
                    </tbody>
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
              <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
          </div>

        </div>
  <script src="../js/bootstrap.min.js"></script>

        <!-- bootstrap progress js -->
        <script src="../js/progressbar/bootstrap-progressbar.min.js"></script>
        <!-- icheck -->
        <script src="../js/icheck/icheck.min.js"></script>

        <script src="../js/custom.js"></script>


        <!-- Datatables -->
        <!-- <script src="js/datatables/js/jquery.dataTables.js"></script>
  <script src="js/datatables/tools/js/dataTables.tableTools.js"></script> -->

        <!-- Datatables-->
        <script src="../js/datatables/jquery.dataTables.min.js"></script>
        <script src="../js/datatables/dataTables.bootstrap.js"></script>
        <script src="../js/datatables/dataTables.buttons.min.js"></script>
        <script src="../js/datatables/buttons.bootstrap.min.js"></script>
        <script src="../js/datatables/jszip.min.js"></script>
        <script src="../js/datatables/pdfmake.min.js"></script>
        <script src="../js/datatables/vfs_fonts.js"></script>
        <script src="../js/datatables/buttons.html5.min.js"></script>
        <script src="../js/datatables/buttons.print.min.js"></script>
        <script src="../js/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="../js/datatables/dataTables.keyTable.min.js"></script>
        <script src="../js/datatables/dataTables.responsive.min.js"></script>
        <script src="../js/datatables/responsive.bootstrap.min.js"></script>
        <script src="../js/datatables/dataTables.scroller.min.js"></script>


        <!-- pace -->
        <script src="../js/pace/pace.min.js"></script>
        <script>
          var handleDataTableButtons = function() {
              "use strict";
              0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
                dom: "Bfrtip",
                buttons: [{
                  extend: "copy",
                  className: "btn-sm"
                }, {
                  extend: "csv",
                  className: "btn-sm"
                }, {
                  extend: "excel",
                  className: "btn-sm"
                }, {
                  extend: "pdf",
                  className: "btn-sm"
                }, {
                  extend: "print",
                  className: "btn-sm"
                }],
                responsive: !0
              })
            },
            TableManageButtons = function() {
              "use strict";
              return {
                init: function() {
                  handleDataTableButtons()
                }
              }
            }();
        </script>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable').dataTable();
            $('#datatable-keytable').DataTable({
              keys: true
            });
            $('#datatable-responsive').DataTable();
            $('#datatable-scroller').DataTable({
              ajax: "js/datatables/json/scroller-demo.json",
              deferRender: true,
              scrollY: 380,
              scrollCollapse: true,
              scroller: true
            });
            var table = $('#datatable-fixed-header').DataTable({
              fixedHeader: true
            });
          });
          TableManageButtons.init();
        </script>
</body>

</html>
