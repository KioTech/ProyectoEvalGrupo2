<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proyectos extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
	}

	public function _example_output($output = null, $data=null)
	{
                $data['title']="PROYECTOS";
		$this->load->view('ListaProyectos',$output, $data);
	}

	
	public function index()
	{
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}

	public function projects()
	{
		try{
			$crud = new grocery_CRUD();

			//$crud->set_theme('datatables');
			$crud->set_table('t05_proyecto_ma');
			$crud->set_subject('Proyecto');
			$crud->columns('Nombre_TXT','Resumen_TXT','ImagenProyecto_TXT','VideoProyecto_TXT','Descripcion_TXT');
                        $crud->fields('Nombre_TXT','Resumen_TXT','ImagenProyecto_TXT','VideoProyecto_TXT','Descripcion_TXT');
                         $crud->display_as('Nombre_TXT', 'Nombre del proyecto')
                        ->display_as('Resumen_TXT', 'Resumen')
                        ->display_as('ImagenProyecto_TXT', 'Imagen')
                        ->display_as('VideoProyecto_TXT', 'Video')
                        ->display_as('Descripcion_TXT', 'Descripción');
                        $crud->set_field_upload('ImagenProyecto_TXT', 'assets/uploads/proyectos');
                        $crud->set_field_upload('VideoProyecto_TXT', 'assets/uploads/proyectos');
                        $crud->required_fields('Nombre_TXT','Resumen_TXT','Descripcion_TXT');
                        $crud->edit_fields('Resumen_TXT','Descripcion_TXT');
			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	

}