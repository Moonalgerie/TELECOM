  <?php
  
  
//requette afficher le nombre Projet
 $sql1 = "SELECT
Count(`projet`.`Etat_projet`) AS `Nbr`
FROM
`projet` ,
`user`
WHERE
`projet`.`Etat_projet` =  '0' AND
`projet`.`id_user` =  `user`.`id_user` AND
`user`.`pseudo` =  '".$pseudo."'
 ";
 $result1 = mysqli_query($link, $sql1);
$Nbr_Projet = mysqli_fetch_array($result1); 
 
  //requette afficher le nombre Activité 
 $sql3 = "SELECT COUNT(*) as Nbr
FROM
`activite` ,
`user`
WHERE
`activite`.`Etat_activite` =  '0' AND
`activite`.`id_user` =  `user`.`id_user` AND
`user`.`pseudo` =  '".$pseudo."' ";
 $result3 = mysqli_query($link, $sql3);
$Nbr_Act = mysqli_fetch_array($result3);

//requette afficher le nombre Tache
 $sql2 = "SELECT COUNT(*) as Nbr
FROM
`tache_projet` ,
`user` ,
`projet`
WHERE
`tache_projet`.`Etat_tache` =  '0' AND
`tache_projet`.`id_projet` =  `projet`.`id_projet` AND
`projet`.`id_user` =  `user`.`id_user` and 
`user`.`pseudo` =  '".$pseudo."'
 ";
 $result2 = mysqli_query($link, $sql2);
$Nbr_Tache = mysqli_fetch_array($result2);


//requette recuprer les données d'Activité
$sql_NotAct = "SELECT
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
`activite`.`Etat_activite`=0 AND
`user`.`pseudo` =  '".$pseudo."' 
";  

// excuetion la requette 

$result_NotAct = mysqli_query($link, $sql_NotAct);





//requette recuprer les données
$sql_NotProjet = "SELECT
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

$result_NotProjet = mysqli_query($link, $sql_NotProjet);


//requette recuprer les données
$sql_NotTache = "SELECT
`tache_projet`.`id_tache_projet`,
`tache_predifinie`.`Design_tache`,
`tache_projet`.`date_debut_tache`,
`tache_projet`.`date_fin_tache`,
`tache_projet`.`Priorite_tache`,
`projet`.`Design_projet`,
`tache_projet`.`Etat_tache`,
`user`.`Nom_user`,
`user`.`Prenom_user`,
`user`.`pseudo`,
`fonction`.`Design_fonction`
FROM
`tache_projet` ,
`projet` ,
`tache_predifinie`,
`fonction`,
`user` 
WHERE
`tache_projet`.`id_projet` =  `projet`.`id_projet` AND
`tache_projet`.`id_tache` =  `tache_predifinie`.`id_tache` and Etat_tache= 0  AND  
`projet`.`id_user` =  `user`.`id_user` and 
`user`.`id_fonction`= `fonction`.`id_fonction` AND
`user`.`pseudo` = '".$pseudo."' 
";

