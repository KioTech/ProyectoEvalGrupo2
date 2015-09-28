<?php

class Inicio extends CI_Controller{
	public function __construct() {
        parent::__construct();
        //$this->load->model('busquedaCurp_model');
        $this->load->helper(array('url','form'));
        $this->load->library(array('form_validation'));
    }
    
    public function index() {
        $data['vista'] = $this->load->view('index');
        //$data['vista'] = $this->load->view('index', '', TRUE);
        //$this->load->view('templates/layout', $data);
    }

}

?>