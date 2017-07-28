<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Noticia extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Noticia_model'); //carga model Unidad de Salud   
        //$this->load->model('Especialidad_model'); //carga el model de Especialidad
        //$this->load->model('Servicios_model'); // Carga el model de Servicios
        //$this->load->model('AreasEspecialidad_model'); // Carga el model de Area de Especialidad
    }

    public function index() {//crear Unidad de salud
        $data['title'] = "Formulario Crear Noticia";
        $data['main'] = 'Noticia/frm_CrearNoticia';
        $data['lista'] = $this->Noticia_model->getNoticias($this->session->userdata['esta_logeado']['idUsuario']);
        $this->load->vars($data);
        $this->load->view('include/header');
    }
    /////////Guardar Noticia
    public function guardarNoticia() {
        $lista = array(
            'usuarioidUsuario' => $this->session->userdata['esta_logeado']['idUsuario'],
            'TITULO' => strtoupper($this->input->post("Titulo")),
            'DESCRIPCION' => strtoupper($this->input->post("Descripcion")),
            'FECHA' => strtoupper($this->input->post("Fecha"))
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
        $id = $this->Noticia_model->guardar($lista);
        if ($id > 0) {
            redirect('noticia/infNoticia/' . $id, 'refresh');
        }
    }
    ///////////
    //////// Listar noticias
    public function listaNoticias() {
        $data['title'] = "Administrar Noticias";
        $data['main'] = 'Noticia/frm_Listar_Noticias';
        $data['lista'] = $this->Noticia_model->getNoticias($this->session->userdata['esta_logeado']['idUsuario']);
        $this->load->vars($data);
        $this->load->view('include/header');
    }
    ///////informacion de noticia
    public function infNoticia($id) {
        $data['title'] = "Información De La Noticia";
        $data['main'] = 'Noticia/frm_InfNoticia';
        $data['lista'] = $this->Noticia_model->getNoticias($this->session->userdata['esta_logeado']['idUsuario']);
        $infU = $this->Noticia_model->getNoticia($this->session->userdata['esta_logeado']['idUsuario'], $id);
        $data['infNoticia'] = $infU;;
        $this->load->vars($data);
        $this->load->view('include/header');
    }
    //////////modificar noticia
    function modificarNoticia($id) {
        $lista = array(
            'usuarioidUsuario' => $this->session->userdata['esta_logeado']['idUsuario'],
            'TITULO' => strtoupper($this->input->post("Titulo")),
            'DESCRIPCION' => strtoupper($this->input->post("Descripcion")),
            'FECHA' => strtoupper($this->input->post("Fecha")),
        );
        echo "<script>alert('Formulario enviado con exito....!!!! ');</script>";
        $this->Noticia_model->actualizarNoticia($id, $lista);
        redirect('noticia/infNoticia/' . $id, 'refresh');
    }
    ///////////////////Modificar foto Noticia
    function modificarFotoNoticia($id) {
        $config['upload_path'] = './uploads';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = 'true';
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('Foto')) {
            $this->session->set_flashdata('error', 'No selecciono una imagen');
            redirect('noticia/infNoticia/' . $id, 'refresh');
        } else {
            $datosFoto = $this->upload->data();
            chmod($datosFoto['full_path'], 0777);
            $foto['Foto'] = 'uploads/' . $datosFoto['file_name'];
            $this->Noticia_model->actualizarNoticia($id, $foto);
            $this->session->set_flashdata('error', 'Foto actualizada');
            redirect('noticia/infNoticia/' . $id, 'refresh');
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
