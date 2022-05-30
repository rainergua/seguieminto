<div class="container">
    <div class="row">
        <h5 class="center-align">Cuestionario diagnóstico sobre el uso de computadoras KUAA dotadas por QUIPUS<br>entre las gestiones <b class="error">2014 y 2019</b></h5>
    </div>
    <?php
    $att = array('id' => 'cuestkuaa', 'class' =>'form-group', 'enctype' => 'multipart/form-data');
    ?>
    <?php echo form_open(base_url().'cuestionario/guardakuaa', $att);
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
            <label for="kuaa">¿Cuantas computadoras KUAA recibió su Unidad Educativa entre las gestiones <b>2014 y 2019</b>?</label>
            <input type="number" name="kuaa" id="kuaa">
        </div>
        <div class="col l6 m6 s12">
            <label for="funkuaa">¿Cuantas computadoras KUAA actualmente se encuantran en funcionamiento?</label>
            <input type="number" name="funkuaa" id="funkuaa">
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col l6 m6 s12">
            <label for="nofunkuaa">¿Cuantas computadoras KUAA actualmente NO se encuantran en funcionamiento?</label>
            <input type="number" name="nofunkuaa" id="nofunkuaa">
        </div>
        <div class="col l6 m6 s12">
            <label for="blqkuaa">¿Cuantas computadoras KUAA actualmente se encuantran bloquedas?</label>
            <input type="number" name="blqkuaa" id="blqkuaa">
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col l6 m6 s12">
            <label for="piso">¿La Unidad Educativa cuenta con piso tecnológico? </label>
            <select class="browser-default" name="piso" id="piso">
                <option value=''>Elija una opción</option>
                <option value='Si'>Si</option>
                <option value='No'>No</option>
            </select>
        </div>
        <div class="col l6 m6 s12">
            <label for="funpiso">¿El piso tecnológico se encuentra en funcionamiento? </label>
            <select class="browser-default" name="funpiso" id="funpiso">
                <option value=''>Elija una opción</option>
                <option value='Si'>Si</option>
                <option value='No'>No</option>
            </select>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col l6 m6 s12">
            <label for="intrnt">¿La Unidad Educativa cuenta con servicio de internet? </label>
            <select class="browser-default" name="intrnt" id="intrnt">
                <option value=''>Elija una opción</option>
                <option value='Si'>Si</option>
                <option value='No'>No</option>
            </select>
        </div>
        <div class="col l6 m6 s12">
            <label for="tecint">¿Por qué medio tecnológico tiene servicio de internet la unidad Educativa? </label>
            <select class="browser-default" name="tecint" id="tecint">
                <option value=''>Elija una opción</option>
                <option value='fibra'>Fibra Óptica</option>
                <option value='adsl'>ADSL</option>
                <option value='wimax'>WiMax</option>
                <option value='satelital'>Satelital</option>
                
            </select>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col l6 m6 s12">
            <label for="estudiantes">¿Los estudiantes de la Unidad Educativa hacen uso regular de las computadoras KUAA? </label>
            <select class="browser-default" name="estudiantes" id="estudiantes">
                <option value=''>Elija una opción</option>
                <option value='Si'>Si</option>
                <option value='No'>No</option>
            </select>
        </div>
        <div class="col l6 m6 s12">
            <label for="maestros">¿Que porcentaje de maestros considera usted que se encuentran capacitados para incorporar las computadoras KUAA en sus procesos educativos? </label>
            <input type="number" name="maestros" id="maestros">
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col l6 m6 s12">
            <label for="elec">¿Las aulas donde funcionan las computadoras KUAA, tienen electricidad constante? </label>
            <select class="browser-default" name="elec" id="elec">
                <option value=''>Elija una opción</option>
                <option value='Si'>Si</option>
                <option value='No'>No</option>
            </select>
        </div>
        <div class="col l6 m6 s12">
            <label for="aula">¿Existen aulas o laboratorios exclusivos para el uso de las computadoras KUAA? </label>
            <select class="browser-default" name="aula" id="aula">
                <option value=''>Elija una opción</option>
                <option value='Si'>Si</option>
                <option value='No'>No</option>
            </select>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col l6 m6 s12">
            <label for="seguro">¿Las aulas donde funcionan las computadoras KUAA, cuentan con medidas de seguridad? </label>
            <select class="browser-default" name="seguro" id="seguro">
                <option value=''>Elija una opción</option>
                <option value='Si'>Si</option>
                <option value='No'>No</option>
            </select>
        </div>
        <div class="col l6 m6 s12">
            <label for="almseg">¿Las computadoras KUAA, son almacenadas o guardadas en depósitos seguros? </label>
            <select class="browser-default" name="almseg" id="almseg">
                <option value=''>Elija una opción</option>
                <option value='Si'>Si</option>
                <option value='No'>No</option>
            </select>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col l6 m6 s12">
            <label for="soporte">¿Existe soporte y mantenimiento a las computadoras KUAA por parte de su Municipio? </label>
            <select class="browser-default" name="soporte" id="soporte">
                <option value=''>Elija una opción</option>
                <option value='Si'>Si</option>
                <option value='No'>No</option>
            </select>
        </div>
        
        <div class="file-field input-field col l6 m6 s12">
            <div class="btn blue accent-4">
                <span>Subir Imágenes</span>
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