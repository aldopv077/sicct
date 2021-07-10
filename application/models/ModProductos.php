<?php

class ModProductos extends CI_Model{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    //Lista de departamentos que intervienen en el proceso de corte
    public function listaEstados(){
        $this->db->select('*');
        $this->db->from('TblDepartamento');
        $consulta = $this->db->get();
        
        return $consulta->result();
    }
    
    //Lista de los tipos de productos
    public function tproductos(){
        $this->db->select('*');
        $this->db->from('TblTipoProducto');
        $consulta = $this->db->get();
        
        return $consulta->result();
    }
    
    //Lista de los datps del producto a modificar
    public function producto($Id){
        $this->db->select('*');
        $this->db->from('TblProducto');
        $this->db->where('IdProducto', $Id);
        $this->db->where('IdEmpresa', $this->session->userdata('Empresa'));
        
        $consulta = $this->db->get();
        
        return $consulta->result();
    }
    
    //Ingresa a la BD los datos del corte que acaba de ingresar a la fabrica
    public function ingresar($Clave, $IdEmpresa, $Cliente, $TProducto, $Estado, $Piezas, $Sesiones, $Ingreso, $Entrega, $Clasificacion){
        $arrayDatos = array(
            'Clave' => $Clave,
            'IdCliente' => $Cliente,
            'IdTProducto' => $TProducto,
            'IdEmpresa' => $IdEmpresa,
            'Estado' => $Estado,
            'Totalpiezas' => $Piezas,
            'NumeroSesiones' => $Sesiones,
            'Fechaingreso' => $Ingreso,
            'Fechasalida' => $Entrega,
            'Clasificacion' => $Clasificacion
        );
        
        $this->db->insert('TblProducto', $arrayDatos);
        
        return true;
    }
    
    
    
    //Lista de los cortes no terminados
    public function lista(){

        $this->db->select('pr.IdProducto as Id, pr.Clave as Clave, c.Nombre as Cliente, t.TipoProducto as TipoProducto, d.Departamento as Estado, pr.TotalPiezas as PiezasTotales, pr.NumeroSesiones AS Sesiones, pr.Fechaingreso as Ingreso, pr.Fechasalida as Salida, pr.Clasificacion AS Clasificacion, pr.Terminado as Terminado');
        $this->db->from('tblproducto as pr');
        $this->db->join('tblclientes as c ', ' pr.IdCliente=c.IdCliente');
        $this->db->join('tbltipoproducto AS t', 'pr.IdTProducto = t.IdTproducto');
        $this->db->join('tbldepartamento as d','pr.Estado = d.IdDepartamento');
        $this->db->where('pr.Terminado', 0);
        $this->db->where('pr.IdEmpresa', $this->session->userdata('Empresa'));
        
        $consulta = $this->db->get();
        //$this->db->query('SELECT pr.IdProducto as Id, pr.Clave as Clave, c.Nombre as Cliente, t.TipoProducto as TipoProducto, d.Departamento as Estado, pr.TotalPiezas as PiezasTotales, pr.NumeroSesiones AS Sesiones, pr.Fechaingreso as Ingreso, pr.Fechasalida as Salida, pr.Clasificacion AS Clasificacion, pr.Terminado as Terminado FROM tblproducto as pr INNER JOIN tblclientes as c on pr.IdCliente=c.IdCliente INNER JOIN  tbltipoproducto AS t ON pr.IdTProducto = t.IdTproducto INNER JOIN tbldepartamento as d ON pr.Estado = d.IdDepartamento WHERE pr.Terminado=0');
        
        return $consulta->result();
    }
    
    
    //Busqueda del corte seleccionado
    public function busqueda($Clave){
        $this->db->select("pr.IdProducto as Id, pr.Clave as Clave, c.Nombre as Cliente, t.TipoProducto as TipoProducto, d.Departamento as Estado, pr.TotalPiezas as PiezasTotales, pr.NumeroSesiones AS Sesiones, pr.Fechaingreso as Ingreso, pr.Fechasalida as Salida, pr.Clasificacion AS Clasificacion, pr.Terminado as Terminado");
        $this->db->from("TblProducto as pr");
        $this->db->join("TblClientes as c","pr.IdCliente=c.IdCliente");
        $this->db->join("TblTipoProducto AS t","pr.IdTProducto = t.IdTproducto");
        $this->db->join("TblDepartamento as d","pr.Estado = d.IdDepartamento");
        $this->db->where("pr.Clave",$Clave);
        
        $consulta = $this->db->get();
        return $consulta->result();
    }
    
    public function update($Id, $Cliente, $TProducto, $Estado, $Piezas, $Sesiones, $Ingreso, $Entrega, $Clasificacion){
        $arrayDatos = array(
            'IdCliente' => $Cliente,
            'IdTProducto' => $TProducto,
            'Estado' => $Estado,
            'Totalpiezas' => $Piezas,
            'NumeroSesiones' => $Sesiones,
            'Fechaingreso' => $Ingreso,
            'Fechasalida' => $Entrega,
            'Clasificacion' => $Clasificacion
        );
        
        $this->db->where('IdProducto', $Id);
        $this->db->update('TblProducto', $arrayDatos);
        
        return true;
    }
    
    public function lastId(){
        $consulta=$this->db->query('SELECT IdProducto FROM TblProducto order by IdProducto desc limit 1');
        return $consulta->result();
    }
    
    public function redireccion($Id){
        $this->db->select('Clasificacion');
        $this->db->where('IdProducto', $Id);
        $this->db->from('TblProducto');
        
        $consulta = $this->db->get();
        
        return $consulta->result();
    }
}