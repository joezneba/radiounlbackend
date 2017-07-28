<?php

/**
 * Description of Login CTRL
 *
 * @author Kevin Atiencia
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Cargar Librerias de codeigniter
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('encrypt');
        //Cargar los modelos que conectan a la base de datos
        $this->load->model('Login_model');
        $this->load->model('Noticia_model');
    }

    /* Metodos que cargan una nueva interfaz */

    //Carga el frameLogin para autenticarse
    public function index($data = array()) {
        //array que contiene un mensaje
        $data['title'] = "Login";
        $this->load->vars($data);
        $this->load->view('frmLogin');
    }

    //valida si el correo y contraseña son correctos
    /*public function validar() {
        $username = $this->input->post('email');
        $clave = $this->input->post('password');
        $result = $this->Login_model->getCorreos();
        $i = 0;
        foreach ($result as $datos) {
            if ($this->encrypt->decode($datos['CORREO']) == $username) {
                if ($this->encrypt->decode($datos['CLAVE']) == $clave) {
                    $datosU = $this->Login_model->getUsuario($datos['CORREO']);
                    $captcha = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6Ld6xCMTAAAAALEb-9ChmsbZnt6BWkSlnkhKs0S7&response=' . $_POST['g-recaptcha-response'] . '&remoteip=' . $_SERVER['REMOTE_ADDR']), TRUE);
                    if ($captcha['success'] == TRUE) {
                        $session_data = array(
                            'idUsuario' => $datosU[$i]->IDUSUARIO,
                            'nombre' => $datosU[$i]->NOMBRE,
                            'apellido' => $datosU[$i]->APELLIDO,
                            'email' => $datosU[$i]->CORREO,
                            'estado' => $datosU[$i]->ESTADO
                        ); //datos de una sesión  
                        $this->session->set_userdata('esta_logeado', $session_data);
                        session_start();
                        redirect('login/page_Admin', 'refresh');
                    } else {
                        redirect('login/PreguntaSeguridad/' . $datosU[$i]->IDUSUARIO, 'refresh');
                    }
                } else {
                    $data = array(
                        'message' => 'Invalido El <strong>Password</strong>');
                    $this->index($data);
                }
            } else {
                $data = array(
                    'message' => 'Invalido El <strong>Email</strong>');
                $this->index($data);
            }$i++;
        }
    }*/

    public function validar() {
        $username = $this->input->post('email');
        $clave = $this->input->post('password');
        $result = $this->Login_model->getCorreos();
        $i = 0;
        foreach ($result as $datos) {
            if ($this->encrypt->decode($datos['CORREO']) == $username) {
                if ($this->encrypt->decode($datos['CLAVE']) == $clave) {
                    $datosU = $this->Login_model->getUsuario($datos['CORREO']);
                    if ($username==$datos['CORREO']) {
                        $session_data = array(
                            'idUsuario' => $datosU[$i]->IDUSUARIO,
                            'nombre' => $datosU[$i]->NOMBRE,
                            'apellido' => $datosU[$i]->APELLIDO,
                            'email' => $datosU[$i]->CORREO,
                            'estado' => $datosU[$i]->ESTADO
                        ); //datos de una sesión  
                        $this->session->set_userdata('esta_logeado', $session_data);
                        session_start();
                        redirect('login/page_Admin', 'refresh');
                    } else {
                        redirect('login/PreguntaSeguridad/' . $datosU[$i]->IDUSUARIO, 'refresh');
                    }
                } else {
                    $data = array(
                        'message' => 'Invalido El <strong>Password</strong>');
                    $this->index($data);
                }
            } else {
                $data = array(
                    'message' => 'Invalido El <strong>Email</strong>');
                $this->index($data);
            }$i++;
        }
    }

    //Carga la pagina principal
    public function page_Admin() {
        $data['title'] = "Admin Page";
        $data['main'] = 'Principal/frmPrincipal';
        $data['lista'] = $this->Noticia_model->getNoticias($this->session->userdata['esta_logeado']['idUsuario']);
        $this->load->vars($data);
        $this->load->view('include/header');
    }

    //Carga la interfaz de Pregunta de Seguridad
    public function PreguntaSeguridad($id, $data = array()) {
        $data['title'] = "Pregunta Seguridad";
        $data['idUsuario'] = $id;
        $this->load->vars($data);
        $this->load->view('frmPreguntaSeguridad');
    }

    //salir del sistema
    public function logout() {
        $sess_array = array(
            'idUsuario' => ' ',
            'nombre' => ' ',
            'apellido' => ' ',
            'email' => ' ',
            'tipo_usuario' => ' ',
            'estado' => ' ',
        );
        $this->session->unset_userdata('esta_logeado', $sess_array); //destruye la sesion
        $data['message'] = 'Vuelva Pronto...';
        $data['title'] = "Login";
        $this->session->sess_destroy();
        $this->load->vars($data);
        $this->load->view('frmLogin');
    }

    //carga la view de Google Maps
    public function googleMaps() {
        $this->load->library('googlemaps'); // llamada a la libreria googlemaps
        $config['center'] = '-3.993771, -79.204728'; //Posicion por  inicial
        $config['zoom'] = 'auto'; // zoom 
        $this->googlemaps->initialize($config); //Inicializa el mapa con las configuraciones 
        //**************Marcadores ****************//
        // Se obtiene la Informacion de las Unidades de Salud
        $data['lista'] = $this->UnidadSalud_model->getUnidades($this->session->userdata['esta_logeado']['idUsuario']);
        $data = $this->UnidadSalud_model->getInformacionMaps($this->session->userdata['esta_logeado']['idUsuario']);
        $i = 0;
        $marker = array();
        if (!is_null($data)) {
            foreach ($data as $infUS) {
                $latitud = $infUS['LATITUD'];
                $longitud = $infUS['LONGITUD'];
                //Arreglo con la informacion de cada marcador
                $marker[$i] = array(
                    'position' => "$latitud,$longitud",
                    'infowindow_content' => $infUS['NOMBRE_OFICIAL'],
                    'icon' => base_url() . 'img/icon.png',
                    'draggable' => true,
                    'ondragend' => '$("#Latitud").val(marker_' . $i . '.getPosition().lat());$("#Longitud").val(marker_' . $i . '.getPosition().lng());$("#Nombre_Oficial").val(this.get("content"));',
                    'onclick' => '$("#Latitud").val(marker_' . $i . '.getPosition().lat());$("#Longitud").val(marker_' . $i . '.getPosition().lng());$("#Nombre_Oficial").val(this.get("content"));'
                );

                $this->googlemaps->add_marker($marker[$i]);
                $i++;
            }
        }
        $data['map'] = $this->googlemaps->create_map();
        $data['lista'] = $this->UnidadSalud_model->getUnidades($this->session->userdata['esta_logeado']['idUsuario']);
        $data['title'] = "Google Maps";
        $data['main'] = 'Principal/frmGoogleMaps';
        $this->load->vars($data);
        $this->load->view('include/header');
    }

    //Valida si las pregunta de seguridad es correcta
    public function validarPregunta() {
        $id = $this->input->post('idUsuario'); //obtiene el id del usuario
        $respuesta = $this->input->post('respuesta'); // se obtiene la respuesta del usuaio por medio de post
        $result = $this->Login_model->getUsuarioID($id); // se obtiene el resultado de la pregunta  de la DDBB
        if ($respuesta === $this->encrypt->decode($result[0]->RESPUESTA)) {
            $session_data = array(
                'idUsuario' => $result[0]->IDUSUARIO,
                'nombre' => $result[0]->NOMBRE,
                'apellido' => $result[0]->APELLIDO,
                'email' => $result[0]->CORREO,
                'estado' => $result[0]->ESTADO
            ); //datos de una sesión  
            $this->session->set_userdata('esta_logeado', $session_data);
            redirect('login/page_Admin', 'refresh');
        } else {
            $data = array(
                'message' => 'Respuesta <strong>Incorrecta</strong>');
            $this->PreguntaSeguridad($result[0]->IDUSUARIO, $data);
        }
    }

    //actualiza el latitud y longitud de una Unidad de salur X
    public function actualizar() {
        $id = $this->input->post("Nombre_Oficial");
        $lista = array(
            'LONGITUD' => $this->input->post("Longitud"),
            'LATITUD' => $this->input->post("Latitud"),
        );
        $this->UnidadSalud_model->actualizarPorNombre($id, $lista);
        redirect('Login/googleMaps', 'refresh');
    }

    public function RecuperarClave() {
        $correoAlternativo = $this->input->post('correoAlter');
        $result = $this->Login_model->getCorreosAlternativos();
        foreach ($result as $datos) {
            if ($this->encrypt->decode($datos['CORREORESPALDO']) == $correoAlternativo) {
                redirect('login/PreguntaSeguridad/' . $datos['IDUSUARIO']);
            } else {
                $data = array(
                    'message' => 'Invalido el <strong>Email de Recuperación</strong>');
                $this->index($data);
            }
        }
    }
 
}
