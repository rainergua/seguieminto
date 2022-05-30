<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listado extends CI_Controller{
    public function __construct(){
        parent::__construct();
		$this->load->model('listado_model');
		$this->load->library('form_validation');
		//$this->load->database('default');
    }
    public function valido(){
        if($this->session->userdata('is_logued_in') == FALSE)
        {
            $url= explode("/",$_SERVER["REQUEST_URI"]); //---- /seguimiento/cuestionario
            print_r($url);
            if($url[2]=='listado')
                $this->session->set_userdata('url', $url[2]);
            redirect(base_url().'login');
            redirect(base_url().'login');
        }
    }
    /*public function index() {


    }*/

    public function devDeptos(){
        $this->valido();
        $data['deptos'] = $this->listado_model->listaDepto();
        $this->load->view('template/template');
        $this->load->view('sis_vw/segmtros', $data);
        $this->load->view('template/footer');
    }
    public function llenaDepto(){
        $deptosel = $this->input->post('deptosel');
        $distritos = $this->listado_model->listaDist($deptosel);
        if($distritos){
            foreach ($distritos as $dis) {
                echo "<option value='".$dis->cod_dis."'>".trim($dis->distrito)."</option>";
            }
        }
    }
    public function llenaDist(){
        $distsel = intval($this->input->post('distsel'));
        $ues = $this->listado_model->listaUes($distsel);
        if($ues){
            echo "<option value='0'>Seleccione Unidad Educativa</option>";
            foreach ($ues as $ue) {
                echo "<option value='".$ue->cod_ue."'>".trim($ue->des_ue)."</option>";
            }
        }
    }
    public function llenaMaestros(){
        $uesel = $this->input->post('uesel');
        $maestros = $this->listado_model->listaMaestros($uesel);
        if($maestros){
            echo json_encode($maestros);
        }
    }
    public function getImagenes(){
        $rda = $this->input->post('rda');
        $listaFotos = $this->listado_model->getImagenes($rda);
        if($listaFotos){
            echo json_encode($listaFotos);
        }
    }
}
?>
