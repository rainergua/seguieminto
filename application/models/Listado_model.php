<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listado_model extends CI_Model{
    public function __construct() {
    		parent::__construct();
    	}
    public function cargaData($fila, $tabla)
    {
        $this->db->insert($tabla, $fila);
    }

    public function listaDepto()
    {
        $res = $this->db->get('departamento');
        if($res->num_rows()>0){
            return $res->result();
        }else {
            return false;
        }
    }
    public function listaDist($depto){
        $this->db->where('cod_dep', $depto);
        $this->db->order_by('distrito');
        $res = $this->db->get('distrito');
        if($res->num_rows()>0){
            return $res->result();
        }else {
            return false;
        }
    }
    public function listaUes($dist){
        $this->db->where('cod_dis', $dist);
        $this->db->order_by('des_ue');
        $res = $this->db->get('ues');
        if($res->num_rows()>0){
            return $res->result();
        }else {
            return false;
        }
    }
    public function listaMaestros($ue){
        $this->db->distinct();
        $this->db->select("m.cod_rda, m.carnet, m.paterno, m.materno, m.nombre1, m.nombre2, p.programa, m.serie, m.fecharecibio, m.vigente, m.scandoc,
        (select count(*) from reporte where rda=p.cod_rda and carnet = p.carnet  and archivo='s') reportes");
        $this->db->from("maestroservprog p");
        $this->db->join('Maestro m', 'p.cod_rda = m.cod_rda and m.carnet = p.carnet', 'inner');
        $this->db->where('p.programa', $ue);
        //$this->db->where('m.vigente', 'S');
        $this->db->order_by('m.paterno, m.materno, m.nombre1, m.nombre2', "asc");
        return $this->db->get()->result();
    }
    public function getImagenes($cod_rda){
        $this->db->select('imagen');
        $this->db->where('rda', $cod_rda);
        return $this->db->get('reporte')->result();
    }
}
?>
