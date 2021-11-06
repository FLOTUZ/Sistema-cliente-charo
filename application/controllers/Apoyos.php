<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apoyos extends CI_Controller {
	public function __construct(){
        parent::__construct();
        if ($this->session->Charo2019['id_usuario'] == null) {
            redirect(base_url()); 
        }
    	$this->load->model('Administracion_model');
    	$this->load->model('Apoyos_model');
    	$this->load->model('Usuarios_model');
    }
    
	public function index()
	{
	}

	public function nuevo(){
		$data['apoyos'] = $this->Administracion_model->getApoyosList();
		$data['unidades'] = $this->Administracion_model->getUnidadesList();
		$data['beneficiarios'] = $this->Apoyos_model->getBeneficiarios();
		$data['secciones'] = $this->Administracion_model->getSeccionesList();
		$data['comunidades'] = $this->Administracion_model->getComunidadesList();
		$this->load->view('plantillas/header');
		$this->load->view('apoyos/nuevo',$data);
		$this->load->view('plantillas/footer');
		$this->load->view('apoyos/bot_nuevo');
	}

	public function listado(){
		$data['estatus'] = $this->Apoyos_model->getEstatus();
		$this->load->view('plantillas/header');
		$this->load->view('apoyos/listado',$data);
		$this->load->view('plantillas/footer');
		$this->load->view('apoyos/bot_listado');		
	}

	public function ifExisBeneficiario(){
		echo $this->Apoyos_model->ifExisBeneficiario();
	}

	public function saveBeneficiario(){
		echo $this->Apoyos_model->saveBeneficiario();
	}

	public function nuevaSolicitud(){
		echo $this->Apoyos_model->saveSolicitud();
	}

	public function ultimosCinco($id_beneficiario){
		$data['beneficiario'] = $this->Apoyos_model->getBeneficiario($id_beneficiario);
		$data['apoyos'] = $this->Apoyos_model->getUltimosCinco($id_beneficiario);
		$this->load->view('apoyos/ultimos_cinco',$data);
	}

	public function loadListado(){
		$data['estatus'] = $this->input->get('estatus');
		$data['fecha_inicio'] = $this->input->get('fecha_inicio');
		$data['fecha_final'] = $this->input->get('fecha_final');
		$this->load->view('apoyos/listado_load',$data);
	}

	public function loadListadoJson(){
		echo $this->Apoyos_model->loadListadoJson();
	}

	public function dataSolicitud(){
		echo $this->Apoyos_model->dataSolicitud();
	}

	public function autorizar(){
		echo $this->Apoyos_model->autorizar();
	}

	public function cambiarEstatus(){
		echo $this->Apoyos_model->cambiarEstatus();
	}

	public function dataBeneficiario(){
		echo $this->Apoyos_model->dataBeneficiario();
	}

	public function recibido(){
		$this->load->helper('generacionpdf');    
		$data['solicitud'] = json_decode($this->Apoyos_model->dataSolicitud());
        $meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
        $data['fecha'] = date('d')." de ".$meses[date('n')-1]." del ".date('Y');
        $html = $this->load->view('/pdf/recibido', $data, true);
        $filename = "formato_recibido";
        pdf_create($html,$filename);
	}

	public function solicitud(){
		$this->load->helper('generacionpdf');    
		$data['solicitud'] = json_decode($this->Apoyos_model->dataSolicitud());
        $meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
        $data['fecha'] = date('d')." de ".$meses[date('n')-1]." del ".date('Y');
        $html = $this->load->view('/pdf/solicitud', $data, true);
        $filename = "formato_solicitud";
        pdf_create($html,$filename);
	}

	public function editar($id_solicitud){
		$data['solicitud'] = $this->Apoyos_model->dataSolicitudId($id_solicitud);
		if(($this->session->Charo2019['id_usuario']==$data['solicitud']->id_usuario&&$data['solicitud']->id_estatus_solicitud==1)||($this->session->Charo2019['tipo_usuario']==3)){
			$data['apoyos'] = $this->Administracion_model->getApoyosList();
			$data['beneficiarios'] = $this->Apoyos_model->getBeneficiarios();
			$data['secciones'] = $this->Administracion_model->getSeccionesList();
			$data['comunidades'] = $this->Administracion_model->getComunidadesList();
			$this->load->view('plantillas/header');
			$this->load->view('apoyos/editar',$data);
			$this->load->view('plantillas/footer');
			$this->load->view('apoyos/bot_editar');
		}else{
			redirect(base_url()); 
		}
	}

	public function editarSolicitud(){
		echo $this->Apoyos_model->editarSolicitud();
	}

	public function eliminarSolicitud(){
		echo $this->Apoyos_model->eliminarSolicitud();
	}
}
