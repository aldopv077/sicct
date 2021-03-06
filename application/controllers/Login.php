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
                        'pueston'      =>       $datuser->Puesto
                    );
                    
                    //echo $data['Id'].' ';
                    //echo $data['nombre'].' ';
                    //echo $data['paterno'].' ';
                    //echo $data['materno'].' ';
                    //echo $data['perfil'].' ';
                    //echo $data['username'].' ';
                    //echo $data['puesto'].' ';
                    //echo $data['pueston'];

                    //exit;

                    $this->session->set_userdata($data); // Se crea la sesión
                
                    $data['contenido'] ="Inicio/index";
                    $data['user'] = $this->ModInicio->Usuarios();
                    $data['client'] = $this->ModInicio->Clientes();
                    $data['producto'] = $this->ModInicio->Productos();
                    $data['accesorio'] = $this->ModInicio->Accesorios();
                    $data['taller'] = $this->ModInicio->Externos();
                    $this->load->view('plantilla',$data);
                
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
    
    public function cerrar_sesion(){
        $this->session->sess_destroy();//se cierra la sesión
        redirect('login','refresh');
    }
}