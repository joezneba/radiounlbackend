<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('encrypt');
        $this->load->model('Usuario_model');
        $this->load->model('Noticia_model');
    }

    public function index() {
        $data['title'] = "Modificar Datos";
        $data['main'] = 'Usuario/frmModificarUsuario';
        $data['lista'] = $this->Noticia_model->getNoticias($this->session->userdata['esta_logeado']['idUsuario']);
        $data['datosU'] = $this->Usuario_model->getUsuario($this->session->userdata['esta_logeado']['idUsuario']);
        $this->load->vars($data);
        $this->load->view('include/header');
    }

    public function guardar($id) {
        $encrypt_nombre = $this->encrypt->encode($this->input->post('Nombre'));
        $encrypt_apellido = $this->encrypt->encode($this->input->post('Apellido'));
        $encrypt_clave = $this->encrypt->encode($this->input->post('pass1'));
        $encrypt_cedula = $this->encrypt->encode($this->input->post('cedula'));
        $encrypt_correo = $this->encrypt->encode($this->input->post('email'));
        $encrypt_correoRespaldo = $this->encrypt->encode($this->input->post('emailRespaldo'));
        $encrypt_direccion = $this->encrypt->encode($this->input->post('direccion'));
        $encrypt_telefono = $this->encrypt->encode($this->input->post('telefono'));
        $encrypt_respuesta = $this->encrypt->encode($this->input->post('respuesta'));
        $datos = array(
            'NOMBRE' => $encrypt_nombre,
            'APELLIDO' => $encrypt_apellido,
            'CLAVE' => $encrypt_clave,
            'CEDULA' => $encrypt_cedula,
            'CORREO' => $encrypt_correo,
            'DIRECCION' => $encrypt_direccion,
            'ESTADO' => 'A', //A DE ACTIVADO
            'TELEFONO' => $encrypt_telefono,
            'RESPUESTA' => $encrypt_respuesta,
            'CORREORESPALDO' => $encrypt_correoRespaldo,
        );
        $config['upload_path'] = './uploads/user';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = 'true';
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('Foto')) {
            $this->session->set_flashdata('error', 'Error Al Cargar La Imagen');
            $datos['FOTO'] = 'uploads/user/Cuentas_de_usuario.png';
        } else {
            $datosFoto = $this->upload->data();
            chmod($datosFoto['full_path'], 0777);
            $datos['FOTO'] = 'uploads/user' . $datosFoto['file_name'];
            $this->session->set_flashdata('error', 'Carga Exitosa');
        }
        $this->Usuario_model->actualizar($id, $datos);
        redirect('usuario/index', 'refresh');
    }

    function modificarFoto($id) {
        $config['upload_path'] = './uploads/user';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = 'true';
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('Foto')) {
            $this->session->set_flashdata('error', 'No selecciono una imagen');
            redirect('usuario', 'refresh');
            //redirect('usuario/' . $id, 'refresh');
        } else {
            $datosFoto = $this->upload->data();
            chmod($datosFoto['full_path'], 0777);
            $foto['FOTO'] = 'uploads/user' . $datosFoto['file_name'];
            $this->Usuario_model->actualizar($id, $foto);
            $this->session->set_flashdata('error', 'Foto actualizada');
            redirect('usuario', 'refresh');
            //redirect('usuario/editar/' . $id, 'refresh');
        }
    }

}
