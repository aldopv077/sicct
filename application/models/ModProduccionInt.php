<?php

class ModPRoduccionInt extends CI_Model{
    function __construct() {
        parent::__construct();
        $this->load->database();
    } 

    public function listaCortes(){
        $this->db->select('IdProducto, Clave');
        $this->db->from('TblProducto');
        
        $consulta = $this->db->get();
        return $consulta->result();
    }

    public function listaSesiones($producto){
        $this->db->select('IdSesion');
        $this->db->from('TblSesiones');
        $this->db->where('IdProducto', $producto);
        $this->db->where('Matriz', 1);

        $consulta = $this->db->get();
        return $consulta->result();
    }

    public function lista($Operacion, $producto){
        $this->db->select('emp.Nombre As Nombre, emp.Paterno As Paterno, emp.Materno As Materno, prodin.Cantidad As Cantidad, prodin.Fecha AS Fecha, prodin.Hora As Hora');
        $this->db->from('TblEmpleados as emp');
        $this->db->join('TblProduccionInterna as prodin', 'emp.IdEmpleados = prodin.IdEmpleado');
        $this->db->where('prodin.IdOperacion', $Operacion);
        $this->db->where('prodin.IdProducto', $producto);

        $consulta = $this->db->get();
        return $consulta->result();
    }

    public function avance($avance){
        $ing = $this->db->insert('TblProduccionInterna', $avance);
        if($ing){
            return true;
        }else{
            return false;
        }
    }
}