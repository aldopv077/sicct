<?php

class ModUsuarios extends CI_Model{
    function __construct() {
        parent::__construct();
        $this->load->database();
    } 
    
    //Agregar los datos del usuario a la BD
    public function AgregarUsuario($IdEmpresa, $Nombre,$Paterno, $Materno,$Telefono,$Direccion,$Puesto,$Usuario,$Email, $Pass, $Rol){
        
        $arrayDatos = array(
            'IdPuesto' => $Puesto,
            'IdEmpresa' => $IdEmpresa,
            'Nombre' => $Nombre,
            'ApPaterno' => $Paterno,
            'ApMaterno' => $Materno,
            'Direccion' => $Direccion,
            'Correo' => $Email,
            'Telefono' => $Telefono,
            'IdRol' => $Rol,
            'Usuario' => $Usuario,
            'Pass' => $Pass
        );
        
        $this->db->insert('TblUsuario', $arrayDatos);
        
        return true;
    }
    
    //Consulta todos los datos de los usuarios
    public function selUsuarios(){
        $this->db->select('u.IdUsuario, u.Nombre, u.ApPaterno, u.ApMaterno, u.Telefono, u.Correo, u.Direccion, p.Puesto');
        $this->db->from('TblUsuario As u ');
        $this->db->join('TblPuesto As p' ,'u.IdPuesto = p.IdPuesto');
        $this->db->where('u.Bloqueado', 0);
        $this->db->where('IdEmpresa', $this->session->userdata('Empresa'));
        
        $query = $this->db->get();

        return $query->result();
    }
    
    //Consulta todos los puestos
    public function selPuesto(){
        $query = $this->db->query("SELECT * FROM TblPuesto");
        return $query->result();
    }
    
    //Consulta los perfiles
    public function selperfil(){
        $query = $this->db->query("SELECT * FROM TblRoles");
        return $query->result();
    }
    
    //Consulta los datos del usuario para mostrarlos en el formulario de modificación.
    public function frmModificar($Id){
        $this->db->select('u.IdUsuario, u.Nombre, u.ApPaterno, u.ApMaterno, u.Telefono, u.Correo, u.Direccion, p.Puesto,u.IdPuesto, u.IdRol, r.Rol');
        $this->db->from('TblUsuario As u ');
        $this->db->join('TblPuesto As p' ,'u.IdPuesto = p.IdPuesto');
        $this->db->join('TblRoles AS r', 'u.IdRol = r.IdRol');
        $this->db->where('IdUsuario', $Id);
        
       // $query = $this->db->query('SELECT u.IdUsuario, u.Nombre, u.ApPaterno, u.ApMaterno, u.Telefono, u.Correo, u.Direccion, p.Puesto,u.IdPuesto, u.IdRol, r.Rol FROM TblUsuario As u INNER JOIN TblPuesto As p ON u.IdPuesto = p.IdPuesto INNER JOIN TblRoles AS r ON u.IdRol = r.IdRol WHERE u.IdUsuario='.$Id);
        $query = $this->db->get(); 

        return $query->result();
    }
    
    
    //Modifica los datos que hayan cambiado en el formulario
    public function update($Id, $Nombre,$Paterno, $Materno,$Telefono,$Direccion,$Puesto,$Email, $Pass, $Rol){
        $arrayDatos = array(
            'IdPuesto' => $Puesto,
            'Nombre' => $Nombre,
            'ApPaterno' => $Paterno,
            'ApMaterno' => $Materno,
            'Direccion' => $Direccion,
            'Correo' => $Email,
            'Telefono' => $Telefono,
            'IdRol' => $Rol,
            'Pass' => $Pass
        );
        
        $this->db->where('IdUsuario', $Id);
        $this->db->update('TblUsuario', $arrayDatos);
        
        return true;
    }
    
    
    //Elimina al usuario seleccionado
    public function Eliminar($Id){
        $arrayDatos = array( 
            'Bloqueado' => 1);
        
        $this->db->where('IdUsuario',$Id);
        $this->db->update('TblUsuario', $arrayDatos);
        
    }
    
    public function busqueda($Id){
        $this->db->select("u.IdUsuario, u.Nombre, u.ApPaterno, u.ApMaterno, u.Telefono, u.Correo, u.Direccion, p.Puesto");
        $this->db->from("TblUsuario As u");
        $this->db->join("TblPuesto As p","u.IdPuesto = p.IdPuesto");
        $this->db->where("u.IdUsuario",$Id);
        
        $consulta = $this->db->get();
        return $consulta->result();
    }

}
