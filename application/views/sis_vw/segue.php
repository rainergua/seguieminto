<div class="row">
  <div class="col l12 m12 s12 center-align"></div>
</div>
<div class="row bolding">
  <div class="col l1 m1 s1 center-align"></div>
  <div class="col l3 m3 s10 center-align">Unidad Educativa: <?=$ues->des_ue?></div>
  <div class="col l2 m2 s10 center-align">SIE: <?=$ues->cod_ue?></div>
  <div class="col l3 m3 s10 center-align">Distrito: <?=$ues->distrito?></div>
  <div class="col l2 m2 s10 center-align">Departamento: <?=$ues->departamento?></div>
  <div class="col l1 m1 s1 center-align"></div>
</div>
<div class="row">
  <div class="col l12 m12 s12 center-align"></div>
</div>

    <div class="">
        <table id="editable_table" class="table table-striped table-bordered tabla centered responsive-table">
            <thead>
                <th>Nro.</th><th>rda</th><th>Carnet</th><th>Nombre Completo</th>
                <th>Beneficiario</th><th>Reporte</th><th>Funcionamiento</th>
                <th>Conservación</th><th>Donde Usa</th><th>Observaciones</th>
            </thead>
            <tbody>
        <?php
        $i=1;
        foreach ($res as $key => $value) {
            $color = "";
            if($value->reportes==0 && $value->serie != 'NULL' && $value->serie != 'NO ES BENEFICIARIO')
                $color = "rojo";
            else
                if($value->reportes<3  && $value->serie != 'NULL' && $value->serie != 'NO ES BENEFICIARIO')
                    $color = "amarillo";
                else
                    if($value->reportes>=3  && $value->serie != 'NULL' && $value->serie != 'NO ES BENEFICIARIO')
                        $color = "verde";
            echo "<tr>";
            echo "<td>".$i."</td><td>".$value->cod_rda."</td><td>".$value->carnet."</td><td>".$value->nomcom."</td>";
            echo "<td id='seriecmp'>".$value->serie."</td><td class='bolding ". $color ."'>".$value->reportes."</td><td>".$value->funcionamiento."</td>";
            echo "<td>".$value->conservacion."</td><td>".$value->uso."</td><td>".$value->observacion."</td>";
            echo "</tr>";
            $i++;
        }
        ?>
        </tbody>
        </table>
    </div>
    <div class="row">

    </div>
    <div class="row">
      <div class="col l12 m12 s12 center-align"></div>
    </div>
    <div class="row">
        <div class="col l8 m8 s12">
            <div id="chartContainer" style="height: 400px; width: 100%;"></div>
        </div>
        <div class="col l4 m4 s12 center-align">
            <a href="<?=base_url().'reportsup/printues'?>" class="btn orange darken-3">Imprimir Reporte</a>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo base_url().'files/js/jquery.canvasjs.min.js'; ?>"></script>
    <script>
window.onload = function () {

//Better to construct options first and then pass it as a parameter
var options = {
	title: {
		text: "Gráfico de maestros y sus reportes"
	},
	data: [
	{
		// Change type to "doughnut", "line", "splineArea", etc.
		type: "column",
		dataPoints: [
            { label: "Total Maestros",  y: <?php echo $grf->maestros;?>  },
			{ label: "Recibieron",  y: <?php echo $grf->si;?>  },
			{ label: "No Recibieron", y: <?php echo $grf->no;?>  },
			{ label: "Reportaron", y: <?php echo $grf->reporte;?>  },
			{ label: "No Reportaron",  y: <?php echo ($grf->si-$grf->reporte);?>  }
		]
	}
	]
};

$("#chartContainer").CanvasJSChart(options);
}
</script>
