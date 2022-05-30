<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<script type="text/javascript" src="<?php echo base_url().'files/js/jquery.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'files/js/material/materialize.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'files/js/tabledit/jquery.tabledit.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'files/js/valid/jquery.validate.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'files/js/funciones.js'; ?>"></script>
	<?php
	$this->load->helper('html');
	$link = array(
	'href' => 'files/css/material/materialize.min.css',
	'rel' => 'stylesheet',
	'type' => 'text/css',
	);
	echo link_tag($link);?>
	<?php
	$this->load->helper('html');
	$link = array(
	'href' => 'files/css/estilo.css',
	'rel' => 'stylesheet',
	'type' => 'text/css',
	);
	echo link_tag($link);?>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
<div class="navbar-fixed">
<nav class="blue-minedu">
   <div class="nav-wrapper">
	 <a href="<?php echo base_url();?>" class="brand-logo">Logo</a>
	 <?php
	 if($this->session->userdata('is_logued_in')){
		 ?>
	 <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
	 <?php
 }
 ?>
	 <ul class="right hide-on-med-and-down">
		 <?php
		 if($this->session->userdata('is_logued_in')){
			 ?>
	   <li><a href="<?php echo base_url().'login/panelctrl';?>">Panel de control</a></li>
	   <li><a href="<?php echo base_url().'login/logout';?>">Salir</a></li>
	   <?php
   }
   ?>
	 </ul>
   </div>
 </nav>
</div>
<?php
if($this->session->userdata('is_logued_in')){
	?>
 <ul class="sidenav" id="mobile-demo">
	 <li><a href="<?php echo base_url().'login/panelctrl';?>">Panel de control</a></li>
     <li><a href="<?php echo base_url().'login/logout';?>">Salir</a></li>
 </ul>
 <?php
}
?>
<main>
<div class="section">
	<h4 class="center">UNA COMPUTADORA POR DOCENTE
	</h4>
	<div class="row">
		<div class="flow-text center">
			<?php
			if($this->session->userdata('is_logued_in')){ ?>
				Bienvenido(a) <?=$this->session->userdata('nombre');
			}?>
		</div>
	</div>
