<div class="container">
    <div class="row">
        <h5 class="center-align">Cuestionario diagnóstico sobre el uso de laboratorios de Ciencias</h5>
    </div>
    <?php
    $att = array('id' => 'cuestlab', 'class' =>'form-group', 'enctype' => 'multipart/form-data');
    ?>
    <?php echo form_open(base_url().'cuestionario/guardalab', $att);
    ?>
    <div class="row">
        <div class="col l6 m6 s6"><b>Departamento:</b> <?=$datos->departamento?></div>
        <div class="col l6 m6 s6"><b>Distrito:</b> <?=$datos->distrito?></div>
    </div>
    <div class="row">
        <div class="col l12 m12 s"><b>Unidad Educativa:</b> <?=$datos->des_ue?> - <?=$datos->programa?></div>
    </div>
    <div class="row">
        <div class="col l6 m6 s12">
            <label for="labo">¿La Unidad Educativa cuenta con laboratotio de Ciencias?</label>
            <select class="browser-default" name="labo" id="labo">
                <option value=''>Elija una opción</option>
                <option value='Si'>Si</option>
                <option value='No'>No</option>
            </select>
        </div>
        <div class="col l6 m6 s12">
            <label for="fulabo">El laboratorio con el que cuenta la Unidad Educativa fue entregado por:</label>
            <select class="browser-default" name="fulabo" id="fulabo">
                <option value=''>Elija una opción</option>
                <option value='minedu'>Ministerio de Educación</option>
                <option value='gam'>Gobierno Autónomo Municipal</option>
                <option value='ong'>ONG</option>
                <option value='otro'>Otro</option>
            </select>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col l6 m6 s12">
            <label for="labinfra">¿La Unidad Educativa cuenta con ambientes apropiados para el funcionamiento del laboratorio?</label>
            <select class="browser-default" name="labinfra" id="labinfra">
                <option value=''>Elija una opción</option>
                <option value='Si'>Si</option>
                <option value='No'>No</option>
            </select>
        </div>
        <div class="col l6 m6 s12">
            <label for="seglabo">¿Los ambientes cuentan con la seguridad apropiada para la conservación del laboratorio?</label>
            <select class="browser-default" name="seglabo" id="seglabo">
                <option value=''>Elija una opción</option>
                <option value='Si'>Si</option>
                <option value='No'>No</option>
            </select>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col l6 m6 s12">
            <label for="capmaes">¿Que porcentaje de maestras y maestros de La Unidad Educativa estan capacitados en el uso de laboratorios? </label>
            <input type="number" name="capmaes" id="capmaes">
        </div>
        <div class="col l6 m6 s12">
            <label for="usolab">¿Los estudantes de la Unidad Educativa utilizan el laboratorio? </label>
            <select class="browser-default" name="usolab" id="usolab">
                <option value=''>Elija una opción</option>
                <option value='Si'>Si</option>
                <option value='No'>No</option>
            </select>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col l6 m6 s12">
            <label for="gesten">¿En qué gestión se hizo entrega a su Unidad Educativa el laboratorio? </label>
            <input type="number" name="gesten" id="gesten">
        </div>
        <div class="file-field input-field col l6 m6 s12">
            <div class="btn blue accent-4">
                <span>SUbir Imágenes</span>
                <input type="file" id="archivo" name="archivo[]" multiple>
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text" placeholder="Subir una o más imágenes">
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col l4 m4 s12">
        </div>
        <div class="col l4 m4 s12 center-align">
            <button type="reset" name="button" class="btn red">Borrar</button>
            <button type="submit" class="btn">Enviar</button>
        </div>
        <div class="col l4 m4 s12">

        </div>
    </div>
    <?php echo form_close();?>
</div>

<div class="modal" tabindex="-1" role="dialog" id="mymodal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title acordion-link">Sus datos estan siendo enviados</h5>
            </div>
            <div class="modal-body">
                <p>Está seguro de enviar los datos?<br>
                <span class="cursos"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn blue darken-1" id="confirmar">Confirmar envío</button>
                <button type="button" class="modal-action modal-close waves-effect waves-green btn red darken-1" data-dismiss="modal">Revisar</button>
            </div>
        </div>
    </div>
</div>