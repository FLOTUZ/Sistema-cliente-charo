<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informacion extends CI_Controller {

	public function __construct(){
        parent::__construct();
        if ($this->session->Charo2019['id_usuario'] == null) {
            redirect(base_url()); 
        }
        $this->load->model('Administracion_model');
    	$this->load->model('Apoyos_model');
    }
    
	public function index()
	{
		$this->load->view('plantillas/header');
		$this->load->view('informacion/tenencias');
		$this->load->view('plantillas/footer');
		$this->load->view('informacion/bot_tenencias');
	}

	public function personas()
	{
		$data['beneficiarios'] = $this->Apoyos_model->getBeneficiarios();
		$this->load->view('plantillas/header');
		$this->load->view('informacion/personas',$data);
		$this->load->view('plantillas/footer');
		$this->load->view('informacion/bot_personas');
	}

	public function loadPersonas(){
		$data['beneficiario'] = $this->input->get('beneficiario');
		$data['fecha_inicio'] = $this->input->get('fecha_inicio');
		$data['fecha_final'] = $this->input->get('fecha_final');
		$this->load->view('informacion/personas_load',$data);
	}

	public function loadPersonasJson(){
		$id_beneficiario = $this->input->post('beneficiario');
		$where = 'WHERE s.id_beneficiario ='.$id_beneficiario;
		if($this->input->post('fecha_inicio')!=''&&$this->input->post('fecha_final')!=''){
			$where .= ' AND s.fecha >= "'.$this->input->post('fecha_inicio').'" and s.fecha <= "'.$this->input->post('fecha_final').'"';
		}
		echo $this->Apoyos_model->loadListadoJsonWhere($where);
	}

	public function tenencias(){
		$data['secciones'] = $this->Administracion_model->getSeccionesList();
		$data['comunidades'] = $this->Administracion_model->getComunidadesList();
		$this->load->view('plantillas/header');
		$this->load->view('informacion/tenencias',$data);
		$this->load->view('plantillas/footer');
		$this->load->view('informacion/bot_tenencias');
	}

	public function loadTenencias(){
		$data['seccion'] = $this->input->get('seccion');
		$data['comunidad'] = $this->input->get('comunidad');
		$data['fecha_inicio'] = $this->input->get('fecha_inicio');
		$data['fecha_final'] = $this->input->get('fecha_final');
		$this->load->view('informacion/tenencias_load',$data);
	}

	public function loadTenenciasJson(){
		$id_comunidad = $this->input->post('comunidad');
		$where = 'WHERE be.id_comunidad ='.$id_comunidad;
		if($this->input->post('seccion')>0)
			$where .= ' AND be.id_seccion ='.$this->input->post('seccion');
		if($this->input->post('fecha_inicio')!=''&&$this->input->post('fecha_final')!=''){
			$where .= ' AND s.fecha >= "'.$this->input->post('fecha_inicio').'" and s.fecha <= "'.$this->input->post('fecha_final').'"';
		}
		echo $this->Apoyos_model->loadListadoJsonWhere($where);
	}

	public function apoyos(){
		$data['apoyos'] = $this->Administracion_model->getApoyosList();
		$this->load->view('plantillas/header');
		$this->load->view('informacion/apoyos',$data);
		$this->load->view('plantillas/footer');
		$this->load->view('informacion/bot_apoyos');
	}

	public function loadApoyos(){
		$data['apoyo'] = $this->input->get('apoyo');
		$data['fecha_inicio'] = $this->input->get('fecha_inicio');
		$data['fecha_final'] = $this->input->get('fecha_final');
		$data['totalApoyos'] = $this->Apoyos_model->getTotal($data['apoyo']);
		$this->load->view('informacion/apoyos_load',$data);
	}

	public function loadApoyosJson(){
		$id_apoyo = $this->input->post('apoyo');
		$where = 'WHERE s.id_apoyo ='.$id_apoyo;
		if($this->input->post('fecha_inicio')!=''&&$this->input->post('fecha_final')!=''){
			$where .= ' AND s.fecha >= "'.$this->input->post('fecha_inicio').'" and s.fecha <= "'.$this->input->post('fecha_final').'"';
		}
		echo $this->Apoyos_model->loadListadoJsonWhere($where);
	}
}
