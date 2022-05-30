<div class="container">
    <div class="row" id="rep_img">
        <?php
        //$arreglo = (array) $deptos;
        foreach($images as $fila){
        ?>
        <div>
          <div class="materialboxed-set col l4 m6 s12 center-align">
              <div class="cajita" id="rep_gal">
                  <img class="materialboxed" width="150" height="150" src="data:image/jpg;base64,<?php echo $fila->imagen;?>">
                  <button type="button" name="button" class="btn red" id='<?php echo $fila->codigo;?>'>Eliminar</button>
              </div>
          </div>
        </div>
    <?php } ?>
    </div>
    <div class="row">
        <div class="center-align">
            <a href="<?php echo base_url();?>reportar/print_comp" class="btn red" id='<?php echo $fila->codigo;?>'>Imprimir Reporte</a>
        </div>
    </div>
</div>
