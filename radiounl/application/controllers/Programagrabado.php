<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Programagrabado extends CI_Controller {

	    public function __construct() {
        parent::__construct();
        $this->load->model('Programagrabado_model'); //carga model Unidad de Salud   
        //$this->load->model('Especialidad_model'); //carga el model de Especialidad
        //$this->load->model('Servicios_model'); // Carga el model de Servicios
        //$this->load->model('AreasEspecialidad_model'); // Carga el model de Area de Especialidad
    }

    public function index() {//crear Unidad de salud
        $data['title'] = "Formulario Crear Programa Grabado";
        $data['main'] = 'programagrabado/frm_CrearProgramaGrabado';
        $data['lista'] = $this->Programagrabado_model->getProgramasGrabados($this->session->userdata['esta_logeado']['idUsuario']);
        $this->load->vars($data);
        $this->load->view('include/header');
    }
    /////////Guardar programa grabado 
    public function guardarProgramaGrabado() {
        $lista = array(
            'usuarioidUsuario' => $this->session->userdata['esta_logeado']['idUsuario'],
            'TITULO' => strtoupper($this->input->post("Titulo"))
        );
        
        $config['upload_path'] = './audios';
        $config['allowed_types'] = 'mp3';
        $config['max_size'] = '0';
        $config['overwrite'] = 'true';

        $this->upload->initialize($config);
        if (!$this->upload->do_upload('Audio')) {
            $this->session->set_flashdata('error', 'Error Al Cargar el Audio');
            $lista['AUDIO'] = 'audios/defect.mp3';
        } else {
            $datosAudio = $this->upload->data();
            chmod($datosAudio['full_path'], 0777);
            $lista['AUDIO'] = 'audios/' . $datosAudio['file_name'];
            $this->session->set_flashdata('error', 'Carga Exitosa');
        }
        $id = $this->Programagrabado_model->guardar($lista);
        if ($id > 0) {
            redirect('programagrabado/infProgramaGrabado/'.$id, 'refresh');
        }
    }
    ///////////
    //////// Listar Programas Grabados
    public function listaProgramasGrabados() {
        $data['title'] = "Administrar Programas Grabados";
        $data['main'] = 'Programagrabado/frm_Listar_ProgramasGrabados';
        $data['lista'] = $this->Programagrabado_model->getProgramasGrabados($this->session->userdata['esta_logeado']['idUsuario']);
        $this->load->vars($data);
        $this->load->view('include/header');
    }
    ///////informacion de Programa Grabado
    public function infProgramaGrabado($id) {
        $data['title'] = "Información Del Programa Grabado";
        $data['main'] = 'Programagrabado/frm_InfProgramaGrabado';
        $data['lista'] = $this->Programagrabado_model->getProgramasGrabados($this->session->userdata['esta_logeado']['idUsuario']);
        $infU = $this->Programagrabado_model->getProgramaGrabado($this->session->userdata['esta_logeado']['idUsuario'], $id);
        $data['infProgramaGrabado'] = $infU;;
        $this->load->vars($data);
        $this->load->view('include/header');
    }
    //////////modificar Programa Grabado
    function modificarProgramaGrabado($id) {
        $lista = array(
            'usuarioidUsuario' => $this->session->userdata['esta_logeado']['idUsuario'],
            'TITULO' => strtoupper($this->input->post("Titulo")),
        );
        echo "<script>alert('Formulario enviado con exito....!!!! ');</script>";
        $this->Programagrabado_model->actualizarProgramaGrabado($id, $lista);
        redirect('programagrabado/infProgramaGrabado/' . $id, 'refresh');
    }
    ///////////////////Modificar Audio Programa Grabado
    function modificarAudioProGra($id) {
        $config['upload_path'] = './audios';
        $config['allowed_types'] = 'mp3';
        $config['max_size'] = '0';
        $config['overwrite'] = 'true';

        $this->upload->initialize($config);
        if (!$this->upload->do_upload('Audio')) {
            $this->session->set_flashdata('error', 'No se selecciono ningun audio');
             redirect('programagrabado/infProgramaGrabado/' . $id, 'refresh');
        } else
        {
            $datosAudio = $this->upload->data();
            chmod($datosAudio['full_path'], 0777);
            $lista['AUDIO'] = 'audios/' . $datosAudio['file_name'];
            $this->Programagrabado_model->actualizarProgramaGrabado($id, $lista);
            $this->session->set_flashdata('error', 'Audio actualizado');
            redirect('programagrabado/infProgramaGrabado/' . $id, 'refresh');
        }
    }
    /////////// Buscar Programa Grabado
    /*public function buscarProgramaGrabado() {
        $datoBuscar = $this->input->post("datoBuscar");
        $data['title'] = "Información Del Programa Grabado";
        $data['main'] = 'Programagrabado/frmResultadobuscador';
        $data['lista'] = $this->Programagrabado_model->getProgramasGrabados($this->session->userdata['esta_logeado']['idUsuario']);
        $data['datoBuscados'] = $this->Programagrabado_model->buscar($datoBuscar);
        $this->load->vars($data);
        $this->load->view('include/header');
    }*/

    /////////// eliminar Noticia

    public function eliminarProGra($id) {
        $this->Programagrabado_model->eliminarProgramaGrabado($id);
        redirect('programagrabado/listaProgramasGrabados/', 'refresh');
    }
    /////////


}

/* End of file Programagrabado.php */
/* Location: ./application/controllers/Programagrabado.php */