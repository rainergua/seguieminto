<?php
        $maestros = 0;
        $recibieron = 0;
        $norec = 0;
        $reportes = 0;  ?>
<div class="row bolding">
  <div class="col l4 m4 s2 center-align"></div>
  <div class="col l4 m4 s10 center-align">Departamento: <?=$dep->departamento?></div>
  <div class="col l4 m4 s2 center-align"></div>
</div>
    <div class="table-responsive">
        <table id="table_dist" class="table tabla centered">
            <tr class="enc">
                <td rowspan="2">Nro.</td><td  rowspan="2">Distrito</td><td  rowspan="2">Maestros</td><td  rowspan="2">Reportes</td>
                <td colspan="2">Recibio</td>
                <td colspan="2">Funciona</td>
                <td colspan="3">Estado</td>
                <td colspan="4">Uso</td>
                <td colspan="5">Observacion</td></tr>

            <tr class="enc">
                <td>Si</td><td>No</td>
                <td>Si</td><td>No</td>
                <td>Bueno</td><td>Reg</td><td>Malo</td>
                <td>Aula</td><td>Casa</td><td>Todos</td><td>Otro</td>
                <td>Retiro</td><td>Penal</td><td>Adm</td><td>Jubilado</td><td>Ninguno</td>
                </tr>
        <?php
        $i=1;
            foreach ($res as $key => $value) {
                $resultado = $value->reporte/$value->si * 100;
                if($resultado<50)
                    $color = "rojo";
                elseif($resultado<70)
                    $color = "amarillo";
                else
                    $color = "verde";
                echo "<tr>";
                echo "<td>".$i."</td><td>$value->distrito</td><td>$value->maestros</td><td class='bolding ". $color ."'>$value->reporte</td>";
                echo "<td>$value->si</td><td>$value->no</td>";
                echo "<td>$value->funsi</td><td>$value->funno</td>";
                echo "<td>$value->consbu</td><td>$value->consre</td><td>$value->consma</td>";
                echo "<td>$value->usoaula</td><td>$value->usocasa</td><td>$value->usotodo</td><td>$value->usotro</td>";
                echo "<td>$value->obsret</td><td>$value->obspen</td><td>$value->obsadm</td><td>$value->obsjub</td><td>$value->obsnin</td>";
                echo "</tr>";
                $maestros+=$value->maestros;
                $recibieron+=$value->si;
                $norec+=$value->no;
                $reportes+=$value->reporte;
                $i++;
            }
        ?>
        </table>
    </div>
    <div class="row">
      <div class="col l12 m12 s12 center-align"></div>
    </div>
    <div class="row">

    </div>
    <div class="row">
        <div class="col l8 m8 s12">
            <div id="chartContainer" style="height: 400px; width: 100%;"></div>
        </div>
        <div class="col l4 m4 s12 center-align">
            <a href="<?=base_url().'reportsup/printdep'?>" class="btn orange darken-3">Imprimir Reporte</a>
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
            { label: "Total Maestros",  y: <?php echo $maestros;?>  },
            { label: "Recibieron",  y: <?php echo $recibieron;?>  },
            { label: "No Recibieron", y: <?php echo $norec;?>  },
            { label: "Reportaron", y: <?php echo $reportes;?>  },
            { label: "No Reportaron",  y: <?php echo ($recibieron-$reportes);?>  }
        ]
    }
    ]
    };

    $("#chartContainer").CanvasJSChart(options);
    }
    </script>
