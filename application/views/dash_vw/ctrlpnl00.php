<div class="container">

<div class="row">
    <div class="col s12 m2 l2">
        <a href="../reportar/envreporte"><img class="imagen" src="../files/img/reportem.png">
        <div class="texto-menu">Reportar</div></a>
    </div>
    <div class="col s12 m2 l2">
        <a href="../reportar/edicion"><img class="imagen" src="../files/img/elirepm.png">
        <div class="texto-menu">Eliminar Imagen</div></a>
    </div>
    <div class="col s12 m2 l2">
        <a href="../cuestionario"><img class="imagen" src="../files/img/cuestionario.png">
        <div class="texto-menu">Cuestionario</div></a>
    </div>
<!--/div-->

<?php
$perfil = $this->session->userdata('perfil');
switch ($perfil) {
    case 'a':
        $frase = 'Administracion';
        $link = 'admin';
        break;
    case 'i':
        $frase = 'Distrito Educativo';
        $link = 'reportedis';
        break;
    case 'd':
        $frase = 'Departamento';
        $link = 'reportedep';
        break;
    case 'u':
        $frase = 'UE';
        $link = 'reporteue';
        break;
}
if($perfil!='m'){
?>

<!--div class="row"<span class="card-title">Reportar <?=$frase?></span>-->
    <div class="col s12 m2 l2">
        <a href="../reportsup/<?=$link?>"><img class="imagen" src="../files/img/repue.png">
        <div class="texto-menu">Reportar <?=$frase?></div></a>
    </div>
    <div class="col s12 m2 l2">
        <a href="../listado/devdeptos"><img class="imagen" src="../files/img/seguimiento.png">
        <div class="texto-menu">Seguimiento</div></a>
    </div>
    <div class="col s12 m2 l2">
        <a href="../login/contactos"><img class="imagen" src="../files/img/contactos.png">
        <div class="texto-menu">Contactanos</div></a>
    </div>
</div>
<?php
}?>
</div>
