<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte_model extends CI_Model{
    public function __construct() {
    	parent::__construct();
    }

    public function guardar($reporte){
        if($this->db->insert("reporte_copy", $reporte)){
			return TRUE;
		}else{
			return FALSE;
		}
    }
    public function nombre($carnet)
	{
		$this->db->where('carnet', $carnet);
        $this->db->select("coalesce(trim(nombre1)||' '||trim(nombre2)||' '||trim(paterno)||' '||trim(materno)) as nom_com, serie");
		$res = $this->db->get('Maestro');
		return $res->row();
	}
    public function serie($carnet)
	{
        $this->db->where('carnet', $carnet);
        $this->db->select("serie");
		$res = $this->db->get('Maestro');
		return $res->row();
	}
    public function reportes($carnet){
        $this->db->select("codigo, imagen");
        $this->db->where('carnet', $carnet);
        $this->db->where('visible', 's');
        $this->db->order_by('codigo', 'desc');
		$res = $this->db->get('reporte_copy');
		return $res->result();
    }
    public function borrar($id_foto){
        $data =  array('visible' => 'n');
        $this->db->where('codigo', $id_foto);
        $res = $this->db->update('reporte_copy', $data);
        return $res;
    }
    public function numReportes($carnet){
        $this->db->distinct();
        $this->db->select("m.carnet, (select count(*) from reporte where carnet = p.carnet and archivo like 's') reportes");
        $this->db->from('maestroservprog p');
        $this->db->join('Maestro m', 'p.cod_rda = m.cod_rda and m.carnet = p.carnet', 'inner');
        $this->db->where('m.carnet', $carnet);
        //$this->db->order_by('m.paterno, m.materno, m.nombre1, m.nombre2', "asc");
        return $this->db->get()->row();
    }
}
?>
