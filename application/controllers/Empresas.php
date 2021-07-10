<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresas extends CI_Controller {

	    
    function __construct() {
        parent::__construct();
        $this->load->model("ModEmpresas");
        $this->load->model("ModUsuarios");
    }

    public function index(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $data['contenido'] = "empresas/index";  // Ruta de la pantalla principal de empresas
            $data['puestos'] = $this->ModUsuarios->selPuesto(); //Envío de los puestos para llenar la lista.
            $data['perfil'] = $this->ModUsuarios->selperfil(); //Envío de los perfiles para llenar el combo
            $this->load->view("plantilla",$data); //Manda a llamar a la vista plantilla con los parametros antes mecionados
        }
    }

    public function ingresar(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $datos = $this->input->post();

            if(isset($datos)){
                $empresa = array(
                    'Nombre'    =>   $datos['empresa_nombre'],
                    'Telefono'  =>   $datos['empresa_telefono'],
                    'Correo'    =>   $datos['empresa_email']
                );

                $ingresa = $this->ModEmpresas->ingresar($empresa);

                if($ingresa){
                    foreach($ingresa as $emp){
                        $IdEmp = $emp->IdEmpresa;
                    }

                    $IdEmpresa = $IdEmp;
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
            
                    $IdEmpresa=trim($IdEmpresa);
                    $Nombre=trim($Nombre);
                    $Paterno=trim($Paterno);
                    $Materno=trim($Materno);
                    $Telefono=trim($Telefono);
                    $Direccion=trim($Direccion);
                    $Email=trim($Email);
                    $Pass=trim($Pass);

                    $agregar = $this->ModUsuarios->AgregarUsuario($IdEmpresa, $Nombre, $Paterno, $Materno,$Telefono,$Direccion,$Puesto,$Usuario,$Email, $Pass, $Rol);
        
                    if($agregar){
                        echo '<script> alert("Empresa agregada satisfactoriamente");</script>';
                        redirect('Empresas/index', 'refresh');
            
                    }
                }else{
                    echo '<scritp> alert("No fue posible agregar la empresa"); </script>';
                    redirect('Empresas', 'refresh');
                }
            }
        }
    }

}