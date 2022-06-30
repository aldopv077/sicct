<?php

class ModEmpleados extends CI_Model{
    function __construct() {
        parent::__construct();
        $this->load->database();
    } 

    public function listaOperaciones(){
        $this->db->select('*');
        $this->db->from('TblOperaciones');

        $consulta = $this->db->get();
        return $consulta->result();
    }

    public function ingresar($Empleado){
        $ing = $this->db->insert('TblEmpleados', $Empleado);

        if($ing){
            return true;
        }else{
            return false;
        }
    }

    public function lista($IdEmpresa){
        $this->db->select('emp.IdEmpleados As IdEmpleado, emp.Nombre As Nombre, emp.Paterno As Paterno, emp.Materno As Materno, emp.Direccion As Direccion, emp.Telefono As Telefono, oper.Operacion As Operacion');
        $this->db->from('TblEmpleados As emp');
        $this->db->join('TblOperaciones as oper', 'emp.IdOperacion = oper.IdOperacion');
        $this->db->where('IdEmpresa', $IdEmpresa);
        $this->db->where('Activo', 1);
        
        $consulta = $this->db->get();
        return $consulta->result();
    }

    public function buscarOperacion($Id, $IdEmpresa){
        $this->db->select('emp.IdEmpleados As IdEmpleado, emp.Nombre As Nombre, emp.Paterno As Paterno, emp.Materno As Materno, emp.Direccion As Direccion, emp.Telefono As Telefono, oper.Operacion As Operacion');
        $this->db->from('TblEmpleados As emp');
        $this->db->join('TblOperaciones as oper', 'emp.IdOperacion = oper.IdOperacion');
        $this->db->where('emp.IdEmpresa', $IdEmpresa);
        $this->db->where('emp.IdOperacion', $Id);
        $this->db->where('Activo', 1);
        
        $consulta = $this->db->get();
        return $consulta->result();
    }

    public function buscarEmpleado($Id, $IdEmpresa){
        $this->db->select('emp.IdEmpleados As IdEmpleado, emp.IdOperacion As IdOperacion,emp.Nombre As Nombre, emp.Paterno As Paterno, emp.Materno As Materno, emp.Direccion As Direccion, emp.Telefono As Telefono, oper.Operacion As Operacion');
        $this->db->from('TblEmpleados As emp');
        $this->db->join('TblOperaciones as oper', 'emp.IdOperacion = oper.IdOperacion');
        $this->db->where('emp.IdEmpresa', $IdEmpresa);
        $this->db->where('emp.IdEmpleados', $Id);
        $this->db->where('Activo', 1);
        
        $consulta = $this->db->get();
        return $consulta->result();
    }

    public function actualizar($Id, $Empleado){
        $this->db->where('IdEmpleados', $Id);
        $this->db->update('TblEmpleados', $Empleado);

        return true;
    }
}