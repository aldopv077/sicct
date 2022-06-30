<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('ModLogin');
        $this->load->model('ModInicio');
    }
    
    public function index(){
        $this->load->view('login');
    }
    
    public function login(){
        if($this->input->post('btnEnviar')){
        
            $datos = $this->input->post();
        
            if(isset($datos)){
                $Usuario = $datos['txtUsuario'];
                $Pass = $datos['txtPass'];
                
                
                $datuser = $this->ModLogin->very_session($Usuario, $Pass);

                if($datuser == true){
                //Se reciben los datos de la consulta y se asignan en un array, para así poder usarlos posteriormente
                
                    $data = array(
                        'is_logued_in' =>       TRUE,
                        'Id'           =>       $datuser->IdUsuario,
                        'nombre'	   =>		$datuser->Nombre,
                        'paterno'      =>       $datuser->ApPaterno,
                        'materno'      =>       $datuser->ApMaterno,
	                    'perfil'	   =>		$datuser->IdRol,
	                    'username' 	   => 		$datuser->Usuario,
                        'puesto'       =>       $datuser->IdPuesto,
                        'pueston'      =>       $datuser->Puesto,
                        'rol'          =>       $datuser->Rol,
                        'Empresa'      =>       $datuser->Empresa,
                        'NombreEmp'    =>       $datuser->EmpresaNom
                    );

                    $this->session->set_userdata($data); // Se crea la sesión
                    $this->very_session();
                
                }else{
                    echo '<script> alert("Usuario o contraseña incorrectos");</script>';
                    redirect('Usuarios/index', 'refresh');
                }
                
            }else{
                $data=array('mensaje' => 'El Usuario o la contraseña son INCORRECTOS');
                $this->load->view('login',data);
            }
        }else{
            redirect('login');
        }
    }
    
    public function very_session(){
        
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $Rol = $this->session->userdata('rol');
            
            switch($Rol){
                case "SuperAdmin":
                    $data['contenido'] ="Inicio/indexadmin";
                    $data['user'] = $this->ModInicio->Usuarios();
                    $data['empresas'] = $this->ModInicio->Empresas();
                    $this->load->view('plantilladmin',$data);
                break;
                case "Supervisor General":
                    $data['contenido'] ="Inicio/indexsup";
                    $this->load->view('plantillasup',$data);
                break;
                default:
                    $data['contenido'] ="Inicio/index";
                    $data['user'] = $this->ModInicio->Usuarios();
                    $data['client'] = $this->ModInicio->Clientes();
                    $data['producto'] = $this->ModInicio->Productos();
                    $data['accesorio'] = $this->ModInicio->Accesorios();
                    $data['taller'] = $this->ModInicio->Externos();
                    $this->load->view('plantilla',$data);
                break;

            }

            
           /* if($Rol == "SuperAdmin"){
                $data['contenido'] ="Inicio/indexadmin";
                $data['user'] = $this->ModInicio->Usuarios();
                $data['empresas'] = $this->ModInicio->Empresas();
                $this->load->view('plantilladmin',$data);
            }else{
                $data['contenido'] ="Inicio/index";
                $data['user'] = $this->ModInicio->Usuarios();
                $data['client'] = $this->ModInicio->Clientes();
                $data['producto'] = $this->ModInicio->Productos();
                $data['accesorio'] = $this->ModInicio->Accesorios();
                $data['taller'] = $this->ModInicio->Externos();
                $this->load->view('plantilla',$data);
            }*/
            
        }
    }
    
    public function cerrar_sesion(){
        $this->session->sess_destroy();//se cierra la sesión
        redirect('login','refresh');
    }
}