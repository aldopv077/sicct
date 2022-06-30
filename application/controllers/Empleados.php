<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleados extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("ModEmpleados");
    }

    public function index(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{        
            $data['contenido'] = 'empleados/index';
            $data['operaciones'] = $this->ModEmpleados->listaOperaciones();
            $this->load->view('plantilla', $data);
        }
    }

    public function ingresar(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $datos = $this->input->post();

            if(isset($datos)){
                $empleados = array(
                    'IdEmpresa' => $this->session->userdata('Empresa'),
                    'IdOperacion' => $datos['cmbPuesto'],
                    'Nombre' => $datos['txtNombre'],
                    'Paterno' => $datos['txtPaterno'],
                    'Materno' => $datos['txtMaterno'],
                    'Telefono' => $datos['txtTelefono'],
                    'Direccion' => $datos['txtDireccion'],
                    'Activo' => '1'
                );

                $ingresar = $this->ModEmpleados->ingresar($empleados);

                if($ingresar){
                    echo '<script> alert("Empleado registrado"); </script>';
                    redirect('Empleados/index', 'refresh');
                }else{
                    echo '<script> alert("No fue posible registrar el empleado"); </script>';
                    redirect('Empleados/index', 'refresh');
                }
            }
        }
    }

    public function lista(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $data['contenido'] = 'empleados/lista';
            $data['operaciones'] = $this->ModEmpleados->listaOperaciones();
            $data['empleados'] = $this->ModEmpleados->lista($this->session->userdata('Empresa'));
            $this->load->view('plantilla', $data);
        }
    }

    public function buscar(){
        if($this->session->userdata('is_loguer_in' == FALSE)){
            redirect('login', 'refresh');
        }else{
            $datos = $this->input->post();

            if(isset($datos)){
                $empleado = $datos['txtEmpleados'];
                $operacion = $datos['txtOperaciones'];

                if($empleado == null && $operacion != null){
                    
                    $list = explode(' ', $operacion);
                    foreach($list as $value=>$operacion){
                        $Id=$list[0];
                    }
                    
                    $empleados = $this->ModEmpleados->buscarOperacion($Id, $this->session->userdata('Empresa'));

                }elseif($empleado != null && $operacion == null){
                    $list = explode(' ', $empleado);
                    foreach($list as $value=>$empleado){
                        $Id=$list[0];
                    }

                    $empleados = $this->ModEmpleados->buscarEmpleado($Id, $this->session->userdata('Empresa'));

                }elseif($empleado == null && $operacion == null){
                    $empleados = $this->ModEmpleados->lista($this->session->userdata('Empresa'));
                }

                $data['contenido'] = 'empleados/lista';
                $data['operaciones'] = $this->ModEmpleados->listaOperaciones();
                $data['empleados'] = $empleados;

                $this->load->view('plantilla', $data);
            }else{
                echo '<script>alert("Debe elegir alguna opción de busqueda")</script>';
                redirect('Empleados/lista','refresh');
            }
        }

    }

    public function modificar($Id){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $data['contenido'] = 'empleados/modificar';
            $data['empleado'] = $this->ModEmpleados->buscarEmpleado($Id, $this->session->userdata('Empresa'));
            $data['operaciones'] = $this->ModEmpleados->listaOperaciones();

            $this->load->view('plantilla', $data);
        }
    }

    public function actualizar(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $datos = $this->input->post();

            if(isset($datos)){
                $Id = $datos['txtEmpleado'];
                $empleados = array(
                    'IdEmpresa' => $this->session->userdata('Empresa'),
                    'IdOperacion' => $datos['cmbPuesto'],
                    'Nombre' => $datos['txtNombre'],
                    'Paterno' => $datos['txtPaterno'],
                    'Materno' => $datos['txtMaterno'],
                    'Telefono' => $datos['txtTelefono'],
                    'Direccion' => $datos['txtDireccion']
                );

                $act = $this->ModEmpleados->actualizar($Id, $empleados);

                if($act){
                    echo '<script> alert("Datos actualizados"); </script>';
                    redirect('Empleados/lista', 'refresh');
                }else{
                    echo '<script> alert("No fue posible actualizar el empleado"); </script>';
                    redirect('Empleados/lista', 'refresh');
                }
            }
        }
    }

    public function eliminar($Id){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $empleado = array('Activo' => 0);
            $eliminar = $this->ModEmpleados->actualizar($Id, $empleado);

            if($eliminar){
                redirect('Empleados/lista', 'refresh');
            }
        }
    }
}