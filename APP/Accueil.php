<?php
session_start();
include('DBConfig.php');
//requette projet par personne
$sql7 = "SELECT
Count(`projet`.`id_projet`) AS `Nombre`,
`projet`.`Design_projet`,
`user`.`Nom_user`
FROM
`projet` ,
`user`
WHERE
`projet`.`id_user` =  `user`.`id_user`
GROUP BY
`projet`.`id_user`
ORDER BY
Count(`projet`.`Description_projet`) ASC";
$result7 = mysqli_query($link, $sql7);



//requette afficher le nombre user
$sql1 = "SELECT COUNT(*) as Nbr FROM user ";
$result1 = mysqli_query($link, $sql1);
$rows1 = mysqli_fetch_array($result1);



//requette afficher le nombre client
$sql2 = "SELECT COUNT(*) as Nbr FROM client ";
$result2 = mysqli_query($link, $sql2);
$rows2 = mysqli_fetch_array($result2);



//requette afficher le nombre des fourn
$sql3 = "SELECT COUNT(*) as Nbr FROM fournisseur ";
$result3 = mysqli_query($link, $sql3);
$rows3 = mysqli_fetch_array($result3);


//requette afficher le nombre projet
$sql4 = "SELECT COUNT(*) as Nbr FROM projet ";
$result4 = mysqli_query($link, $sql4);
$rows4 = mysqli_fetch_array($result4);


  //requette afficher le nombre tache
$sql5 = "SELECT COUNT(*) as Nbr FROM tache_projet ";
$result5 = mysqli_query($link, $sql5);
$rows5 = mysqli_fetch_array($result5);


//requette afficher le nombre activite
$sql9 = "SELECT
Count(`activite`.`Etat_activite`) AS `Nbr`
FROM
`activite` ,
`user`
WHERE
`activite`.`Etat_activite` =  '0' AND
`activite`.`id_user` =  `user`.`id_user` AND
`user`.`pseudo` =  '".$_SESSION['pseudo']."'
 ";
 $result9 = mysqli_query($link, $sql9);
$rows9 = mysqli_fetch_array($result9);



//requette afficher le nombre projet
$sql8 ="SELECT
Count(`projet`.`Etat_projet`) AS `Nbr`
FROM
`projet` ,
`user`
WHERE
`projet`.`Etat_projet` =  '0' AND
`projet`.`id_user` =  `user`.`id_user` AND
`user`.`pseudo` =  '".$_SESSION['pseudo']."'
 ";
 $result8 = mysqli_query($link, $sql8);
