<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	public function __construct(){
        parent::__construct();
        if ($this->session->Charo2019['id_usuario'] == null) {
            redirect(base_url()); 
        }
        $this->load->model('Usuarios_model');
    }
    
	public function index(){
		if($this->session->Charo2019['tipo_usuario']<3){
			redirect(base_url()); 
		}else{
			$data['tipo_usuarios'] = $this->Usuarios_model->getTipoUsuario();
			$this->load->view('plantillas/header');
			$this->load->view('administracion/usuarios',$data);
			$this->load->view('plantillas/footer');
			$this->load->view('administracion/bot_usuarios');
		}
	}

	public function getListado(){
		echo $this->Usuarios_model->getListado();
	}
	
	public function ifExisUser(){
        echo $this->Usuarios_model->ifExisUser();
    }

    public function addUser(){
        echo $this->Usuarios_model->addUser();
    }

    public function dataUsuario(){
        echo $this->Usuarios_model->dataUsuario();
    }

    public function updateUser(){
        echo $this->Usuarios_model->updateUser();
    }

    public function getAreasList(){
		echo $this->Usuarios_model->getAreasList();
	}

	public function dataArea(){
		echo $this->Usuarios_model->dataArea();
	}

	public function guardarArea(){
		echo $this->Usuarios_model->saveArea();
	}

	public function estadisticasArea(){
		echo $this->Usuarios_model->estadisticasArea();
	}

	public function miInformacion(){
		$data['informacion'] = $this->Usuarios_model->miinfo();
		$this->load->view('plantillas/header');
		$this->load->view('administracion/informacion',$data);
		$this->load->view('plantillas/footer');
		$this->load->view('administracion/bot_informacion');
	}

	public function cambiarPass(){
		echo $this->Usuarios_model->cambiarPass();
	}
}
