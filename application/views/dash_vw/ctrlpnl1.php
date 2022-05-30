<div class="container">

<div class="row">
    <div class="col s12 m4 l4">
      <div class="card">
        <span class="card-title">Reportar</span>
        <div class="card-image">
          <img src="../files/img/reportem.png">
        </div>
        <div class="card-content">
          <p>Ingresando a este enlace puede realizar el reporte de su computadora.</p>
        </div>
        <div class="card-action">
          <a href="../reportar/envreporte">Ingresar</a>
        </div>
      </div>
    </div>
    <div class="col s12 m4 l4">
      <div class="card">
        <span class="card-title">Eliminar imágenes.</span>
        <div class="card-image">
          <img src="../files/img/elirepm.png">
        </div>
        <div class="card-content">
          <p>Ingresando a este enlace puede borrar las imágenes que haya reportado por error.</p>
        </div>
        <div class="card-action">
             <a href="../reportar/edicion">Ingresar</a>
        </div>
      </div>
    </div>
    <div class="col s12 m4 l4">
      <div class="card">
        <span class="card-title">Cuestionario</span>
        <div class="card-image">
          <img src="../files/img/cuestionario.png">
        </div>
        <div class="card-content">
          <p>Cuestionario de detección de necesidades de capacitación para beneficiarios del proyecto.</p>
        </div>
        <div class="card-action">
          <a href="../cuestionario">Ingresar</a>
        </div>
      </div>
    </div>
</div>

<?php
$perfil = $this->session->userdata('perfil');
switch ($perfil) {
    case 'a':
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

<div class="row">
    <div class="col s12 m4 l4">
      <div class="card">
        <span class="card-title">Reportar <?=$frase?></span>
        <div class="card-image">
          <img src="../files/img/repue.png">
        </div>
        <div class="card-content">
          <p>Ingresando a este enlace puede realizar el reporte de su <?=$frase?>.</p>
        </div>
        <div class="card-action">
          <a href="../reportsup/<?=$link?>">Ingresar</a>
        </div>
      </div>
    </div>
    <div class="col s12 m4 l4">
      <div class="card">
        <span class="card-title">Seguimiento.</span>
        <div class="card-image">
          <img src="../files/img/seguimiento.png">
        </div>
        <div class="card-content">
          <p>Ingresando a este enlace puede realizar el seguimiento de sus maestros.</p>
        </div>
        <div class="card-action">
          <a href="../listado/devdeptos">Ingresar</a>
        </div>
      </div>
    </div>
    <div class="col s12 m4 l4">
      <div class="card">
        <span class="card-title">Contactanos</span>
        <div class="card-image">
          <img src="../files/img/contactos.png">
        </div>
        <div class="card-content">
          <p>Ingresando a este enlace podrá establecer contacto con el Ministerio de Educación.</p>
        </div>
        <div class="card-action">
          <a href="../login/contactos">Ingresar</a>
        </div>
      </div>
    </div>
</div>
<?php
}?>
</div>
