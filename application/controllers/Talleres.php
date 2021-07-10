<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Talleres extends CI_Controller {
 
    
    function __construct() {
        parent::__construct();
        $this->load->model("ModTalleres");
    }
    
    //Ver la pagina inicial de clientes que sería para agregar clientes
	public function index()
	{
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $data['contenido'] = "talleres/index";  // Ruta de la pantalla principal de clientes
            $this->load->view("plantilla",$data); //Manda a llamar a la vista plantilla con los parametros antes mecionados
        }
	}
    
    public function ingresar(){
       if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
           $datos=$this->input->post();
           if(isset($datos)){
               $IdEmpresa = $this->session->userdata('Empresa');
               $Nombre = $datos['txtNombre'];
               $Paterno = $datos['txtApPaterno'];
               $Materno = $datos['txtApMaterno'];
               $Direccion = $datos['txtDireccion'];
               $Telefono = $datos['txtTelefono'];
           }
           
           $agregar=$this->ModTalleres->ingresar($IdEmpresa, $Nombre, $Paterno, $Materno, $Direccion, $Telefono);
            
               if($agregar){
                echo '<script> alert("Teller agregado satisfactoriamente");</script>';
            
                redirect('Talleres/index', 'refresh');
            
            }   
       } 
    }
    
    
    public function lista(){
       if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
           $data['contenido'] = "talleres/lista";  // Ruta de la pantalla principal de talleres
           $data['taller'] = $this->ModTalleres->lista(); //Busqueda de todos los talleres agregados
           $data['ltaller'] = $this->ModTalleres->lista(); //Busqueda de todos los talleres agregados
           $this->load->view("plantilla",$data); //Manda a llamar a la vista plantilla con los parametros antes mecionados
       }
    }
    
    public function buscar(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $dato = $this->input->post();
            
            if(isset($dato)){
                $datosclie = $dato['txtTaller'];
                $list = explode(' ', $datosclie);
                foreach($list as $value=>$datosclie){
                    $Id=$list[0];
                    $nombre=$list[1];
                    $paterno=$list[2];
                    $materno=$list[3];
                }
            }
            
            if($Id != NULL){
                
                
                $data['contenido'] = "talleres/lista";  // Ruta de la pantalla principal de clientes
                $data['ltaller'] = $this->ModTalleres->lista();
                $data['taller'] = $this->ModTalleres->busqueda($Id);
                $this->load->view("plantilla",$data); //Manda a llamar a la vista plantilla con los parametros antes mecionados
            }
       }
    }
    
    public function modificar($Id){
       if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
           if($Id != NULL){
               
               $data['contenido'] = "talleres/modificar";
               $data['taller'] = $this->ModTalleres->busqueda($Id);
               $this->load->view("plantilla",$data);
           }
       } 
    }
    
    public function update(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $datos = $this->input->post();
            
            
            if(isset($datos)){
               $Id = $datos['txtId'];
               $Nombre = $datos['txtNombre'];
               $Paterno = $datos['txtApPaterno'];
               $Materno = $datos['txtApMaterno'];
               $Direccion = $datos['txtDireccion'];
               $Telefono = $datos['txtTelefono'];
            }
            
            $actualizar = $this->ModTalleres->update($Id,$Nombre, $Paterno, $Materno, $Direccion, $Telefono);
            
            if($actualizar){
                echo '<script> alert("Datos del taller modificados satisfactoriamente");</script>';
            
                redirect('Talleres/lista', 'refresh');
            }
        }
    }
    
    public function eliminar($Id){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            if($Id != NULL){
                $this->ModTalleres->Eliminar($Id);
                redirect('Talleres/lista');
            }    
        }
    }
}