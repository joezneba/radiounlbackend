<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Programa extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Programa_model'); //carga model Unidad de Salud   
        //$this->load->model('Especialidad_model'); //carga el model de Especialidad
        //$this->load->model('Servicios_model'); // Carga el model de Servicios
        //$this->load->model('AreasEspecialidad_model'); // Carga el model de Area de Especialidad
    }

    public function index() {//crear Unidad de salud
        $data['title'] = "Formulario Crear Programa";
        $data['main'] = 'Programa/frm_CrearPrograma';
        $data['lista'] = $this->Programa_model->getProgramas($this->session->userdata['esta_logeado']['idUsuario']);
        $this->load->vars($data);
        $this->load->view('include/header');
    }
    /////////Guardar Noticia
    public function guardarPrograma() {
        $lista = array(
            'usuarioidUsuario' => $this->session->userdata['esta_logeado']['idUsuario'],
            'TITULO' => strtoupper($this->input->post("Titulo")),
            'HORA' => strtoupper($this->input->post("Hora")),
            'DIA' => strtoupper($this->input->post("Dia"))
        );
        
        $this->session->set_flashdata('error', 'Carga Exitosa');
        $id = $this->Programa_model->guardar($lista);
        if ($id > 0) {
            redirect('programa/infPrograma/' . $id, 'refresh');
        }
    }
    ///////////
    //////// Listar noticias
    public function listaProgramas() {
        $data['title'] = "Administrar Parrilla";
        $data['main'] = 'Programa/frm_ListarProgramas';
        $data['lista'] = $this->Programa_model->getProgramas($this->session->userdata['esta_logeado']['idUsuario']);
        $this->load->vars($data);
        $this->load->view('include/header');
    }
    ///////informacion de noticia
    public function infPrograma($id) {
        $data['title'] = "Información Del Programa";
        $data['main'] = 'Programa/frm_InfPrograma';
        $data['lista'] = $this->Programa_model->getProgramas($this->session->userdata['esta_logeado']['idUsuario']);
        $infU = $this->Programa_model->getPrograma($this->session->userdata['esta_logeado']['idUsuario'], $id);
        $data['infPrograma'] = $infU;;
        $this->load->vars($data);
        $this->load->view('include/header');
    }
    //////////modificar noticia
    function modificarPrograma($id) {
        $lista = array(
            'usuarioidUsuario' => $this->session->userdata['esta_logeado']['idUsuario'],
            'TITULO' => strtoupper($this->input->post("Titulo")),
            'HORA' => strtoupper($this->input->post("Hora")),
            'DIA' => strtoupper($this->input->post("Dia")),
        );
        echo "<script>alert('Formulario enviado con exito....!!!! ');</script>";
        $this->Programa_model->actualizarPrograma($id, $lista);
        redirect('programa/infPrograma/' . $id, 'refresh');
    }
    
    /////////// Buscar Noticia
    public function buscarPrograma() {
        $datoBuscar = $this->input->post("datoBuscar");
        $data['title'] = "Información Del Programa";
        $data['main'] = 'Principal/frmResultadobuscador';
        $data['lista'] = $this->Programa_model->getProgramas($this->session->userdata['esta_logeado']['idUsuario']);
        $data['datoBuscados'] = $this->Programa_model->buscar($datoBuscar);
        $this->load->vars($data);
        $this->load->view('include/header');
    }
    /////////// eliminar Noticia

    public function eliminarPro($id) {
        $this->Programa_model->eliminarPrograma($id);
        redirect('programa/listaProgramas/', 'refresh');
    }
    /////////

}

/* End of file Programa.php */
/* Location: ./application/controllers/Programa.php */