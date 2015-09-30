<?php

class Perfil extends MY_Controller{
	public function __construct() {
        parent::__construct();
        $this->load->model('signup_m');
        $this->load->helper(array('url','form'));
        $this->load->library(array('form_validation'));
    }
    
    public function index() {

        if ( trim($this->input->post('form_nombre')) != "" ) {        
        
            $this->form_validation->set_error_delimiters('<p>', '</p>');  
            $this->form_validation->set_rules('form_nombre', 'Nombre', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('form_ape_p', 'Apellido Paterno', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('form_ape_m', 'Apellido Materno', 'trim|max_length[50]');
            $this->form_validation->set_rules('form_correo', 'Correo Electronico', 'trim|required|valid_email|max_length[50]');
            $this->form_validation->set_rules('form_correo2', 'Correo Electronico', 'trim|required|valid_email|max_length[50]');
            $this->form_validation->set_rules('form_pass', 'Contraseña incorrecto', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('form_pass2', 'Contraseña incorrecta', 'trim|required|max_length[50]');

            $this->form_validation->set_rules('form_username', 'Username', 'trim|required|max_length[50]');            

            $this->form_validation->set_message('required', 'Campo %s es obligatorio');
            $this->form_validation->set_message('valid_email', 'Campo %s es invalido');

            if ($this->form_validation->run() == TRUE){ //validacion correocta se procede almacenar el registro
                
                $session_data = $this->signup_m->sign_in();             
                if ($session_data != false) {
                    $newdata = array(
                            'username'  => $session_data->Username_TXT,
                            'nombre'  => $session_data->Nombre_TXT,
                            'paterno'  => $session_data->ApPaterno_TXT,
                            'materno'  => $session_data->ApMaterno_TXT,
                            'email' => $session_data->Email_TXT,
                            'tipo_user' => $session_data->T04_tipousuario_I,
                            'fecha_registro' => $session_data->Registro_DT,
                            'estatus' => 'vigente',
                            'id_usuario' => $session_data->id,
                            'logged_in' => TRUE
                        );

                    $this->session->set_userdata($newdata);
                    redirect('', 'location', 301);
                    //echo "registro guardado exitosamente";
                    
                }else{ //Error al ingresar el registro                  
                    $this->data['vista'] = $this->load->view('nav', '', TRUE);
                    $this->data['vista'] .= $this->load->view('login/perfil_v', '', TRUE);
                    $this->load->view('templates/layout', $this->data);
                }
                
            }else{
                $this->data['vista'] = $this->load->view('nav', '', TRUE);
                $this->data['vista'] .= $this->load->view('login/perfil_v', '', TRUE);
                $this->load->view('templates/layout', $this->data);
            } 

        }else{                
            $this->data['vista'] = $this->load->view('nav_session', '', TRUE);
            $this->data['vista'] .= $this->load->view('login/perfil_v', '', TRUE);
            $this->load->view('templates/layout', $this->data);
        }

    }

}

?>