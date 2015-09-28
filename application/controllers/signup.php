<?php

class Signup extends CI_Controller{
	public function __construct() {
        parent::__construct();
        date_default_timezone_set("America/Mexico_City");
        $this->load->model('signup_m');
        $this->load->helper(array('url','form'));
        $this->load->library('form_validation');

    }
    
    public function index() {    	
        

        if ( trim($this->input->post('form_nombre')) != "" ) {        
       	
            $this->form_validation->set_error_delimiters('', '');  
        	$this->form_validation->set_rules('form_nombre', 'Nombre', 'trim|required|max_length[50]');
        	$this->form_validation->set_rules('form_ape_p', 'Apellido Paterno', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('form_ape_m', 'Apellido Materno', 'trim|required|max_length[50]');
        	$this->form_validation->set_rules('form_correo', 'Correo Electronico', 'trim|required|valid_email|max_length[50]');
        	$this->form_validation->set_rules('form_correo2', 'Correo Electronico', 'trim|required|valid_email|max_length[50]');
        	$this->form_validation->set_rules('form_pass', 'Contraseña incorrecto', 'trim|required|max_length[50]');
        	$this->form_validation->set_rules('form_pass2', 'Contraseña incorrecta', 'trim|required|max_length[50]');

            $this->form_validation->set_rules('form_username', 'Username', 'trim|required|max_length[50]');

            

        	//$this->form_validation->set_message('required', 'Campo %s es obligatorio');

        	if ($this->form_validation->run() == TRUE){ //validacion correocta se procede almacenar el registro
				
				$record = $this->signup_m->record();				
				if ($record) {
				    echo "registro guardado exitosamente";
					
				}else{ //Error al ingresar el registro
					echo "Error al registrar ";
					//redirect('url', 'location', 301);
				}
				
			}else{
				echo "Error de validacion";
			} 

        }else{
        	      $this->load->view('signup_v');
        }


    }

    public function check_username(){       

        if ( trim($this->input->post('username')) != "" ){
            $respuesta = $this->signup_m->check_imput_m('Username_TXT',$this->input->post('username'));
            echo json_encode($respuesta);
        }else{
            echo json_encode(false);
        }
    }

    public function check_email(){      

        if ( trim($this->input->post('emailcheck')) != "" ){
            $respuesta = $this->signup_m->check_imput_m('Email_TXT',$this->input->post('emailcheck'));
            echo json_encode($respuesta);
        }else{
            echo json_encode(false);
        }
    }


    




}

