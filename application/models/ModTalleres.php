<?php
   class ModTalleres extends CI_Model{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
       
    //Ingresa a la BD los datos de los clientes
    public function ingresar($Nombre, $Paterno, $Materno, $Direccion, $Telefono){
        $arrayDatos = array(
            'Nombre' => $Nombre,
            'ApPaterno' => $Paterno,
            'ApMaterno' => $Materno,
            'Telefono' => $Telefono,
            'Direccion' => $Direccion,
        );
        
        $this->db->insert('TblTallerExterno', $arrayDatos);
        
        return true;
    }
       
    public function lista(){
        $this->db->select('*');
        $this->db->from('TblTallerExterno');
        $this->db->where('Bloqueado',0);
           
        $consulta = $this->db->get();
           
        return $consulta->result();
    }
       
    public function busqueda($Id){
        $this->db->select('*');
        $this->db->from('TblTallerExterno');
        $this->db->where('IdExterno', $Id);
           
        $consulta = $this->db->get();
           
        return $consulta->result();
    }
       
    public function update($Id,$Nombre, $Paterno, $Materno, $Direccion, $Telefono){
        $arrayDatos = array(
            'Nombre' => $Nombre,
            'ApPaterno' => $Paterno,
            'ApMaterno' => $Materno,
            'Telefono' => $Telefono,
            'Direccion' => $Direccion
        );
        
        $this->db->where('IdExterno', $Id);
        $this->db->update('TblTallerExterno', $arrayDatos);
        
        return true;
    }
       
    public function Eliminar($Id){
        $arrayDatos = array(
            'Bloqueado' => 1
        );
        
        $this->db->where('IdExterno', $Id);
        $this->db->update('TblTallerExterno', $arrayDatos);
        
        return true;
    }
} 