<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
        parent::__construct();
        if ($this->session->Charo2019['id_usuario'] == null) {
            redirect(base_url()); 
        }
        $this->load->model('Apoyos_model');

    }

	public function index()
	{
		$data['pendientes'] = $this->Apoyos_model->numeroApoyosEstatus(1);
		$data['rechazados'] = $this->Apoyos_model->numeroApoyosEstatus(2);
		$data['autorizados'] = $this->Apoyos_model->numeroApoyosEstatus(3);
		$data['entregados'] = $this->Apoyos_model->numeroApoyosEstatus(4);
		$meses = $total = array();
		$fecha_actual = date("Y-m");
		for($i=4;$i>=0;$i--){
			$fecha =  date("Y-m",strtotime($fecha_actual."- ".$i." month"));
			$meses[] = $this->meses(date("m",strtotime($fecha)));
			$total[] = $this->Apoyos_model->totalFecha($fecha."-1",$fecha.'-31');
		}
		$data['meses'] = json_encode($meses);
		$data['total'] = json_encode($total);
		$this->load->view('plantillas/header');
		$this->load->view('plantillas/contenido',$data);
		$this->load->view('plantillas/footer');
		$this->load->view('plantillas/bot_home');
	}

	function meses($mes){
		$mes = $mes-1;
		$meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
		return $meses[$mes];
	}
}
