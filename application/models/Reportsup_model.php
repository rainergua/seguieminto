<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportsup_model extends CI_Model{

    public function __construct() {
    	parent::__construct();
    }

    public function maestroue($carnet){
        $this->db->where('carnet', $carnet);
        $this->db->select('programa');
        $this->db->order_by('programa','desc');
        $res = $this->db->get('maestroservprog');
        return $res->row();

    }
    public function maestrodist($carnet){
        $this->db->where('carnet', $carnet);
        $this->db->select('substring(servicio, 3, 3) as cod_dis', FALSE);
        //$this->db->order_by('programa','desc');
        $res = $this->db->get('maestroservprog');
        return $res->row();

    }
    public function maestrodep($carnet){
        $this->db->where('carnet', $carnet);
        $this->db->select('substring(servicio, 3, 1) as cod_dep', FALSE);
        //$this->db->order_by('programa','desc');
        $res = $this->db->get('maestroservprog');
        return $res->row();

    }
    public function graficoue($carnet)
    {
        $prog = $this->maestroue($carnet);
        $this->db->select("cod_ue, count(cod_ue) as maestros,
        (select count(*) from public.\"Maestro\" m inner join maestroservprog r on r.carnet=m.carnet where m.fecharecibio = 'NULL' and r.programa=e.cod_ue) as no,
        (select count(distinct m.carnet) from public.\"Maestro\" m inner join maestroservprog r on r.carnet=m.carnet where m.fecharecibio <> 'NULL' and r.programa=e.cod_ue) as si,
        (select count(distinct m.carnet) from public.reporte m inner join maestroservprog r on r.carnet=m.carnet where r.programa=e.cod_ue) as reporte");
        $this->db->from('reporteue e');
        $this->db->where('e.cod_ue', $prog->programa);
        $this->db->group_by('e.cod_ue');
        $res = $this->db->get();
        return $res->row();
    }
    public function graficodis($carnet)
    {
        $prog = $this->maestrodist($carnet);
        $this->db->select("cod_dis, count(*) as maestros,
        (select count(*) from public.\"Maestro\" m inner join reporteue r on r.carnet=m.carnet where m.fecharecibio = 'NULL' and r.cod_dis = e.cod_dis) as no,
        (select count(m.carnet) from public.\"Maestro\" m inner join reporteue r on r.carnet=m.carnet where m.fecharecibio <> 'NULL' and r.cod_dis = e.cod_dis) as si,
        (select count(distinct m.carnet) from public.reporte m inner join reporteue r on r.carnet=m.carnet where r.cod_dis=e.cod_dis) as reporte");
        $this->db->from('reporteue e');
        $this->db->where('e.cod_dis', $prog->cod_dis);
        $this->db->group_by('e.cod_dis');
        $res = $this->db->get();
        return $res->row();
    }
    public function tablaue($carnet, $programa)
    {
        if($programa == ''){
            $prog = $this->maestroue($carnet);
            $programa = $prog->programa;
        }
        $this->db->select("coalesce(trim(m.nombre1)||' '||trim(m.nombre2)||' '||trim(m.paterno)||' '||trim(m.materno)) as nomcom,
        m.carnet, m.cod_rda, m.serie, (select count(*) from reporte where carnet=m.carnet and archivo='s') reportes, r.funcionamiento,
        r.conservacion, r.uso, r.observacion, r.activo");
        $this->db->from('Maestro m');
        $this->db->join('reporteue r', 'm.cod_rda=r.cod_rda and m.carnet=r.carnet');
        $this->db->where('r.cod_ue', $programa);
        $this->db->order_by('m.paterno, m.materno','m.nombre1', 'm.nombre2');
        $res = $this->db->get();
        return $res->result();
    }
    public function tabladis($carnet, $cod_dis)
    {
        if($cod_dis < 1){
            $prog = $this->maestrodist($carnet);
            $cod_dis = $prog->cod_dis;
        }
        $this->db->select("e.cod_ue, trim(s.des_ue) as ue, s.cod_dis, count(e.cod_ue) as maestros,
(select count(*) from public.\"Maestro\" m inner join maestroservprog r on r.carnet=m.carnet where m.fecharecibio = 'NULL' and r.programa=e.cod_ue) as no,
(select count(distinct m.carnet) from public.\"Maestro\" m inner join maestroservprog r on r.carnet=m.carnet where m.fecharecibio <> 'NULL' and r.programa=e.cod_ue) as si,
(select count(distinct m.carnet) from public.reporte m inner join maestroservprog r on r.carnet=m.carnet where r.programa=e.cod_ue) as reporte,
(select count(distinct u.carnet) from reporteue u where u.cod_ue=e.cod_ue and u.funcionamiento='Si') as funsi,
(select count(distinct u.carnet) from reporteue u where u.cod_ue=e.cod_ue and u.funcionamiento='No') as funno,
(select count(distinct u.carnet) from reporteue u where u.cod_ue=e.cod_ue and u.conservacion='Bueno') as consbu,
(select count(distinct u.carnet) from reporteue u where u.cod_ue=e.cod_ue and u.conservacion='Regular') as consre,
(select count(distinct u.carnet) from reporteue u where u.cod_ue=e.cod_ue and u.conservacion='Malo') as consma,
(select count(distinct u.carnet) from reporteue u where u.cod_ue=e.cod_ue and u.uso='Aula') as usoaula,
(select count(distinct u.carnet) from reporteue u where u.cod_ue=e.cod_ue and u.uso='Casa') as usocasa,
(select count(distinct u.carnet) from reporteue u where u.cod_ue=e.cod_ue and u.uso='Todos') as usotodo,
(select count(distinct u.carnet) from reporteue u where u.cod_ue=e.cod_ue and u.uso='Otro Lugar') as usotro,
(select count(distinct u.carnet) from reporteue u where u.cod_ue=e.cod_ue and u.observacion='Retiro') as obsret,
(select count(distinct u.carnet) from reporteue u where u.cod_ue=e.cod_ue and u.observacion='Proceso Penal') as obspen,
(select count(distinct u.carnet) from reporteue u where u.cod_ue=e.cod_ue and u.observacion='Proceso Administrativo') as obsadm,
(select count(distinct u.carnet) from reporteue u where u.cod_ue=e.cod_ue and u.observacion='Jubilación') as obsjub,
(select count(distinct u.carnet) from reporteue u where u.cod_ue=e.cod_ue and u.observacion='Ninguno') as obsnin");
        $this->db->from('reporteue e');
        $this->db->join('ues s', 's.cod_ue = e.cod_ue');
        $this->db->where('s.cod_dis', $cod_dis);
        $this->db->group_by('e.cod_ue, s.des_ue, s.cod_dis');
        $this->db->order_by('ue');
        $res = $this->db->get();
        return $res->result();
    }
    public function tabladep($carnet, $cod_dep)
    {
        if($cod_dep < 1){
            $prog = $this->maestrodist($carnet);
            $cod_dep = floor($prog->cod_dis/100);
        }
        //$cod_dep = floor(985/100);
        $this->db->select("e.cod_dis, trim(d.distrito) distrito, count(distinct e.carnet) as maestros,
(select count(distinct m.carnet) from public.\"Maestro\" m inner join reporteue r on r.carnet=m.carnet where m.fecharecibio = 'NULL' and r.cod_dis=e.cod_dis) as no,
(select count(distinct m.carnet) from public.\"Maestro\" m inner join reporteue r on r.carnet=m.carnet where m.fecharecibio <> 'NULL' and r.cod_dis=e.cod_dis ) as si,
(select count(distinct m.carnet) from public.reporte m inner join reporteue r on r.carnet=m.carnet where r.cod_dis=e.cod_dis) as reporte,
(select count(distinct u.carnet) from reporteue u where u.cod_dis=e.cod_dis and u.funcionamiento='Si') as funsi,
(select count(distinct u.carnet) from reporteue u where u.cod_dis=e.cod_dis and u.funcionamiento='No') as funno,
(select count(distinct u.carnet) from reporteue u where u.cod_dis=e.cod_dis and u.conservacion='Bueno') as consbu,
(select count(distinct u.carnet) from reporteue u where u.cod_dis=e.cod_dis and u.conservacion='Regular') as consre,
(select count(distinct u.carnet) from reporteue u where u.cod_dis=e.cod_dis and u.conservacion='Malo') as consma,
(select count(distinct u.carnet) from reporteue u where u.cod_dis=e.cod_dis and u.uso='Aula') as usoaula,
(select count(distinct u.carnet) from reporteue u where u.cod_dis=e.cod_dis and u.uso='Casa') as usocasa,
(select count(distinct u.carnet) from reporteue u where u.cod_dis=e.cod_dis and u.uso='Todos') as usotodo,
(select count(distinct u.carnet) from reporteue u where u.cod_dis=e.cod_dis and u.uso='Otro Lugar') as usotro,
(select count(distinct u.carnet) from reporteue u where u.cod_dis=e.cod_dis and u.observacion='Retiro') as obsret,
(select count(distinct u.carnet) from reporteue u where u.cod_dis=e.cod_dis and u.observacion='Proceso Penal') as obspen,
(select count(distinct u.carnet) from reporteue u where u.cod_dis=e.cod_dis and u.observacion='Proceso Administrativo') as obsadm,
(select count(distinct u.carnet) from reporteue u where u.cod_dis=e.cod_dis and u.observacion='Jubilación') as obsjub,
(select count(distinct u.carnet) from reporteue u where u.cod_dis=e.cod_dis and u.observacion='Ninguno') as obsnin");
        $this->db->from('reporteue e');
        $this->db->join('distrito d', 'e.cod_dis=d.cod_dis');
        $this->db->where('d.cod_dep', $cod_dep);
        $this->db->group_by('e.cod_dis, d.distrito');
        $this->db->order_by('distrito');
        $res = $this->db->get();
        return $res->result();
    }
    public function actualiza($data, $carnet){
        //$data =  array('archivo' => 'n');
        $this->db->where('carnet', $carnet);
        $res = $this->db->update('reporteue', $data);
        return $res;
    }
    public function dataUE($carnet){
        $prog = $this->maestroue($carnet);
        $programa = $prog->programa;
        $this->db->select("e.departamento, d.distrito, u.des_ue, u.cod_ue");
        $this->db->from('ues u');
        $this->db->join('distrito d', 'u.cod_dis = d.cod_dis');
        $this->db->join('departamento e', 'u.cod_dep = e.cod_dep');
        $this->db->where('u.cod_ue', $programa);
        $res = $this->db->get();
        return $res->row();
    }
    public function dataDis($carnet){
        $dis = $this->maestrodist($carnet);
        $distrito = $dis->cod_dis;
        $this->db->select("e.departamento, d.distrito, d.cod_dis");
        $this->db->from('distrito d');
        $this->db->join('departamento e', 'e.cod_dep = d.cod_dep');
        $this->db->where('d.cod_dis', $distrito);
        $res = $this->db->get();
        return $res->row();
    }
    public function dataDep($carnet){
        $dep = $this->maestrodep($carnet);
        $depto = $dep->cod_dep;
        $this->db->select("departamento");
        $this->db->from('departamento');
        $this->db->where('cod_dep', $depto);
        $res = $this->db->get();
        return $res->row();
    }
}
?>
