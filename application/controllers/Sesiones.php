<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sesiones extends CI_Controller {
    
    
    
    function __construct() {
        parent::__construct();
        $this->load->model("ModAccesorios");
        $this->load->model("ModSesiones");
        $this->load->model("ModTalleres");
    }
     
    //Ver la pagina inicial de sesiones que sería para agregar producto
	public function index()
	{
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
                $Id = $this->session->flashdata('IdProducto');
                $Rango = $this->session->flashdata('Clasificacion');
                $inicio = '';
                $fin = '';           
            
                /*$talleres = $this->ModTalleres->lista();
                print_r($talleres);
                exit;*/
            
                switch($Rango){
                    case 'Niño':
                        $inicio = 11;
                        $fin = 18;
                        break;
                    case 'Dama':
                        $inicio = 19;
                        $fin = 27;
                        break;
                    case 'Caballero':
                        $inicio = 28;
                        $fin = 35;
                        break;
                }
                
                $data['contenido'] = "sesiones/index";  // Ruta de la pantalla principal de sesiones
                $data['accesorios'] = $this->ModAccesorios->lista(); //Llama los accesorios de las prendas
                $data['productos'] = $this->ModSesiones->productos($Id); //Llama los datos generales del producto          
                $data['ltaller'] = $this->ModTalleres->lista();
                $data['tallas'] = $this->ModSesiones->tallasnum($inicio, $fin); //Llama las tallas numericas dependiendo la clasificación de la prenda
                $this->load->view("plantilla", $data); //Manda a llamar a la vista plantilla con los parametros antes mecionados
        }
	}
    
    //Muestra la lista de las sesiones agregadas y puede buscar por nombre clave del producto
    public function lista($Id = NULL){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            if($Id != NULL){
                $data['contenido'] = "sesiones/lista"; 
                $data['lista'] = $this->ModSesiones->lista($Id);
                $this->load->view("plantilla",$data); 
            }
        }
    }
    
    //Muestra el formulario para poder modificar algun dato de la sesión
    public function modificar($Id = NULL, $prod = NULL){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            if($Id != NULL && $prod != NULL){

                $Prod = $this->ModSesiones->modSesion($Id,$prod);
                
                foreach($Prod as $rango){
                    $rang = $rango->Clasificacion; 
                }
                
                switch($rang){
                    case 'Niño':
                        $inicio = 11;
                        $fin = 18;
                        break;
                    case 'Dama':
                        $inicio = 19;
                        $fin = 27;
                        break;
                    case 'Caballero':
                        $inicio = 28;
                        $fin = 35;
                        break;
                }
                
                $data['contenido'] = "sesiones/modificar";
                $data['productos'] = $Prod;
                $data['tallas'] =  $this->ModSesiones->tallasnum($inicio, $fin);
                $data['accesorios'] = $this->ModAccesorios->lista();
                $data['tallaselect'] = $this->ModSesiones->modTallas($Id,$prod);
                $data['accesorioselect'] = $this->ModSesiones->modAccesorios($Id,$prod);
                $data['ltaller'] = $this->ModTalleres->lista();
                $this->load->view("plantilla",$data); 
            }
                
        }
    }
    
    //Ingresa los datos de las sesión
    public function ingresar(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $datos=$this->input->post();
            
            $Fecha=date('Y-m-d');
            
            if(isset($datos)){
                //TblSesiones
                $Sesion = $datos['rbSesion'];
                $IdProducto = $datos['txtId'];
                $Taller = $datos['txtTaller'];
                $Estado = $datos['cmbEstado'];
                $TPiezas = $datos['txtTPiezas'];
                $Entrega = $datos['dtEntrega'];
                $Clasificacion = $datos['txtClasificacion'];
                
                //TblAccesorioSesion
                if(!empty($datos['chbAccesorios'])){
                    //echo 'Accesorios';
                    foreach($datos['chbAccesorios'] as $select){
                       $Accesorios = $this->ModSesiones->ingresarAccesorios($Sesion,$select,$IdProducto);
                    }
                }
                            
                
                //TblTallaSesion
                $Talla = $datos['rbTipoTalla'];
                
                if($Talla == 'Letra'){
                    $TallaL = $_POST['chbTallaL'];
                    $Cantidad = $_POST['txtCantidad'];
                    
                    $TallasL = $this->ModSesiones->ingresarTallas($Sesion,$TallaL,$IdProducto,$Cantidad);
                }else{
                    $Tallas = $_POST['chbTallas'];
                    $CantidadN = $_POST['txtCantidadN'];
                    $Cant= array();
                    $Lugar=0;
                    
                    for($x=0; $x < count($CantidadN);$x++){
                        if($CantidadN[$x] != 0){
                            $Cant[$Lugar]=$CantidadN[$x];
                            $Lugar++;
                        }
                    }
                    /*print_r($CantidadN);
                    echo '<br>';
                    print_r($Cant);
                    exit;*/
                    
                    $TallasN = $this->ModSesiones->ingresarTallas($Sesion, $Tallas, $IdProducto, $Cant);
                }
            }
            
            //echo 'Sesion: '.$Sesion. ' Producto: '.$IdProducto.' Estado: '.$Estado.' Piezas: '.$TPiezas. ' Fecha: '.$Fecha. ' Clasificacion: '.$Clasificacion;
            //exit;
            
            $agregar = $this->ModSesiones->ingresarSesion($Sesion, $IdProducto, $Taller,$Estado, $TPiezas, $Fecha, $Entrega);
        
            if($agregar){    
                echo '<script> alert("Sesion agregada satisfactoriamente");</script>';
            
                $this->session->set_flashdata('IdProducto', $IdProducto);
                $this->session->set_flashdata('Clasificacion', $Clasificacion);
                redirect('Sesiones/index');
            }
            
        }
    }
    
    public function update(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $datos=$this->input->post();
                
            if(isset($datos)){
                
                //TblSesiones
                $Sesion = $datos['txtIdSeccion'];
                $IdProducto = $datos['txtId'];
                $Taller = $datos['txtTaller'];
                $Estado = $datos['cmbEstado'];
                $TPiezas = $datos['txtTPiezas'];
                $Pzas = $datos['txtHechas'];
                $Entrega = $datos['dtEntrega'];
                $Clave = $datos['txtClave'];
                
                $cambioAcc = $datos['rbAccesorios'];
                
                if($cambioAcc == 'Si'){
                    //TblAccesorios
                    $this->ModSesiones->eliminarAccesorio($Sesion,$IdProducto);
                
                    //TblAccesorioSesion
                    if(!empty($datos['chbAccesorios'])){
                            //echo 'Accesorios';
                        foreach($datos['chbAccesorios'] as $select){
                            $Accesorios = $this->ModSesiones->ingresarAccesorios($Sesion,$select,$IdProducto);
                            //echo $select;
                            //echo '<br>';
                        
                        }
                    }    
                }
                
                $cambioTalla = $datos['rbTallas'];                
                if($cambioTalla == 'Si'){
                    
                    
                    $this->ModSesiones->eliminarTalla($Sesion,$IdProducto);
                    
                    //TblTallaSesion
                    $Talla = $datos['rbTipoTalla'];
                
                    if($Talla == 'Letra'){
                        $TallaL = $_POST['chbTallaL'];
                        $Cantidad = $_POST['txtCantidad'];
                    
                        $TallasL = $this->ModSesiones->ingresarTallas($Sesion,$TallaL,$IdProducto,$Cantidad);
                    }else{
                        $Tallas = $_POST['chbTallas'];
                        $CantidadN = $_POST['txtCantidadN'];
                        $Cant= array();
                        $Lugar=0;
                    
                        for($x=0; $x < count($CantidadN);$x++){
                            if($CantidadN[$x] != 0){
                                $Cant[$Lugar]=$CantidadN[$x];
                                $Lugar++;
                            }
                        }
                        /*print_r($CantidadN);
                        echo '<br>';
                        print_r($Cant);
                        exit;*/
                    
                        $TallasN = $this->ModSesiones->ingresarTallas($Sesion, $Tallas, $IdProducto, $Cant);
                }
                }
                
                $modificar = $this->ModSesiones->updateSesion($Sesion, $IdProducto, $Taller, $Estado, $TPiezas, $Pzas,$Entrega);
                
                if($modificar){    
                    echo '<script> alert("Sesion modificada satisfactoriamente");</script>';
            
                    redirect('Sesiones/lista/'.$Clave);
                }
            }
                
        }
        
    }
    
    public function eliminar($Id){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            if($Id != NULL){
                $this->ModSesiones->Eliminar($Id);
                redirect('Sesiones/lista');
            }
        }
    }
    
    //Muestra la lista de las sesiones agregadas y puede buscar por nombre clave del producto
    public function busqueda(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            $Clave = $this->input->post();
            
            if(isset($Clave)){
                
                $Id=$Clave['txtIdCorte'];
                
                $data['contenido'] = "sesiones/lista"; 
                $data['lista'] = $this->ModSesiones->lista($Id);
                $this->load->view("plantilla",$data); 
            }
        }
    }
    
    public function avance(){
        $Fecha=date('Y-m-d');
        
        
        $IdSesion = $_POST['txtSesion'];
        $IdProducto = $_POST['txtProducto'];
        $Hechas = $_POST['txtHechas'];
        $Entrega = $_POST['txtEntrega'];
        $Estado = $_POST['txtEstado'];
        $Taller = $_POST['txtTaller'];
        $Avance = $_POST['txtavance'];
        $Piezas = $_POST['txtTPiezas'];
        $Clave = $_POST['txtClave'];
        
        for($x=0; $x < count($Hechas);$x++){
            $AvanceTotal = $Hechas[$x] + $Avance[$x];
            
            //echo 'Sesión: '. $IdSesion[$x].' Avance: '.$Avance[$x].' Pzas Hechas hasta hoy: '.$Hechas[$x].' Pzas Hechas + Avance Actual: '. $AvanceTotal;
            //echo '<br>';
            
            $Avan = $this->ModSesiones->Avance($IdSesion[$x], $IdProducto[$x], $Avance[$x], $Fecha);
            $Total = $this->ModSesiones->updateSesion($IdSesion[$x], $IdProducto[$x], $Taller[$x], $Estado[$x],$Piezas[$x], $AvanceTotal, $Entrega[$x]);
        }
        
        if($Avan && $Total){
            echo '<script> alert("Piezas agregadas satisfactoriamente");</script>';
            
            redirect('Sesiones/lista/'.$Clave);
        }
    } 
    
}