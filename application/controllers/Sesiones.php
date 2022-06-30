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
            }else{
                $data['contenido'] = "sesiones/lista"; 
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

                $list = explode(' ', $Taller);
                foreach($list as $value=>$Taller){
                    $Matriz=$list[2];
                    $IdTaller=$list[0];
                }
    
                //echo $Matriz; exit;
                if($Matriz == 'Matríz'){
                    $mat = 1;
                }else{
                    $mat = 0;
                }
                
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
           
            $agregar = $this->ModSesiones->ingresarSesion($Sesion, $IdProducto, $IdTaller, $Estado, $TPiezas, $Fecha, $Entrega, $mat);
        
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

                $list = explode(' ', $Taller);
                foreach($list as $value=>$Taller){
                    $Matriz=$list[2];
                    $IdTaller=$list[0];
                }
    
                if($Matriz == 'Matríz'){
                    $mat = 1;
                }else{
                    $mat = 0;
                }
                
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
                
                $modificar = $this->ModSesiones->updateSesion($Sesion, $IdProducto, $IdTaller, $Estado, $TPiezas, $Pzas,$Entrega);
                
                if($modificar){    
                    echo '<script> alert("Sesion modificada satisfactoriamente");</script>';
            
                    redirect('Sesiones/lista/'.$Clave);
                }
            }
                
        }
        
    }
    
    public function eliminar($IdProducto, $Id){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
            if($Id != NULL && $IdProducto != NULL){
                $sesion = $this->ModSesiones->ConsultaSesion($IdProducto, $Id);

                foreach($sesion as $value){
                    $CantTotal = $value->Cantidad;
                    $CantHecha = $value->PiezasHechas;
                }

                if($CantTotal != $CantHecha){
                    echo '<script> alert("La CANTIDAD TOTAL es DIFERENTE a la CANTIDAD HECHA"); </script>';
                    redirect('Sesiones/lista/'.$IdProducto, 'refresh');
                }
                
                $this->ModSesiones->Eliminar($IdProducto, $Id);
                redirect('Sesiones/lista/'.$IdProducto, 'refresh');
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
    

    //Ingresa las piesas entregadas
    public function avance(){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{
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
            $IdExterno = $_POST['txtTaller'];
            
            for($x=0; $x < count($Hechas);$x++){
                $AvanceTotal = $Hechas[$x] + $Avance[$x];
                
                //echo 'Sesión: '. $IdSesion[$x].' Avance: '.$Avance[$x].' Pzas Hechas hasta hoy: '.$Hechas[$x].' Pzas Hechas + Avance Actual: '. $AvanceTotal;
                //echo '<br>';
                //exit;

                $Avan = $this->ModSesiones->Avance($IdSesion[$x], $IdExterno[$x], $IdProducto[$x], $Avance[$x], $Fecha);
                $Total = $this->ModSesiones->updateSesion($IdSesion[$x], $IdProducto[$x], $Taller[$x], $Estado[$x],$Piezas[$x], $AvanceTotal, $Entrega[$x]);
                
                $sesion = $this->ModSesiones->ConsultaSesion($IdProducto[$x], $IdSesion[$x]);
                
                foreach($sesion as $value){
                    $CantTotal = $value->Cantidad;
                    $CantHecha = $value->PiezasHechas;
                }

                if($CantTotal == $CantHecha){
                    $this->ModSesiones->Eliminar($IdProducto[$x], $IdSesion[$x]);
                    echo '<script> alert("Sesión:'.$IdSesion[$x].' marcada como terminada");</script>';
                }                
            }
            


            if($Avan && $Total){
                echo '<script> alert("Piezas agregadas satisfactoriamente");</script>';
                
                redirect('Sesiones/lista/'.$Clave);
            }
        }
    } 

    //Muestra el avance de la seccion seleccionada
    public function historial($IdProducto, $Id){
        if($this->session->userdata('is_logued_in') == FALSE){
            redirect('login','refresh');
        }else{

            $historial = $this->ModSesiones->Historial($IdProducto, $Id);

            $data['contenido'] = 'sesiones/avance';
            $data['lista'] = $historial;
            $data['sesion'] = $Id;

            $this->load->view('plantilla', $data);
        }
    }
    
}