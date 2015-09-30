<?php

class Signup_m extends CI_Model {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set("America/Mexico_City");
        $this->load->database();
        $this->load->helper('url', 'form', 'date');
        $this->load->library( array('form_validation', 'session') );
    }

    public function sign_in() {
        $form = $this->input->post();
        $datetime = date("Y-m-d H:i:s"); 
        $data = array(
            'Nombre_TXT' => trim($form['form_nombre']),
            'ApPaterno_TXT' => trim($form['form_ape_p']),
            'ApMaterno_TXT' => trim($form['form_ape_m']),
            'Email_TXT' => trim($form['form_correo']),
            'Password_TXT' => md5(trim($form['form_pass'])),
            'Username_TXT' => trim($form['form_username']),
            'T04_tipousuario_I' => '1',
            'Registro_DT' => trim( $datetime )             
        );

        $this->db->insert('t01_usuario_ma', $data);

        $insert_usuario = $this->db->affected_rows();
        $id_usuario = $this->db->insert_id();

        if($insert_usuario == 1){
            return $this->get_usuario_by_id($id_usuario);
        }else{
            return FALSE;
        }
             
    }

    public function login() {
        $form = $this->input->post();        

        $this->db->select("id, Nombre_TXT, ApPaterno_TXT, ApMaterno_TXT, Email_TXT, Username_TXT, T04_tipousuario_I, Registro_DT" );
        $this->db->from('t01_usuario_ma');
        $this->db->where('Username_TXT', $form["form_username"] );         
        $this->db->where('Password_TXT', md5($form["form_pass"]) );  
        $query = $this->db->get();  

        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return FALSE;
        }


    }
    
    public function check_imput_m($table , $field){ 
        return $this->db->get_where('t01_usuario_ma', array($table => trim($field)  ), 1)->num_rows() > 0 ? false : true; 
    }

    function get_usuario_by_id($id_usuario){
       
        $this->db->select("id, Nombre_TXT, ApPaterno_TXT, ApMaterno_TXT, Email_TXT, Username_TXT, T04_tipousuario_I, Registro_DT" );
        $this->db->from('t01_usuario_ma');
        $this->db->where('id', $id_usuario);         
        $query = $this->db->get();        
        return $query->row();
    }


    

    
}