// excuetion la requette 
$result_NotTache = mysqli_query($link, $sql_NotTache);

  
  
   ?>
        
  
  <!-- top navigation -->
      <div class="top_nav">

        <div class="nav_menu">
          <nav class="" role="navigation">
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="../images/img.jpg" alt=""><?php echo $pseudo;?>
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="../profile/profile.php">  Profile</a>
                  </li>

                  <li><a href="../index.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </li>
                </ul>
              </li>

              <li role="presentation" class="dropdown">
              
              <?php if ($_SESSION['id_fonction'] !== '1')
	{ ?>
                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-archive">Projet</i>
                  
                  <span class="badge bg-green"><?php echo $Nbr_Projet['Nbr']; ?></span>
                </a>
                <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                
                <?php
	while($Row_NotProjet = mysqli_fetch_array($result_NotProjet))
{					
 ?>
                   <li>
    <form id="projet" method="post" action="afficher_projet.php">
   <input type="hidden" name="ci" value="<?php echo $Row_NotProjet["id_projet"]; ?>" />
     <input type="hidden" name="action" value="edit" />  
                          <a href='#' onclick='document.getElementById("projet").submit()'>
             
                      <span class="image">
                                        <img src="../images/img.jpg" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span><?php echo $Row_NotProjet["Nom_user"]; ?></span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        <?php echo $Row_NotProjet["Description_projet"]; ?>...
                                    </span>
                    </a>
                    
                       </form>
                  </li>
                 
                 <?php } ?> 
                  
                  <?php 
				 
                  if ($Nbr_Projet['Nbr'] !== '0'){?>  
                  <li>
                     <div class="text-center">
                      <a href="consultation_projet.php">
                        <strong>Voir Tout</strong>
                        <i class="fa fa-angle-right"></i>
                      
                      </a>
                    </div>
                    
                  </li>
                   <?php } ?>
                </ul>
              </li>
            <!-- /Fin notification Tache --> 

         <!-- Debut notification Tache -->  
        <li role="presentation" class="dropdown">
                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-bell-o">Tache</i>
                  <span class="badge bg-green"><?php echo $Nbr_Tache['Nbr']; ?></span>
                </a>
                <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
             <?php
	while($Row_NotTache = mysqli_fetch_array($result_NotTache))
{					
 ?>
                  <li>
    <form id="Tache" method="post" action="afficher_tache.php">
   <input type="hidden" name="ci" value="<?php echo $Row_NotTache["id_tache_projet"]; ?>" />
     <input type="hidden" name="action" value="edit" />  
                          <a href='#' onclick='document.getElementById("Tache").submit()'>
             
                      <span class="image">
                                        <img src="../images/img.jpg" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span><?php echo $Row_NotTache["Nom_user"]; ?></span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        <?php echo $Row_NotTache["Priorite_tache"]; ?>...
                                    </span>
                    </a>
                    
                  </form>
                  </li>
                 
                 <?php } ?> 
                  
                    <?php 
				 
                  if ($Nbr_Tache['Nbr'] !== '0'){?>
                  <li>
                    <div class="text-center">
                      <a href="consultation_tache.php">
                        <strong>Voir Tout</strong>
                        <i class="fa fa-angle-right"></i>
                   
                      </a>
                    </div>
                  </li>
                <?php } ?>
                </ul>
              </li>
            <!-- /Fin notification Tache -->   

<!-- /Debut notification Activité --> 
              <li role="presentation" class="dropdown">
                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-male">Activité</i>
                  <span class="badge bg-green"><?php echo $Nbr_Act['Nbr']; ?></span>
                </a>
                
                <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
            <?php
	while($Row_Act = mysqli_fetch_array($result_NotAct))
{					
 ?>
                   <li>
    <form id="Activite" method="post" action="afficher_activite.php">
   <input type="hidden" name="ci" value="<?php echo $Row_Act["id_activite"]; ?>" />
     <input type="hidden" name="action" value="edit" />  
                          <a href='#' onclick='document.getElementById("Activite").submit()'>
             
                      <span class="image">
                                        <img src="../images/img.jpg" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span><?php echo $Row_Act["Nom_user"]; ?></span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        <?php echo $Row_Act["Design_activite"]; ?>...
                                    </span>
                    </a>
                    
                  </form>
                  </li>
                 
                 <?php } ?> 
                 
                 <?php 
				 
                  if ($Nbr_Act['Nbr'] !== '0'){?>
                  <li>
                  
                  
                    <div class="text-center">
                      <a href="consultation_activite.php">
                        <strong>Voir Tout</strong>
                        <i class="fa fa-angle-right"></i>
                      
                      </a>
                    </div>
                     <?php } ?>
                  </li>
                  
                  
                </ul>
              </li>
        <!-- /fin notification Activité -->  


  <?php } ?>

            </ul>
          </nav>
        </div>

      </div>
      <!-- /top navigation -->
        
     