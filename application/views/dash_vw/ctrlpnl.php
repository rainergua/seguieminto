<div class="container">

<div class="row">
    <?php
    if(0){
        ?>
    <div class="col s12 m2 l2">
        <a href="../reportar/envreporte"><img class="imagen" src="<?php echo base_url().'files/img/reportem.png'; ?>">
        <div class="texto-menu">Reportar</div></a>
    </div>
    <div class="col s12 m2 l2">
        <a href="../reportar/edicion"><img class="imagen" src="<?php echo base_url().'files/img/elirepm.png'?>">
        <div class="texto-menu">Eliminar Imagen</div></a>
    </div>
    <div class="col s12 m2 l2">
        <a href="<?php echo base_url().'listado/devdeptos'?>"><img class="imagen" src="<?php echo base_url().'files/img/seguimiento.png'?>">
        <div class="texto-menu">Seguimiento</div></a>
    </div>
    <div class="col s12 m2 l2">
        <a href="../cuestionario"><img class="imagen" src="<?php echo base_url().'files/img/cuestionario.png'?>">
        <div class="texto-menu">Cuestionario UCPD</div></a>
    </div>
    <?php }
    ?>
    <div class="col s12 m2 l2"></div>
<?php
$perfil = $this->session->userdata('perfil');
switch ($perfil) {
    case 'a':
        $frase = 'Administracion';
        $link = 'admin';
        break;
    case 'o':
        $frase = 'Distrito Educativo';
        $link = 'reportedis';
        break;
    case 'd':
        $frase = 'Departamento';
        $link = 'reportedep';
        break;
    case 'i':
        $frase = 'UE';
        $link = 'reporteue';
        break;
    case 'p':
        $frase = 'UE';
        $link = 'reporteue';
        break;
    case 's':
        $frase = 'UE';
        $link = 'reporteue';
        break;
    case 'u':
        $frase = 'UE';
        $link = 'reporteue';
        break;
    case 'r':
        $frase = 'UE';
        $link = 'reporteue';
        break;
    case 't':
        $frase = 'UE';
        $link = 'reporteue';
        break;
    case 'e':
        $frase = 'UE';
        $link = 'reporteue';
        break;
}
?>
    <div class="col s12 m2 l2">
        <a href="../cuestionario"><img class="imagen" src="<?php echo base_url().'files/img/cuestionario.png'?>">
        <div class="texto-menu">Cuestionario UCPD</div></a>
    </div>
    <div class="col s12 m2 l2">
        <a href="<?php echo base_url().'reportsup/'.$link?>"><img class="imagen" src="<?php echo base_url().'files/img/repue.png'?>">
        <div class="texto-menu">Reportar <?=$frase?></div></a>
    </div>
    <div class="col s12 m2 l2">
        <a href="<?php echo base_url().'cuestionario/kuaa'?>"><img class="imagen" src="<?php echo base_url().'files/img/kuaa.png'?>">
        <div class="texto-menu">Cuestionario KUAA</div></a>
    </div>
    <div class="col s12 m2 l2">
        <a href="<?php echo base_url().'cuestionario/labos'?>"><img class="imagen" src="<?php echo base_url().'files/img/labos.png'?>">
        <div class="texto-menu">Cuestionario Laboratorio</div></a>
    </div>
    <div class="col s12 m2 l2">
        <a href="<?php echo base_url().'login/contactos'?>"><img class="imagen" src="<?php echo base_url().'files/img/contactos.png'?>">
        <div class="texto-menu">Contactanos</div></a>
    </div>
    <div class="col s12 m2 l2"></div>
</div>
</div>
