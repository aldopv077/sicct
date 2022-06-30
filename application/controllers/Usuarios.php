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
            $rol = $this->session->userdata('rol');
            $data['contenido'] = "usuarios/index";  // Ruta de la pantalla principal de usuarios
            $data['puestos'] = $this->ModUsuarios->selPuesto(); //Envío de los puestos para llenar la lista.
            $data['perfil'] = $this->ModUsuarios->selperfil(); //Envío de los perfiles para llenar el combo
            if($rol != "SuperAdmin"){
                $this->load->view("plantilla",$data); //Manda a llamar a la vista plantilla con los parametros antes mecionados
            }else{
                /*print_r($data['perfil']);
                exit;*/
                $this->load->view("plantilladmin",$data); //Manda a llamar a la vista plantilla con los parametros antes mecionados 
            }
        }
    }
    
    //Muestra la lista de los usuarios agregados
    public function lista(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $rol = $this->session->userdata('rol');
            $data['contenido'] = "usuarios/lista";
            $data['usuarios'] = $this->ModUsuarios->selUsuarios();
            $data['lUsuarios'] = $this->ModUsuarios->selUsuarios();
            if($rol != "SuperAdmin"){
                $this->load->view("plantilla",$data); //Manda a llamar a la vista plantilla con los parametros antes mecionados
            }else{
                $this->load->view("plantilladmin",$data); //Manda a llamar a la vista plantilla con los parametros antes mecionados 
            } 
        }
    }
    
    //Muestra el formulario para poder modificar algun dato del usuario
    public function modificar($Id=NULL){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            if($Id != NULL){
                $rol = $this->session->userdata('rol');
                $data['contenido'] = "usuarios/modificar";  //Ruta de la pantalla de modificacion de los usuarios
                $data['DatosUsuario'] = $this->ModUsuarios->frmModificar($Id);
                $data['puestos'] = $this->ModUsuarios->selPuesto(); 
                $data['perfil'] = $this->ModUsuarios->selperfil(); 
                if($rol != "SuperAdmin"){
                    $this->load->view("plantilla",$data); //Manda a llamar a la vista plantilla con los parametros antes mecionados
                }else{
                    $this->load->view("plantilladmin",$data); //Manda a llamar a la vista plantilla con los parametros antes mecionados 
                }
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
                $Empresa = $this->session->userdata('Empresa');
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
            
                $Id=trim($Empresa);
                $Nombre=trim($Nombre);
                $Paterno=trim($Paterno);
                $Materno=trim($Materno);
                $Telefono=trim($Telefono);
                $Direccion=trim($Direccion);
                $Email=trim($Email);
                $Pass=trim($Pass);
            }
        
            $agregar = $this->ModUsuarios->AgregarUsuario($Id,$Nombre,$Paterno, $Materno,$Telefono,$Direccion,$Puesto,$Usuario,$Email, $Pass, $Rol);
        
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
    
    
    public function buscar(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $dato = $this->input->post();
            
            if(isset($dato)){
                $datosclie = $dato['txtUsuario'];
                $list = explode(' ', $datosclie);
                foreach($list as $value=>$datosclie){
                    $Id=$list[0];
                    $nombre=$list[1];
                    $paterno=$list[2];
                    $materno=$list[3];
                }
            }
            
            if($Id != NULL){
                
                $rol = $this->session->userdata('rol');
                $data['contenido'] = "usuarios/lista";  // Ruta de la pantalla principal de clientes
                $data['usuarios'] = $this->ModUsuarios->busqueda($Id);
                $data['lUsuarios'] = $this->ModUsuarios->selUsuarios();
                if($rol != "SuperAdmin"){
                    $this->load->view("plantilla",$data); //Manda a llamar a la vista plantilla con los parametros antes mecionados
                }else{
                    $this->load->view("plantilladmin",$data); //Manda a llamar a la vista plantilla con los parametros antes mecionados 
                }            }
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