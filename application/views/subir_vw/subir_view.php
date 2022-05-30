<?php
    $archivo = array('id' => 'archivo[]', 'name' => 'archivo[]', 'multiple'=>'', 'class' => 'archivo ', 'size' => '1024','placeholder' => 'archivo',  'accept'=>'application/x-csv');
    $submit = array('name' => 'guardar', 'value' => 'Guardar', 'title' => 'Guardar', 'id' =>'guardar', 'class' =>'btn waves-effect waves-light white-text');
    print("".form_open(base_url()."depurar/subirArchivos", 'id = "proyform" enctype="multipart/form-data" class="col s12 m12 l12"')."");
 ?>
<div class="row">
    <div class="col s12 m12 l12 center">
        <legend><h5>Subir los archivos</h5></legend>
    </div>
</div>
<div class="row">
    <div class="col s12 m9 l9 center">
        <div class="file-field input-field">
            <div class ="btn">
                <span>Subir Archivos</span>
                <?=form_upload($archivo);?>
            </div>
            <div class="file-path-wraper">
                <input type="text" class="file-path validate">
            </div>
        </div>
    </div>
    <div class="col s12 m3 l3 center">
        <?=form_submit($submit);?>
    </div>
</div>
<?=form_close();?>
 <div class="row">
     <div class="col s12 m12 l12 center">
         <div>
             <?=anchor(base_url().'login/logout', 'Cerrar sesión','class="btn waves-effect waves-light red white-text"')?>
         </div>
     </div>
 </div>
