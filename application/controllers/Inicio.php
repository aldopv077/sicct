<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model("ModInicio");
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
    
    public function fuentes(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $this->load->view('fuentes');
        }
    }
}
