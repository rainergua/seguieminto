<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('login_model');
		//$this->load->library('form_validation');
		//$this->load->database('default');
    }
    public function valido(){
        if($this->session->userdata('is_logued_in') == FALSE)
        {
            redirect(base_url().'login');
        }
    }
    public function index()
	{
		switch ($this->session->userdata('perfil')) {
			case '':
				$data['token'] = $this->token();
				$data['titulo'] = 'Ingrese sus Datos';
				$this->load->view('template/template');
				$this->load->view('login_vw/login_view',$data);
                $this->load->view('template/footer');
				break;
            case 'o':
            case 'a':
            case 'd':
                redirect(base_url().'login/panelctrl');
                break;
            case 'p':
            case 'i':
			case 'u':
            case 's':
            case 'r':
            case 'u':
            case 'e':
                $this->load->model('cuestionario_model');
                $rda = $this->session->userdata('id_usuario');
                $carnet = $this->session->userdata('username');
                if($this->cuestionario_model->verifica($rda, $carnet))
                    //redirect(base_url().'cuestionario');
                    redirect(base_url().'login/panelctrl');
                else
                    redirect(base_url().'login/panelctrl');
				break;
			default:
                $data['token'] = $this->token();
				$data['titulo'] = 'Ingrese sus datos';
				$this->load->view('template/template');
				$this->load->view('login_vw/login_view',$data);
                $this->load->view('template/footer');
				break;
		}
	}
    public function ingresar()
	{
        if($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token'))
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            //Verifica en la BBDD si esta el usuario o Unidad Educativa
            $check_user = $this->login_model->login_user($username,$password);
            if($check_user == TRUE)
            {
                //ASigna al array data el estado logueado, su id, su perfil(administrador, director), su nombre de usuario
                $data = array(
                'is_logued_in' 	=> 		TRUE,
                'id_usuario' 	=> 		$check_user->cod_rda,
                'perfil'		=>		$check_user->perfil,
                'username' 		=> 		$check_user->carnet,
                'nombre'      =>        $check_user->perfil=='a' ? 'Administrador(a)' : $this->login_model->nombuser($check_user->carnet,$check_user->cod_rda)->nomcom
                );
                //con el array	crea las 4 variables de sesion
                $this->session->set_userdata($data);
                //redirecciona al Metodo Index del Controlador Login
                if($this->session->userdata('url')){
                    //redirect(base_url().$this->session->userdata('url'));
                    redirect(base_url().'login/panelctrl');
                }else {
                    $this->index();
                }
            }else{
                redirect(base_url().'login');
            }
	    }else{
			redirect(base_url().'login');
		}
    }

    public function token()
	{
		$token = md5(uniqid(rand(),true));
		$this->session->set_userdata('token',$token);
		return $token;
	}
    public function logout()
	{
		$this->session->sess_destroy();
		$this->index();
	}
    public function panelctrl(){
        $this->valido();
        $this->load->model('cuestionario_model');
        $rda = $this->session->userdata('id_usuario');
        $carnet = $this->session->userdata('username');
        if($this->cuestionario_model->verifica($rda, $carnet)==0 && $this->session->userdata('perfil')!= 'a' &&  $this->session->userdata('perfil')!= 'd'){
            //redirect(base_url().'cuestionario');
        }
        $this->load->view('template/template');
        $this->load->view('dash_vw/ctrlpnl');
        $this->load->view('template/footer');
    }
    public function contactos(){
        $this->valido();
        $this->load->view('template/template');
        $this->load->view('sis_vw/contactos');
        $this->load->view('template/footer');
    }

}
?>
