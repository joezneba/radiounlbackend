<?php

class Usuario_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getUsuario($id) {
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where('usuario.IDUSUARIO', $id);
        $datos = $this->db->get();
        if ($datos->num_rows() > 0) {
            return $datos->row_array();
        } else {
            return NULL;
        }
    }

    function actualizar($id, $datos) {
        $this->db->where('usuario.IDUSUARIO', $id);
        $this->db->update('usuario', $datos);
        return $id;
    }
}
