<?php
session_start();
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
<script type="text/javascript">
function ConfirmDelete(){
	var d = confirm('Do you really want to delete data?');
	if(d == false){
		return false;
	}
}
</script>
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
                  
                     
            <input type="hidden" name="id_tache_projet" value="<?php echo (isset($gresult) ? $gresult["id_tache_projet"] :  ''); ?>" />
            

                   <div class="item form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Tache predifinie<span class="required">*</span></label>

  <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php
include '../DBConfig.php';
$a=isset($gresult) ? $gresult["id_tache"] :  ''; 
$sql="SELECT * FROM tache_predifinie  where id_tache != '".$a."'; ;";
$result = mysqli_query($link, $sql);?>
<select style="width:500px; height:30px" class="txt-fld" name="id_tache" id="id_tache" placeholder="" required>
<option value="<?php echo (isset($gresult) ? $gresult["id_tache"] :  ''); ?>"><?php echo (isset($gresult) ? $gresult["Design_tache"] :  ''); ?></option>
<?php while ($row =  mysqli_fetch_array($result)) { ?>
<option value="<?php echo $row["id_tache"];?>"><?php echo $row["Design_tache"];?></option>
<?php }?>
</select>	
                      </div>
                </div>
                  
                  
                    
                   
                <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Date d'Expression Du Besoin<span class="required">*</span>
                      </label>
     <div class="col-md-6 col-sm-6 col-xs-12">
                       <input name="date_debut_tache" type="text" class="form-control has-feedback-left" id="single_cal1" placeholder="Date debut" aria-describedby="inputSuccess2Status" value="<?php echo (isset($gresult) ? $gresult["date_debut_tache"] :  ''); ?>" required>
                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                              <span id="inputSuccess2Status" class="sr-only">(success)</span>
                      </div>
                      
                      </div>
                     
                     <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Date de Remise<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="date_fin_tache" type="text" class="form-control has-feedback-left" id="single_cal2" placeholder="Date fin" aria-describedby="inputSuccess2Status" value="<?php echo (isset($gresult) ? $gresult["date_fin_tache"] :  ''); ?>" required>
                        
                         <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                              <span id="inputSuccess2Status" class="sr-only">(success)</span>
                      </div>
                    </div>
                     <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Projet Concerné<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php
include '../DBConfig.php';
$a=isset($gresult) ? $gresult["id_projet"] :  ''; 
$sql="SELECT * FROM projet  where id_projet != '".$a."'; ;";
$result = mysqli_query($link, $sql);?>
<select style="width:500px; height:30px" class="txt-fld" name="id_projet" id="id_projet" placeholder="" required>
<option value="<?php echo (isset($gresult) ? $gresult["id_projet"] :  ''); ?>"><?php echo (isset($gresult) ? $gresult["Design_projet"] :  ''); ?></option>
<?php while ($row =  mysqli_fetch_array($result)) { ?>
<option value="<?php echo $row["id_projet"];?>"><?php echo $row["Design_projet"];?></option>
<?php }?>
</select>	
                      </div>
                    </div>
                   <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Priorité<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="name" class="form-control col-md-7 col-xs-12" name="Priorite_tache" 
							value="<?php echo (isset($gresult) ? $gresult["Priorite_tache"] :  ''); ?>"  placeholder="" required type="text">
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                       <input type="hidden" name="action_type" value="<?php echo (isset($gresult) ? 'edit' :  'add');?>"/>
                       <button id="send" type="submit" class="btn btn-success">Valider</button>
                         <button type="submit" class="btn btn-primary">Annuler</button>
                       
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
 <script type="text/javascript" src="../js/moment/moment.min.js"></script>
  <script type="text/javascript" src="../js/datepicker/daterangepicker.js"></script>
   <script type="text/javascript">
            $(document).ready(function() {
              $('#birthday').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4"
              }, function(start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
              });
            });
          </script>
   <script type="text/javascript">
    $(document).ready(function() {
      $('#single_cal1').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_1"
      }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
      });
	   $('#single_cal2').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_1"
      }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
      });
 
    });
  </script>
</body>

</html>
