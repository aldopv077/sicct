<?php
    class ModGrafica extends CI_Model{
        
        function __construct() {
            parent::__construct();
            $this->load->database();
        }
        
        public function productos(){
            $this->db->select('IdProducto,Clave,Totalpiezas');
            $this->db->from('TblProducto');
            $this->db->where('Terminado', 0);            
            $this->db->where('IdEmpresa', $this->session->userdata('Empresa'));

            $consulta = $this->db->get();
            return $consulta->result();
        }
    }