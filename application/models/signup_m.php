<?php

class Signup_m extends CI_Model {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set("America/Mexico_City");
        $this->load->database();
        $this->load->helper('url', 'form', 'date');
        $this->load->library( array('form_validation', 'session') );
    }

    public function record() {
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
        return true;       
    }
    
    public function check_imput_m($table , $field){ 
        return $this->db->get_where('t01_usuario_ma', array($table => trim($field)  ), 1)->num_rows() > 0 ? false : true; 
    }

    

    
}



