<?php
/**
 * Description of Login MODEL
 *
 * @author Kevin Atiencia
 */
class Login_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function getUsuario($username) {
        $condition = "CORREO =" . "'" . $username . "'";
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getCorreos() {
        $this->db->select('`IDUSUARIO`,`CORREO`,`CLAVE`');
        $this->db->from('usuario');
        $datos = $this->db->get();
        if ($datos->num_rows() > 0) {
            return $datos->result_array();
        } else {
            return NULL;
        }
    }

    function getCorreosAlternativos() {
        $this->db->select('`IDUSUARIO`,`CORREORESPALDO`,`CLAVE`');
        $this->db->from('usuario');
        $datos = $this->db->get();
        if ($datos->num_rows() > 0) {
            return $datos->result_array();
        } else {
            return NULL;
        }
    }

    public function getUsuarioID($id) {
        $condition = "IDUSUARIO =" . "'" . $id . "'";
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

}
