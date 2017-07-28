<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Especialidad CTRL
 *
 * @author Kevin
 */
class Especialidad extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('UnidadSalud_model');
        $this->load->model('Especialidad_model');
        $this->load->model('AreasEspecialidad_model');
    }

    public function index($idUS) {
        $data['title'] = "Formulario Areas Especialidad";
        $data['main'] = 'AreasEspecialidad/frmCrearAEspecialidad';
        $data['lista'] = $this->UnidadSalud_model->getUnidades($this->session->userdata['esta_logeado']['idUsuario']);
        $data['idUS'] = $idUS;
        $this->load->vars($data);
        $this->load->view('include/header');
    }

    public function editar($idUS) {
        $infU = $this->UnidadSalud_model->getUnidad($this->session->userdata['esta_logeado']['idUsuario'], $idUS);
        $infAE = $this->AreasEspecialidad_model->getAreasEspecialidad($infU[0]->IDUNIDADSALUD, $infU[0]->UNICODIGO);
        $infE = array();
        $i = 0;
        foreach ($infAE as $idAE) {
            $infE[$i] = $this->Especialidad_model->getEspecialidades($idAE['IDAREA_ESPECIALIDAD']);
            $i++;
        }
        $data['title'] = "Formulario De Cartera De Servicios";
        $data['main'] = 'AreasEspecialidad/frmEditarAEspecialidad';
        $data['lista'] = $this->UnidadSalud_model->getUnidades($this->session->userdata['esta_logeado']['idUsuario']);
        $data['idUS'] = $idUS;
        $data['infAE'] = $infAE;
        $data['infE'] = $infE;
        $this->load->vars($data);
        $this->load->view('include/header');
    }

    public function guardar($idUS) {
        $infUS = $this->UnidadSalud_model->getUnidad($this->session->userdata['esta_logeado']['idUsuario'], $idUS);
        $datosAE = array(
            'unidad_SaludIDUNIDADSALUD' => $idUS,
            'unidad_SaludUNICODIGO' => $infUS[0]->UNICODIGO,
            'NOMBRE' => strtoupper($this->input->post("Nombre_Servicio"))
        );
        $idAE = $this->AreasEspecialidad_model->guardar($datosAE);
        if ($idAE != NULL) {
            $datosE = array(
                'area_especialidadIDAREA_ESPECIALIDAD' => $idAE,
                'NOMBRE' => strtoupper($this->input->post("Nombre")),
                'DISPONIBILIDAD' => strtoupper($this->input->post("Disponibilidad")),
                'TELEFONO' => $this->input->post("Telefono"),
                'NOMBRE_PROFESIONAL_RESPONSABLE' => strtoupper($this->input->post("Nombre_Profesional_Responsable")),
                'HORARIO_ATENCION' => strtoupper($this->input->post("Horario_Atencion")),
                'DIAS_ATENCION' => strtoupper($this->input->post("Dias_Atencion"))
            );
            $id = $this->Especialidad_model->guardar($datosE);
        }
        if ($id > 0) {
            redirect('unidadSalud/infU/' . $idUS, 'refresh');
        } else {
            $this->index($idUS);
        }
    }

    public function actualizar($idUS) {
        $infUS = $this->UnidadSalud_model->getUnidad($this->session->userdata['esta_logeado']['idUsuario'], $idUS);
        $contador = $this->input->post('contador');
        $k = 0;
        for ($i = 0; $i < $contador; $i++) {
            $idAE = $this->input->post("idAE" . $i);
            $datosAE = array(
                'unidad_SaludIDUNIDADSALUD' => $idUS,
                'unidad_SaludUNICODIGO' => $infUS[0]->UNICODIGO,
                'NOMBRE' => strtoupper($this->input->post("Nombre_Servicio" . $i)),
            );
            $this->AreasEspecialidad_model->update($idAE, $datosAE);
            $lim = $this->input->post('i' . $i);
            for ($j = 0; $j < $lim; $j++) {
                $idE = $this->input->post("idE" . $k);
                $datos = array(
                    'area_especialidadIDAREA_ESPECIALIDAD' => $idAE,
                    'NOMBRE' => strtoupper($this->input->post("Nombre" . $k)),
                    'DISPONIBILIDAD' => strtoupper($this->input->post("Disponibilidad" . $k)),
                    'TELEFONO' => strtoupper($this->input->post("Telefono" . $k)),
                    'NOMBRE_PROFESIONAL_RESPONSABLE' => strtoupper($this->input->post("Nombre_Profesional_Responsable" . $k)),
                    'HORARIO_ATENCION' => strtoupper($this->input->post("Horario_Atencio" . $k)),
                    'DIAS_ATENCION' => strtoupper($this->input->post("Dias_Atencio" . $k)),
                );
                $k++;
                $this->Especialidad_model->actualizar($idE, $datos);
            }
        }

        $this->session->set_flashdata('error', 'Datos Actualizados');
        redirect('especialidad/editar/' . $idUS, 'refresh');
    }

    //Eliminado Logico
    function eliminarL($idUS, $idE) {
        $datosE = array(
            'DISPONIBILIDAD' => 0,
        );
        $this->Especialidad_model->actualizar($idE, $datosE);
        redirect('unidadSalud/infU/' . $idUS, 'refresh');
    }

    function deAlta($idUS, $idE) {
        $datosE = array(
            'DISPONIBILIDAD' => 1,
        );
        $this->Especialidad_model->actualizar($idE, $datosE);
        redirect('unidadSalud/infU/' . $idUS, 'refresh');
    }

    //Eliminado Fisico
    function eliminar($idUS, $idE) {
        $this->Especialidad_model->eliminar($idE);
        redirect('unidadSalud/infU/' . $idUS, 'refresh');
    }

    //Eliminar Area de Especialidad 
    public function eliminarAE($idUS, $idAE) {
        $this->AreasEspecialidad_model->delete($idAE);
        redirect('unidadSalud/infU/' . $idUS, 'refresh');
    }

    //crear Especialidades
    public function crear($idUS, $idAE) {
        $infAE = $this->AreasEspecialidad_model->get_Id($idAE); // obtener la informacion de la US
        $data['title'] = "Formulario Areas Especialidad";
        $data['main'] = 'AreasEspecialidad/frmCrearEspecialidad';
        $data['lista'] = $this->UnidadSalud_model->getUnidades($this->session->userdata['esta_logeado']['idUsuario']);
        $data['idUS'] = $idUS;
        $data['infAE'] = $infAE;
        $this->load->vars($data);
        $this->load->view('include/header');
    }

    public function guardarE($idUS) {
        $infUS = $this->UnidadSalud_model->getUnidad($this->session->userdata['esta_logeado']['idUsuario'], $idUS);
        $idAE = $this->input->post("idAE");
        $datosE = array(
            'area_especialidadIDAREA_ESPECIALIDAD' => $idAE,
            'NOMBRE' => strtoupper($this->input->post("Nombre")),
            'DISPONIBILIDAD' => strtoupper($this->input->post("Disponibilidad")),
            'TELEFONO' => strtoupper($this->input->post("Telefono")),
            'NOMBRE_PROFESIONAL_RESPONSABLE' => strtoupper($this->input->post("Nombre_Profesional_Responsable")),
            'HORARIO_ATENCION' => strtoupper($this->input->post("Horario_Atencion")),
            'DIAS_ATENCION' => strtoupper($this->input->post("Dias_Atencion"))
        );
        $id = $this->Especialidad_model->guardar($datosE);

        if ($id > 0) {
            redirect('unidadSalud/infU/' . $idUS, 'refresh');
        } else {
            $this->index($idUS);
        }
    }

    public function upload() {
        $config["upload_path"] = "./files/";
        $config["allowed_types"] = 'xls';
        $config["max_size"] = '0';
        $idUS = $this->input->post("idUS");
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('file')) {
            $this->session->set_flashdata('error', 'No selecciono un <strong>Archivo correcto</strong>');
            redirect('unidadSalud/infU/' . $idUS, 'refresh');
        } else {
            $data = array('upload_data' => $this->upload->data());
            $this->load->library('PHPExcel');
            $objPHPExcel = PHPExcel_IOFactory::load('./files/' . $data['upload_data']['file_name']);
        }
        unlink($config["upload_path"] . '/' . $data['upload_data']['file_name']);
        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection(); //estamos trayendo la coleccion de filas
        $header = array();
        $arr_data = array();
        foreach ($cell_collection as $cell) {
            # code...
            //aui estamos obteniendo las columnas a,b,c
            $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
            //Aqui obtenemos el numero de filas
            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
            //
            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
            if ($row == 1) {
                $header[$row][$column] = $data_value;
            } else {
                $arr_data[$row][$column] = $data_value;
            }
        }
        $data["title"] = 'Tabla de Información';
        $data['lista'] = $this->UnidadSalud_model->getUnidades($this->session->userdata['esta_logeado']['idUsuario']);
        $data["header"] = $header;
        $data["values"] = $arr_data;
        $data['main'] = 'AreasEspecialidad/frmTablaEspecialidad';
        $data['idUS'] = $idUS;
        $this->load->vars($data);
        $this->load->view('include/header');
    }

    public function guardarEspecialidades() {
        $idUS = $this->input->post("idUS");
        $datosUS = $this->UnidadSalud_model->getNombre($idUS);
        $contador = $this->input->post('contador');
        for ($i = 1; $i <= $contador; $i++) {
            $unicodigo = $datosUS[0]['UNICODIGO'];
            $nombreAE = strtoupper($this->input->post("NOMBRE_AREA_ESPECIALIDAD" . $i));
            $datosAreaEspecialidad = array(
                'unidad_SaludIDUNIDADSALUD' => $idUS,
                'unidad_SaludUNICODIGO' => $unicodigo,
                'NOMBRE' => $nombreAE,
            );
            $datosTemporalesAE = $this->AreasEspecialidad_model->getAreasEspecialidad($idUS, $unicodigo);
            $id=-1;
            if ($datosTemporalesAE != null) {
                foreach ($datosTemporalesAE as $datos) {
                    if ($nombreAE == $datos['NOMBRE']) {
                        $datosEspecialidad = array(
                            'area_especialidadIDAREA_ESPECIALIDAD' => $datos['IDAREA_ESPECIALIDAD'],
                            'NOMBRE' => strtoupper($this->input->post("NOMBRE_ESPECIALIDAD" . $i)),
                            'DISPONIBILIDAD' => 1,
                            'TELEFONO' => strtoupper($this->input->post("TELEFONO" . $i)),
                            'NOMBRE_PROFESIONAL_RESPONSABLE' => strtoupper($this->input->post("NOMBRE_PROFESIONAL_RESPONSABLE" . $i)),
                            'HORARIO_ATENCION' => strtoupper($this->input->post("HORARIO_ATENCION" . $i)),
                            'DIAS_ATENCION' => strtoupper($this->input->post("DIAS_ATENCION" . $i))
                        );
                        $id = $this->Especialidad_model->guardar($datosEspecialidad);
                    }
                }
            }
            if ($id < 0 || $id == NULL) {
                $idAE = $this->AreasEspecialidad_model->guardar($datosAreaEspecialidad);
                if ($idAE != NULL) {
                    $datosEspecialidad = array(
                        'area_especialidadIDAREA_ESPECIALIDAD' => $idAE,
                        'NOMBRE' => strtoupper($this->input->post("NOMBRE_ESPECIALIDAD" . $i)),
                        'DISPONIBILIDAD' => 1,
                        'TELEFONO' => strtoupper($this->input->post("TELEFONO" . $i)),
                        'NOMBRE_PROFESIONAL_RESPONSABLE' => strtoupper($this->input->post("NOMBRE_PROFESIONAL_RESPONSABLE" . $i)),
                        'HORARIO_ATENCION' => strtoupper($this->input->post("HORARIO_ATENCION" . $i)),
                        'DIAS_ATENCION' => strtoupper($this->input->post("DIAS_ATENCION" . $i))
                    );
                    $id = $this->Especialidad_model->guardar($datosEspecialidad);
                }
            }
        }
        redirect('unidadSalud/infU/' . $idUS, 'refresh');
    }

}
