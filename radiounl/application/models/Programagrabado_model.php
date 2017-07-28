<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Programagrabado_model extends CI_Model {

	function __construct() {
        parent::__construct();
    }

    function guardar($data) {
        $this->db->insert('programagrabado', $data);
        return $this->db->insert_id();
    }


    function actualizarPorNombre($nombreUS, $datos) {
        $this->db->where('unidad_salud.NOMBRE_OFICIAL', $nombreUS);
        $this->db->update('unidad_salud', $datos);
    }
    /////obtener Programas Grabados
    public function getProgramasGrabados($id) {
        $this->db->select('*');
        $this->db->from('programagrabado');
        $this->db->where('programagrabado.usuarioidUsuario', $id);
        $lista = $this->db->get();
        if ($lista->num_rows() > 0) {
            return $lista->result_array();
        } else {
            return null;
        }
    }
    ///////// Obtener Programa Grabado
    public function getProgramaGrabado($idU, $idPrograma) {
        $condition = "usuarioidUsuario =" . "'" . $idU . "' AND " . "IDPROGRAMAGRABADO =" . "'" . $idPrograma . "'";
        $this->db->select('*');
        $this->db->from('programagrabado');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    //////// actualizar Programa Grabado
    function actualizarProgramaGrabado($id, $datos) {
        $this->db->where('programagrabado.IDPROGRAMAGRABADO', $id);
        $this->db->update('programagrabado', $datos);
    }
    //////// eliminar Programa Grabado
    function eliminarProgramaGrabado($id) {
        $this->db->where('programagrabado.IDPROGRAMAGRABADO', $id);
        $this->db->delete('programagrabado');
    }

    //////////////////////////////////
    /////REST CODEIGNITER ////////////7
    public function get($id=NULL)
    {
        if (! is_null($id)) 
        {
            $query=$this->db->select("*")->from("programagrabado")->where("IDPROGRAMAGRABADO",$id)->get();
            if ($query->num_rows()===1) {
                return $query->row_array();
            }
            return NULL;
        }

        $query=$this->db->select("*")->from("programagrabado")->get();
            if ($query->num_rows()>0) {
                return $query->result_array();
            }
            return NULL;
    }

    private function _setPrograma($programagrabado)
    {
        return array(
            "TITULO" => $programagrabado["TITULO"],
            "AUDIO"   =>  $programagrabado["AUDIO"]
        );
    }




}

/* End of file Programagrabado_model.php */
/* Location: ./application/models/Programagrabado_model.php */