<div class="row">
    <div class="col l4 m4 s12">
        <label for="departamento">Departamento</label>
    <select id=departamento name="departamento" class="browser-default">
    <?php
    $arreglo = (array) $deptos;
    foreach($deptos as $fila){
    ?>
    <option value=<?=$fila->cod_dep ?>><?=$fila->departamento ?></option>
    <?php
    }

    ?>
    </select>
    </div>
    <div class="col l4 m4 s12">
        <label for="distrito">Distrito</label>
        <select name=“distrito” id=distrito class="browser-default">
             <option value=“0”>Seleccione distrito</option>
        </select>
    </div>
    <div class="col l4 m4 s12">
        <label for="ues">Unidad Educativa</label>
        <select name="ues" id="ues" class="browser-default">
             <option value=“0”>Seleccione Unidad Educativa</option>
        </select>
    </div>
</div>
<div class="maestros" id="maestros">

</div>
<div id="img-modal" class="modal">
  <div class="modal-content">
        <div class="slider">
            <ul class="slides">
            </ul>
        </div>
    </div>
</div>
