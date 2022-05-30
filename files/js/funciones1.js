$(document).ready(inicio);
function inicio() {
    $("#departamento").change(cambiaDepto);
    $("#distrito").change(cambiaDist);
    $("#ues").change(cambiaUes);
    $("#img-modal").modal();
    $(".materialboxed").materialbox();
    $('.sidenav').sidenav();
    $("#cuestionario").validate({
        rules: {
            'contenido[]': {required: true},
            'programas[]': {required: true},
            'planificacion[]': {required: true},
            'desarrollo[]': {required: true},
            'capacitacion': {required: true, min: 0},
            'evento': {required: true, min:0},
            'acceso[]': {required: true},
            'tecinter[]': {required: true},
            'portal[]': {required: true}
        },
        messages: {
            'contenido[]': {required: "Elija al menos una opción"},
            'programas[]': {required: "Elija al menos una opción"},
            'planificacion[]': {required: "Elija al menos una opción"},
            'desarrollo[]': {required: "Elija al menos una opción"},
            'capacitacion': {required: "Valor Obligatorio", min: "Solo valores válidos"},
            'evento': {required: "Valor Obligatorio", min: "Solo valores válidos"},
            'acceso[]': {required: "Elija al menos una opción"},
            'tecinter[]': {required: "Elija al menos una opción"},
            'portal[]': {required: "Elija al menos una opción"}
        },
        submitHandler: function(form){
            alert("Sus datos fueron enviados");
            url = base_url()+"login/panelctrl";
            $(location).attr("href", url);
            return false;
        }
    });
    if(actual_url('reporteue'))
        editarTabla();
    if(actual_url('envreporte')){
        uploadHBR.init({
                    "target": "#uploads",
                    "max": 6,
                    "textNew": "Adicionar",
                    "textTitle": "Click aqui o arrastrar para subir la imágen",
                    "textTitleRemove": "Click aqui para remover la imagen"
                });
                $('#reset').click(function () {
                    uploadHBR.reset('#uploads');
                });
    }
    $("#maestros").on("click",".btn",function(e){
        $('.slides').html('');
        rda = this.id;
        $.post(base_url()+"listado/getImagenes", {rda : rda},
        function(data){
            var fotos = JSON.parse(data);
            imagenes = '';
            for(i=0; i<fotos.length;i++){
                imagenes+="<li>";
                imagenes+="<img src='data:image/png;base64," + fotos[i].imagen + "' class='responsive-img' height='500px' width='auto'>";
                imagenes+="</li>";
            }

            $('.slides').html(imagenes);
            $('.slider').slider({height: 500});
            imagenes='';
        });
    });

    $("#rep_img").on("click",".btn",function(e){
        var r = confirm("¿Esta seguro de eliminar la imagen?");
        if(r == true){
            imagenes = '';
            $('#rep_img').html(imagenes);
            id_img = this.id;
            $.post(base_url()+"reportar/borrar", {id_img : id_img},
                function(data){
                    var fotos = JSON.parse(data);
                    for(i=0; i<fotos.length;i++){
                        imagenes+="<div>";
                        imagenes+="<div class='materialboxed-set col l4 m6 s12 center-align'>";
                        imagenes+="<div class='cajita' id='rep_gal'>";
                        imagenes+="<img class='materialboxed' width='150' height='150' src='data:image/jpg;base64," + fotos[i].imagen + "'>";
                        imagenes+="<button type='button' name='button' class='btn red' id='"+fotos[i].codigo+"'>Eliminar</button>";
                        imagenes+="</div></div></div>";
                    }
                    $('#rep_img').html(imagenes);
                });
        }else{

        }
            });

}
function base_url()
{
	var base = window.location.href.split('/');
	var todo = window.location.href;
	return base[0]+ '//' + base[2] + '/' + base[3] + '/';
}
function actual_url(controler)
{
	var base = window.location.href.split('/');
	var todo = window.location.href;
    if(base[5]==controler && base.length==6)
	   return true;
      else {
          return false;
      }
}

function enviaDataDep(){
    deptosel = $('#departamento').val();
    $.post(base_url()+"listado/llenaDepto", {deptosel : deptosel},
    function(data){
        $("#distrito").html(data);
    });
}
function enviaDataDist(){
    distsel = $('#distrito').val();
    $.post(base_url()+"listado/llenaDist", {distsel : distsel},
    function(data){
        $("#ues").html(data);
    });
}
function enviaDataUe(){
    distsel = $('#ues').val();
    $.post(base_url()+"listado/llenaMaestros", {uesel : distsel},
    function(data){
        var maestros = JSON.parse(data);
        var tablaFinal = '<table class="striped responsive-table centered">';
        tablaFinal += '<thead><tr><th>RDA</th><th>CARNET</th><th>NOMBRE COMPLETO</th><th>SERIE</th><th>REPORTES</th><th></th></thead>';
        for(i=0; i<maestros.length;i++){
            boton = maestros[i].reportes==0 ? '' : '<button type=button data-target="img-modal" class="btn modal-trigger" id='+maestros[i].cod_rda+'>Ver imágenes</button>' ;
            tablaFinal+='<tr><td>'+maestros[i].cod_rda+'</td><td>'+ maestros[i].carnet+'</td><td>'+(maestros[i].paterno).trim()+' '+(maestros[i].materno).trim()+' '+(maestros[i].nombre1).trim()+' '+(maestros[i].nombre2).trim();
            tablaFinal+='<td>'+maestros[i].serie+'</td><td>'+maestros[i].reportes+'</td><td>'+ boton + '</td></tr>';
        }
        tablaFinal+='</table>';
        $('#maestros').html(tablaFinal);
    });
}
function cambiaDepto(){
    $("#maestros").html('');
    $("#ues").html('<option value=“0”>Seleccione Unidad Educativa</option>');
    $("#departamento option:selected").each(enviaDataDep);
}
function cambiaDist(){
    $("#maestros").html('');
    $("#distrito option:selected").each(enviaDataDist);
}
function cambiaUes(){
    $("#ues option:selected").each(enviaDataUe);
}

function editarTabla(){
    $('#editable_table').Tabledit({
        url: base_url()+'reportsup/procesa',
        deleteButton: false,
        //editButton: ,
        autoFocus: false,
        restoreButton: false,
        //saveButton: false,
        buttons:{
            edit:{
                class: 'btn blue',
                html: 'Editar',
                action: 'edit'
            },
            save:{
                 class: 'btn btn-sm btn-primary red',
                html: 'Guardar',
                 action: 'save'
            },
        },
        columns:{
            identifier: [2, 'carnet'],
            editable: [[6, 'funcionamiento','{"Si":"Si", "No":"No"}'],
                        [7, 'conservacion','{"Bueno":"Bueno", "Regular":"Regular","Malo":"Malo"}'],
                        [8, 'uso', '{"Aula":"Aula", "Casa":"Casa","Otro Lugar":"Otro Lugar","Todos":"Todos"}'],
                        [9, 'observacion', '{"Jubilación":"Jubilación", "Retiro":"Retiro", "Proceso Penal":"Proceso Penal", "Proceso Administrativo":"Proceso Administrativo","Ninguno":"Ninguno"}']]
        },
        onSuccess: function(data, textStatus, jqXHR){
            if(data.action == 'edit'){
                console.log(data);
            }else{
                console.log(data);
            }
        }
    });
}
