<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct(){
    parent::__construct();
		date_default_timezone_set('America/Monterrey');
		if(!$this->session->userdata('logged_in')){
			//redirect('', 'location', 301);
		}			
    }



}
