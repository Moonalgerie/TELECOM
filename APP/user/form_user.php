<?php
//connexion a la base de données
include('../DBConfig.php');
//pour le jrnal d'utilasateur
$pseudo=$_SESSION['pseudo'];
// la date actuale en algerie
date_default_timezone_set("Africa/Algiers");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>DDA | ALGERIE TELECOM </title>

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
        <script type="text/javascript">

function Validate(){
	var valid = true;
	var message = '';
	
	if(nom_client.value.trim() == ''){
		valid = false;
		message = message + '*First Name is required' + '\n';
	}
	if(Tel_client.value.trim() == ''){
		valid = false;
		message = message + '*Last Name is required';
	}
	
	if (valid == false){
		alert(message);
		return false;
	}
}

function GotoHome(){
	window.location = 'form_user.php?';
}

</script>

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
            <div class="title_left">
              <h3>
                    Form Validation
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
            <span class="col-md-6 col-sm-6 col-xs-12">
            </span>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Remplir Formulaire</h2>
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

                 <form class="form-horizontal form-label-left" method="POST" action="index.php" onSubmit="return Validate();" novalidate>
                  
                     
            <input type="hidden" name="id_user" value="<?php echo (isset($gresult) ? $gresult["id_user"] :  ''); ?>" />

                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nom<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="name" class="form-control col-md-7 col-xs-12" name="Nom_user" 
							value="<?php echo (isset($gresult) ? $gresult["Nom_user"] :  ''); ?>"  placeholder="" required type="text">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Prénom<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="name" class="form-control col-md-7 col-xs-12" name="Prenom_user" 
							value="<?php echo (isset($gresult) ? $gresult["Prenom_user"] :  ''); ?>"  placeholder="" required type="text">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="email" id="email" name="Email_user" 
							value="<?php echo (isset($gresult) ? $gresult["Email_user"] :  ''); ?>"  required class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="item form-group">
                    </div>
                     <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Téléphone <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="tel" id="telephone" name="Tel_user" 
							value="<?php echo (isset($gresult) ? $gresult["Tel_user"] :  ''); ?>"  required data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Fonction<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php
include '../DBConfig.php';
$a=isset($gresult) ? $gresult["id_fonction"] :  ''; 
$sql="SELECT * FROM fonction  where id_fonction != '".$a."'; ;";
$result = mysqli_query($link, $sql);?>
<select style="width:500px; height:30px" class="txt-fld" name="id_fonction" id="id_fonction" placeholder="" required>
<option value="<?php echo (isset($gresult) ? $gresult["id_fonction"] :  ''); ?>"><?php echo (isset($gresult) ? $gresult["Design_fonction"] :  ''); ?></option>
<?php while ($row =  mysqli_fetch_array($result)) { ?>
<option value="<?php echo $row["id_fonction"];?>"><?php echo $row["Design_fonction"];?></option>
<?php }?>
</select>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label for="password" class="control-label col-md-3">Mot de Passe*</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="password" type="password" name="password" 
							value="<?php echo (isset($gresult) ? $gresult["password"] :  '');?>"  data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required>
                      </div>
                    </div>
                   <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Pseudonyme<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="occupation" type="text" name="pseudo" 
							value="<?php echo (isset($gresult) ? $gresult["pseudo"] :  '');?>"  class="optional form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Département<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php
include '../DBConfig.php';
$a=isset($gresult) ? $gresult["id_departement"] :  ''; 
$sql="SELECT * FROM departement  where id_departement != '".$a."'; ;";
$result = mysqli_query($link, $sql);?>
<select style="width:500px; height:30px" class="txt-fld" name="id_departement" id="id_departement" placeholder="Département" required>
<option value="<?php echo (isset($gresult) ? $gresult["id_departement"] :  ''); ?>"><?php echo (isset($gresult) ? $gresult["Nom_departement"] :  ''); ?></option>
<?php while ($row =  mysqli_fetch_array($result)) { ?>
<option value="<?php echo $row["id_departement"];?>"><?php echo $row["Nom_departement"];?></option>
<?php }?>
</select>	
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                        <input type="hidden" name="action_type" value="<?php echo (isset($gresult) ? 'edit' :  'add');?>"/>
                     
      <button name="save" id="save" type="submit" class="btn btn-success">Valider</button>
       <button type="submit" class="btn btn-primary" name="save" id="cancel" onclick="return GotoHome();" >Annuler</button>
      
                      </div>
                    </div>
                  </form>
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
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

  <script src="../js/bootstrap.min.js"></script>

  <!-- bootstrap progress js -->
  <script src="../js/progressbar/bootstrap-progressbar.min.js"></script>
  <!-- icheck -->
  <script src="../js/icheck/icheck.min.js"></script>
  <!-- pace -->
  <script src="../js/pace/pace.min.js"></script>
  <script src="../js/custom.js"></script>
  <!-- form validation -->
  <script src="../js/validator/validator.js"></script>
  <script>
    // initialize the validator function
    validator.message['date'] = 'not a real date';

    // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
    $('form')
      .on('blur', 'input[required], input.optional, select.required', validator.checkField)
      .on('change', 'select.required', validator.checkField)
      .on('keypress', 'input[required][pattern]', validator.keypress);

    $('.multi.required')
      .on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });

    // bind the validation to the form submit event
    //$('#send').click('submit');//.prop('disabled', true);

    $('form').submit(function(e) {
      e.preventDefault();
      var submit = true;
      // evaluate the form using generic validaing
      if (!validator.checkAll($(this))) {
        submit = false;
      }

      if (submit)
        this.submit();
      return false;
    });

    /* FOR DEMO ONLY */
    $('#vfields').change(function() {
      $('form').toggleClass('mode2');
    }).prop('checked', false);

    $('#alerts').change(function() {
      validator.defaults.alerts = (this.checked) ? false : true;
      if (this.checked)
        $('form .alert').remove();
    }).prop('checked', false);
  </script>

</body>

</html>
