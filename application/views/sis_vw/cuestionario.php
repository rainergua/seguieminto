<div class="container">
    <div class="row">
        <h5 class="center-align">Cuestionario de Detección de Necesidades de Capacitación en TIC</h5>
    </div>
    <?php
    $att = array('id' => 'cuestionario');
    ?>
    <?php echo form_open(base_url().'cuestionario/guardar', $att);
    ?>
    <div class="row">
        <div class="col l6 m6 s6"><b>Departamento:</b> <?=$datos->departamento?></div>
        <div class="col l6 m6 s6"><b>Distrito:</b> <?=$datos->distrito?></div>
    </div>
    <div class="row">
        <div class="col l12 m12 s"><b>Unidad Educativa:</b> <?=$datos->des_ue?> - <?=$datos->programa?></div>
    </div>
    <div class="row">
        <div class="col l4 m4 s12">
            <label for="ucpd">¿Ha recibido su computadora portátil del proyecto “Una Computadora por Docente”?</label>
                <select class="browser-default" name="ucpd" id="ucpd">
                    <option value='N'>No</option>
                    <option value='S'>Si</option>
                </select>
        </div>
        <div class="col l4 m4 s12" id="marca">
            <label for="marca">¿De qué marca es la computadora que le dotó el gobierno?  </label>
            <select class="browser-default" name="marca" class="">
                <option value='Q'>Quipus</option>
                <option value='S'>Samsung</option>
                <option value='L'>Lenovo</option>
                <option value='O'>Otro</option>
            </select>
        </div>
        <div class="col l4 m4 s12" id="serie">
            <label for="serie">Introduzca el número de serie de su computadora</label>
            <label class="error" for="evento"></label>
            <input type="text" name="serie">
        </div>
    </div>

    <div class="row">
        <div class="col l6 m6 s12">
            <label for="ucpd">¿Usted se capacita en el uso de las TIC?</label>
                <select class="browser-default" name="tic">
                    <option value='S'>Si</option>
                    <option value='N'>No</option>
                </select>
        </div>
        <div class="col l6 m6 s12">
            <label for="desarrollo">Usted, ¿utiliza la computadora portátil (propia o dotada por el gobierno) para el desarrollo de sus clases?  </label>
            <select class="browser-default" name="desclase" class="">
                <option value='S'>Si</option>
                <option value='N'>No</option>
                <option value='V'>Algunas veces</option>
            </select>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col l6 m6 s12">
            <label for="texto">¿Qué nivel de conocimiento tiene sobre el procesador de texto (Word/Writer)?</label>
                <select class="browser-default" name="texto">
                    <option value='N'>Ninguno</option>
                    <option value='B'>Básico</option>
                    <option value='I'>Intermedio</option>
                    <option value='A'>Avanzado</option>
                </select>
        </div>
        <div class="col l6 m6 s12">
            <label for="calc">¿Qué nivel de conocimiento tiene sobre la hoja de cálculo (Excel/Calc)?</label>
                <select class="browser-default" name="calc">
                    <option value='N'>Ninguno</option>
                    <option value='B'>Básico</option>
                    <option value='I'>Intermedio</option>
                    <option value='A'>Avanzado</option>
                </select>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col l6 m6 s12">
            <label for="press">¿Qué nivel de conocimiento tiene sobre el gestor de presentaciones (Power Point/Impress)? </label>
            <select class="browser-default" name="press">
                <option value='N'>Ninguno</option>
                <option value='B'>Básico</option>
                <option value='I'>Intermedio</option>
                <option value='A'>Avanzado</option>
            </select>
        </div>
        <div class="col l6 m6 s12">
            <label for="contenido">Marque las aplicaciones que utiliza para la elaboración de sus recursos educativos digitales para el desarrollo de su clase</label><br />
            <label class="error" for="contenido[]"></label>
            <div class="row">
                <label class="col l6 m6 s12"><input type="checkbox" value="W" name="contenido[]"> <span>Word/Writer</span></label>
                <label class="col l6 m6 s12"><input type="checkbox" value="E" name="contenido[]"> <span>Excel/Calc</span></label>
            </div><div class="row">
                <label class="col l6 m6 s12"><input type="checkbox" value="P" name="contenido[]"> <span>Power Point/Impress</span></label>
                <label class="col l6 m6 s12"><input type="checkbox" value="T" name="contenido[]"> <span>Todos</span></label>
            </div><div class="row">
                <label class="col l6 m6 s12"><input type="checkbox" value="N" name="contenido[]"> <span>Ninguno</span></label>
                <label class="col l6 m6 s12"><input type="checkbox" value="O" name="contenido[]"> <span>Otros</span></label>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col l6 m6 s12">
            <label for ="programas" class="checkbox-inline">Marque las aplicaciones que utiliza para la elaboración de recursos educativos digitales para su clase, como herramienta pedagógica.</label> <br />
            <label class="error" for="programas[]"></label>
            <div class="row">
                <label class="col l6 m6 s12"><input type="checkbox" value="J" name="programas[]"> <span>JClic</span></label>
                <label class="col l6 m6 s12"><input type="checkbox" value="H" name="programas[]"> <span>HotPotatoes</span></label>
            </div><div class="row">
                <label class="col l6 m6 s12"><input type="checkbox" value="S" name="programas[]"> <span>Scratch</span></label>
                <label class="col l6 m6 s12"><input type="checkbox" value="G" name="programas[]"> <span>Geogebra</span></label>
            </div><div class="row">
                <label class="col l6 m6 s12"><input type="checkbox" value="A" name="programas[]"> <span>Ardora</span></label>
                <label class="col l6 m6 s12"><input type="checkbox" value="N|" name="programas[]"> <span>Ninguno</span></label>
            </div><div class="row">
                <label class="col l6 m6 s12"><input type="checkbox" value="T" name="programas[]"> <span>Todos</span></label>
                <label class="col l6 m6 s12"><input type="checkbox" value="O" name="programas6[]"> <span>Otros</span></label>
            </div>
        </div>
        <div class="col l6 m6 s12">
            <label for="planificacion"class="checkbox-inline">Marque las aplicaciones que utiliza para el proceso de planificación del PSP, PAB y PDC. </label><br />
            <label class="error" for="planificacion[]"></label>
            <div class="row">
                <label class="col l6 m6 s12"><input type="checkbox" value="W" name="planificacion[]"> <span>Word/Writer</span></label>
                <label class="col l6 m6 s12"><input type="checkbox" value="E" name="planificacion[]"> <span>Excel/Calc</span></label>
            </div><div class="row">
                <label class="col l6 m6 s12"><input type="checkbox" value="T" name="planificacion[]"> <span>Todos</span></label>
                <label class="col l6 m6 s12"><input type="checkbox" value="N" name="planificacion[]"> <span>Ninguno</span></label>
            </div><div class="row">
                <label class="col l6 m6 s12"><input type="checkbox" value="O" name="planificacion[]"> <span>Otros</span></label>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col l6 m6 s12">
            <label for="desarrollo" class="checkbox-inline">Marque las aplicaciones que utiliza para el desarrollo de los contenidos curriculares. </label><br />
            <label class="error" for="desarrollo[]"></label>
            <div class="row">
                <label class="col l6 m6 s12"><input type="checkbox" value="J" name="desarrollo[]"> <span>JClic</span></label>
                <label class="col l6 m6 s12"><input type="checkbox" value="H" name="desarrollo[]"> <span>HotPotatoes</span></label>
            </div><div class="row">
                <label class="col l6 m6 s12"><input type="checkbox" value="S" name="desarrollo[]"> <span>Scratch</span></label>
                <label class="col l6 m6 s12"><input type="checkbox" value="G" name="desarrollo[]"> <span>Geogebra</span></label>
            </div><div class="row">
                <label class="col l6 m6 s12"><input type="checkbox" value="A" name="desarrollo[]"><span>Ardora</span></label>
                <label class="col l6 m6 s12"><input type="checkbox" value="O" name="desarrollo[]"><span>Otros</span></label>
            </div><div class="row">
                <label class="col l6 m6 s12"><input type="checkbox" value="T" name="desarrollo[]"> <span>Todos</span></label>
                <label class="col l6 m6 s12"><input type="checkbox" value="N" name="desarrollo[]"> <span>Ninguno</span></label>
            </div>
        </div>
        <div class="col l6 m6 s12">
            <label for="desempenio">¿Considera usted que el uso de los programas  mencionados  han contribuido a mejorar su desempeño pedagógico? </label>
            <select class="browser-default" name="desempenio">
                <option value='P'>Poco</option>
                <option value='M'>Mucho</option>
                <option value='N'>Nada</option>
            </select>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col l6 m6 s12">
            <label for="capacitacion">Entre las gestiones 2011 y 2018, ¿de cuántos eventos de capacitación en TIC (Seminario y Talleres, cursos cortos) participó? </label>
            <label class="error" for="capacitacion"></label>
            <input type="number" name="capacitacion" value="0">
        </div>
        <div class="col l6 m6 s12">
            <label for="evento">Usted, entre las gestiones 2011 y 2018, ¿en cuántos eventos relacionados con el uso de las TIC del Ministerio de Educación participo? (Por ejemplo: Encuentros de Red de Maestros, Educa Innova, Ferias de Tecnología, etc.) </label>
            <label class="error" for="evento"></label>
            <input type="number" name="evento" value="0">
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col l6 m6 s12">
            <label for="acceso">Marque desde dónde accede a internet. </label><br />
            <label class="error" for="acceso[]"></label>
            <div class="row">
                <label class="col l6 m6 s12"><input type="checkbox" value="U" name="acceso[]"> <span>Unidad Educativa</span></label>
                <label class="col l6 m6 s12"><input type="checkbox" value="C" name="acceso[]"><span>En Casa</span></label>
            </div><div class="row">
            <label class="col l6 m6 s12"><input type="checkbox" value="T" name="acceso[]"><span>Telecentro</span></label>
            <label class="col l6 m6 s12"><input type="checkbox" value="M" name="acceso[]"><span>Equipo Movil</span></label>
            </div><div class="row">
                <label class="col l6 m6 s12"><input type="checkbox" value="I" name="acceso[]"><span>Café Internet</span></label>
                <label class="col l6 m6 s12"><input type="checkbox" value="N" name="acceso[]"><span>No Accedo</span></label>
            </div>
        </div>
        <div class="col l6 m6 s12">
            <label for="acceso">Marque el medio tecnológico por el cual accede a internet </label><br />
            <label class="error" for="tecinter[]"></label>
            <div class="row">
                <label class="col l6 m6 s12"><input type="checkbox" value="F" name="tecinter[]"> <span>Fibra Óptica</span></label>
                <label class="col l6 m6 s12"><input type="checkbox" value="A" name="tecinter[]"><span>ADSL</span></label>
            </div>
            <div class="row">
            <label class="col l6 m6 s12"><input type="checkbox" value="M" name="tecinter[]"><span>Móvil</span></label>
            <label class="col l6 m6 s12"><input type="checkbox" value="S" name="tecinter[]"><span>Satelital</span></label>
        </div>
        <div class="row">
            <label class="col l6 m6 s12"><input type="checkbox" value="W" name="tecinter[]"><span>Wi Max</span></label>
            <label class="col l6 m6 s12"><input type="checkbox" value="N" name="tecinter[]"><span>No Accedo</span></label>
        </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col l6 m6 s12">
            <label for="apoya">¿Apoya sus contenidos de avance curricular con informacion de internet? </label>
            <select class="browser-default" name="continter">
                <option value='S'>Si</option>
                <option value='N'>No</option>
                <option value='V'>A veces</option>
            </select>
        </div>
        <div class="col l6 m6 s12">
                <label for="planificacion" class="checkbox-inline">Marque si conoce alguno de los siguientes portales educativos </label><br />
                <label class="error" for="portal[]"></label>
            <div class="row">
                <label class="col l6 m12 s12"><input type="checkbox" value="E" name="portal[]"> <span>Educabolivia.bo</span></label>
                <label class="col l6 m12 s12"><input type="checkbox" value="B" name="portal[]"> <span>Bilbliotecaderecursoseducativos.bo</span></label>
            </div><div class="row">
                <label class="col l6 m12 s12"><input type="checkbox" value="N" name="portal[]"> <span>Ninguno</span></label>
                <label class="col l6 m12 s12"><input type="checkbox" value="O" name="portal[]"> <span>Otros</span></label>
            </div>
        </div>
    </div>
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