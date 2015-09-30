<?php

class Inicio extends CI_Controller{
	public function __construct() {
        parent::__construct();
        //$this->load->model('busquedaCurp_model');
        $this->load->helper(array('url','form'));
        $this->load->library(array('form_validation'));
    }
    
    public function index() {
//        $data['vista'] = $this->load->view('index');
        if($this->session->userdata('logged_in')){
            $this->data['vista'] = $this->load->view('nav_session', '', TRUE);
        }else{
            $this->data['vista'] = $this->load->view('nav', '', TRUE);
        }   

        
        $this->data['vista'] .= $this->load->view('index', '', TRUE);
        $this->load->view('templates/layout', $this->data);
    }

    public function log_out(){
        $this->session->sess_destroy();
        redirect('', 'location', 301);
    }
    public function perfil(){
        
    }

}

?>