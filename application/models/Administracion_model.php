<?php
class Administracion_model extends CI_Model {
	function __construct(){
		
	}

	function getSecciones(){
		$query = $this->db->query("select secciones.*,comunidad.comunidad from secciones join comunidad on comunidad.id_comunidad = secciones.id_comunidad order by seccion ASC");
		if($query->num_rows()>0){
	      	foreach($query->result() as $seccion){
		      	$data[] = array(
		      			'seccion'=>$seccion->seccion,
		      			'comunidad' => $seccion->comunidad,    			
		      			'accion'=>'<a href="javascript:;" class="btn btn-sm btn-success" onclick="editarSeccion('.$seccion->id_seccion.')"><i class="fa fa-edit"></i></a>'
		      		);
	      	}
	      	return json_encode($data);	
	    }else{
			return 0;
	    }	
	}

	function getComunidades(){
		$query = $this->db->query("SELECT comunidad.* FROM comunidad ORDER BY comunidad ASC");
		if($query->num_rows()>0){
	      	foreach($query->result() as $comunidad){
		      	$data[] = array(
		      			'comunidad'=>$comunidad->comunidad,   			
		      			'accion'=>'<a href="javascript:;" class="btn btn-sm btn-success" onclick="editarComunidad('.$comunidad->id_comunidad.')"><i class="fa fa-edit"></i></a>'
		      		);
	      	}
	      	return json_encode($data);	
	    }else{
			return 0;
	    }	
	}

	function getSeccionesList(){
		$this->db->order_by("seccion", "asc");
		return $this->db->get('secciones');
	}

	function getComunidadesList(){
		$this->db->order_by("comunidad", "asc");
		return $this->db->get('comunidad');
	}

	function saveSeccion(){
		$id_seccion = $this->input->post('id_seccion');
		$data = array('seccion'=>$this->input->post('seccion'),'id_comunidad'=>$this->input->post('id_comunidad'));
		if($id_seccion==0){
			$this->db->where('seccion',$this->input->post('seccion'));
			$seccion = $this->db->get('secciones');
			if($seccion->num_rows()==0){
				$this->db->insert('secciones',$data);
				return "success";
			}else{
				return "La sección ya se encuentra registrado";
			}
		}else{
			$this->db->where('id_seccion',$id_seccion);
			$this->db->update('secciones',$data);
			return "success";
		}
	}

	function dataSeccion(){
		$id_seccion = $this->input->post('id_seccion');
		$seccion = $this->db->query('select * from secciones where id_seccion = '.$id_seccion)->row();
		$data = array(
			'seccion' => $seccion->seccion,
			'id_comunidad' => $seccion->id_comunidad
		);
		return json_encode($data);
	}

	function saveComunidad(){
		$id_comunidad = $this->input->post('id_comunidad');
		$data = array(
			'comunidad'=>$this->input->post('comunidad')
		);
		if($id_comunidad==0){
			$this->db->where('comunidad',$this->input->post('comunidad'));
			$comunidad = $this->db->get('comunidad');
			if($comunidad->num_rows()==0){
				$this->db->insert('comunidad',$data);
				return "success";
			}else{
				return "Nombre de comunidad ya se encuentra registrado";
			}
		}else{
			$this->db->where('id_comunidad',$id_comunidad);
			$this->db->update('comunidad',$data);
			return "success";
		}
	}

	function dataComunidad(){
		$id_comunidad = $this->input->post('id_comunidad');
		$comunidad = $this->db->query('select * from comunidad where id_comunidad = '.$id_comunidad)->row();
		$data = array(
			'comunidad' => $comunidad->comunidad
		);
		return json_encode($data);
	}

	function getUnidades(){
		$query = $this->db->query("SELECT * FROM unidad order by unidad ASC");
		if($query->num_rows()>0){
	      	foreach($query->result() as $unidad){
		      	$data[] = array(
		      			'unidad'=>$unidad->unidad,     			
		      			'accion'=>'<a href="javascript:;" class="btn btn-sm btn-success" onclick="editarUnidad('.$unidad->id_unidad.')"><i class="fa fa-edit"></i></a>'
		      		);
	      	}
	      	return json_encode($data);	
	    }else{
			return 0;
	    }	
	}

	function getApoyos(){
		$query = $this->db->query("SELECT apoyo.*, unidad.unidad FROM apoyo JOIN unidad on unidad.id_unidad = apoyo.id_unidad ORDER BY apoyo ASC");
		if($query->num_rows()>0){
	      	foreach($query->result() as $apoyo){
		      	$data[] = array(
		      			'apoyo'=>$apoyo->apoyo,
		      			'unidad' => $apoyo->unidad,
		      			'costo' => '$'.number_format($apoyo->costo, 2, '.', ','),    			
		      			'accion'=>'<a href="javascript:;" class="btn btn-sm btn-success" onclick="editarApoyo('.$apoyo->id_apoyo.')"><i class="fa fa-edit"></i></a>'
		      		);
	      	}
	      	return json_encode($data);	
	    }else{
			return 0;
	    }	
	}



