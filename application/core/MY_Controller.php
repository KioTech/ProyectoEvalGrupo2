<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    // Enable Profiler
    protected $_enable_profiler = FALSE;
    
    // Variables that pass to the view
	protected $nav;

	// This one for error logging...
	protected $error_log = "";

    public function __construct(){
    parent::__construct();
	date_default_timezone_set('America/Monterrey');

	if(!$this->session->userdata('logged_in')){
		redirect('inicio/index');
	}		
		
        // toggle the profiler on/off globally
        $this->output->enable_profiler($this->_enable_profiler);

		
    }



}
