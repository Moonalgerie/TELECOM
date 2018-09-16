
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">

          <div class="navbar nav_title" style="border: 0;">
            <a href="../Accueil.php" class="site_title"><i class="fa fa-group"></i> <span>Accueil</span></a>
          </div>
          <div class="clearfix"></div>

          <!-- menu prile quick info -->
          <div class="profile">
            <div class="profile_pic">
              <img src="../images/img.jpg" alt="..." class="img-circle profile_img">
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
              
                <li><a><i class="fa fa-group"></i>Accueil<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                  
                    <li><a href="../Accueil.php">Accueil</a>
                    </li>
                  </ul>
                </li>
                
                <li><a><i class="fa fa-edit"></i>Projet<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                  <?php if ($_SESSION['id_fonction'] == '1')
	{?>
                    <li><a href="../projet/form_projet.php">Nouveau Projet</a></li>
                    <?php } ?>
                    
                    <li><a href="../projet/consulter_projet.php">Projet En Cours de Réalisation</a>
                    </li>
                  </ul>
                </li>
                 <li><a><i class="fa fa-edit"></i>Tache<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="../tache/form_tache.php">Nouvelle Tache</a>
                    </li>
                    <li><a href="../tache/consulter_tache.php">Tache En Cours de Réalisation</a>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-table"></i>Activitée<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="../activite/form_activite.php">Nouvelle Activitée</a>
                    </li>
                    <li><a href="../activite/consulter_activite.php">Activitée En Cours de Réalisation</a>
                    </li>
                  </ul>
                </li>
           <li><a><i class="fa fa-edit"></i>Client<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">      
                <li><a href="#client">Client</a>
                    <ul class="nav child_menu" style="display: none">
                            <li class="sub_menu"><a href="../client/form_client.php">Nouveau Client</a>
                            </li>
                            <li><a href="../client/consulter_client.php">Liste des Clients</a>
                            </li>
                  </ul>
                    </li>
                    <li><a href="#contact_client">Contacts des Clients</a>
                     <ul class="nav child_menu" style="display: none">
                            <li class="sub_menu"><a href="../contact_client/form_contact_client.php">Nouveau Contact</a>
                            </li>
                            <li><a href="../contact_client/consulter_contact_client.php">Liste des Contacts</a>
                            </li>
                      </ul>
                    </li>
                  </ul>
                </li>
                
                  <li><a><i class="fa fa-edit"></i>Partenaire<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">      
                
                <li><a href="#partenaire">Partenaire</a>
                   <ul class="nav child_menu" style="display: none">
                   <li class="sub_menu">
                            <?php if ($_SESSION['id_fonction'] == '1')
	{ ?>
                           <li> <a href="../fournisseur/form_fourn.php">Nouveau Partenaire</a>
                            </li>
                    <?php } ?>
                    </li>    
                        
                            <li><a href="../fournisseur/consulter_fourn.php">Liste des Partenaires</a>
                            </li>
                  </ul>
                    </li>
                    <li><a href="#contact_fourn">Contacts des Partenaires</a>
                    <ul class="nav child_menu" style="display: none">
                             <?php if ($_SESSION['id_fonction'] == '1')
	{ ?>
                            <li class="sub_menu"><a href="../contact_fournisseur/form_contact_fourn.php">Nouveau Contact</a>
                            </li>
                             <?php } ?>
                            
                            <li><a href="../contact_fournisseur/consulter_contact_fourn.php">Liste des Contacts</a>
                            </li>
                      </ul>
                     </li>
                  </ul>
                </li>
               <?php if ($_SESSION['id_fonction'] == '1')
	{ ?>
                <li><a><i class="fa fa-desktop"></i>Utilisateur<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="../user/form_user.php">Nouvel Utilisateur</a>
                    </li>
                    
                    <li><a href="../user/consulter_user.php">Liste Des Utilisateurs</a>
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
            <a href="../index.php" data-toggle="tooltip" data-placement="top" title="Logout">
      <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div>
          <!-- /menu footer buttons -->
        </div>
      </div>