<?php

class Noticia_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function guardar($data) {
        $this->db->insert('noticia', $data);
        return $this->db->insert_id();
    }

    function actualizar($id, $datos) {
        $this->db->where('unidad_salud.IDUNIDADSALUD', $id);
        $this->db->update('unidad_salud', $datos);
    }

    function actualizarPorNombre($nombreUS, $datos) {
        $this->db->where('unidad_salud.NOMBRE_OFICIAL', $nombreUS);
        $this->db->update('unidad_salud', $datos);
    }
    /////obtener noticias
    public function getNoticias($id) {
        $this->db->select('*');
        $this->db->from('noticia');
        $this->db->where('noticia.usuarioidUsuario', $id);
        $lista = $this->db->get();
        if ($lista->num_rows() > 0) {
            return $lista->result_array();
        } else {
            return null;
        }
    }
    ///////// Obtener noticia
    public function getNoticia($idU, $idUnidad) {
        $condition = "usuarioidUsuario =" . "'" . $idU . "' AND " . "IDNOTICIA =" . "'" . $idUnidad . "'";
        $this->db->select('*');
        $this->db->from('noticia');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    //////// actualizar noticia
    function actualizarNoticia($id, $datos) {
        $this->db->where('noticia.IDNOTICIA', $id);
        $this->db->update('noticia', $datos);
    }
    //////// eliminar noticia
    function eliminarNoticia($id) {
        $this->db->where('noticia.IDNOTICIA', $id);
        $this->db->delete('noticia');
    }

    ////////

    public function getUnidadEliminadas() {
        $condition = "ESTADO =" . 0;
        $this->db->select('*');
        $this->db->from('unidad_salud');
        $this->db->where($condition);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }




    /*     * ** SERVICIO WEB*** */

    public function get($id = NULL) {
        $condition = "IDUNIDADSALUD =" . "'" . $id . "' AND " . "ESTADO =" . "'" . 1 . "'";
        if (!is_null($id)) {
            $query = $this->db->select('`IDUNIDADSALUD`,`UNICODIGO`,`NOMBRE_OFICIAL`,`DIRECCION`,`TELEFONO`,`PROVINCIA`,`LUCRO`,`NIVEL_ATENCION`,`TIPOLOGIA`,`FOTO`')->from('unidad_salud')->where($condition)->get();
            if ($query->num_rows() === 1) {
                return $query->result_array();
            }
            return NULL;
        }
        $condition = "ESTADO =" . "'" . 1 . "'";
        $query = $this->db->select('`IDUNIDADSALUD`,`UNICODIGO`,`NOMBRE_OFICIAL`,`DIRECCION`,`TELEFONO`,`LUCRO`,`LONGITUD`, `LATITUD`,`FOTO`')->from('unidad_salud')->where($condition)->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return NULL;
//        $sql = $this->db->get('unidad_salud');
        //return $sql->result();
    }

        public function getInactivas() {
        $condition = "ESTADO =" . "'" . 0 . "'";
        $query = $this->db->select('*')->from('unidad_salud')->where($condition)->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return NULL;
//        $sql = $this->db->get('unidad_salud');
        //return $sql->result();
    }
    public function getNombre($id = NULL) {
        if (!is_null($id)) {
            $condition = "IDUNIDADSALUD =" . "'" . $id . "' AND " . "ESTADO =" . "'" . 1 . "'";
            $query = $this->db->select('`IDUNIDADSALUD`,`UNICODIGO`,`NOMBRE_OFICIAL`,`FOTO`,`LUCRO`')->from('unidad_salud')->where($condition)->get();
            if ($query->num_rows() === 1) {
                return $query->result_array();
            }
            return NULL;
        }
        $sql = $this->db->get('unidad_salud');
        return $sql->result();
    }

    /*     * ********************************* */
}
