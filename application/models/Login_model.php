<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{
    public function __construct() {
		parent::__construct();
	}
    public function login_user($username,$password)
	{
        $this->db->where('carnet',$username);
    	$this->db->where('cod_rda',$password);
    	$query = $this->db->get('maestroservprog');
    	if($query->num_rows() > 0)
    	{
    		return $query->row();
    	}else{
    	    return FALSE;
    	}
    }
    public function nombuser($username,$password){
        $this->db->select("coalesce(trim(m.nombre1)||' '||trim(m.nombre2)||' '||trim(m.paterno)||' '||trim(m.materno)) as nomcom");
        $this->db->where('carnet',$username);
    	$this->db->where('cod_rda',$password);
    	$query = $this->db->get('Maestro m');
    	if($query->num_rows() > 0)
    	{
    		return $query->row();
    	}else{
    	    return FALSE;
    	}
    }

}
?>
