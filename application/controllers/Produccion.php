<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produccion extends CI_Controller {
     
    function __construct() {
        parent::__construct();
        $this->load->model("ModProductos");
        $this->load->model("ModClientes");
        $this->load->model("ModSesiones");
    }
    
    //Ver la pagina inicial de productos que sería para agregar producto
	public function index()
	{
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $data['contenido'] = "producto/lista"; 
            $data['productos'] = $this->ModProductos->lista();
            $data['controller'] = $this;
            $this->load->view("plantilla",$data);
        }
	}

    //Selecciona las secciones terminadas del corte
    public function seccTerm ($IdProd){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $SesionesTerm = $this->ModSesiones->SesionesTerminadas($IdProd);
            
            foreach($SesionesTerm as $secc){
                echo $secc->Estado;
            }
        }
    }

    //Diferencia de Secciones entregadas y Secciones faltantes
    public function seccFalt ($IdProd){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $SesionesTerm = $this->ModSesiones->SesionesFaltantes($IdProd);
            
            foreach($SesionesTerm as $secc){
                echo $secc->Estado;
            }
        }
    }
}