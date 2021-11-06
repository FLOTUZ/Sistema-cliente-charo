<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sanitizar extends CI_Controller {
	public function __construct(){
        parent::__construct();
    }
    
	public function index(){
		if ($this->session->Sanitizar != null) {
            redirect(base_url() . "Sanitizar/listado");
        }
		$this->load->view('sanitizar/login');
	}

	public function iniciarSesion(){
		if(($this->input->post('usuario')=='amiko'&&$this->input->post('password')=='okima')||($this->input->post('usuario')=='amiko2'&&$this->input->post('password')=='okima2')){
			$id = 2;
			if($this->input->post('usuario')=='amiko2')
				$id = 1;
			$data= array(
				'id_usuario' => $id
			);
			$this->session->unset_userdata("Sanitizar");
			$this->session->set_userdata("Sanitizar",$data);
			echo "success";
		}else{
			echo 0;
		}
	}

	public function listado(){
		if ($this->session->Sanitizar != null) {
            $this->db->order_by('estatus','ASC');
			$data['listado'] = $this->db->get('sanitizar');
			$this->load->view('sanitizar/listado',$data);
        }else{
        	redirect(base_url() . "Sanitizar");
        }		
	}

	public function exportarPDF(){
		$this->db->order_by('estatus','ASC');
		$data['listado'] = $this->db->get('sanitizar');
		$this->load->helper('generacionpdf');    
		$html = $this->load->view('/pdf/listado_sanitizar', $data, true);
        $filename = "listado";
        pdf_create($html,$filename);
	}

	public function guardar(){
		if($this->input->post('fecha')){
			$fecha = $this->input->post('fecha');
		}else{
			$fecha = '0001-01-01';
		}
		$data = array(
			'responsable' => $this->input->post('responsable'),
			'direccion' => $this->input->post('direccion'),
			'giro' => $this->input->post('giro'),
			'fecha' => $fecha,
			'estatus' => $this->input->post('estatus'),
			'telefono' => $this->input->post('telefono')
		);
		if($this->input->post('id_sanitizar')==0){
			if($this->db->insert('sanitizar',$data))
				echo $this->db->insert_id();
			else
				echo "error";
		}else{
			$this->db->where('id_sanitizar',$this->input->post('id_sanitizar'));
			$this->db->update('sanitizar',$data);
			echo $this->input->post('id_sanitizar');
		}
	}

	public function sanitizado(){
		$this->db->where('id_sanitizar',$this->input->post('id_sanitizar'));
		if($this->db->update('sanitizar',array('estatus'=>$this->input->post('estatus')))){
			echo "success";
		}else{
			echo "error";
		}
	}

	public function cerrarSesion(){
		$this->session->unset_userdata("Sanitizar");
		redirect(base_url() . "Sanitizar");
	}

	public function getSanitizar(){
		$this->db->where('id_sanitizar',$this->input->post('id_sanitizar'));
		$row = $this->db->get('sanitizar')->row();
		echo json_encode($row);
	}

	public function eliminar(){
		$this->db->where('id_sanitizar',$this->input->post('id_sanitizar'));
		$this->db->delete('sanitizar');
		echo "success";
	}
}
