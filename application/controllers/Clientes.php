<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

	    
    function __construct() {
        parent::__construct();
        $this->load->model("ModClientes");
    }
    
    //Ver la pagina inicial de clientes que sería para agregar clientes
	public function index()
	{
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $data['contenido'] = "clientes/index";  // Ruta de la pantalla principal de clientes
            $this->load->view("plantilla",$data); //Manda a llamar a la vista plantilla con los parametros antes mecionados
        }
	}
    
    //Muestra la lista de los clientes agregados y puede buscar por nombre del cliente
    public function lista(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('Login/index','refresh');
        }else{
            $data['contenido'] = "clientes/lista"; 
            $data['clientes'] = $this->ModClientes->lista();
            $data['lcliente'] = $this->ModClientes->lista();
            $this->load->view("plantilla",$data); 
        }
    }
    
    //Muestra el formulario para poder modificar algun dato del cliente
    public function modificar($Id = NULL){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            
            if($Id != NULL){
                $data['contenido'] = "clientes/modificar"; 
                $data['clientes'] = $this->ModClientes->listamod($Id);
                $this->load->view("plantilla",$data); 
            }else{
                redirect('Clientes/index','refresh');
            }
        }
    }
    
    //Envía los datos del formulario al modelo para su inserción a la BD
    public function ingresar(){
         if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
             $datos=$this->input->post();
        
            if(isset($datos)){
                $Nombre = $datos['txtNombre'];
                $RFC = $datos['txtRFC'];
                $Telefono = $datos['txtTelefono'];
                $Direccion = $datos['txtDireccion'];
                $Email = $datos['txtEmail'];
                $Contacto = $datos['txtNombreContacto'];
                $TelContacto = $datos['txtTelefonoContacto'];
            
                $Nombre=trim($Nombre);
                $RFC=trim($RFC);
                $Telefono=trim($Telefono);
                $Direccion=trim($Direccion);
                $Email=trim($Email);
                $Contacto=trim($Contacto);
                $TelContacto=trim($TelContacto);
            }
             
            /*echo $Nombre.' ';
            echo $RFC.' ';
            echo $Telefono.' ';
            echo $Email.' ';
            echo $Direccion.' ';
            echo $Contacto.' ';
            echo $TelContacto.' ';
             exit;*/
             
            $agregar=$this->ModClientes->ingresar($Nombre, $RFC, $Telefono, $Direccion, $Email, $Contacto, $TelContacto);
            
            if($agregar){
                echo '<script> alert("Cliente agregado satisfactoriamente");</script>';
            
                redirect('Clientes/index', 'refresh');
            }
        }
    }
    
    //envía los datos al modelo para su modificación en la BD
    public function update(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
             $datos=$this->input->post();
        
            if(isset($datos)){
                $Id = $datos['txtIdCliente'];
                $Nombre = $datos['txtNombre'];
                $RFC = $datos['txtRFC'];
                $Telefono = $datos['txtTelefono'];
                $Direccion = $datos['txtDireccion'];
                $Email = $datos['txtEmail'];
                $Contacto = $datos['txtNombreContacto'];
                $TelContacto = $datos['txtTelefonoContacto'];
                
                $Id=trim($Id);
                $Nombre=trim($Nombre);
                $RFC=trim($RFC);
                $Telefono=trim($Telefono);
                $Direccion=trim($Direccion);
                $Email=trim($Email);
                $Contacto=trim($Contacto);
                $TelContacto=trim($TelContacto);
            }
             
            /*echo $Nombre.' ';
            echo $RFC.' ';
            echo $Telefono.' ';
            echo $Email.' ';
            echo $Direccion.' ';
            echo $Contacto.' ';
            echo $TelContacto.' ';
             exit;*/
             
            $agregar=$this->ModClientes->update($Id, $Nombre, $RFC, $Telefono, $Direccion, $Email, $Contacto, $TelContacto);
            
            if($agregar){
                echo '<script> alert("Los datos se han modificado satisfactoriamente");</script>';
            
                redirect('Clientes/lista', 'refresh');
            }
        }
    }
    
    //Elimina el cliente seleccionado
    public function eliminar($Id = NULL){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            if($Id != NULL){
                $this->ModClientes->Eliminar($Id);
                redirect('Clientes/lista');
            }
        }
    }
    
    //Busqueda del cliente seleccionado
    public function busqueda(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $dato = $this->input->post();
            
            if(isset($dato)){
                $datosclie = $dato['txtCliente'];
                $list = explode(' ', $datosclie);
                foreach($list as $value=>$datosclie){
                    $Id=$list[0];
                    $nombre=$list[1];
                }
            }
            
            if($Id != NULL){
                
                
                $data['contenido'] = "clientes/lista";  // Ruta de la pantalla principal de clientes
                $data['lcliente'] = $this->ModClientes->lista();
                $data['clientes'] = $this->ModClientes->busqueda($Id);
                $this->load->view("plantilla",$data); //Manda a llamar a la vista plantilla con los parametros antes mecionados
            }
       }
    }
}
