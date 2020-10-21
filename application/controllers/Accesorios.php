<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accesorios extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model("ModAccesorios");
    }
    
    public function index(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $data['contenido'] = 'accesorios/index';
            $this->load->view('plantilla',$data);
        }
    }
    
    //Hace la petición para buscar los accesorios agregados en la BD
    public function lista(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $data['contenido'] = 'accesorios/lista';
            $data['lista'] =$this->ModAccesorios->lista();
            $this->load->view('plantilla',$data);
        }
    } 
    
    //Recoje los datos del formulario para agregarlos en la BD
    public function ingresar(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $datos=$this->input->post();
        
            if(isset($datos)){
                $Accesorio = $datos['txtAccesorio'];
                $Medida = $datos['txtMedida'];
            
                $Accesorio=trim($Accesorio);
                $Medida=trim($Medida);
               
            }
        
            $agregar = $this->ModAccesorios->ingresar($Accesorio,$Medida);
        
            if($agregar){
                echo '<script> alert("Accesorio agregado satisfactoriamente");</script>';
            
                redirect('Accesorios/index', 'refresh');
            
            }
        }
    }
    
    //Busca los datos del acceseorio seleccionado para su modificación de datos
    public function modificar($Id = NULL){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            if($Id != NULL){
                $data['contenido'] = 'accesorios/modificar';
                $data['accesorio'] = $this->ModAccesorios->modificar($Id);
                $this->load->view('plantilla',$data);
            }
        }
    }
    
    //Recoje los datos del formulario para modicarlos en la bd
    public function update(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $datos=$this->input->post();
        
            if(isset($datos)){
                $Id = $datos['txtIdAccesorio'];
                $Accesorio = $datos['txtAccesorio'];
                $Medida = $datos['txtMedida'];
            
                $Id=trim($Id);
                $Accesorio=trim($Accesorio);
                $Medida=trim($Medida);
               
            }
        
            $agregar = $this->ModAccesorios->update($Id,$Accesorio,$Medida);
        
            if($agregar){
                echo '<script> alert("Accesorio modificado satisfactoriamente");</script>';
            
                redirect('Accesorios/lista', 'refresh');
            
            }
        }
    }
    
    //Elimina el accesorio seleccionado
    public function eliminar($Id = NULL){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            if ($Id != NULL){
                $eliminar = $this->ModAccesorios->eliminar($Id);
                
                if($eliminar){
                    echo '<script> alert("Accesorio eliminado satisfactoriamente");</script>';
            
                redirect('Accesorios/lista', 'refresh');
                }
            }
        }
    }
}