<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuestionario_model extends CI_Model{

    public function __construct() {
    	parent::__construct();
    }

    public function guardar_data($data){
        if($this->db->insert("cuestionario", $data)){
			return TRUE;
		}else{
			return FALSE;
		}
    }
    public function guardar($data){
        $this->db->where('cod_rda', $data['cod_rda']);
        $this->db->where('carnet', $data['carnet']);
        $filas = $this->db->get('cuestionario')->num_rows();
        if($filas == 0)
            $this->guardar_data($data);
        return $filas;
    }
    public function verifica($rda, $carnet){
        $this->db->where('cod_rda', $rda);
        $this->db->where('carnet', $carnet);
        return $this->db->get('cuestionario')->num_rows();
    }
    public function dtsdoc($rda, $carnet){
        $this->db->distinct();
        $this->db->select("m.cod_rda, m.carnet, m.paterno, m.materno, m.nombre1, m.nombre2, p.programa, u.des_ue, d.distrito, e.departamento");
        $this->db->from("maestroservprog p");
        $this->db->join('Maestro m', 'p.cod_rda = m.cod_rda and m.carnet = p.carnet', 'inner');
        $this->db->join('ues u', 'p.programa = u.cod_ue', 'inner');
        $this->db->join('distrito d', 'u.cod_dis = d.cod_dis', 'inner');
        $this->db->join('departamento e', 'd.cod_dep = e.cod_dep', 'inner');
        $this->db->where('m.cod_rda', $rda);
        $this->db->where('m.carnet', $carnet);
        //$this->db->where('m.vigente', 'S');
        $this->db->order_by('m.paterno, m.materno, m.nombre1, m.nombre2', "asc");
        $query = $this->db->get('');
        return $query->row();
    }
}
?>
