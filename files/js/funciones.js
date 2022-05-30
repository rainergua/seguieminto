$(document).ready(inicio);
function inicio() {
    $("#marca").hide();
    $("#serie").hide();
    $("#departamento").change(cambiaDepto);
    $("#distrito").change(cambiaDist);
    $("#ues").change(cambiaUes);
    $("#depadmin").change(cmbDeptoAdmin);
    $("#distadmin").change(cmbDistAdmin);
    $("#uesadmin").change(cmbUesAdmin);
    $("#btndepto").click(dataDeptoAdmin);
    $("#btndist").click(dataDistAdmin);
    $("#confirmar").click(enviaData);
    $("#img-modal").modal();
    $("#doc-modal").modal();
    $("#mymodal").modal();
    $(".materialboxed").materialbox();
    $('.sidenav').sidenav(); 
    /*****
     * 
     * 
     */
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
            //alert("Sus datos fueron enviados");
            /*url = base_url()+"cuestionario/guardar";
            $(location).attr("href", url);*/
            $('#mymodal').modal('open');
            //form.submit();
            return false;
        }
    });

    /********************************
     * 
     * INICIOOOOOOOO
     */
    $("#cuestkuaa").validate({
        rules: {
            'kuaa': {required: true, min: 0},
            'funkuaa': {required: true, min: 0},
            'nofunkuaa': {required: true, min: 0},
            'blqkuaa': {required: true, min: 0},
            'piso': {required: true},
            'funpiso': {required: true},
            'intrnt': {required: true},
            'tecint': {required: true},
            'estudiantes': {required: true},
            'maestros': {required: true, min: 0, max: 100},
            'elec': {required: true},
            'aula': {required: true},
            'seguro': {required: true},
            'almseg': {required: true},
            'soporte': {required: true},
            'archivo[]': {required: true}
        },
        messages: {
            'kuaa': {required: "Valor Obligatorio", min: "Solo valores válidos"},
            'funkuaa': {required: "Valor Obligatorio", min: "Solo valores válidos"},
            'nofunkuaa': {required: "Valor Obligatorio", min: "Solo valores válidos"},
            'blqkuaa': {required: "Valor Obligatorio", min: "Solo valores válidos"},
            'piso': {required: "Elija una opción"},
            'funpiso': {required: "Elija una opción"},
            'intrnt': {required: "Elija una opción"},
            'tecint': {required: "Elija una opción"},
            'estudiantes': {required: "Elija una opción"},
            'maestros': {required: "Valor Obligatorio", min: "El valor debe ser mayor o igual a 0", max: "El valor debe ser menor o igual a 100"},
            'elec': {required: "Elija una opción"},
            'aula': {required: "Elija una opción"},
            'seguro': {required: "Elija una opción"},
            'almseg': {required: "Elija una opción"},
            'soporte': {required: "Elija una opción"},
            'archivo[]': {required: "Elija al menos un archivo"}
        },
        submitHandler: function(form){
            //alert("Sus datos fueron enviados");
            /*url = base_url()+"cuestionario/guardar";
            $(location).attr("href", url);*/
            $('#mymodal').modal('open');
            //form.submit();
            return false;
        }
    });

    $("#cuestlab").validate({
        rules: {
            'labo': {required: true},
            'fulabo': {required: true},
            'labinfra': {required: true},
            'seglabo': {required: true},
            'capmaes': {required: true, min: 0, max:100},
            'usolab': {required: true},
            'gesten': {required: true, min:2000, max:2022},
            'archivo[]': {required: true}
        },
        messages: {
            'labo': {required: "Elija una opción"},
            'fulabo': {required: "Elija una opción"},
            'labinfra': {required: "Elija una opción"},
            'seglabo': {required: "Elija una opción"},
            'capmaes': {required: "Valor Obligatorio", min: "Solo valores entre 0 y 100", max: "Solo valores entre 0 y 100"},
            'usolab': {required: "Elija una opción"},
            'gesten': {required: "Valor Obligatorio", min: "Gestión no válida", max: "Gestión no válida"},
            'archivo[]': {required: "Elija al menos un archivo"}
        },
        submitHandler: function(form){
            //alert("Sus datos fueron enviados");
            /*url = base_url()+"cuestionario/guardar";
            $(location).attr("href", url);*/
            $('#mymodal').modal('open');
            //form.submit();
            return false;
        }
    });
    /*************
     * 
     * FINNNNNNNN
     */
    if(actual_url('reporteue'))
        editarTabla();
    if(actual_url('envreporte')){
        uploadHBR.init({
                    "target": "#uploads",
                    "max": 6,
                    "textNew": "Adicionar",
                    "textTitle": "Click aqui o arrastrar para subir la imágen",
                    "textTitleRemove": "Click aqui para remover la imagen",
                    "mimes": ["image/jpeg", "image/png"]

                });
                $('#reset').click(function () {
                    uploadHBR.reset('#uploads');
                });
    }
    $("#maestros").on("click",".btn",function(e){
        $('.slides').html('');
        /**/
        if((this.id).length<10){
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
        }else{
            pdf = this.id + '.PDF';
            contenido = "<embed id='escaneado' width='800' height='600' src='../files/pdf/"+ pdf + "' type='application/pdf'></embed>"
            $(".slider").css("width", "100%");
            /*$(".slider").css("height", "768");*/
            $('.slides').html(contenido);
        }
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

function enviaData(){
    //console.log($('form')[0]);
    $('form')[0].submit();
    return false;
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
    uesel = $('#ues').val();
    $.post(base_url()+"listado/llenaMaestros", {uesel : uesel},
    function(data){
        var maestros = JSON.parse(data);
        console.log(data);
        var tablaFinal = '<table class="striped responsive-table centered">';
        tablaFinal += '<thead><tr><th>RDA</th><th>CARNET</th><th>NOMBRE COMPLETO</th><th>SERIE</th><th>REPORTES</th><th></th><th></th></thead>';
        for(i=0; i<maestros.length;i++){
            boton = maestros[i].reportes==0 ? '' : '<button type=button data-target="img-modal" class="btn modal-trigger" id='+maestros[i].cod_rda+'>Ver imágenes</button>' ;
            docu = maestros[i].scandoc==0 ? '' : '<button type=button data-target="img-modal" class="btn modal-trigger" id="0' + maestros[i].carnet + ' ' + maestros[i].cod_rda + '">Documentos</button>' ;
            tablaFinal+='<tr><td>'+maestros[i].cod_rda+'</td><td>'+ maestros[i].carnet+'</td><td>'+(maestros[i].paterno).trim()+' '+(maestros[i].materno).trim()+' '+(maestros[i].nombre1).trim()+' '+(maestros[i].nombre2).trim();
            tablaFinal+='<td>'+maestros[i].serie+'</td><td>'+maestros[i].reportes+'</td><td>'+ boton + '</td><td>'+ docu +'</td></tr>';/*'';*/
        }
        tablaFinal+='</table>';
        $('#maestros').html(tablaFinal);
    });
}
 ///////////////////**********************

function dataDeptoAdmin(){
    deptosel = $('#depadmin').val();
    $('#tabfree').html('<img src="../files/img/loadingeng.gif">');
    $.post(base_url()+"reportsup/llenaDepto", {deptosel : deptosel},
    function(data){
        var maestros = JSON.parse(data);
        var tablaFinal = '<table class="striped responsive-table centered tabla">';
        tablaFinal += '<tr class="enc">';
        tablaFinal += '<td rowspan="2">Nro.</td><td  rowspan="2">Distrito</td><td  rowspan="2">Maestros</td><td  rowspan="2">Reportes</td>';
        tablaFinal += '<td colspan="2">Recibio</td>';
        tablaFinal += '<td colspan="2">Funciona</td>';
        tablaFinal += '<td colspan="3">Estado</td>';
        tablaFinal += '<td colspan="4">Uso</td>';
        tablaFinal += '<td colspan="5">Observacion</td></tr>';
        tablaFinal += '<tr class="enc">';
        tablaFinal += '<td>Si</td><td>No</td>';
        tablaFinal += '<td>Si</td><td>No</td>';
        tablaFinal += '<td>Bueno</td><td>Reg</td><td>Malo</td>';
        tablaFinal += '<td>Aula</td><td>Casa</td><td>Todos</td><td>Otro</td>';
        tablaFinal += '<td>Retiro</td><td>Penal</td><td>Adm</td><td>Jubilado</td><td>Ninguno</td>';
        tablaFinal += '</tr>';
        for(i=0; i<maestros.length;i++){
            var resultado = 0;
            var color = "";
            resultado = maestros[i].reporte/maestros[i].si * 100;
            if(resultado<50)
                color = "rojo";
            else
                if(resultado<70)
                    color = "amarillo";
                else
                    color = "verde";
            tablaFinal+='<tr><td>'+ (i+1) +'</td><td>'+maestros[i].distrito+'</td><td>'+ maestros[i].maestros+'</td><td class="bolding '+ color +'">'+maestros[i].reporte;
            tablaFinal+='<td>'+maestros[i].si+'</td><td>'+maestros[i].no+'</td><td>'+ maestros[i].funsi + '</td>';
            tablaFinal+='<td>'+maestros[i].funno + '</td><td>'+ maestros[i].consbu + '</td><td>'+ maestros[i].consre + '</td><td>'+ maestros[i].consma + '</td>';
            tablaFinal+='<td>'+maestros[i].usoaula + '</td><td>'+ maestros[i].usocasa + '</td><td>'+ maestros[i].usotodo + '</td><td>'+ maestros[i].usotro + '</td>';
            tablaFinal+='<td>'+maestros[i].obsret + '</td><td>'+ maestros[i].obspen + '</td><td>'+ maestros[i].obsadm + '</td><td>'+ maestros[i].obsjub + '</td><td>'+ maestros[i].obsnin + '</td></tr>';
        }
        tablaFinal+='</table>';
        $('#tabfree').html('');
        $('#tabfree').html(tablaFinal);
    });
}
function dataDistAdmin(){
    distsel = $('#distadmin').val();
    $('#tabfree').html('<img src="../files/img/loadingeng.gif">');
    $.post(base_url()+"reportsup/llenaDist", {distsel : distsel},
    function(data){
        var maestros = JSON.parse(data);
        var tablaFinal = '<table class="striped responsive-table centered tabla">';
        tablaFinal += '<tr class="enc">';
        tablaFinal += '<td rowspan="2">Nro.</td><td rowspan="2">SIE</td><td  rowspan="2">Unidad Educativa</td><td  rowspan="2">Maestros</td><td  rowspan="2">Reportes</td>';
        tablaFinal += '<td colspan="2">Recibio</td>';
        tablaFinal += '<td colspan="2">Funciona</td>';
        tablaFinal += '<td colspan="3">Estado</td>';
        tablaFinal += '<td colspan="4">Uso</td>';
        tablaFinal += '<td colspan="5">Observacion</td></tr>';
        tablaFinal += '<tr class="enc">';
        tablaFinal += '<td>Si</td><td>No</td>';
        tablaFinal += '<td>Si</td><td>No</td>';
        tablaFinal += '<td>Bueno</td><td>Reg</td><td>Malo</td>';
        tablaFinal += '<td>Aula</td><td>Casa</td><td>Todos</td><td>Otro</td>';
        tablaFinal += '<td>Retiro</td><td>Penal</td><td>Adm</td><td>Jubilado</td><td>Ninguno</td>';
        tablaFinal += '</tr>';
        for(i=0; i<maestros.length;i++){
            var resultado = 0;
            var resultado = "";
            if(maestros[i].si>0)
                resultado = maestros[i].reporte/maestros[i].si * 100;
            else
                resultado = 0;
            if(resultado<50)
                color = "rojo";
            else
                if(resultado<70)
                    color = "amarillo";
                else
                    color = "verde";
            tablaFinal+='<tr><td>'+ (i+1) +'</td><td>'+maestros[i].cod_ue+'</td><td>'+maestros[i].ue+'</td><td>'+ maestros[i].maestros+'</td><td class="bolding '+color+'">'+maestros[i].reporte;
            tablaFinal+='<td>'+maestros[i].si+'</td><td>'+maestros[i].no+'</td><td>'+ maestros[i].funsi + '</td>';
            tablaFinal+='<td>'+maestros[i].funno + '</td><td>'+ maestros[i].consbu + '</td><td>'+ maestros[i].consre + '</td><td>'+ maestros[i].consma + '</td>';
            tablaFinal+='<td>'+maestros[i].usoaula + '</td><td>'+ maestros[i].usocasa + '</td><td>'+ maestros[i].usotodo + '</td><td>'+ maestros[i].usotro + '</td>';
            tablaFinal+='<td>'+maestros[i].obsret + '</td><td>'+ maestros[i].obspen + '</td><td>'+ maestros[i].obsadm + '</td><td>'+ maestros[i].obsjub + '</td><td>'+ maestros[i].obsnin + '</td></tr>';
        }
        tablaFinal+='</table>';
        $('#tabfree').html('');
        $('#tabfree').html(tablaFinal);
    });
}

function envDataUeAdmin(){
    distsel = $('#uesadmin').val();
    $('#tabfree').html('<img src="../files/img/loadingeng.gif">');
    $.post(base_url()+"reportsup/llenaMaestros", {uesel : distsel},
    function(data){
        var maestros = JSON.parse(data);
        var tablaFinal = '<table class="striped responsive-table centered tabla">';
        tablaFinal += '<thead><tr><th>Nro.</th><th>RDA</th><th>CARNET</th><th>NOMBRE COMPLETO</th><th>SERIE</th><th>REPORTES</th><th>Funcionamiento</th>';
        tablaFinal += '<th>Conservación</th><th>Donde Usa</th><th>Observaciones</th></thead>';
        for(i=0; i<maestros.length;i++){
            var color = "";
            if(maestros[i].reportes==0 && maestros[i].serie != 'NULL' && maestros[i].serie != 'NO ES BENEFICIARIO')
                color = "rojo";
            else
                if(maestros[i].reportes<3  && maestros[i].serie != 'NULL' && maestros[i].serie != 'NO ES BENEFICIARIO')
                    color = "amarillo";
                else
                    if(maestros[i].reportes>=3  && maestros[i].serie != 'NULL' && maestros[i].serie != 'NO ES BENEFICIARIO')
                        color = "verde";
            tablaFinal+='<tr><td>'+ (i+1) +'</td><td>'+maestros[i].cod_rda+'</td><td>'+ maestros[i].carnet+'</td><td>'+maestros[i].nomcom;
            tablaFinal+='<td>'+maestros[i].serie+'</td><td class="bolding '+color+'">'+maestros[i].reportes+'</td><td>'+ maestros[i].funcionamiento + '</td><td>'+ maestros[i].conservacion;
            tablaFinal+='</td><td>'+ maestros[i].uso + '</td><td>'+ maestros[i].observacion + '</td></tr>';
        }
        tablaFinal+='</table>';
        $('#tabfree').html('');
        $('#tabfree').html(tablaFinal);
    });
}
///////////******/*****************************/
function envDataDepAdmin(){
    deptosel = $('#depadmin').val();
    $.post(base_url()+"listado/llenaDepto", {deptosel : deptosel},
    function(data){
        $("#distadmin").html(data);
    });
}
function envDataDistAdmin(){
    distsel = $('#distadmin').val();
    $.post(base_url()+"listado/llenaDist", {distsel : distsel},
    function(data){
        $("#uesadmin").html(data);
    });
}


/////////////////////////****************
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
///**************DOMIN****///////////
function cmbDeptoAdmin(){
    $("#tabfree").html('');
    $("#uesadmin").html('<option value=“0”>Seleccione Unidad Educativa</option>');
    $("#depadmin option:selected").each(envDataDepAdmin);
}
function cmbDistAdmin(){
    $("#tabfree").html('');
    $("#distadmin option:selected").each(envDataDistAdmin);
}
function cmbUesAdmin(){
    $("#uesadmin option:selected").each(envDataUeAdmin);
}
///**************DOMIN END****///////////

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
