<?php

/**
 * Description of Contribuidor_model
 *
 * @author Kevin
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class UnidadSalud_SW extends REST_Controller {

    public function __construct() {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
        parent::__construct();
        $this->load->model('UnidadSalud_model');
    }

    public function index_get() {
        $datos = $this->UnidadSalud_model->get();
        if (!is_null($datos)) {
            $this->response(array('response' => $datos), 200); // 200 por que la peticion a sido corrrecta
        } else {
            $this->response(array('response' => "No hay Unidades de Salud"), 404); // 400 por que la peticion a sido incorrrecta
        }
    }

    public function find_get($id) {
        if (!$id) {
            $this->response(NULL, 400);
        }
        $datos = $this->UnidadSalud_model->get($id);
        if (!is_null($datos)) {
            $this->response(array('response' => $datos), 200); // 200 por que la peticion a sido corrrecta
        } else {
            $this->response(array('response' => "No existe la Unidades de Salud"), 404); // 400 por que la peticion a sido incorrrecta
        }
    }

    public function lucro_get($id) {
        $datos = $this->UnidadSalud_model->get();
        if ($id == 1) {//Unidades de Salus Publicas
            if (!is_null($datos)) {
                $response = array();
                $i = 0;
                foreach ($datos as $datosUS) {
                    if ($datosUS->LUCRO == 'NO DEFINIDO' || $datosUS->LUCRO == 'SIN FINES DE LUCRO') {
                        $response[$i] = $datosUS;
                        $i++;
                    }
                }
                $this->response(array('response' => $response), 200); // 200 por que la peticion a sido corrrecta
            } else {
                $this->response(array('response' => "No hay Unidades de Salud"), 404); // 400 por que la peticion a sido incorrrecta
            }
        } else {
            if ($id == 2) {
                $this->index_get();
            } else {
                if ($id == 3) {//Unidades de Salud PRIVADAS
                    if (!is_null($datos)) {
                        $response = array();
                        $i = 0;
                        foreach ($datos as $datosUS) {
                            if ($datosUS->LUCRO == 'CON FINES DE LUCRO') {
                                $response[$i] = $datosUS;
                                $i++;
                            }
                        }
                        $this->response(array('response' => $response), 200); // 200 por que la peticion a sido corrrecta
                    } else {
                        $this->response(array('response' => "No hay Unidades de Salud"), 404); // 400 por que la peticion a sido incorrrecta
                    }
                }
            }
        }
    }

    public function disponibilidad_get() {
        $datos = $this->UnidadSalud_model->getInactivas();
        $response = array();
        $i = 0;
        if (!is_null($datos)) {
            foreach ($datos as $dataS) {
                if ($dataS->ESTADO == 0) {
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

}
