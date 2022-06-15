<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuestionario extends CI_Controller{
    public function __construct(){
        parent::__construct();
		$this->load->model('cuestionario_model');
		$this->load->library('form_validation');
		$this->load->database('default');
    }
    /** 1. Genera un código aleatorio de al menos 6 caracteres
     * sirve como clave para la identificación del ingreso de información del 
     * funciona como codigo unico del reporte 
     */
    private function generaCodigo($length = 6){
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, $length);  
    }
    public function valido(){
        if($this->session->userdata('is_logued_in') == FALSE)
        {
            //$host= $_SERVER["HTTP_HOST"];
            $url= explode("/",$_SERVER["REQUEST_URI"]); //---- /seguimiento/cuestionario
            //print_r($url);
            if($url[2]=='cuestionario')
                $this->session->set_userdata('url', $url[2]);
            redirect(base_url().'login');
        }
    }
    public function index(){
        $this->valido();
        $cod_rda = $this->session->userdata('id_usuario');
        $carnet = $this->session->userdata('username');
        $data['datos'] = $this->cuestionario_model->dtsdoc($cod_rda, $carnet);
        $this->load->view('template/template');
        $this->load->view('sis_vw/cuestionario', $data);
        $this->load->view('template/footer');
    }
    public function kuaa(){
        $this->valido();
        $cod_rda = $this->session->userdata('id_usuario');
        $carnet = $this->session->userdata('username');
        $data['datos'] = $this->cuestionario_model->dtsdoc($cod_rda, $carnet);
        $this->load->view('template/template');
        $this->load->view('sis_vw/cuestkuaa', $data);
        $this->load->view('template/footer');
    }
    public function labos(){
        $this->valido();
        $cod_rda = $this->session->userdata('id_usuario');
        $carnet = $this->session->userdata('username');
        $data['datos'] = $this->cuestionario_model->dtsdoc($cod_rda, $carnet);
        $this->load->view('template/template');
        $this->load->view('sis_vw/cuestlab', $data);
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
    public function guardakuaa(){
        print_r($_POST);
        echo '<br>';
        print_r($_FILES);
        $datos = array();
        $config['upload_path'] = './assets/uploads/files/kuaa/';
        
        $config['allowed_types'] = 'jpg|jpeg|png|bmp|pdf|xls|xlsx';
        $codigo = $this->generaCodigo(7);
        $dname = explode(".", $_FILES["archivo"]["name"]);
        $ext = end($dname);
        $archivo = $codigo . '.'. $ext;
        $config['file_name'] = $archivo;
        $config['max_size'] = '102400';
        $this->load->library('upload');
        $this->upload->initialize($config);
        if(!$this->upload->do_upload('videxp')){
            $data1 = $this->upload->data();
        }
        $this->load->view('template/header');
        if ( $sw == 2){
            // error en la subida del archivo 
            // obtenemos el error en un array 
            $error = array('error' => $this->upload->display_errors());
            $data['error'] = "Algo salió mal por favor intenta de nuevo";
        }else{
            if(!empty($_POST['rude'])){
                $datos = array(
                    'kuaa' => $this->input->post('kuaa'),
                    'funkuaa' => $this->input->post('funkuaa'),
                    'nofunkuaa' => $this->input->post('nofunkuaa'),
                    'blqkuaa' => $this->input->post('blqkuaa'),
                    'piso' => $this->input->post('piso'),
                    'funpiso' => $this->input->post('funpiso'),
                    'intrnt' => $this->input->post('intrnt'),
                    'tecint' => $this->input->post('tecint'),
                    'estudiantes' => $this->input->post('estudiantes'),
                    'maestros' => $this->input->post('maestros'),
                    'elec' => $this->input->post('elec'),
                    'aula' => $this->input->post('aula'),
                    'seguro' => $this->input->post('seguro'),
                    'almseg' => $this->input->post('almseg'),
                    'soporte' => $this->input->post('soporte'),
                    'clave_arch' => $this->input->post('archivo'),
                    
                );
                $res = $this->conales_model->guardatal($datos);
                $this->gendoc($datos);
            }else{
                $data['error'] = "Algo salió mal por favor intenta de nuevo";
                $this->load->view('vistas/alesp/talext', $data);
                $this->load->view('template/footer');
            }
        }
    }
    public function guardalab(){
        print_r($_POST);
        echo '<br>';
        print_r($_FILES);
    }
}
?>
