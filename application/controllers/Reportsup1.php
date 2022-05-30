<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportsup extends CI_Controller{
    public function __construct(){
        parent::__construct();
		    $this->load->model('reportsup_model');
    }

    public function valido(){
        if($this->session->userdata('is_logued_in') == FALSE)
        {
            redirect(base_url().'login');
        }
    }

    public function reporteue(){
        $this->valido();
        $rda = $this->session->userdata('id_usuario');
        $carnet = $this->session->userdata('username');
        $data['ues'] = $this->reportsup_model->dataUE($carnet);
        $data['res'] = $this->reportsup_model->tablaue($carnet);
        $data['grf'] = $this->reportsup_model->graficoue($carnet);
        $this->load->view('template/template');
        $this->load->view('sis_vw/segue', $data);
        $this->load->view('template/footer');
    }
    public function reportedis(){
        $this->valido();
        $rda = $this->session->userdata('id_usuario');
        $carnet = $this->session->userdata('username');
        $data['dis'] = $this->reportsup_model->dataDis($carnet);
        $data['res'] = $this->reportsup_model->tabladis($carnet);
        $data['grf'] = $this->reportsup_model->graficodis($carnet);
        $this->load->view('template/template');
        $this->load->view('sis_vw/segdis', $data);
        $this->load->view('template/footer');
    }
    public function reportedep(){
        $this->valido();
        $rda = $this->session->userdata('id_usuario');
        $carnet = $this->session->userdata('username');
        $data['dep'] = $this->reportsup_model->dataDep($carnet);
        $data['res'] = $this->reportsup_model->tabladep($carnet);
        $this->load->view('template/template');
        $this->load->view('sis_vw/segdep', $data);
        $this->load->view('template/footer');
    }
    public function procesa(){
        $this->valido();
        $input = filter_input_array(INPUT_POST);
        $datos = array();
        $datos['funcionamiento'] = $input['funcionamiento'];
        $datos['conservacion'] = $input['conservacion'];
        $datos['uso'] = $input['uso'];
        $datos['observacion'] = $input['observacion'];
        $datos['activo'] = true;
        $data['res'] = $this->reportsup_model->actualiza($datos, $input['carnet']);
        echo json_encode($data);

    }

    ///***---------PDF-------************//////////////////////////

    public function construyeCodigoue(){
        $this->valido();
        $this->load->library('encrypt');
        $datosUE = $this->reportsup_model->dataUE($this->session->userdata('username'));
        $cadena = 'UE: '.$datosUE->des_ue;
        $cadena .= ' | SIE: '.$datosUE->cod_ue;
        $cadena .= ' | DISTRITO: '.$datosUE->distrito;
        return $cadena;
    }
    public function construyeCodigodis(){
        $this->valido();
        $this->load->library('encrypt');
        $datosUE = $this->reportsup_model->dataDis($this->session->userdata('username'));
        /*$cadena = 'UE: '.$datosUE->des_ue;
        $cadena .= ' | SIE: '.$datosUE->cod_ue;*/
        $cadena .= 'DISTRITO: '.$datosUE->distrito;
        $cadena .= ' | DEPARTAMENTO: '.$datosUE->cod_ue;
        return $cadena;
    }
    public function construyeCodigodep(){
        $this->valido();
        $this->load->library('encrypt');
        $datosUE = $this->reportsup_model->dataDep($this->session->userdata('username'));
        $cadena = 'DEPARTAMENTO: '.$datosUE->departamento;
        /*$cadena .= ' | SIE: '.$datosUE->departamento;
        $cadena .= ' | DISTRITO: '.$datosUE->distrito;*/
        return $cadena;
    }
    public function arma_tabladep(){
        $this->valido();
        $datosUE = $this->reportsup_model->dataDep($this->session->userdata('username'));
        $cad = '';
        $i = 1;
        $cad.='<table>';
        /*$cad.='<tr><th colspan="6">DATOS DE LA UNIDAD EDUCATIVA</th>';
        $cad.='</tr><tr>';
        $cad.='<td class="enc">NOMBRE:</td>';
        $cad.='<td colspan="3">'.$datosUE->des_ue.'</td>';
        $cad.='<td class="enc">SIE:</td>';
        $cad.='<td>'.$datosUE->cod_ue.'</td></tr>';*/
        $cad.='<tr>';
        $cad.='<td class="enc">DEPARTAMENTO:</td>';
        $cad.='<td>'.$datosUE->departamento.'</td>';
        /*$cad.='<td class="enc">DISTRITO:</td>';
        $cad.='<td>'.$datosUE->distrito.'</td>';*/
        $cad.='<td class="enc">FECHA DEL COMPROBANTE:</td>';
        $cad.='<td>'.date("d-m-Y H:i:s").'</td>';
        $cad.='</tr></table> <br /><br /><br />';
        $cad.='<table>';
        $cad.='<tr class="enc">
                <td rowspan="2">Nro.</td><td colspan="3" rowspan="2">Distrito</td><td  rowspan="2">Maestros</td><td  rowspan="2">Reportes</td>
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
                </tr>';
        //$cad.='<th>ACTIVO</th></tr>';

        $res = $this->reportsup_model->tabladep($this->session->userdata('username'));
        foreach ($res as $value) {
            $cad.="<tr>";
            $cad.='<td>'.$i.'</td><td colspan="3">'.$value->distrito.'</td><td>'.$value->maestros.'</td><td>'.$value->reporte.'</td>';
            $cad.="<td>$value->si</td><td>$value->no</td>";
            $cad.="<td>$value->funsi</td><td>$value->funno</td>";
            $cad.="<td>$value->consbu</td><td>$value->consre</td><td>$value->consma</td>";
            $cad.="<td>$value->usoaula</td><td>$value->usocasa</td><td>$value->usotodo</td><td>$value->usotro</td>";
            $cad.="<td>$value->obsret</td><td>$value->obspen</td><td>$value->obsadm</td><td>$value->obsjub</td><td>$value->obsnin</td>";
            $cad.="</tr>";
            $i++;
        }
        $cad.='</table>';
        $cad.='<br /><br /><br /><br /><br />* EL O LA DIRECTORA DEPARTAMENTAL DE EDUCACIÓN DEBE FIRMAR Y SELLAR EL PRESENTE REPORTE<br />';
        $cad.='* EL PRESENTE REPORTE DEBERÁ SER REMITIDO AL MINISTERIO DE EDUCACIÓN.<br />';
        $cad.='<br /><a href="'.base_url().'reportsup/reportedep" align="right">Volver</a>';
        return $cad;
    }
    public function arma_tabladis(){
        $this->valido();
        $datosDis = $this->reportsup_model->dataDis($this->session->userdata('username'));
        $cad = '';
        $i = 1;
        $cad.='<table>';
        /*$cad.='<tr><th colspan="6">DATOS DE LA UNIDAD EDUCATIVA</th>';
        $cad.='</tr><tr>';
        $cad.='<td class="enc">NOMBRE:</td>';
        $cad.='<td colspan="3">'.$datosUE->des_ue.'</td>';
        $cad.='<td class="enc">SIE:</td>';
        $cad.='<td>'.$datosUE->cod_ue.'</td></tr>';*/
        $cad.='<tr>';
        $cad.='<td class="enc">DEPARTAMENTO:</td>';
        $cad.='<td>'.$datosDis->departamento.'</td>';
        $cad.='<td class="enc">DISTRITO:</td>';
        $cad.='<td>'.$datosDis->distrito.'</td>';
        $cad.='<td class="enc">FECHA DEL COMPROBANTE:</td>';
        $cad.='<td>'.date("d-m-Y H:i:s").'</td>';
        $cad.='</tr></table> <br /><br /><br />';
        $cad.='<table>';
        $cad.='<tr class="enc">
                <td rowspan="2">Nro.</td><td  colspan="2" rowspan="2">SIE</td><td colspan="3" rowspan="2">Unidad Educativa</td><td  rowspan="2">Maestros</td><td  rowspan="2">Reportes</td>
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
                </tr>';
        //$cad.='<th>ACTIVO</th></tr>';

        $res = $this->reportsup_model->tabladis($this->session->userdata('username'));
        foreach ($res as $value) {
            $cad.="<tr>";
            $cad.='<td>'.$i.'</td><td colspan="2">'.$value->cod_ue.'</td><td colspan="3">'.$value->ue.'</td><td>'.$value->maestros.'</td><td>'.$value->reporte.'</td>';
            $cad.="<td>$value->si</td><td>$value->no</td>";
            $cad.="<td>$value->funsi</td><td>$value->funno</td>";
            $cad.="<td>$value->consbu</td><td>$value->consre</td><td>$value->consma</td>";
            $cad.="<td>$value->usoaula</td><td>$value->usocasa</td><td>$value->usotodo</td><td>$value->usotro</td>";
            $cad.="<td>$value->obsret</td><td>$value->obspen</td><td>$value->obsadm</td><td>$value->obsjub</td><td>$value->obsnin</td>";
            $cad.="</tr>";
            $i++;
        }
        $cad.='</table>';
        $cad.='<br /><br /><br /><br /><br />* EL O LA DIRECTORA DISTRITAL DE EDUCACIÓN DEBE FIRMAR Y SELLAR EL PRESENTE REPORTE<br />';
        $cad.='* EL PRESENTE REPORTE DEBERÁ SER PRESENTADO A SU DIRECCIÓN DEPARTAMENTAL DE EDUCACIÓN<br />';
        $cad.='<br /><a href="'.base_url().'reportsup/reportedis" align="right">Volver</a>';
        return $cad;
    }
    public function arma_tablaue(){
        $this->valido();
        $datosUE = $this->reportsup_model->dataUE($this->session->userdata('username'));
        $cad = '';
        $i = 1;
        $cad.='<table><tr>';
        $cad.='<th colspan="6">DATOS DE LA UNIDAD EDUCATIVA</th>';
        $cad.='</tr><tr>';
        $cad.='<td class="enc">NOMBRE:</td>';
        $cad.='<td colspan="3">'.$datosUE->des_ue.'</td>';
        $cad.='<td class="enc">SIE:</td>';
        $cad.='<td>'.$datosUE->cod_ue.'</td>';
        $cad.='</tr><tr>';
        $cad.='<td class="enc">DEPARTAMENTO:</td>';
        $cad.='<td>'.$datosUE->departamento.'</td>';
        $cad.='<td class="enc">DISTRITO:</td>';
        $cad.='<td>'.$datosUE->distrito.'</td>';
        $cad.='<td class="enc">FECHA DEL COMPROBANTE:</td>';
        $cad.='<td>'.date("d-m-Y H:i:s").'</td>';
        $cad.='</tr></table> <br /><br /><br />';
        $cad.='<table>';
        $cad.='<tr><th>Nro.</th>';
        $cad.='<th colspan="2">RDA</th>';
        $cad.='<th colspan="2">CARNET</th>';
        $cad.='<th colspan="3">NOMBRE COMPLETO</th>';
        $cad.='<th colspan="2">SERIE</th>';
        $cad.='<th colspan="2">REPORTES</th>';
        $cad.='<th colspan="2">FUNCIONAMIENTO</th>';
        $cad.='<th colspan="2">CONSERVACIÓN</th>';
        $cad.='<th colspan="2">USO</th>';
        $cad.='<th colspan="2">OBSERVACION</th></tr>';
        //$cad.='<th>ACTIVO</th></tr>';

        $res = $this->reportsup_model->tablaue($this->session->userdata('username'));
        foreach ($res as $row) {
            $cad.='<tr><td>'.$i.'</td>';
            $cad.='<td colspan="2">'.$row->cod_rda.'</td>';
            $cad.='<td colspan="2">'.$row->carnet.'</td>';
            $cad.='<td colspan="3">'.$row->nomcom.'</td>';
            $cad.='<td colspan="2">'.$row->serie.'</td>';
            $cad.='<td colspan="2">'.$row->reportes.'</td>';
            $cad.='<td colspan="2">'.$row->funcionamiento.'</td>';
            $cad.='<td colspan="2">'.$row->conservacion.'</td>';
            $cad.='<td colspan="2">'.$row->uso.'</td>';
            $cad.='<td colspan="2">'.$row->observacion.'</td></tr>';
            //$cad.='<td>'.$row->activo.'</td></tr>';
            $i++;

        }
        $cad.='</table>';
        $cad.='<br /><br /><br /><br /><br />* EL O LA DIRECTORA DE UNIDAD EDUCATIVA DEBE FIRMAR Y SELLAR EL PRESENTE REPORTE<br />';
        $cad.='* EL PRESENTE REPORTE DEBERÁ SER PRESENTADO A SU DIRECCIÓN DISTRITAL DE EDUCACIÓN<br />';
        $cad.='* PUEDE HACER CLICK EN VOLVER PARA CORREGIR ALGUN CAMPO EDITABLE';

        $cad.='<br /><a href="'.base_url().'reportsup/reporteue" align="right">Volver</a>';
        return $cad;
    }

    public function print_comp($instancia){
        $this->valido();
        ////////////// set document information
        $this->load->library('Pdf');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('VCyT - MinEdu');
        $pdf->SetTitle('Comprobante de Reporte UCPD - Unidades Educativas');
        $pdf->SetSubject('Una Computadora Por Docente');
        $pdf->SetKeywords('UCPD, VCyT, Ministerio, Educacion, Bolivia');
        $pdf->setPageOrientation('L',true,'1');
        $pdf->SetHeaderData('logoh.png', '250', '', '', array(1, 59, 120), array(0, 64, 138));
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH,
        //PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        //$pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        $page_format = array(
            'MediaBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 215, 'ury' => 280),
            'Dur' => 3,
            'trans' => array(
                'D' => 1.5,
                'S' => 'Split',
                'Dm' => 'V',
                'M' => 'O'
            ),
            'PZ' => 1,
        );
        $pdf->SetFont('dejavusans', '', 8, '', true);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(15,25,15,true);
        $pdf->AddPage('L', $page_format, false, false);
        //preparamos y maquetamos el contenido a crear
        $html = '';
        $html .= '<meta charset="utf-8">';
        $html .= "<style type=text/css>";
        $html .= "th{color: #000; font-weight: bold; background-color: #aaadaf; height:25px; text-align: center}";
        $html .= "td{background-color: #FFFFFF; color: #000; border: #000 1px solid; text-align: center}";
        $html .= "td.enc{font-weight: bold}";
        $html .= "tr.enc{font-weight: bold}";
        $html .= "td.space{font-weight: bold}";
        $html .= "h2{text-align: center}";
        $html .= "</style>";
        $html .= "<h2>COMPROBANTE DE REPORTE DE ". $instancia ."</h2>";
        $html .= "<h2>Proyecto Una Computadora Por Docente</h2>";
        ///AQUI EL DISCRIMINANTE DEL TIPO DE TABLA
        switch($instancia){
            case "UNIDAD EDUCATIVA":
                $html .= $this->arma_tablaue();
                $codigo = $this->construyeCodigoue();
                break;
            case "DISTRITO":
                $html .= $this->arma_tabladis();
                $codigo = $this->construyeCodigodis();
                break;
            case "DEPARTAMENTO":
                $html .= $this->arma_tabladep();
                $codigo = $this->construyeCodigodep();
                break;
            default:
                $html.="";
        }
        //echo $html;
        ob_clean();
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        // QRCODE,H : QR-CODE Best error correction
        $style = array(
            'border' => 1,
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255)
            'module_width' => 1, // width of a single module in points
            'module_height' => 1 // height of a single module in points
        );
        //
        $pdf->write2DBarcode($codigo, 'QRCODE,H', 10, 170, 30, 30, $style, 'N');
        $pdf->Output("Comprbante.pdf", 'I');
    }
    public function printues(){
        $this->valido();
        $this->print_comp("UNIDAD EDUCATIVA");
    }
    public function printdis(){
        $this->valido();
        $this->print_comp("DISTRITO");
    }
    public function printdep(){
        $this->valido();
        $this->print_comp("DEPARTAMENTO");
    }
}
?>
