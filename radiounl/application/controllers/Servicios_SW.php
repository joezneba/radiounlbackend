<?php

/**
 * Description of Servicios_SW
 *
 * @author Jonathan Neira
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Servicios_SW extends REST_Controller {

    public function __construct() {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
        parent::__construct();
        $this->load->model('Servicios_model');
    }

    public function index_get() {
        $datos = $this->Servicios_model->get();
        $response = array();
        $i = 0;
        if (!is_null($datos)) {
            foreach ($datos as $dataS) {
                if ($dataS['DISPONIBILIDAD'] == 1) {
                    $response[$i] = $dataS;
                }
                $i++;
            }
            $this->response(array('response' => $response), 200); // 200 por que la peticion a sido corrrecta
        } else {
            $this->response(array('response' => "No existen Servicios"), 404); // 400 por que la peticion a sido incorrrecta
        }
    }

    public function find_get($id) {
        if (!$id) {
            $this->response(NULL, 400);
        }
        $datos = $this->Servicios_model->get($id);
        if (!is_null($datos)) {
            $this->response(array('response' => $datos), 200); // 200 por que la peticion a sido corrrecta
        } else {
            $this->response(array('response' => "No existen Servicios"), 404); // 400 por que la peticion a sido incorrrecta
        }
    }

    public function id_get($id) {
        if (!$id) {
            $this->response(NULL, 400);
        }
        $datos = $this->Servicios_model->get_Id($id);
        if (!is_null($datos)) {
            $response = [];
            $i = 0;
            foreach ($datos as $datosS) {
                //print_r($datosE);
                if ($datosS['DISPONIBILIDAD'] == 1) {
                    $response[$i] = $datosS;
                    $i++;
                }
            }
            $this->response(array('response' => $response), 200); // 200 por que la peticion a sido corrrecta
        } else {
            $this->response(array('response' => "No existen Servicios"), 404); // 400 por que la peticion a sido incorrrecta
        }
    }

    public function disponibilidad_get() {
        $datos = $this->Servicios_model->get();
        $response = array();
        $i = 0;
        if (!is_null($datos)) {
            foreach ($datos as $dataS) {
                if ($dataS['DISPONIBILIDAD'] == 2) {
                    $response[$i] = $dataS;
                    $i++;
                }
            }
            $response['length'] = $i;
            $this->response(array('response' => $response), 200); // 200 por que la peticion a sido corrrecta
        } else {
            $this->response(array('response' => "No existen Servicios"), 404); // 400 por que la peticion a sido incorrrecta
        }
    }

    public function index_post() {
        $datos = array(
            'unidad_SaludIDUNIDADSALUD' => $this->post('unidad_SaludIDUNIDADSALUD'),
            'unidad_SaludUNICODIGO' => $this->post('unidad_SaludUNICODIGO'),
            'contribuidorIDCONTRIBUIDOR' => $this->post('contribuidorIDCONTRIBUIDOR'),
            'DESCRIPCION' => $this->post('DESCRIPCION'),
            'DISPONIBILIDAD' => 2, //0 desactivado 1 activado 2 en pendiente de validacion
            'TELEFONO' => $this->post('TELEFONO'),
            'NOMBRE_RESPONSABLE' => $this->post('NOMBRE_RESPONSABLE'),
            'HORARIO' => $this->post('HORARIO'),
        );
        if (!$datos) {
            $this->response(array('response' => "NULL"), 400);
        }
        $idServicios = $this->Servicios_model->guardar($datos);
        if (!is_null($idServicios)) {
            $this->response(array('response' => $idServicios), 200); // 200 por que la peticion a sido corrrecta
        } else {
            $this->response(array('response' => "Servicio no almacenado"), 404); // 400 por que la peticion a sido incorrrecta
        }
    }

}
