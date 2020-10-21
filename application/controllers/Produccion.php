<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produccion extends CI_Controller {
     
    function __construct() {
        parent::__construct();
        $this->load->model("ModProductos");
        $this->load->model("ModClientes");
    }
    
    //Ver la pagina inicial de productos que sería para agregar producto
	public function index()
	{
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $data['contenido'] = "producto/lista"; 
            $data['productos'] = $this->ModProductos->lista();
            $this->load->view("plantilla",$data);
        }
	}
}