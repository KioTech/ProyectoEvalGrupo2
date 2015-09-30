<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Start Kiotech</title>

       <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>content/vendor/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

   

    <!-- jQuery -->
    <script src="<?php echo base_url(),'content/vendor/js/jquery.js'?>" type="text/javascript"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(),'content/vendor/js/bootstrap.min.js'?>" type="text/javascript"></script>

    <!-- Bootstrap Core CSS -->
    <!-- <link href="< ?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/css/business-frontpage.css" rel="stylesheet" type="text/css" />



    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo base_url(),'content/Assets/Js/validateMsessage.js'?>" type="text/javascript"></script>

    
</head>
  <?php include ('header.php'); ?>
  <!--
  <div class="breadcrumb">
    < ?php if(isset($breadcrumb)){?>
    < ?php echo '<img src="'.base_url().'img/'.$breadcrumb.'"/>';}?>
  </div>
-->
  <body > <!-- oncontextmenu="return false;" -->
    <?php date_default_timezone_set("America/Mexico_City");?>
	  <div id="Contenido">
		  <?php echo $vista ?>
	  </div>
  <?php include ('footer.php'); ?>
</body>
</html>