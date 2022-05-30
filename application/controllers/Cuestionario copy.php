<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuestionario extends CI_Controller{
    public function __construct(){
        parent::__construct();
		$this->load->model('cuestionario_model');
		$this->load->library('form_validation');
		$this->load->database('default');
    }
    public function valido(){
        if($this->session->userdata('is_logued_in') == FALSE)
        {
            //$host= $_SERVER["HTTP_HOST"];
            $url= explode("/",$_SERVER["REQUEST_URI"]); //---- /seguimiento/cuestionario
            print_r($url);
            if($url[2]=='cuestionario')
                $this->session->set_userdata('url', $url[2]);
            redirect(base_url().'login');
        }
    }
    public function index(){
        $this->valido();
        $this->load->view('template/template');
        $this->load->view('sis_vw/cuestionario');
        $this->load->view('template/footer');
    }

    
    public function guardar(){
        $datos = array();
        foreach ($_POST as $campo => $valor) {
            $cadena = is_array($valor) ? implode($valor) : $valor;
            $datos[$campo] = $cadena;
        }
        $datos['cod_rda'] = $this->session->userdata('id_usuario');
        $datos['carnet'] = $this->session->userdata('username');
        $datos['fecha'] = date("d-m-Y H:i:s");
        $res = $this->cuestionario_model->guardar($datos);
        if($res==0){
            $this->load->view('template/template');
            $this->load->view('sis_vw/exito');
            $this->load->view('template/footer');
        }
        else{
            $this->load->view('template/template');
            $this->load->view('sis_vw/fracaso');
            $this->load->view('template/footer');
        }
    }
}
?>
