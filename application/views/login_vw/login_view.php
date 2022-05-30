<?php
	$username = array('name' => 'username', 'placeholder' => 'Carnet');
	$password = array('name' => 'password',	'placeholder' => 'RDA');
	$submit = array('name' => 'submit', 'value' => 'Iniciar sesión', 'title' => 'Iniciar sesión', 'class' => 'btn');
	?>
	<div class="row">
			<div class="col s12 m12 l12">
				<h5 class="center">Ingrese sus Datos</h5>
			</div>
	</div>

	<div class="row">
			<div class="input-field col s1 m3 l3"></div>
			<div class="input-field col s10 m6 l6">
				<?=form_open(base_url().'login/ingresar')?>
				<label for="username">Carnet:</label><?=form_input($username)?><?=form_error('username')?></div>
			<div class="input-field col s1 m3 l3"></div>
	</div>
	<div class="row">
			<div class="input-field col s1 m3 l3"></div>
			<div class="input-field col s10 m6 l6">
				<label for="password">RDA:</label><?=form_password($password)?><?=form_error('password')?></div>
			<div class="input-field col s1 m3 l3"></div>
	</div>
	<?=form_hidden('token',$token)?>
	<div class="row">
				<div class="input-field col s3 m3 l3"></div>
				<div class="input-field col s6 m6 l6 center">
					<?=form_submit($submit)?>
				<?=form_close()?>
				</div>
				<div class="input-field col s3 m3 l3"></div>
	</div>

	<?php
	if($this->session->flashdata('usuario_incorrecto'))
	{
	?>
		<div class="row">
		<div class="col s12 m12 l12 center red-text">
		<?=$this->session->flashdata('usuario_incorrecto')?></div>
		</div>
	<?php
	}
	?>
