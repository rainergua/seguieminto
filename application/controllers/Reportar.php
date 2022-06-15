<?php
/***
 * Controlador para manejo de reporte de Maestras y Maestros
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportar extends CI_Controller{
    public function __construct(){
        parent::__construct();
		$this->load->model('reporte_model');
		$this->load->library('form_validation');
		//$this->load->database('default');
    }
    public function valido(){
        if($this->session->userdata('is_logued_in') == FALSE)
        {
            $url= explode("/",$_SERVER["REQUEST_URI"]); //---- /seguimiento/cuestionario
            //print_r($url);
            if($url[2]=='reportar')
                $this->session->set_userdata('url', $url[2]);
            //redirect(base_url().'login');
            redirect(base_url().'login');
        }
    }
    public function envreporte(){
        $this->valido();
        //echo ($_SERVER['DOCUMENT_ROOT'] ."/seguimiento/files/tmp/");
        $this->load->view('template/template');
        $this->load->view('sis_vw/reporte');
        $this->load->view('template/footer');
    }
    private function base64Jpeg($fotobase64, $i){
        $rda = $this->session->userdata('id_usuario');
        $carnet = $this->session->userdata('username');
        $file = $rda.'_'.$carnet.'_'.$i.'.jpg';
        if (!is_dir ($_SERVER['DOCUMENT_ROOT'] ."/seguimiento/files/tmp/"))
            mkdir($_SERVER['DOCUMENT_ROOT'] . "/seguimiento/files/tmp/");
        $ifp = fopen($_SERVER['DOCUMENT_ROOT'] ."/seguimiento/files/tmp/".$file, 'wb');
        fwrite($ifp, base64_decode($fotobase64));
        fclose($ifp);
        return $file;
    }
    /**
     * Saca las imágenes de los reportes
     */
    public function images(){
        $this->valido();
        if(empty($base = $_POST['base'])){
            die("Se esperaban los archivos");
        }
        $rda = $this->session->userdata('id_usuario');
        $carnet = $this->session->userdata('username');
        $nombre = $this->reporte_model->nombre($carnet)->nom_com;
        $serie = $this->reporte_model->serie($carnet)->serie;
        $i=0;
        foreach ($base as $index => $base64) {
            $data = explode(';', $base64);
            $dataa = explode(',', $base64);
            if($base64){
                $img = $dataa[1];
                $reporte = array(
                    'nombre' => $nombre,
                    'rda' => $rda,
                    'carnet' => $carnet,
                    'serie' => $serie,
                    'imagen' => $img,
                    'archivo' => $this->base64Jpeg($img, $i),
                    'fecha' => date("Y-m-d H:i:s"),
                    'hora' => date("Y-m-d H:i:s")
                );
                $resultado = $this->reporte_model->guardar($reporte);
                if($resultado){
                    $i++;
                }else{
                    $this->index();
                }
            }
        }
        $data['images'] = $this->reporte_model->reportes($carnet);
        $this->load->view('template/template');
        $this->load->view('sis_vw/edicion', $data);
        $this->load->view('template/footer');
        //redirect(base_url().'login');
    }
    public function edicion(){
        $this->valido();
        $carnet = $this->session->userdata('username');
        $data['images'] = $this->reporte_model->reportes($carnet);
        $this->load->view('template/template');
        $this->load->view('sis_vw/edicion', $data);
        $this->load->view('template/footer');
    }
    public function borrar(){
        $this->valido();
        $id = $_POST['id_img'];
        $elimina = $this->reporte_model->borrar($id);
        if ($elimina) {
            $carnet = $this->session->userdata('username');
            $images = $this->reporte_model->reportes($carnet);
            echo json_encode($images);
        }
    }
    public function construyeCodigo(){
        $this->valido();
        $this->load->library('encrypt');
        $rda = $this->session->userdata('id_usuario');
        $carnet = $this->session->userdata('username');
        $nombre = $this->reporte_model->nombre($carnet)->nom_com;
        $serie = $this->reporte_model->nombre($carnet)->serie;
        $cadena = 'Nombre: '.$nombre;
        $cadena .= ' | Carnet: '.$carnet;
        $cadena .= ' | RDA: '.$rda;
        $cadena .= ' | Serie: '.$serie;
        return $cadena;
    }
    public function arma_tabla(){
        $this->valido();
        $rda = $this->session->userdata('id_usuario');
        $carnet = $this->session->userdata('username');
        $nombre = $this->reporte_model->nombre($carnet)->nom_com;
        $serie = $this->reporte_model->nombre($carnet)->serie;
        $reportes = $this->reporte_model->numReportes($carnet)->reportes;
        $cad='';
        $cad.='<table><tr>';
        $cad.='<th colspan="6">1. DATOS DEL MAESTRO</th>';
        $cad.='</tr><tr>';
        $cad.='<td class="enc">NOMBRE COMPLETO:</td>';
        $cad.='<td>'.$nombre.'</td>';
        $cad.='<td class="enc">CARNET:</td>';
        $cad.='<td>'.$carnet.'</td>';
        $cad.='<td class="enc">RDA:</td>';
        $cad.='<td>'.$rda.'</td>';
        $cad.='</tr><tr>';
        $cad.='<td class="enc">SERIE DEL EQUIPO:</td>';
        $cad.='<td>'.$serie.'</td>';
        $cad.='<td class="enc">CANTIDAD DE REPORTES:</td>';
        $cad.='<td>'.$reportes.'</td>';
        $cad.='<td class="enc">FECHA DEL COMPROBANTE:</td>';
        $cad.='<td>'.date("d-m-Y H:i:s").'</td>';
        $cad.='</tr></table> <br /><br /><br /><br />';
        $cad.='<a href="'.base_url().'" align="right">Volver</a>';
        return $cad;
    }

    public function print_comp(){
        $this->valido();
        ////////////// set document information
        $this->load->library('Pdf');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('VCyT - MinEdu');
        $pdf->SetTitle('Comprobante de Reporte UCPD');
        $pdf->SetSubject('Una Computadora Por Docente');
        $pdf->SetKeywords('UCPD, VCyT, Ministerio, Educacion, Bolivia');
        $pdf->setPageOrientation('P','','1');
        $pdf->SetHeaderData('logo.png', '185',
        '', '', array(1, 59, 120), array(0, 64, 138));
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
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(15,25,15,true);
        $pdf->AddPage('P', $page_format, false, false);
        //preparamos y maquetamos el contenido a crear
        $html = '';
        $html .= '<meta charset="utf-8">';
        $html .= "<style type=text/css>";
        $html .= "th{color: #000; font-weight: bold; background-color: #aaadaf; height:25px}";
        $html .= "td{background-color: #FFFFFF; color: #000; border: #000 1px solid; text-align: center}";
        $html .= "td.enc{font-weight: bold}";
        $html .= "td.space{font-weight: bold}";
        $html .= "h2{text-align: center}";
        $html .= "</style>";
        $html .= "<h2>Comprobante de Reporte UCPD</h2>";
        $html .= "<h2>Proyecto Una Computadora Por Docente</h2>";
        $html .= $this->arma_tabla();
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
        $codigo = $this->construyeCodigo();
        $pdf->write2DBarcode($codigo, 'QRCODE,H', 20, 210, 50, 50, $style, 'N');
        $pdf->Output("Comprbante.pdf", 'I');
    }
}
?>
