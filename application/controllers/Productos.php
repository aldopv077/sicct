<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {
     
    function __construct() {
        parent::__construct();
        $this->load->model("ModProductos");
        $this->load->model("ModClientes");
        $this->load->model("ModSesiones");
        $this->load->model("ModInicio");
    }
    
    //Ver la pagina inicial de productos que sería para agregar producto
	public function index()
	{
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $data['contenido'] = "producto/index";  // Ruta de la pantalla principal de productos
            $data['clientes'] = $this->ModClientes->lista(); //Lista de clientes
            $data['estados'] = $this->ModProductos->listaestados(); //Lista de los departamentos de la fabrica
            $data['tproducto'] = $this->ModProductos->tproductos(); //Lista de los tipos de productos
            $this->load->view("plantilla",$data); //Manda a llamar a la vista plantilla con los parametros antes mecionados
        }
	}
    
    //Muestra la lista de los productos agregados y puede buscar por nombre clave del producto
    public function lista(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $data['contenido'] = "producto/lista"; 
            $data['controller'] = $this;
            $data['productos'] = $this->ModProductos->lista();;
           
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
    
    //Muestra el formulario para poder modificar algun dato del producto
    public function modificar($Id=NULL){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            if($Id!=NULL){
                $data['contenido'] = "producto/modificar"; 
                $data['clientes'] = $this->ModClientes->lista(); //Lista de clientes
                $data['estados'] = $this->ModProductos->listaestados(); //Lista de los departamentos de la fabrica
                $data['tproducto'] = $this->ModProductos->tproductos(); //Lista de los tipos de productos
                $data['producto'] = $this->ModProductos->producto($Id);//Datos del producto seleccionado a moduficar
                $this->load->view("plantilla",$data); 
            }else{
                redirect('producto/index','refresch');
            }
        }
    }
    
    //Agregar los datos generales del producto
    public function ingresar(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $datos=$this->input->post();
            
            if(isset($datos)){
                $Clave = $datos['txtClave'];
                $IdEmpresa = $this->session->userdata('Empresa');
                $Cliente = $datos['cmbCliente'];
                $TProducto = $datos['cmbTProducto'];
                $Estado = $datos['cmbEstado'];
                $Piezas = $datos['txtTPiezas'];
                $Sesiones = $datos['txtSesiones'];
                $Ingreso = $datos['dtIngreso'];
                $Entrega = $datos['dtEntrega'];
                $Clasificacion = $datos['cmbPara'];
            }
             $agregar=$this->ModProductos->ingresar($Clave, $IdEmpresa, $Cliente, $TProducto, $Estado, $Piezas, $Sesiones, $Ingreso, $Entrega, $Clasificacion);
            
            if($agregar){
                $Ide = $this->ModProductos->lastId();
                foreach($Ide as $value){
                    $Id=$value->IdProducto;
                    
                }
                
                echo '<script> alert("Producto agregado satisfactoriamente");</script>';
                
                $this->session->set_flashdata('IdProducto', $Id);
                $this->session->set_flashdata('Clasificacion', $Clasificacion);
                redirect('Sesiones/index');
            }
        }
    }
    
     //Actualiza los datos modificados en el formulario 
    public function update(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
        
                $datos=$this->input->post();
            
                if(isset($datos)){
                    $Id = $datos['txtIdCorte'];
                    $Cliente = $datos['cmbCliente'];
                    $TProducto = $datos['cmbTProducto'];
                    $Estado = $datos['cmbEstado'];
                    $Piezas = $datos['txtTPiezas'];
                    $Sesiones = $datos['txtSesiones'];
                    $Ingreso = $datos['dtIngreso'];
                    $Entrega = $datos['dtEntrega'];
                    $Clasificacion = $datos['cmbPara'];
                }
                $agregar=$this->ModProductos->update($Id, $Cliente, $TProducto, $Estado, $Piezas, $Sesiones, $Ingreso, $Entrega, $Clasificacion);
            
                if($agregar){
                    
                    
                    echo '<script> alert("Producto actualizado satisfactoriamente");</script>';
            
                    $this->session->set_flashdata('IdProducto', $Id);
                    $this->session->set_flashdata('Clasificacion', $Clasificacion);
                    
                    redirect('Sesiones/index');
                    //redirect('Productos/lista', 'refresh');
                }
            
        }
    }
    
    public function redireccion($Id){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $Prod = $this->ModProductos->redireccion($Id);
            
            foreach($Prod as $value){
                $Clasificacion = $value->Clasificacion;
            }
            
            $this->session->set_flashdata('IdProducto', $Id);
            $this->session->set_flashdata('Clasificacion', $Clasificacion);
                    
            redirect('Sesiones/index');
        }
    }
    
    public function busqueda(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $clave = $_POST["txtClave"];
            
            $data['contenido'] = 'producto/lista';
            $data['productos'] = $this->ModProductos->busqueda($clave);
            
            if($data['producto'] == NULL){
                echo '<script> alert("No se encontró el producto indicado");</script>';
                redirect('Productos/lista');
            }
            
            $this->load->view("plantilla", $data);
        }
    }
}