<?php

class ModSesiones extends CI_Model{
    function __construct() {
        parent::__construct();
        $this->load->database();
    } 
    
    //Consulta el producto al que se le agregarán las sesiones
    public function productos($Id){
        $this->db->select('p.IdProducto AS IdProducto, p.Clave AS Clave, p.NumeroSesiones As NumeroSesiones, p.Clasificacion AS Clasificacion, tp.TipoProducto As Prenda');
        $this->db->from('TblProducto AS p');
        $this->db->join('TblTipoProducto AS tp', 'tp.IdTProducto = p.IdTProducto');
        $this->db->where('p.IdProducto',$Id);
        
        $consulta = $this->db->get();
        
        return $consulta->result();
    }  
    
    //Consulta las tallas numericas dentro de un rango espesificado
    public function tallasnum($inicio, $fin){
        $query = $this->db->query('SELECT * FROM TblTallas WHERE IdTalla BETWEEN '. $inicio. ' AND '. $fin);
        
        return $query->result();
        
    }
    
    //Inserta las sesión seleccionada con los datos generales de ésta
    public function ingresarSesion($Sesion,$Producto,$Taller,$Estado,$Piezas,$Fecha,$Entrega){
        $arrayDatos = array(
            'IdSesion' => $Sesion,
            'IdProducto' => $Producto,
            'IdTaller' => $Taller,
            'Estado' => $Estado,
            'Cantidad' => $Piezas,
            'FechaInicio' => $Fecha,
            'FechaProgramada' =>$Entrega
        );
        
        $this->db->insert('TblSesiones', $arrayDatos);
        
        return true;
    }
    
    //Inserta los accesorios que tendrá el producto en la sesión espesificada
   public function ingresarAccesorios($Sesion,$Accesorio,$IdProducto){

        $arrayDatos = array(
            'IdSesion' => $Sesion,
            'IdAccesorio' => $Accesorio,
            'IdProducto' => $IdProducto
        );
        
        $this->db->insert('TblAccesoriosSesiones',$arrayDatos);
        return true;
    }
    
    //Inserta las tallas que conformarán la sesión y la cantidad de piezas que tendrá cada talla
    public function ingresarTallas($Sesion,$Talla,$IdProducto,$Cantidad){
        $ingresar = "INSERT INTO TblTallasSesiones (IdSesion,IdTalla, IdProducto,Cantidad) VALUES ";
        
        for($x=0; $x < count($Talla);$x++){
            $ingresar .="(".$Sesion.", ".$Talla[$x].",".$IdProducto.", ".$Cantidad[$x]."), ";
        }

        
        $cadena=substr($ingresar,0,-2);
        $cadena.=';';
        
        $query= $this->db->query($cadena);
		return TRUE;
    }
    
    public function lista($Id){
        $query = $this->db->query("SELECT s.IdSesion As Id, p.IdProducto AS IdProducto, p.Clave AS Clave, s.Estado AS Estado, p.Clasificacion AS Clasificacion, tp.TipoProducto AS Producto, c.Nombre AS Cliente, s.Cantidad AS Piezas, s.PiezasHechas AS Avance, s.FechaInicio AS Inicio, s.FechaProgramada AS Fin, ta.IdExterno AS Taller,ta.Nombre AS Nombre, ta.ApPaterno AS Paterno, ta.ApMaterno AS Materno FROM tblsesiones AS s INNER JOIN tblproducto AS p ON s.IdProducto=p.IdProducto INNER JOIN tblclientes As c ON c.IdCliente=p.IdCliente INNER JOIN tbltipoproducto AS tp ON tp.IdTProducto = p.IdTProducto INNER JOIN tbltallerexterno AS ta ON s.IdTaller=ta.IdExterno WHERE p.Clave = '".$Id."' ORDER BY s.IdSesion asc");
        
        return $query->result();
    }
    
   public function eliminar($Id){
       $arrayDatos = array( 
            'Estado' => "Terminado");
        
        $this->db->where('IdSesion',$Id);
        $this->db->update('TblSesiones', $arrayDatos);
    } 
    
    public function modSesion($IdSesion, $IdProducto){
        $this->db->select("p.IdProducto AS IdProducto, se.IdSesion AS IdSesion, se.IdTaller AS Taller,se.FechaProgramada AS Programada, se.Estado AS Estado, se.Cantidad AS Cantidad, p.Clave AS Clave, se.PiezasHechas AS Hechas,p.Clasificacion AS Clasificacion, tp.TipoProducto As Prenda");
        $this->db->from("TblProducto AS p");
        $this->db->join("TblTipoProducto AS tp","tp.IdTProducto = p.IdTProducto");
        $this->db->join("TblSesiones AS se","se.IdProducto = p.IdProducto");
        $this->db->where("p.IdProducto",$IdProducto);
        $this->db->where("se.IdSesion",$IdSesion);
        
        $consulta = $this->db->get();
        return $consulta->result();
    }
    
    public function modAccesorios($IdSesion,$Id){
        $this->db->select('acs.IdAcceSecc AS IdAcceSecc, acs.IdAccesorio AS IdAccesorio, ac.Accesorio AS Accesorio');
        $this->db->from('TblAccesoriosSesiones AS acs');
        $this->db->join('TblAccesorios as ac','acs.IdAccesorio = ac.IdAccesorio');
        $this->db->where('IdProducto',$Id);
        $this->db->where('IdSesion',$IdSesion);
        
        $consulta = $this->db->get();
        
        return $consulta->result();
    }
    
    public function modTallas($Id,$prod){
        $this->db->select('t.Talla, ts.Cantidad');
        $this->db->from('TblTallas AS t');
        $this->db->join('TblTallasSesiones AS Ts','t.IdTalla = ts.IdTalla');
        $this->db->where('IdSesion',$Id);
        $this->db->where('IdProducto', $prod);
        
        $consulta = $this->db->get();
        
        return $consulta->result();
    }
    
    public function updateSesion($IdSesion,$IdProducto,$Taller,$Estado,$Tpiezas,$Pzas,$Entrega){
        $data = array(
            'Estado' => $Estado,
            'IdTaller' => $Taller,
            'Cantidad' => $Tpiezas,
            'PiezasHechas' => $Pzas,
            'FechaProgramada' => $Entrega
        );
        
        $this->db->where('IdSesion',$IdSesion);
        $this->db->where('IdProducto',$IdProducto);
        $this->db->update('TblSesiones',$data);
        
        return true;
    }
    
    public function eliminarAccesorio($Id, $Idprod){
        $this->db->where('IdSesion', $Id);
        $this->db->where('IdProducto', $Idprod);
        $this->db->delete('TblAccesoriosSesiones');
        
        return true;
    }
    
    public function eliminarTalla($Id, $IdProd){
        $this->db->where('IdSesion', $Id);
        $this->db->where('IdProducto', $IdProd);
        $this->db->delete('TblTallasSesiones');
        
        return true;
    }
    
    public function talleres(){
        $this->db->select('IdExterno, Nombre, ApPaterno, ApMaterno');
        $this->db->from('TblTallerExterno');
        
        $consulta = $this->db->get();
        
        return $consulta->result();
    }
    
    public function Avance($Sesion, $Producto, $Pzas, $Fecha){
        $data = array(
            'IdSesion' => $Sesion,
            'IdProducto' => $Producto,
            'Produccion' => $Pzas,
            'Fecha' => $Fecha
        );
        
        $this->db->insert('TblProduccion', $data);
        return true;
    }
}
