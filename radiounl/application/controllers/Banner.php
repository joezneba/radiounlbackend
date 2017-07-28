<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Banner_model'); 
    }

    public function index() {//crear Unidad de salud
        $data['title'] = "Formulario Cargar Banner";
        $data['main'] = 'Banner/frm_CargarBanner';
        $data['lista'] = $this->Banner_model->getBanners($this->session->userdata['esta_logeado']['idUsuario']);
        $this->load->vars($data);
        $this->load->view('include/header');
    }
    /////////Guardar Banner
    public function guardarBanner() {
        $lista = array(
            'usuarioidUsuario' => $this->session->userdata['esta_logeado']['idUsuario']
        );
        //print_r($lista);
        $config['upload_path'] = './uploads';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = 'true';

        $this->upload->initialize($config);
        if (!$this->upload->do_upload('Foto')) {
            $this->session->set_flashdata('error', 'Error Al Cargar La Imagen');
            $lista['FOTO'] = 'uploads/US_defect.jpg';
        } else {
            $datosFoto = $this->upload->data();
            chmod($datosFoto['full_path'], 0777);
            $lista['FOTO'] = 'uploads/' . $datosFoto['file_name'];
            $this->session->set_flashdata('error', 'Carga Exitosa');
        }
        $id = $this->Banner_model->guardar($lista);
        if ($id > 0) {
            redirect('Banner/infBanner/' . $id, 'refresh');
        }
    }

    ///////////
    //////// Listar Banners
    public function listaBanners() {
        $data['title'] = "Administrar Banners";
        $data['main'] = 'Banner/frm_ListaBanner';
        $data['lista'] = $this->Banner_model->getBanners($this->session->userdata['esta_logeado']['idUsuario']);
        $this->load->vars($data);
        $this->load->view('include/header');
    }
    ///////informacion de Banner
    public function infBanner($id) {
        $data['title'] = "BANNER";
        $data['main'] = 'Banner/frm_InfBanner';
        $data['lista'] = $this->Banner_model->getBanners($this->session->userdata['esta_logeado']['idUsuario']);
        $infU = $this->Banner_model->getBanner($this->session->userdata['esta_logeado']['idUsuario'], $id);
        $data['infBanner'] = $infU;;
        $this->load->vars($data);
        $this->load->view('include/header');
    }

    ///////////////////Modificar Banner
    function modificarBanner($id) {
        $config['upload_path'] = './uploads';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = 'true';
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('Foto')) {
            $this->session->set_flashdata('error', 'No selecciono una imagen');
            redirect('banner/infBanner/' . $id, 'refresh');
        } else {
            $datosFoto = $this->upload->data();
            chmod($datosFoto['full_path'], 0777);
            $foto['Foto'] = 'uploads/' . $datosFoto['file_name'];
            $this->Banner_model->actualizarBanner($id, $foto);
            $this->session->set_flashdata('error', 'Foto actualizada');
            redirect('banner/infBanner/' . $id, 'refresh');
        }
    }
    /////////// Buscar Noticia
    public function buscarNoticia() {
        $datoBuscar = $this->input->post("datoBuscar");
        $data['title'] = "Información De La Noticia";
        $data['main'] = 'Principal/frmResultadobuscador';
        $data['lista'] = $this->Noticia_model->getNoticias($this->session->userdata['esta_logeado']['idUsuario']);
        $data['datoBuscados'] = $this->Noticia_model->buscar($datoBuscar);
        $this->load->vars($data);
        $this->load->view('include/header');
    }
    /////////// eliminar Noticia

    public function eliminarNo($id) {
        $this->Noticia_model->eliminarNoticia($id);
        redirect('noticia/listaNoticias/', 'refresh');
    }
    /////////


}
