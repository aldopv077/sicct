<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model("ModInicio");
        $this->load->model("ModGrafica");
        $this->load->model("ModSesiones");
    }
	
	public function index()
	{
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $data['contenido'] = "inicio/index";
            $data['user'] = $this->ModInicio->Usuarios();
            $data['client'] = $this->ModInicio->Clientes();
            $data['producto'] = $this->ModInicio->Productos();
            $data['accesorio'] = $this->ModInicio->Accesorios();
            $data['taller'] = $this->ModInicio->Externos();
            
            /*print_r($data['accesorio']);
            exit;*/
            
            $this->load->view('plantilla',$data);
        }
        
	}


    public function indexadmin()
	{
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $data['contenido'] = "inicio/indexadmin";
            $data['user'] = $this->ModInicio->Usuarios();
            $data['empresas'] = $this->ModInicio->Empresas();
            
            $this->load->view('plantilladmin',$data);
        }
        
	}

    public function indexsup()
	{
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{

            $data['contenido'] = "inicio/indexsup";
            $this->load->view('plantillasup',$data);
        }
        
	}

    public function grafica(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login', 'refresh');
        }else{
            
            $Productos = $this->ModGrafica->productos();

            $arrayProd = array();
            $arrayIds = array();
            $arraySesionTerm = array();

            foreach($Productos as $value){
                $arrayProd[] = $value->Clave;
                $arrayIds[] = $value->IdProducto;
            }

            for($x=0; $x < count($arrayIds); $x++){
                $sesiones = $this->ModSesiones->SesionesTerminadas($arrayIds[$x]);
                if($sesiones == 0){
                    $arraySesion[] = 0;
                }else{
                    foreach($sesiones as $val){
                        $arraySesionTerm[] = $val->Estado;
                    }
                }
                
            }
            $data['productos'] = $Productos;
            $data['sesiones'] = $arraySesionTerm;

            echo json_encode($data);
        }
    }

    /*public function misrutas(){
        if (isset($_SERVER['HTTP_ORIGIN'])) {

            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Allow-Max-Age: 86400');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']));
            header('Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS');
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']));
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
            exit(0);
        }

        $method = $_SERVER['REQUEST_METHOD'];
        
        
		if($method != 'POST'){
            $error = array([
                'status' => false,
                'messaje' => 'Bad request',
            ], 400);

			//json_output(400,array('status' => 400,'message' => 'Bad request.'));
            echo json_encode($error);
		} else{
             $Productos = $this->ModGrafica->productos();

            $arrayProd = array();
            $arrayIds = array();
            $arraySesionTerm = array();

            foreach($Productos as $value){
                $arrayProd[] = $value->Clave;
                $arrayIds[] = $value->IdProducto;
            }

            for($x=0; $x < count($arrayIds); $x++){
                $sesiones = $this->ModSesiones->SesionesTerminadas($arrayIds[$x]);
                if($sesiones == 0){
                    $arraySesion[] = 0;
                }else{
                    foreach($sesiones as $val){
                        $arraySesionTerm[] = $val->Estado;
                    }
                }
                
            }
            $data['productos'] = $Productos;
            $data['sesiones'] = $arraySesionTerm;

            echo json_encode($data);
            
           //echo json_encode(array('success'=>true, 'result' => $Rutas));

        }
    }*/
    
    public function fuentes(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $this->load->view('fuentes');
        }
    }
}
