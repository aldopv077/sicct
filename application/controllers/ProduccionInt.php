<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProduccionInt extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("ModEmpleados");
        $this->load->model("ModProduccionInt");

    }

    public function index(){
        if($this->session->userdata('is_loguer_in' == FALSE)){
            redirect('login', 'refresh');
        }else{
        
            $cortes = $this->ModProduccionInt->listaCortes();

            $data['contenido'] = 'produccionint/index';
            $data['operaciones'] = $this->ModEmpleados->listaOperaciones();
            $data['cortes'] = $cortes;
            

            $this->load->view('plantilla', $data);
        }
    }

    public function buscar(){
        if($this->session->userdata('is_loguer_in' == FALSE)){
            redirect('login', 'refresh');
        }else{
            $datos = $this->input->post();

            if(isset($datos)){
                $operacion = $datos['txtOperaciones'];
                $producto = $datos['txtProducto'];

                if($operacion != null){
                    
                    $list = explode(' ', $operacion);
                    foreach($list as $value=>$operacion){
                        $Id=$list[0];
                    }

                    $list = explode(' ', $producto);
                    foreach($list as $value=>$producto){
                        $IdProd=$list[0];
                    }
                    
                    $empleados = $this->ModEmpleados->buscarOperacion($Id, $this->session->userdata('Empresa'));

                }else{
                    echo '<script>alert("Debe elegir alguna opción de busqueda")</script>';
                    redirect('ProdInterna/index','refresh');
                }


                $data['contenido'] = 'produccionint/index';
                $data['operaciones'] = $this->ModEmpleados->listaOperaciones();
                $data['cortes'] = $this->ModProduccionInt->listaCortes();
                $data['sesiones'] = $this->ModProduccionInt->listaSesiones($IdProd);
                $data['empleados'] = $empleados;
                $data['producto'] = $IdProd;
                $data['operacion'] = $Id;

                $this->load->view('plantilla', $data);
            }else{
                echo '<script>alert("Debe elegir alguna opción de busqueda")</script>';
                redirect('ProdInterna/index','refresh');
            }
        }
    }

    public function avance(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $IdEmpleado = $_POST['txtIdEmpleado'];
            $Cantidad = $_POST['txtCantidad'];
            $IdProducto = $_POST['txtProducto'];
            $Sesion = $_POST['cmbSesiones'];
            $Operacion = $_POST['txtOperacion'];

            $cant = 0;

            for($x= 0; $x < sizeof($Cantidad); $x++){
                date_default_timezone_set('America/Mexico_City');
                $datos = $this->input->post();
                $fecha = date("Y-m-d");
                $hora = date("h:i:s a",  time());

                $avance = array(
                    'IdOperacion' => $Operacion,
                    'IdEmpleado' => $IdEmpleado[$x],
                    'IdProducto' => $IdProducto,
                    'IdSesion' => $Sesion,
                    'Cantidad' => $Cantidad[$x],
                    'Fecha' => $fecha,
                    'Hora' => $hora
                );

                $ing = $this->ModProduccionInt->avance($avance);

                //$cant = $cant + $Cantidad[$x];
            }

            
            if($ing){
                echo '<script> alert("Se han registrado los avances de los empleados") </script>';
                redirect('ProduccionInt/index');
            }
        }
    }

    public function lista(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login', 'refresh');
        }else{
            $cortes = $this->ModProduccionInt->listaCortes();

            $data['contenido'] = 'produccionint/lista';
            $data['operaciones'] = $this->ModEmpleados->listaOperaciones();
            $data['cortes'] = $cortes;
            

            $this->load->view('plantilla', $data);
        }
    }

    public function consulta(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login', 'refresh');
        }else{
            $datos = $this->input->post();
            if(isset($datos)){
                $operacion = $datos['txtOperaciones'];
                $producto = $datos['txtProducto'];

                if($operacion != null){
                    
                    $list = explode(' ', $operacion);
                    foreach($list as $value=>$operacion){
                        $Id=$list[0];
                    }

                    $list = explode(' ', $producto);
                    foreach($list as $value=>$producto){
                        $IdProd=$list[0];
                    }
                    
                    $empleados = $this->ModProduccionInt->lista($Id, $IdProd);

                }else{
                    echo '<script>alert("Debe elegir alguna opción de busqueda")</script>';
                    redirect('ProduccionInterna/lista','refresh');
                }


                $data['contenido'] = 'produccionint/lista';
                $data['operaciones'] = $this->ModEmpleados->listaOperaciones();
                $data['cortes'] = $this->ModProduccionInt->listaCortes();
                $data['sesiones'] = $this->ModProduccionInt->listaSesiones($IdProd);
                $data['empleados'] = $empleados;
                $data['producto'] = $IdProd;

                $this->load->view('plantilla', $data);
            }else{
                echo '<script>alert("Debe elegir alguna opción de busqueda")</script>';
                redirect('ProduccionInterna/lista','refresh');
            }
        }
    }
}