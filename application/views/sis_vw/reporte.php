<div class="row">
    <div class="col-md-12">
        <div class="col-md-12 text-center">
            <form role="form" action='<?=base_url()?>reportar/images' method="post" enctype="multipart/form-data">
                <div class="row">

                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="col-md-12 col-lg-12 col-xs-12" id="columns">
                            <h3 class="form-label">Seleccionar imágenes</h3>
                            <div class="desc"><p class="text-center">O arrastrar a las cajas segmentadas</p></div>
                            <div id="uploads"><!-- Upload Content --></div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col m12 l12 s12">
                            <button class="btn btn-danger btn-lg pull-left" id="reset" type="button" ><i class="fa fa-history"></i> Limpiar</button>
                            <button class="btn btn-primary btn-lg pull-right" type="submit" ><i class="fa fa-upload"></i> Guardar </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url().'files/js/upload/modernizr.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'files/js/upload/uploadHBR.min.js'; ?>"></script>

<?php
$this->load->helper('html');
$link = array(
'href' => 'files/css/upload/style.min.css',
'rel' => 'stylesheet',
'type' => 'text/css',
);
echo link_tag($link);?>
<?php
$this->load->helper('html');
$link = array(
'href' => 'files/css/upload/responsive.min.css',
'rel' => 'stylesheet',
'type' => 'text/css',
);
echo link_tag($link);?>
<link id="bootstrap-styleshhet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
