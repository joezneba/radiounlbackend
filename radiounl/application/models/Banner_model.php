<?php

class Banner_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function guardar($data) {
        $this->db->insert('banner', $data);
        return $this->db->insert_id();
    }

    /////obtener Banners
    public function getBanners($id) {
        $this->db->select('*');
        $this->db->from('banner');
        $this->db->where('banner.usuarioidUsuario', $id);
        $lista = $this->db->get();
        if ($lista->num_rows() > 0) {
            return $lista->result_array();
        } else {
            return null;
        }
    }
    ///////// Obtener Banner
    public function getBanner($idU, $idBanner) {
        $condition = "usuarioidUsuario =" . "'" . $idU . "' AND " . "IDBANNER =" . "'" . $idBanner . "'";
        $this->db->select('*');
        $this->db->from('banner');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    //////// actualizar banner
    function actualizarBanner($id, $datos) {
        $this->db->where('banner.IDBANNER', $id);
        $this->db->update('banner', $datos);
    }
    //////// eliminar noticia
    function eliminarNoticia($id) {
        $this->db->where('noticia.IDNOTICIA', $id);
        $this->db->delete('noticia');
    }

    ////////

    /*     * ********************************* */
}
