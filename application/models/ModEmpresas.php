<?php

class ModEmpresas extends CI_Model{
    function __construct() {
        parent::__construct();
        $this->load->database();
    } 

    public function ingresar($empresa){
        $ingresa = $this->db->insert('TblEmpresas', $empresa);

        if($ingresa){
            $this->db->select_max('IdEmpresa');
            $this->db->from('TblEmpresas');

            $consulta = $this->db->get();
            return $consulta->result();
        }        
    }


}