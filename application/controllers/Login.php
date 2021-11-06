<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuarios_model');
    }

	public function index()
	{
		if ($this->session->Charo2019 != null) {
            redirect(base_url() . "Home");  // Si existe la sesion se redirige al panel de control
        }
		$this->load->view('plantillas/login');
	}

	public function iniciarSesion() {
        echo $this->Usuarios_model->iniciarSesion();
    }

    public function logOut(){
    	$this->Usuarios_model->logOut();
        redirect(base_url());
    }

    public function hash(){
        echo password_hash(123456,PASSWORD_DEFAULT);
    }
}
