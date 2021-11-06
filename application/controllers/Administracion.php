<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administracion extends CI_Controller {
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
	}

	public function unidadesApoyos(){
		$this->load->model('Usuarios_model');
		$data['usuarios'] = $this->Usuarios_model->getUsers();
		$data['unidades'] = $this->Administracion_model->getUnidadesList();
		$this->load->view('plantillas/header');
		$this->load->view('administracion/unidades',$data);
		$this->load->view('plantillas/footer');
		$this->load->view('administracion/bot_unidades');
	}

	public function nuevoUsuario(){
		$this->load->library('encrypt');
		$data = array(
			'usuario' => 'Sistema',
			'password' => $this->encrypt->encode('123456'),
			'nombre' => 'Sistema Ayuntamiento',
			'id_tipo_usuario' => 1,
		);
		$this->db->insert('usuario',$data);
	}

	public function comunidades(){
		if($this->session->Charo2019['tipo_usuario']==3){
			$data['comunidades'] = $this->Administracion_model->getComunidadesList();
			$this->load->view('plantillas/header');
			$this->load->view('administracion/comunidades',$data);
			$this->load->view('plantillas/footer');
			$this->load->view('administracion/bot_comunidades');
		}else{
			redirect(base_url());
		}
	}

	public function beneficiarios(){
		if($this->session->Charo2019['tipo_usuario']==3){
			$this->load->view('plantillas/header');
			$this->load->view('administracion/beneficiarios');
			$this->load->view('plantillas/footer');
			$this->load->view('administracion/bot_beneficiarios');
		}else{
			redirect(base_url());
		}
	}

	public function editarBeneficiario($id_beneficiario=0){
		if($this->session->Charo2019['tipo_usuario']==3&&$id_beneficiario!=0){
			$data['beneficiario'] = $this->Apoyos_model->getBeneficiario($id_beneficiario);
			$data['totalApoyos'] = $this->Administracion_model->totalApoyos($id_beneficiario);
			$data['apoyos'] = $this->Administracion_model->apoyosBeneficiario($id_beneficiario);
			$this->load->view('plantillas/header');
			$this->load->view('administracion/editar_beneficiario',$data);
			$this->load->view('plantillas/footer');
			$this->load->view('administracion/bot_editar_beneficiario');
		}else{
			redirect(base_url());
		}
	}

	public function getSecciones(){
		echo $this->Administracion_model->getSecciones();
	}
	public function getComunidades(){
		echo $this->Administracion_model->getComunidades();
	}

	public function getBeneficiarios(){
	 	echo $this->Administracion_model->getBeneficiarios();	
	}

	public function guardarSeccion(){
		echo $this->Administracion_model->saveSeccion();
	}

	public function guardarComunidad(){
		echo $this->Administracion_model->saveComunidad();
	}

	public function dataSeccion(){
		echo $this->Administracion_model->dataSeccion();
	}

	public function dataComunidad(){
		echo $this->Administracion_model->dataComunidad();
	}

	public function getUnidades(){
		echo $this->Administracion_model->getUnidades();
	}
	public function getApoyos(){
		echo $this->Administracion_model->getApoyos();
	}

	public function guardarUnidad(){
		echo $this->Administracion_model->saveUnidad();
	}

	public function guardarApoyo(){
		echo $this->Administracion_model->saveApoyo();
	}

	public function dataUnidad(){
		echo $this->Administracion_model->dataUnidad();
	}

	public function dataApoyo(){
		echo $this->Administracion_model->dataApoyo();
	}

	public function limpiar(){
		$this->db->query('TRUNCATE apoyo');
		$this->db->query('TRUNCATE beneficiario');
		$this->db->query('TRUNCATE comunidad');
		$this->db->query('TRUNCATE solicitud');
		$this->db->query('TRUNCATE secciones');
		$this->db->query('TRUNCATE unidad');
	}

	public function asignarApoyos(){
		echo $this->Administracion_model->asignarApoyos();
	}

	public function eliminarBeneficiario(){
		echo $this->Administracion_model->eliminarBeneficiario();
	}
}
