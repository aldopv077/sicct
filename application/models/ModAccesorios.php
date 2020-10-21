<?php

class ModAccesorios extends CI_Model{
    function __construct() {
        parent::__construct();
        $this->load->database();
    } 
    
    //Ingresa los datos a la BD
    public function ingresar($Accesorio, $Medida){
        $arrayDatos = array(
            'Accesorio' => $Accesorio,
            'Medida' => $Medida
        );
        
        $this->db->insert('TblAccesorios', $arrayDatos);
        
        return true;
    }
    
    //consulta todos los accesorios agregados en la bd
    public function lista(){
        $this->db->select('*');
        $this->db->order_by('Accesorio','asc');
        $this->db->from('TblAccesorios');
        $consulta = $this->db->get();
        
        return $consulta->result();
    }
    
    //Realiza la busqueda de los datos para mostrarlos en el formulario
    public function modificar($Id){
        $this->db->select('*');
        $this->db->where('IdAccesorio',$Id);
        $this->db->from('TblAccesorios');
        $consulta = $this->db->get();
        
        return $consulta->result();
    }
    
    //Modifica los datos del accesorio seleccinado
    public function update($Id, $Accesorio, $Medida){
         $arrayDatos = array(
            'Accesorio' => $Accesorio,
            'Medida' => $Medida
        );
        
        $this->db->where('IdAccesorio', $Id);
        $this->db->update('TblAccesorios', $arrayDatos);
        
        return true;
    }
    
    //Elimina el accesorio seleccionado
        public function eliminar($Id){
         
        
        $this->db->where('IdAccesorio', $Id);
        $this->db->delete('TblAccesorios');
        
        return true;
    }
}