$rows8 = mysqli_fetch_array($result8);
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

  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/maps/jquery-jvectormap-2.0.3.css" />
  <link href="css/icheck/flat/green.css" rel="stylesheet" />
  <link href="css/floatexamples.css" rel="stylesheet" type="text/css" />

  <script src="js/jquery.min.js"></script>
  <script src="js/nprogress.js"></script>

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


      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">

          <div class="navbar nav_title" style="border: 0;">
           <a href="Accueil.php" class="site_title"><i class="fa fa-paw"></i> <span>Accueil</span></a>
          </div>
          <div class="clearfix"></div>

          <!-- menu prile quick info -->
          <div class="profile">
            <div class="profile_pic">
              <img src="images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Bienvenue,</span>
              <h2><?php echo $_SESSION['Nom_user']; ?> &nbsp;&nbsp;<?php echo $_SESSION['Prenom_user']; ?></h2>
            </div>
          </div>
          <!-- /menu prile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
              <h3><?php echo $_SESSION['Design_fonction']; ?></h3>
              <ul class="nav side-menu">

                <li><a><i class="fa fa-home"></i>Accueil<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="Accueil.php">Accueil</a>
                    </li>
                  </ul>
                </li>


                <li><a><i class="fa fa-edit"></i>Projet<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
          <?php if ($_SESSION['id_fonction'] == '1')
	{?>
                    <li><a href="projet/form_projet.php">Nouveau Projet</a>
                    </li>
                    <?php } ?>
                    <li><a href="projet/consulter_projet.php">Projet En Cours de Réalisation</a>
                    </li>
                  </ul>
                </li>
                 <li><a><i class="fa fa-edit"></i>Tache<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="tache/form_tache.php">Nouvelle Tache</a>
                    </li>
                    <li><a href="tache/consulter_tache.php">Tache En Cours de Réalisation</a>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-table"></i>Activitée<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="activite/form_activite.php">Nouvelle Activitée</a>
                    </li>
                    <li><a href="activite/consulter_activite.php">Activitée En Cours de Réalisation</a>
                    </li>
                  </ul>
                </li>
           <li><a><i class="fa fa-edit"></i>Client<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                <li><a href="#client">Client</a>
                    <ul class="nav child_menu" style="display: none">
                            <li class="sub_menu"><a href="client/form_client.php">Nouveau Client</a>
                            </li>
                            <li><a href="client/consulter_client.php">Liste des Clients</a>
                            </li>
                  </ul>
                    </li>
                    <li><a href="#contact_client">Contacts des Clients</a>
                     <ul class="nav child_menu" style="display: none">
                            <li class="sub_menu"><a href="contact_client/form_contact_client.php">Nouveau Contact</a>
                            </li>
                            <li><a href="contact_client/consulter_contact_client.php">Liste des Contacts</a>
                            </li>
                      </ul>
                    </li>
                  </ul>
                </li>
                  <li><a><i class="fa fa-edit"></i>Partenaire<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                <li><a href="#partenaire">Partenaire</a>
                   <ul class="nav child_menu" style="display: none">
                            <li class="sub_menu"><a href="contact_fournisseur/consulter_contact_fourn.php">Nouveau Partenaire</a>
                            </li>
                            <li><a href="fournisseur/consulter_fourn.php">Liste des Partenaires</a>
                            </li>
                  </ul>
                    </li>
                    <li><a href="#contact_fourn">Contacts des Partenaires</a>
                    <ul class="nav child_menu" style="display: none">
                            <li class="sub_menu"><a href="contact_fournisseur/consulter_contact_fourn.php">Nouveau Contact</a>
                            </li>
                            <li><a href="contact_fournisseur/consulter_contact_fourn.php">Liste des Contacts</a>
                            </li>
                      </ul>
                    </li>
                  </ul>
                </li>
                            <?php if ($_SESSION['id_fonction'] == '1')
	{ ?>
                <li><a><i class="fa fa-desktop"></i>Utilisateur<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="user/form_user.php">Nouvel Utilisateur</a>
                    </li>
                    <li><a href="user/consulter_user.php">Liste Des Utilisateurs</a>
                    </li>

                  </ul>
                </li>
                 <?php } ?>
                <li><a><i class="fa fa-bar-chart-o"></i>Statistiques<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="chartjs.html">Graphes</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
              <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a href="index.php" data-toggle="tooltip" data-placement="top" title="Logout">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div>
          <!-- /menu footer buttons -->
        </div>
      </div>

 <!-- top navigation -->

      <!-- /top navigation -->


      <!-- page content -->
      <div class="right_col" role="main">

        <!-- top tiles -->
        <div class="row tile_count">
            <?php if ($_SESSION['id_fonction'] == '1')
	{ ?>

          <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>


            <div class="right">

              <span class="count_top"><i class="fa fa-user"></i> Nombre des Utilistaeurs</span>
              <div class="count">
              <?php echo $rows1['Nbr'];?>


              </div>
              <span class="count_bottom"><i class="green">4% </i> From last Week</span>
            </div>


          </div>

          <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i>Nombre des Clients</span>
              <div class="count"> <?php echo $rows2['Nbr'];?> </div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
            </div>
          </div>

          <?php } ?>
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i>Nombre des Partenaires</span>
              <div class="count"> <?php  echo $rows3['Nbr']; ?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
          </div>
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i> Nombre des Projets</span>
              <div class="count green">
			  <?php
			  if ($_SESSION['id_fonction'] == '1')
	{ echo $rows4['Nbr'];

	} else {


		echo $rows8['Nbr'];

		}
	 ?></div>
              <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
            </div>
          </div>
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i> Nombre des Taches</span>
              <div class="count green"><?php  echo $rows5['Nbr']; ?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
          </div>
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i> Nombre des Activitées</span>
              <div class="count green"><?php  echo $rows9['Nbr']; ?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
          </div>

        </div>
        <!-- /top tiles -->

        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

              <div class="row x_title">
                <div class="col-md-6">
                  <h3>Network Activities <small>Graph title sub-title</small></h3>
                </div>
                <div class="col-md-6">
                  <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                    <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                  </div>
                </div>
              </div>

              <div class="col-md-9 col-sm-9 col-xs-12">
                <div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
                <div style="width: 100%;">
                  <div id="canvas_dahs" class="demo-placeholder" style="width: 100%; height:270px;"> </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                <div class="x_title">
                  <h2>Projet En cours </h2>
                  <div class="clearfix"></div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-6">

                <?php
	while($rows7 = mysqli_fetch_array($result7))
{
 ?>

                  <div>
                    <p><?php echo $rows7['Nombre']; ?>Projet :&nbsp;&nbsp;<?php echo $rows7['Nom_user']; ?> </p>
                    <div class="">
                      <div class="progress progress_sm" style="width: 76%;">
                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $rows7['Nombre']; ?>"></div>
                      </div>
                    </div>
                  </div>

                 <?php } ?>


                </div>
              </div>

              <div class="clearfix"></div>
            </div>
          </div>

        </div>
        <br />

        <div class="row">


          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile fixed_height_320">
              <div class="x_title">
                <h2>Projets</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Settings 1</a>
                      </li>
                      <li><a href="#">Settings 2</a>
                      </li>
                    </ul>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <h4>App Usage across versions</h4>
                <div class="widget_summary">
                  <div class="w_left w_25">
                    <span>0.1.5.2</span>
                  </div>
                  <div class="w_center w_55">
                    <div class="progress">
                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
                        <span class="sr-only">60% Complete</span>
                      </div>
                    </div>
                  </div>
                  <div class="w_right w_20">
                    <span>123k</span>
                  </div>
                  <div class="clearfix"></div>
                </div>

                <div class="widget_summary">
                  <div class="w_left w_25">
                    <span>0.1.5.3</span>
                  </div>
                  <div class="w_center w_55">
                    <div class="progress">
                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                        <span class="sr-only">60% Complete</span>
                      </div>
                    </div>
                  </div>
                  <div class="w_right w_20">
                    <span>53k</span>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget_summary">
                  <div class="w_left w_25">
                    <span>0.1.5.4</span>
                  </div>
                  <div class="w_center w_55">
                    <div class="progress">
                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                        <span class="sr-only">60% Complete</span>
                      </div>
                    </div>
                  </div>
                  <div class="w_right w_20">
                    <span>23k</span>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget_summary">
                  <div class="w_left w_25">
                    <span>0.1.5.5</span>
                  </div>
                  <div class="w_center w_55">
                    <div class="progress">
                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
                        <span class="sr-only">60% Complete</span>
                      </div>
                    </div>
                  </div>
                  <div class="w_right w_20">
                    <span>3k</span>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget_summary">
                  <div class="w_left w_25">
                    <span>0.1.5.6</span>
                  </div>
                  <div class="w_center w_55">
                    <div class="progress">
                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 2%;">
                        <span class="sr-only">60% Complete</span>
                      </div>
                    </div>
                  </div>
                  <div class="w_right w_20">
                    <span>1k</span>
                  </div>
                  <div class="clearfix"></div>
                </div>

              </div>
            </div>
          </div>

          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile fixed_height_320">
              <div class="x_title">
                <h2>Activitées</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Settings 1</a>
                      </li>
                      <li><a href="#">Settings 2</a>
                      </li>
                    </ul>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <h4>App Usage across versions</h4>
                <div class="widget_summary">
                  <div class="w_left w_25">
                    <span>0.1.5.2</span>
                  </div>
                  <div class="w_center w_55">
                    <div class="progress">
                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
                        <span class="sr-only">60% Complete</span>
                      </div>
                    </div>
                  </div>
                  <div class="w_right w_20">
                    <span>123k</span>
                  </div>
                  <div class="clearfix"></div>
                </div>

                <div class="widget_summary">
                  <div class="w_left w_25">
                    <span>0.1.5.3</span>
                  </div>
                  <div class="w_center w_55">
                    <div class="progress">
                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                        <span class="sr-only">60% Complete</span>
                      </div>
                    </div>
                  </div>
                  <div class="w_right w_20">
                    <span>53k</span>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget_summary">
                  <div class="w_left w_25">
                    <span>0.1.5.4</span>
                  </div>
                  <div class="w_center w_55">
                    <div class="progress">
                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                        <span class="sr-only">60% Complete</span>
                      </div>
                    </div>
                  </div>
                  <div class="w_right w_20">
                    <span>23k</span>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget_summary">
                  <div class="w_left w_25">
                    <span>0.1.5.5</span>
                  </div>
                  <div class="w_center w_55">
                    <div class="progress">
                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
                        <span class="sr-only">60% Complete</span>
                      </div>
                    </div>
                  </div>
                  <div class="w_right w_20">
                    <span>3k</span>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget_summary">
                  <div class="w_left w_25">
                    <span>0.1.5.6</span>
                  </div>
                  <div class="w_center w_55">
                    <div class="progress">
                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 2%;">
                        <span class="sr-only">60% Complete</span>
                      </div>
                    </div>
                  </div>
                  <div class="w_right w_20">
                    <span>1k</span>
                  </div>
                  <div class="clearfix"></div>
                </div>

              </div>
            </div>
          </div>


          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile fixed_height_320">
              <div class="x_title">
                <h2>Quick Settings</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Settings 1</a>
                      </li>
                      <li><a href="#">Settings 2</a>
                      </li>
                    </ul>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="dashboard-widget-content">
                  <ul class="quick-list">
                    <li><i class="fa fa-calendar-o"></i><a href="#">Settings</a>
                    </li>
                    <li><i class="fa fa-bars"></i><a href="#">Subscription</a>
                    </li>
                    <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                    <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                    </li>
                    <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                    <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                    </li>
                    <li><i class="fa fa-area-chart"></i><a href="#">Logout</a>
                    </li>
                  </ul>

                  <div class="sidebar-widget">
                    <h4>Profile Completion</h4>
                    <canvas width="150" height="80" id="foo" class="" style="width: 160px; height: 100px;"></canvas>
                    <div class="goal-wrapper">
                      <span class="gauge-value pull-left">$</span>
                      <span id="gauge-text" class="gauge-value pull-left">3,200</span>
                      <span id="goal-text" class="goal-value pull-right">$5,000</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>


        <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Recent Activities <small>Sessions</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Settings 1</a>
                      </li>
                      <li><a href="#">Settings 2</a>
                      </li>
                    </ul>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="dashboard-widget-content">

                  <ul class="list-unstyled timeline widget">
                    <li>
                      <div class="block">
                        <div class="block_content">
                          <h2 class="title">
                                            <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                        </h2>
                          <div class="byline">
                            <span>13 hours ago</span> by <a>Jane Smith</a>
                          </div>
                          <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                          </p>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="block">
                        <div class="block_content">
                          <h2 class="title">
                                            <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                        </h2>
                          <div class="byline">
                            <span>13 hours ago</span> by <a>Jane Smith</a>
                          </div>
                          <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                          </p>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="block">
                        <div class="block_content">
                          <h2 class="title">
                                            <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                        </h2>
                          <div class="byline">
                            <span>13 hours ago</span> by <a>Jane Smith</a>
                          </div>
                          <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                          </p>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="block">
                        <div class="block_content">
                          <h2 class="title">
                                            <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                        </h2>
                          <div class="byline">
                            <span>13 hours ago</span> by <a>Jane Smith</a>
                          </div>
                          <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                          </p>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>


          <div class="col-md-8 col-sm-8 col-xs-12">



            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Visitors location <small>geo-presentation</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="dashboard-widget-content">
                      <div class="col-md-4 hidden-small">
                        <h2 class="line_30">125.7k Views from 60 countries</h2>

                        <table class="countries_list">
                          <tbody>
                            <tr>
                              <td>United States</td>
                              <td class="fs15 fw700 text-right">33%</td>
                            </tr>
                            <tr>
                              <td>France</td>
                              <td class="fs15 fw700 text-right">27%</td>
                            </tr>
                            <tr>
                              <td>Germany</td>
                              <td class="fs15 fw700 text-right">16%</td>
                            </tr>
                            <tr>
                              <td>Spain</td>
                              <td class="fs15 fw700 text-right">11%</td>
                            </tr>
                            <tr>
                              <td>Britain</td>
                              <td class="fs15 fw700 text-right">10%</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div id="world-map-gdp" class="col-md-8 col-sm-12 col-xs-12" style="height:230px;"></div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="row">


              <!-- Start to do list -->
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>To Do List <small>Sample tasks</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="">
                      <ul class="to_do">
                        <li>
                          <p>
                            <input type="checkbox" class="flat"> Schedule meeting with new client </p>
                        </li>
                        <li>
                          <p>
                            <input type="checkbox" class="flat"> Create email address for new intern</p>
                        </li>
                        <li>
                          <p>
                            <input type="checkbox" class="flat"> Have IT fix the network printer</p>
                        </li>
                        <li>
                          <p>
                            <input type="checkbox" class="flat"> Copy backups to offsite location</p>
                        </li>
                        <li>
                          <p>
                            <input type="checkbox" class="flat"> Food truck fixie locavors mcsweeney</p>
                        </li>
                        <li>
                          <p>
                            <input type="checkbox" class="flat"> Food truck fixie locavors mcsweeney</p>
                        </li>
                        <li>
                          <p>
                            <input type="checkbox" class="flat"> Create email address for new intern</p>
                        </li>
                        <li>
                          <p>
                            <input type="checkbox" class="flat"> Have IT fix the network printer</p>
                        </li>
                        <li>
                          <p>
                            <input type="checkbox" class="flat"> Copy backups to offsite location</p>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End to do list -->

              <!-- start of weather widget -->
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Espace Météo</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="temperature"><b>Monday</b>, 07:30 AM
                          <span>F</span>
                          <span><b>C</b></span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="weather-icon">
                          <canvas height="84" width="84" id="partly-cloudy-day"></canvas>
                        </div>
                      </div>
                      <div class="col-sm-8">
                        <div class="weather-text">
                          <h2>Texas <br><i>Partly Cloudy Day</i></h2>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="weather-text pull-right">
                        <h3 class="degrees">23</h3>
                      </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row weather-days">
                      <div class="col-sm-2">
                        <div class="daily-weather">
                          <h2 class="day">Mon</h2>
                          <h3 class="degrees">25</h3>
                          <canvas id="clear-day" width="32" height="32"></canvas>
                          <h5>15 <i>km/h</i></h5>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="daily-weather">
                          <h2 class="day">Tue</h2>
                          <h3 class="degrees">25</h3>
                          <canvas height="32" width="32" id="rain"></canvas>
                          <h5>12 <i>km/h</i></h5>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="daily-weather">
                          <h2 class="day">Wed</h2>
                          <h3 class="degrees">27</h3>
                          <canvas height="32" width="32" id="snow"></canvas>
                          <h5>14 <i>km/h</i></h5>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="daily-weather">
                          <h2 class="day">Thu</h2>
                          <h3 class="degrees">28</h3>
                          <canvas height="32" width="32" id="sleet"></canvas>
                          <h5>15 <i>km/h</i></h5>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="daily-weather">
                          <h2 class="day">Fri</h2>
                          <h3 class="degrees">28</h3>
                          <canvas height="32" width="32" id="wind"></canvas>
                          <h5>11 <i>km/h</i></h5>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="daily-weather">
                          <h2 class="day">Sat</h2>
                          <h3 class="degrees">26</h3>
                          <canvas height="32" width="32" id="cloudy"></canvas>
                          <h5>10 <i>km/h</i></h5>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </div>

              </div>
              <!-- end of weather widget -->
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
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

  <script src="js/bootstrap.min.js"></script>

  <!-- gauge js -->
  <script type="text/javascript" src="js/gauge/gauge.min.js"></script>
  <script type="text/javascript" src="js/gauge/gauge_demo.js"></script>
  <!-- bootstrap progress js -->
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <!-- icheck -->
  <script src="js/icheck/icheck.min.js"></script>
  <!-- daterangepicker -->
  <script type="text/javascript" src="js/moment/moment.min.js"></script>
  <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>
  <!-- chart js -->
  <script src="js/chartjs/chart.min.js"></script>

  <script src="js/custom.js"></script>

  <!-- flot js -->
  <!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
  <script type="text/javascript" src="js/flot/jquery.flot.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.pie.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.orderBars.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.time.min.js"></script>
  <script type="text/javascript" src="js/flot/date.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.spline.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.stack.js"></script>
  <script type="text/javascript" src="js/flot/curvedLines.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.resize.js"></script>
  <script>
    $(document).ready(function() {
      // [17, 74, 6, 39, 20, 85, 7]
      //[82, 23, 66, 9, 99, 6, 2]
      var data1 = [
        [gd(2012, 1, 1), 17],
        [gd(2012, 1, 2), 74],
        [gd(2012, 1, 3), 6],
        [gd(2012, 1, 4), 39],
        [gd(2012, 1, 5), 20],
        [gd(2012, 1, 6), 85],
        [gd(2012, 1, 7), 7]
      ];

      var data2 = [
        [gd(2012, 1, 1), 82],
        [gd(2012, 1, 2), 23],
        [gd(2012, 1, 3), 66],
        [gd(2012, 1, 4), 9],
        [gd(2012, 1, 5), 119],
        [gd(2012, 1, 6), 6],
        [gd(2012, 1, 7), 9]
      ];
      $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
        data1, data2
      ], {
        series: {
          lines: {
            show: false,
            fill: true
          },
          splines: {
            show: true,
            tension: 0.4,
            lineWidth: 1,
            fill: 0.4
          },
          points: {
            radius: 0,
            show: true
          },
          shadowSize: 2
        },
        grid: {
          verticalLines: true,
          hoverable: true,
          clickable: true,
          tickColor: "#d5d5d5",
          borderWidth: 1,
          color: '#fff'
        },
        colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
        xaxis: {
          tickColor: "rgba(51, 51, 51, 0.06)",
          mode: "time",
          tickSize: [1, "day"],
          //tickLength: 10,
          axisLabel: "Date",
          axisLabelUseCanvas: true,
          axisLabelFontSizePixels: 12,
          axisLabelFontFamily: 'Verdana, Arial',
          axisLabelPadding: 10
            //mode: "time", timeformat: "%m/%d/%y", minTickSize: [1, "day"]
        },
        yaxis: {
          ticks: 8,
          tickColor: "rgba(51, 51, 51, 0.06)",
        },
        tooltip: false
      });

      function gd(year, month, day) {
        return new Date(year, month - 1, day).getTime();
      }
    });
  </script>

  <!-- worldmap -->
  <script type="text/javascript" src="js/maps/jquery-jvectormap-2.0.3.min.js"></script>
  <script type="text/javascript" src="js/maps/gdp-data.js"></script>
  <script type="text/javascript" src="js/maps/jquery-jvectormap-world-mill-en.js"></script>
  <script type="text/javascript" src="js/maps/jquery-jvectormap-us-aea-en.js"></script>
  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>
  <script>
    $(function() {
      $('#world-map-gdp').vectorMap({
        map: 'world_mill_en',
        backgroundColor: 'transparent',
        zoomOnScroll: false,
        series: {
          regions: [{
            values: gdpData,
            scale: ['#E6F2F0', '#149B7E'],
            normalizeFunction: 'polynomial'
          }]
        },
        onRegionTipShow: function(e, el, code) {
          el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
        }
      });
    });
  </script>
  <!-- skycons -->
  <script src="js/skycons/skycons.min.js"></script>
  <script>
    var icons = new Skycons({
        "color": "#73879C"
      }),
      list = [
        "clear-day", "clear-night", "partly-cloudy-day",
        "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
        "fog"
      ],
      i;

    for (i = list.length; i--;)
      icons.set(list[i], list[i]);

    icons.play();
  </script>

  <!-- Doughnut Chart -->
  <script>
    $('document').ready(function() {
      var options = {
        legend: false,
        responsive: false
      };

      new Chart(document.getElementById("canvas1"), {
        type: 'doughnut',
        tooltipFillColor: "rgba(51, 51, 51, 0.55)",
        data: {
          labels: [
            "Symbian",
            "Blackberry",
            "Other",
            "Android",
            "IOS"
          ],
          datasets: [{
            data: [15, 20, 30, 10, 30],
            backgroundColor: [
              "#BDC3C7",
              "#9B59B6",
              "#E74C3C",
              "#26B99A",
              "#3498DB"
            ],
            hoverBackgroundColor: [
              "#CFD4D8",
              "#B370CF",
              "#E95E4F",
              "#36CAAB",
              "#49A9EA"
            ]
          }]
        },
        options: options
      });
    });
  </script>
  <!-- /Doughnut Chart -->

  <!-- datepicker -->
  <script type="text/javascript">
    $(document).ready(function() {

      var cb = function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
      }

      var optionSet1 = {
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2015',
        dateLimit: {
          days: 60
        },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'left',
        buttonClasses: ['btn btn-default'],
        applyClass: 'btn-small btn-primary',
        cancelClass: 'btn-small',
        format: 'MM/DD/YYYY',
        separator: ' to ',
        locale: {
          applyLabel: 'Submit',
          cancelLabel: 'Clear',
          fromLabel: 'From',
          toLabel: 'To',
          customRangeLabel: 'Custom',
          daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
          monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          firstDay: 1
        }
      };
      $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
      $('#reportrange').daterangepicker(optionSet1, cb);
      $('#reportrange').on('show.daterangepicker', function() {
        console.log("show event fired");
      });
      $('#reportrange').on('hide.daterangepicker', function() {
        console.log("hide event fired");
      });
      $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
        console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
      });
      $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
        console.log("cancel event fired");
      });
      $('#options1').click(function() {
        $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
      });
      $('#options2').click(function() {
        $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
      });
      $('#destroy').click(function() {
        $('#reportrange').data('daterangepicker').remove();
      });
    });
  </script>
  <script>
    NProgress.done();
  </script>
  <!-- /datepicker -->
  <!-- /footer content -->
</body>

</html>