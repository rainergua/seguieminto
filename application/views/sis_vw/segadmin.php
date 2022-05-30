<div class="row">
    <div class="col l4 m4 s12">
        <label for="depadmin">Departamento</label>
        <select id=depadmin name="depadmin" class="browser-default">
        <?php
        $arreglo = (array) $deptos;
        foreach($deptos as $fila){
        ?>
        <option value=<?=$fila->cod_dep ?>><?=$fila->departamento ?></option>
        <?php
        }
        ?>
        </select>
        <br>
        <button type="button" name="button" id=btndepto class="btn">Ver Departamento</button>
    </div>
    <div class="col l4 m4 s12">
        <label for="distadmin">Distrito</label>
        <select name=“distadmin” id=distadmin class="browser-default">
            <option value=“0”>Seleccione distrito</option>
        </select>
        <br>
        <button type="button" name="button" id=btndist class="btn">Ver Distrito</button>
    </div>
    <div class="col l4 m4 s12">
        <label for="uesadm">Unidad Educativa</label>
        <select name="uesadmin" id=uesadmin class="browser-default">
            <option value=“0”>Seleccione Unidad Educativa</option>
        </select>
    </div>
</div>

<div class="tabfree" id="tabfree">

</div>
