<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Programa_model extends CI_Model {

	function __construct() {
        parent::__construct();
    }

    function guardar($data) {
        $this->db->insert('programa', $data);
        return $this->db->insert_id();
    }


    function actualizarPorNombre($nombreUS, $datos) {
        $this->db->where('unidad_salud.NOMBRE_OFICIAL', $nombreUS);
        $this->db->update('unidad_salud', $datos);
    }
    /////obtener noticias
    public function getProgramas($id) {
        $this->db->select('*');
        $this->db->from('programa');
        $this->db->where('programa.usuarioidUsuario', $id);
        $lista = $this->db->get();
        if ($lista->num_rows() > 0) {
            return $lista->result_array();
        } else {
            return null;
        }
    }
    ///////// Obtener noticia
    public function getPrograma($idU, $idPrograma) {
        $condition = "usuarioidUsuario =" . "'" . $idU . "' AND " . "IDPROGRAMA =" . "'" . $idPrograma . "'";
        $this->db->select('*');
        $this->db->from('programa');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    //////// actualizar programa
    function actualizarPrograma($id, $datos) {
        $this->db->where('programa.IDPROGRAMA', $id);
        $this->db->update('programa', $datos);
    }
    //////// eliminar programa
    function eliminarPrograma($id) {
        $this->db->where('programa.IDPROGRAMA', $id);
        $this->db->delete('programa');
    }

    //////// REST CODEIGNITER   /////////////
    public function get($id=NULL)
    {
        if (! is_null($id)) 
        {
            $query=$this->db->select("*")->from("programa")->where("IDPROGRAMA",$id)->get();
            if ($query->num_rows()===1) {
                return $query->row_array();
            }
            return NULL;
        }

        $query=$this->db->select("*")->from("programa")->get();
            if ($query->num_rows()>0) {
                return $query->result_array();
            }
            return NULL;
    }

    private function _setPrograma($programa)
    {
        return array(
            "TITULO" => $programa["TITULO"],
            "DIA"   =>  $programa["DIA"],
            "HORA"  =>  $programa["HORA"]
        );
    }
    
}

/* End of file Programa_model.php */
/* Location: ./application/models/Programa_model.php */