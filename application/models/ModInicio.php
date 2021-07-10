<?php
    class ModInicio extends CI_Model{
        
        function __construct() {
            parent::__construct();
            $this->load->database();
        }
        
        public function Usuarios(){
            $query = $this->db->query("SELECT COUNT(IdUsuario) AS Usuarios FROM TblUsuario WHERE bloqueado=0  AND IdEmpresa=".$this->session->userdata('Empresa'));
            return $query->result();
        }
        
        public function Clientes(){
            $query = $this->db->query("SELECT COUNT(IdCliente) AS Clientes FROM TblClientes WHERE bloqueado=0  AND IdEmpresa=".$this->session->userdata('Empresa'));
            return $query->result();
        }
        
        public function Departamentos(){
            $query = $this->db->query("SELECT COUNT(IdDepartamento) AS Departamento FROM TblDepartamento");
            return $query->result();
        }
        
        public function Productos(){
            $query = $this->db->query("SELECT COUNT(IdProducto) AS Producto FROM TblProducto WHERE Terminado=0  AND IdEmpresa=".$this->session->userdata('Empresa'));
            return $query->result();
        }
        
        public function Externos(){
            $query = $this->db->query("SELECT COUNT(IdExterno) AS Taller FROM TblTallerExterno WHERE Bloqueado=0  AND IdEmpresa=".$this->session->userdata('Empresa'));
            return $query->result();
        }
        
        public function Accesorios(){
            $query = $this->db->query("SELECT COUNT(IdAccesorio) AS Accesorio FROM TblAccesorios");
            return $query->result();
        }
    }