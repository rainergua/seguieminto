<div class="container">
    <div class="table-responsive">
        <table id="editable_table" class="table table-striped table-bordered">
            <thead>
                <th>IDMALO</th><th>Carnet</th><th>Archivo</th>
            </thead>
        <?php
            foreach ($res as $key => $value) {
                echo "<tr>";
                echo "<td>".$value->idMalo."</td><td>$value->carnet</td><td>$value->archivo</td>";
                echo "</tr>";
            }
        ?>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        editarTabla();
    });
    function editarTabla(){
        //alert("Hola");
        $('#editable_table').Tabledit({
            url: 'http://localhost/ocepeval/depurar/corregir',
            deleteButton: false,
            autoFocus: false,
            restoreButton: false,
            //saveButton: false,
            buttons:{
                edit:{
                    class: 'btn btn-sm btn-primary',
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
                identifier: [0, 'idMalo'],
                editable: [[1, 'carnet']]
            },
            onSuccess: function(data, textStatus, jqXHR){
                console.log("Entro a success");
                if(data.action == 'edit'){
                    $('#'+data.idMalo).remove();
                    console.log(data);
                }
            }
        });
    }
</script>
