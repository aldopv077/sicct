<?php
    class ModLogin extends CI_Model{
        function __construct() {
            parent::__construct();
            $this->load->database();
        }
        
        public function very_session($username, $password) {// se reciben los parámetros del controlador
            //echo $username .' '. $password;
            //exit; 
            
            //$this->db->where('Usuario', $username);
            //$this->db->where('Pass', $password); //se seleccionan los todos los datos cuando los campos coincidan con los parámetros de la tabla usuarios.
            //$query = $this->db->get('tblUsuario');
            
            //echo $query->num_rows();
            //exit;
            
            $query=$this->db->query("SELECT u.IdUsuario, u.Nombre, u.ApPaterno, u.ApMaterno, p.Puesto as Puesto, u.IdPuesto, u.IdRol, u.Usuario FROM TblUsuario As u INNER JOIN TblPuesto As p ON u.IdPuesto = p.IdPuesto WHERE Usuario='".$username."' AND Pass='".$password."' AND Bloqueado=0");
            
            
            if ($query->num_rows() == 1) {//si los datos coinciden solamente 1 vez se envía la fila de lo contrario se manda mensaje de error.
                return $query->row();
            } else {
                $this->session->set_flashdata('usuario_incorrecto', 'Los datos introducidos son incorrectos, porfavor vuelva a introducirlos');
                redirect('');
            }
        }
    }