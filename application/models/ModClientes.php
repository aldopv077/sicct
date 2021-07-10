<?php

class ModClientes extends CI_Model{
    function __construct() {
        parent::__construct();
        $this->load->database();
    } 
    
    //Ingresa a la BD los datos de los clientes
    public function ingresar($IdEmpresa, $Nombre, $RFC, $Telefono, $Direccion, $Email, $Contacto, $TelContacto){
        $arrayDatos = array(
            'IdEmpresa' => $IdEmpresa,
            'Nombre' => $Nombre,
            'RFC' => $RFC,
            'Direccion' => $Direccion,
            'Correo' => $Email,
            'Telefono' => $Telefono,
            'Correo' => $Email,
            'Nombrecontacto' => $Contacto,
            'TelefonoContacto' => $TelContacto
        );
        
        $this->db->insert('TblClientes', $arrayDatos);
        
        return true;
    }
    
    //Lista de los clientes agregados en la BD
    public function lista(){
        $this->db->select('*');
        $this->db->from('TblClientes');
        $this->db->where('Bloqueado', 0);
        $this->db->where('IdEmpresa', $this->session->userdata('Empresa'));
        $consulta = $this->db->get();
        
        return $consulta->result();
    }
    
    public function busqueda($Id){
        $this->db->select('*');
        $this->db->from('TblClientes');
        $this->db->where('IdCliente', $Id);
        $this->db->where('IdEmpresa', $this->session->userdata('Empresa'));
        $consulta = $this->db->get();
        
        return $consulta->result();
    }
    
    //Lista de los clientes agregados en la BD
    public function listamod($Id){
        
        $this->db->select('*');
        $this->db->from('TblClientes');
        $this->db->where('IdEmpresa', $this->session->userdata('Empresa'));
        $this->db->where('IdCliente', $Id);
        $consulta = $this->db->get();
        
        return $consulta->result();
    }
    
    //Actualiza los datos modificados en el formulario
    public function update($Id, $Nombre, $RFC, $Telefono, $Direccion, $Email, $Contacto, $TelContacto){
         $arrayDatos = array(
            'Nombre' => $Nombre,
            'RFC' => $RFC,
            'Direccion' => $Direccion,
            'Correo' => $Email,
            'Telefono' => $Telefono,
            'Correo' => $Email,
            'Nombrecontacto' => $Contacto,
            'TelefonoContacto' => $TelContacto
        );
        
        $this->db->where('IdCliente', $Id);
        $this->db->update('TblClientes', $arrayDatos);
        
        return true;
    }
    
        //Elimina al cliente seleccionado
    public function Eliminar($Id){
        $arrayDatos = array( 
            'Bloqueado' => 1);
        
        $this->db->where('IdCliente',$Id);
        $this->db->update('TblClientes', $arrayDatos);
        
    }
}