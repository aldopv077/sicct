<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model("ModUsuarios");
    }

    
    //Muestra la pagina inicial de usuarios que sería para agregar usuarios
    public function index(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $data['contenido'] = "usuarios/index";  // Ruta de la pantalla principal de usuarios
            $data['puestos'] = $this->ModUsuarios->selPuesto(); //Envío de los puestos para llenar la lista.
            $data['perfil'] = $this->ModUsuarios->selperfil(); //Envío de los perfiles para llenar el combo
            $this->load->view("plantilla",$data); //Manda a llamar a la vista plantilla con los parametros antes mecionados
        }
    }
    
    //Muestra la lista de los usuarios agregados
    public function lista(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $data['contenido'] = "usuarios/lista";
            $data['usuarios'] = $this->ModUsuarios->selUsuarios();
        
            $this->load->view("plantilla",$data); 
        }
    }
    
    //Muestra el formulario para poder modificar algun dato del usuario
    public function modificar($Id=NULL){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            if($Id != NULL){
                $data['contenido'] = "usuarios/modificar";  //Ruta de la pantalla de modificacion de los usuarios
                $data['DatosUsuario'] = $this->ModUsuarios->frmModificar($Id);
                $data['puestos'] = $this->ModUsuarios->selPuesto(); 
                $data['perfil'] = $this->ModUsuarios->selperfil(); 
                $this->load->view("plantilla",$data); 
            }else{
                redirect('Usuarios/index','refresh');
            }
        }
    }
    
    //Obtiene los datos del formulario y los envía al Modelo para ingresarlos a la BD
    public function ingresar(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $datos=$this->input->post();
        
            if(isset($datos)){
                $Nombre = $datos['txtNombre'];
                $Paterno = $datos['txtPaterno'];
                $Materno = $datos['txtMaterno'];
                $Telefono = $datos['txtTelefono'];
                $Direccion = $datos['txtDireccion'];
                $Puesto = $datos['cmbPuesto'];
                $Usuario = $datos['txtUsuario'];
                $Email = $datos['txtEmail'];
                $Pass = $datos['txtpass1'];
                $Pass2 = $datos['txtpass2'];
                $Rol = $datos['cmbRol'];
            
                $Id=trim($Id);
                $Nombre=trim($Nombre);
                $Paterno=trim($Paterno);
                $Materno=trim($Materno);
                $Telefono=trim($Telefono);
                $Direccion=trim($Direccion);
                $Email=trim($Email);
                $Pass=trim($Pass);
            }
        
            $agregar = $this->ModUsuarios->AgregarUsuario($Nombre,$Paterno, $Materno,$Telefono,$Direccion,$Puesto,$Usuario,$Email, $Pass, $Rol);
        
            if($agregar){
                echo '<script> alert("Usuario agregado satisfactoriamente");</script>';
            
                redirect('Usuarios/index', 'refresh');
            
            }
        }
                 
    }
    
    //Obtiene los datos del formulario y los envía al modelo para modificarlos en la BD
    public function update(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $datos=$this->input->post();
        
            if(isset($datos)){
                $Id = $datos['txtIdUsuario'];
                $Nombre = $datos['txtNombre'];
                $Paterno = $datos['txtPaterno'];
                $Materno = $datos['txtMaterno'];
                $Telefono = $datos['txtTelefono'];
                $Direccion = $datos['txtDireccion'];
                $Puesto = $datos['cmbPuesto'];
                $Email = $datos['txtEmail'];
                $Pass = $datos['txtpass1'];
                $Pass2 = $datos['txtpass2'];
                $Rol = $datos['cmbRol'];
            
            
                $Id=trim($Id);
                $Nombre=trim($Nombre);
                $Paterno=trim($Paterno);
                $Materno=trim($Materno);
                $Telefono=trim($Telefono);
                $Direccion=trim($Direccion);
                $Email=trim($Email);
                $Pass=trim($Pass);
            }
        
            $agregar = $this->ModUsuarios->Update($Id, $Nombre,$Paterno, $Materno,$Telefono,$Direccion,$Puesto,$Email, $Pass, $Rol);
        
            if($agregar){
                echo '<script> alert("Usuario modificó satisfactoriamente");</script>';
            
                redirect('Usuarios/lista', 'refresh');
            
            }
        }
    }
    
    public function eliminar($Id = NULL){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            if($Id != NULL){
                $this->ModUsuarios->Eliminar($Id);
                redirect('Usuarios/lista');
            }
        }
    }


}