	function saveUnidad(){
		$id_unidad = $this->input->post('id_unidad');
		$data = array('unidad'=>$this->input->post('unidad'));
		if($id_unidad==0){
			$this->db->where('unidad',$this->input->post('unidad'));
			$unidad = $this->db->get('unidad');
			if($unidad->num_rows()==0){
				$this->db->insert('unidad',$data);
				return "success";
			}else{
				return "Nombre de unidad ya se encuentra registrado";
			}
		}else{
			$this->db->where('id_unidad',$id_unidad);
			$this->db->update('unidad',$data);
			return "success";
		}
		
	}

	function dataUnidad(){
		$id_unidad = $this->input->post('id_unidad');
		$unidad = $this->db->query('select * from unidad where id_unidad = '.$id_unidad)->row();
		$data = array(
			'unidad' => $unidad->unidad
		);
		return json_encode($data);
	}

	function saveApoyo(){
		$id_apoyo = $this->input->post('id_apoyo');
		$data = array(
			'apoyo' => $this->input->post('apoyo'),
			'id_unidad' => $this->input->post('id_unidad'),
			'costo' => $this->input->post('costo'),
			'descripcion' => $this->input->post('descripcion')
		);
		if($id_apoyo==0){
			$this->db->where('apoyo',$this->input->post('apoyo'));
			$unidad = $this->db->get('apoyo');
			if($unidad->num_rows()==0){
				$this->db->insert('apoyo',$data);
				return "success";
			}else{
				return "Nombre de apoyo ya se encuentra registrado";
			}
		}else{
			$this->db->where('id_apoyo',$id_apoyo);
			$this->db->update('apoyo',$data);
			return "success";
		}
	}

	function dataApoyo(){
		$id_apoyo = $this->input->post('id_apoyo');
		$apoyo = $this->db->query('select * from apoyo where id_apoyo = '.$id_apoyo)->row();
		$data = array(
			'apoyo' => $apoyo->apoyo,
			'id_unidad' => $apoyo->id_unidad,
			'costo' => $apoyo->costo,
			'descripcion' => $apoyo->descripcion
		);
		return json_encode($data);
	}

	function getBeneficiarios(){
		$query = "SELECT b.`id_beneficiario`, CONCAT(b.`nombre`,' ',b.`apPaterno`,' ',b.`apMaterno`) AS nombre, se.seccion, c.comunidad, CONCAT(b.direccion,' ',b.numero) as direccion, b.telefono
					FROM beneficiario AS b 
					JOIN secciones AS se ON se.`id_seccion` = b.`id_seccion`
					JOIN comunidad AS c ON c.`id_comunidad` = b.`id_comunidad`
					ORDER BY nombre ASC";
		$result = $this->db->query($query);
		if($result->num_rows()>0){
			foreach($result->result() as $beneficiario){
				$data[] = array(
					'id_beneficiario' => $beneficiario->id_beneficiario,
					'nombre' => $beneficiario->nombre,
					'seccion' => $beneficiario->seccion,
					'comunidad' => $beneficiario->comunidad,
					'direccion' => $beneficiario->direccion,
					'telefono' => $beneficiario->telefono,
					'accion' => '<a href="'.base_url().'Administracion/editarBeneficiario/'.$beneficiario->id_beneficiario.'" class="btn btn-sm btn-success")"><i class="fa fa-eye"></i></a>'
				);
			}
			return json_encode($data);
		}else{
			return 0;
		}
	}

	function getApoyosList(){
		$sql = "SELECT apoyo.*, unidad.`unidad`
		FROM apoyo
		JOIN unidad ON unidad.`id_unidad` = apoyo.`id_unidad`";
		return $this->db->query($sql);
	}

	function getUnidadesList(){
		$this->db->order_by('unidad','asc');
		return $this->db->get('unidad');
	}

	function totalApoyos($id_beneficiario){
		$query = $this->db->query("SELECT COUNT(*) AS total FROM solicitud WHERE id_beneficiario = ".$id_beneficiario);
		return $query->row()->total;
	}

	function apoyosBeneficiario($id_beneficiario){
		$sql = "SELECT e.estatus,e.color, COUNT(*) AS total 
				FROM solicitud AS s
				JOIN estatus_solicitud AS e ON e.`id_estatus_solicitud` = s.`id_estatus_solicitud`
				WHERE id_beneficiario = ".$id_beneficiario."
				GROUP BY e.`estatus`";
		return $this->db->query($sql);
	}

	function asignarApoyos(){
		$this->db->where('id_beneficiario',$this->input->post('id_beneficiario_destino'));
		$beneficiario = $this->db->get('beneficiario');
		$beneficiario_origen = $this->input->post('id_beneficiario_origen');
		$data = array(
			'id_beneficiario' => $this->input->post('id_beneficiario_destino'),
			'id_tenencia' => $beneficiario->row()->id_tenencia,
			'id_comunidad' => $beneficiario->row()->id_comunidad
		);
		$this->db->where('id_beneficiario',$beneficiario_origen);
		if($this->db->update('solicitud',$data))
			return "success";
		else
			echo "error";
	}

	function eliminarBeneficiario(){
		$id_beneficiario = $this->input->post('id_beneficiario');
		$this->db->where('id_beneficiario',$id_beneficiario);
		if($this->db->delete('beneficiario'))
			return 'success';
		else
			return 'error';
	}
	
}

	
