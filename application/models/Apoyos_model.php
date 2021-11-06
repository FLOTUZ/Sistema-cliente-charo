<?php
class Apoyos_model extends CI_Model {
	function __construct(){
		
	}

	function ifExisBeneficiario(){
		$nombre = $this->input->post('nombre');
		$paterno = $this->input->post('paterno');
		$materno = $this->input->post('materno');
		$query = $this->db->query("SELECT * FROM beneficiario where nombre = '".$nombre."' and apPaterno = '".$paterno."' and apMaterno = '".$materno."'");
		if($query->num_rows()>0)
			return "error1";
		else{
			return false;
		}
	}

	function saveBeneficiario(){
		$codigo = $this->generarCodigo();
		$data = array(
			'nombre' => $this->input->post('nombre'),
			'apPaterno' => $this->input->post('apPaterno'),
			'apMaterno' => $this->input->post('apMaterno'),
			'id_seccion' => $this->input->post('seccion'),
			'id_comunidad' => $this->input->post('comunidad'),
			'direccion' => $this->input->post('direccion'),
			'numero' => $this->input->post('numero'),
			'telefono' => $this->input->post('telefono'),
			'id_usuario_registro' => $this->session->Charo2019['id_usuario'],
			'codigo' => $codigo
		);
		if($this->input->post('id_beneficiario')==0){
			if($this->db->insert('beneficiario',$data))
				return $this->db->insert_id();
			else
				return "error";
		}else{
			$this->db->where('id_beneficiario',$this->input->post('id_beneficiario'));
			$this->db->update('beneficiario',$data);
			return $this->input->post('id_beneficiario');
		}
	}

	function generarCodigo(){
		$codigo = rand(10000,99999);
		$this->db->where('codigo',$codigo);
		$query = $this->db->get('beneficiario');
		if($query->num_rows()>0)
			$this->generarCodigo();
		else
			return $codigo;
	}

	function getBeneficiarios(){
		$this->db->order_by("nombre", "asc");
		return $this->db->get('beneficiario');
	}

	function saveSolicitud(){
		$id_beneficiario = $this->input->post('id_beneficiario');
		$data = array(
			'id_beneficiario' => $id_beneficiario,
			'id_apoyo' => $this->input->post('id_apoyo'),
			'cantidad' => $this->input->post('cantidad'),
			'fecha' => $this->input->post('fecha'),
			'id_usuario' => $this->session->Charo2019['id_usuario'],
			'id_estatus_solicitud' => 1,
			'descuento' => $this->input->post('descuento'),
			'total' => $this->input->post('total')
		);
		if($this->db->insert('solicitud',$data)){
			if($this->input->post('autorizado')==1){
				$id_solicitud = $this->db->insert_id();
				$data = array(
					'id_estatus_solicitud' => 3,
					'id_usuario_autorizo' => $this->session->Charo2019['id_usuario'],
					'cantidad_autorizada' => $this->input->post('cantidad'),
					'fecha_autorizo' 	  => $this->input->post('fecha_autorizado')
				);
				if($this->input->post('entregado')==1){
					$data['id_usuario_entrega'] = $this->session->Charo2019['id_usuario'];
					$data['fecha_entrega'] = $this->input->post('fecha_entregado');
					$data['id_estatus_solicitud'] = 4;
 				}
				$this->db->where('id_solicitud',$id_solicitud);
				$this->db->update('solicitud',$data);
			}
			return "success";
		}else{
			return "error";
		}
	}

	function getBeneficiario($id_beneficiario){
		$query = "SELECT be.*, co.`comunidad`, se.`seccion`
				FROM beneficiario AS be
				JOIN comunidad AS co ON co.`id_comunidad` = be.`id_comunidad`
				JOIN secciones AS se ON se.`id_seccion` = be.`id_seccion`
				WHERE be.`id_beneficiario` = ".$id_beneficiario;
		return $this->db->query($query)->row();
	}

	function getUltimosCinco($id_beneficiario){
		$query= "SELECT s.*, u.nombre, es.`estatus`,ap.`apoyo`,un.`unidad`, ua.`nombre` AS autorizo, ue.`nombre` as entrego
				FROM solicitud AS s 
				JOIN usuario AS u ON s.`id_usuario` = u.`id_usuario` 
				JOIN estatus_solicitud AS es ON es.`id_estatus_solicitud` = s.`id_estatus_solicitud` 
				JOIN apoyo AS ap ON ap.`id_apoyo` = s.`id_apoyo`
				JOIN unidad AS un ON un.`id_unidad` = ap.`id_unidad`
				LEFT JOIN usuario AS ua ON s.`id_usuario_autorizo` = ua.`id_usuario` 
				LEFT JOIN usuario as ue ON s.`id_usuario_entrega` = ue.`id_usuario` 
				WHERE s.`id_beneficiario` = ".$id_beneficiario."
				ORDER BY s.id_solicitud DESC LIMIT 10";
		return $this->db->query($query);
	}

	function getEstatus(){
		return $this->db->get('estatus_solicitud');
	}

	function getListado($id_beneficiario){
		$query= "SELECT s.*, u.nombre, es.`estatus`,ap.`apoyo`,un.`unidad`, ua.`nombre` AS autorizo
				FROM solicitud AS s 
				JOIN usuario AS u ON s.`id_usuario` = u.`id_usuario` 
				JOIN estatus_solicitud AS es ON es.`id_estatus_solicitud` = s.`id_estatus_solicitud` 
				JOIN apoyo AS ap ON ap.`id_apoyo` = s.`id_apoyo`
				JOIN unidad AS un ON un.`id_unidad` = s.`id_unidad`
				LEFT JOIN usuario AS ua ON s.`id_usuario_autorizo` = ua.`id_usuario` 
				WHERE s.`id_beneficiario` = ".$id_beneficiario."
				ORDER BY s.`fecha` DESC LIMIT 5";
		return $this->db->query($query);
	}

	function loadListadoJson(){
		$where = '';
		if($this->input->post('estatus')>0){
			$where = 'WHERE s.id_estatus_solicitud = '.$this->input->post('estatus');
		}
		if($this->input->post('fecha_inicio')!=''&&$this->input->post('fecha_final')!=''){
			if($where==''){
				$where = 'WHERE s.fecha >= "'.$this->input->post('fecha_inicio').'" and s.fecha <= "'.$this->input->post('fecha_final').'"';
			}else{
				$where .= ' AND s.fecha >= "'.$this->input->post('fecha_inicio').'" and s.fecha <= "'.$this->input->post('fecha_final').'"';
			}
		}
		$sql = "SELECT s.*,CONCAT(be.`nombre`,' ',be.`apPaterno`,' ',be.`apMaterno`) as beneficiario, u.nombre as nombreU, es.`estatus`,es.`color`,ap.`apoyo`,un.`unidad`, ua.`nombre` AS autorizo
				FROM solicitud AS s 
				JOIN beneficiario as be ON be.`id_beneficiario` = s.`id_beneficiario`
				JOIN usuario AS u ON s.`id_usuario` = u.`id_usuario` 
				JOIN estatus_solicitud AS es ON es.`id_estatus_solicitud` = s.`id_estatus_solicitud` 
				JOIN apoyo AS ap ON ap.`id_apoyo` = s.`id_apoyo`
				JOIN unidad AS un ON un.`id_unidad` = ap.`id_unidad`
				LEFT JOIN usuario AS ua ON s.`id_usuario_autorizo` = ua.`id_usuario` 
				".$where."
				ORDER BY s.`fecha` ASC";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
	      	foreach($query->result() as $solicitud){
	      		$editar = '';
	      		if(($this->session->Charo2019['id_usuario']==$solicitud->id_usuario&&$solicitud->id_estatus_solicitud==1)||($this->session->Charo2019['tipo_usuario']==3))
	      			$editar = '<a href="'.base_url().'Apoyos/editar/'.$solicitud->id_solicitud.'" class="btn btn-sm btn-info m-1"><i class="fa fa-edit"></i></a>';
		      	$data[] = array(
		      			'folio'       =>str_pad($solicitud->id_solicitud, 10, "0", STR_PAD_LEFT),
		      			'fecha'		  =>$solicitud->fecha,
		      			'beneficiario' =>$solicitud->beneficiario,    
		      			'apoyo'		  =>$solicitud->apoyo,
		      			'cantidad'	  =>$solicitud->cantidad,
		      			'unidad'      =>$solicitud->unidad,   
		      			'estatus'	  =>'<span class="text-'.$solicitud->color.'">'.$solicitud->estatus.'</span>',  
		      			'registro'	  =>$solicitud->nombreU,
		      			'cantidadAu'  =>$solicitud->cantidad_autorizada,       			
		      			'accion'	  =>'<a href="javascript:;" title="Seguimiento" class="btn btn-sm btn-success" onclick="informacion('.$solicitud->id_solicitud.')"><i class="fa fa-eye"></i></a> '.$editar);
	      	}
	      	return json_encode($data);	
	    }else{
			return 0;
	    }	
	}

	function dataSolicitud(){
		$id_solicitud = $this->input->post('id_solicitud');
		$sql = "SELECT s.*,CONCAT(be.`nombre`,' ',be.`apPaterno`,' ',be.`apMaterno`) as beneficiario, u.nombre as nombreU, es.`estatus`,es.`color`,ap.`apoyo`,ap.`costo`,un.`unidad`, ua.`nombre` AS autorizo, ue.`nombre` as entrego, co.`comunidad`, se.`seccion`
				FROM solicitud AS s 
				JOIN beneficiario as be ON be.`id_beneficiario` = s.`id_beneficiario`
				JOIN usuario AS u ON s.`id_usuario` = u.`id_usuario` 
				JOIN estatus_solicitud AS es ON es.`id_estatus_solicitud` = s.`id_estatus_solicitud` 
				JOIN apoyo AS ap ON ap.`id_apoyo` = s.`id_apoyo`
				JOIN unidad AS un ON un.`id_unidad` = ap.`id_unidad`
				JOIN comunidad AS co ON co.`id_comunidad` = be.`id_comunidad`
				JOIN secciones AS se ON se.`id_seccion` = be.`id_seccion`
				LEFT JOIN usuario AS ua ON s.`id_usuario_autorizo` = ua.`id_usuario` 
				LEFT JOIN usuario AS ue ON s.`id_usuario_entrega` = ue.`id_usuario` 
				WHERE s.`id_solicitud` = ".$id_solicitud;
		$solicitud = $this->db->query($sql)->row();
		$data = array(
			'folio' => str_pad($id_solicitud, 10, "0", STR_PAD_LEFT),
			'nombre' => $solicitud->beneficiario,
			'seccion' => $solicitud->seccion,
			'comunidad' => $solicitud->comunidad,
			'cantidad' => $solicitud->cantidad,
			'unidad' => $solicitud->unidad,
			'apoyo' => $solicitud->apoyo,
			'fecha' => $solicitud->fecha,
			'estatus' => '<span class="text-'.$solicitud->color.'">'.$solicitud->estatus.'</span>',
			'id_estatus' => $solicitud->id_estatus_solicitud,
			'autorizo' => $solicitud->autorizo,
			'cautorizada' => $solicitud->cantidad_autorizada,
			'fecha_autorizo' => $solicitud->fecha_autorizo,
			'descuento' => '$'.number_format($solicitud->descuento, 2, '.', ','),
			'motivo_rechazo' => $solicitud->motivo_rechazo,
			'entrego' => $solicitud->entrego,
			'costo' => '$'.number_format($solicitud->costo, 2, '.', ','),
			'total' => '$'.number_format($solicitud->total, 2, '.', ','),
			'total2' => $solicitud->total
		);
		return json_encode($data);
	}

	function autorizar(){
		$id_solicitud = $this->input->post('id_solicitud');
		$data = array(
			'id_estatus_solicitud' => 3,
			'id_usuario_autorizo' => $this->session->Charo2019['id_usuario'],
			'cantidad_autorizada' => $this->input->post('cantidad_autorizar'),
			'fecha_autorizo' 	  => $this->input->post('fecha_autorizo'),
			'total' 	  => $this->input->post('total_autorizo')
		);
		$this->db->where('id_solicitud',$id_solicitud);
		if($this->db->update('solicitud',$data))
			return "success";
		else
			return "error";
	}

	function cambiarEstatus(){
		$id_solicitud = $this->input->post('id_solicitud');
		$data = array(
			'id_estatus_solicitud' => $this->input->post('estatus'),
			'motivo_rechazo' => $this->input->post('motivoRechazo')
		);
		if($this->input->post('estatus')==2){
			$data['id_usuario_autorizo'] = $this->session->Charo2019['id_usuario'];
		}
		if($this->input->post('estatus')==4){
			$data['id_usuario_entrega'] = $this->session->Charo2019['id_usuario'];
			$data['fecha_entrega'] = date('Y-m-d');
		}
		$this->db->where('id_solicitud',$id_solicitud);
		if($this->db->update('solicitud',$data))
			return "success";
		else
			return "error";
	}

	function loadListadoJsonWhere($where){
		$sql = "SELECT s.*,CONCAT(be.`nombre`,' ',be.`apPaterno`,' ',be.`apMaterno`) as beneficiario, u.nombre as nombreU, es.`estatus`,es.`color`,ap.`apoyo`,un.`unidad`, ua.`nombre` AS autorizo
				FROM solicitud AS s 
				JOIN beneficiario as be ON be.`id_beneficiario` = s.`id_beneficiario`
				JOIN usuario AS u ON s.`id_usuario` = u.`id_usuario` 
				JOIN estatus_solicitud AS es ON es.`id_estatus_solicitud` = s.`id_estatus_solicitud` 
				JOIN apoyo AS ap ON ap.`id_apoyo` = s.`id_apoyo`
				JOIN unidad AS un ON un.`id_unidad` = ap.`id_unidad`
				LEFT JOIN usuario AS ua ON s.`id_usuario_autorizo` = ua.`id_usuario` 
				".$where."
				 ORDER BY s.`fecha` ASC";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
	      	foreach($query->result() as $solicitud){
	      		$editar = '';
	      		if(($this->session->Charo2019['id_usuario']==$solicitud->id_usuario&&$solicitud->id_estatus_solicitud==1)||($this->session->Charo2019['tipo_usuario']==3))
	      			$editar = '<a href="'.base_url().'Apoyos/editar/'.$solicitud->id_solicitud.'" class="btn btn-sm btn-info m-1"><i class="fa fa-edit"></i></a>';
		      	$data[] = array(
		      			'folio'       =>str_pad($solicitud->id_solicitud, 10, "0", STR_PAD_LEFT),
		      			'fecha'		  =>$solicitud->fecha,
		      			'beneficiario' =>$solicitud->beneficiario,    
		      			'apoyo'		  =>$solicitud->apoyo,
		      			'cantidad'	  =>$solicitud->cantidad,
		      			'unidad'      =>$solicitud->unidad,   
		      			'estatus'	  =>'<span class="text-'.$solicitud->color.'">'.$solicitud->estatus.'</span>',  
		      			'registro'	  =>$solicitud->nombreU,
		      			'cantidadAu'  =>$solicitud->cantidad_autorizada,       			
		      			'accion'	  =>'<a href="javascript:;" class="btn btn-sm btn-success" onclick="informacion('.$solicitud->id_solicitud.')"><i class="fa fa-exchange"></i></a>'.$editar
		      		);
	      	}
	      	return json_encode($data);	
	    }else{
			return 0;
	    }	
	}

	function numeroApoyosEstatus($id_estatus){
		$sql = "SELECT COUNT(*) AS total FROM solicitud WHERE id_estatus_solicitud = ".$id_estatus;
		$query = $this->db->query($sql);
		return $query->row()->total;
	}

	function totalFecha($fecha_inicio,$fecha_final){
		$sql = "SELECT COUNT(*) AS total FROM solicitud WHERE fecha >= '".$fecha_inicio."' and fecha <= '".$fecha_final."'";
		$query = $this->db->query($sql);
		return $query->row()->total;
	}

	function dataBeneficiario(){
		$id_beneficiario = $this->input->post('id_beneficiario');
		$this->db->where('id_beneficiario',$id_beneficiario);
		$beneficiario = $this->db->get('beneficiario')->row();
		$data = array(
			'nombre' => $beneficiario->nombre,
			'apPaterno' => $beneficiario->apPaterno ,
			'apMaterno' => $beneficiario->apMaterno ,
			'id_seccion' => $beneficiario->id_seccion ,
			'id_comunidad' => $beneficiario->id_comunidad ,
			'direccion' => $beneficiario->direccion ,
			'numero' => $beneficiario->numero ,
			'telefono' => $beneficiario->telefono,
		);
		return json_encode($data);
	}

	function getTotal($id_apoyo){
		$sql = "SELECT SUM(s.cantidad_autorizada) AS total, u.unidad
			FROM solicitud AS s
			LEFT JOIN apoyo AS ap ON ap.`id_apoyo` = s.`id_apoyo`
			LEFT JOIN unidad AS u ON u.`id_unidad` = ap.`id_unidad`
			WHERE s.`id_apoyo` = ".$id_apoyo." AND s.`id_estatus_solicitud` = 4
			GROUP BY u.`unidad`
			ORDER BY u.`unidad` DESC";
		return $this->db->query($sql);
	}

	function dataSolicitudId($id_solicitud){
		$query = "SELECT s.*,CONCAT(be.`nombre`,' ',be.`apPaterno`,' ',be.`apMaterno`) as beneficiario
				FROM solicitud AS s 
				JOIN beneficiario as be ON be.`id_beneficiario` = s.`id_beneficiario` 
				where s.`id_solicitud` = ".$id_solicitud;
		return $this->db->query($query)->row();
	}

	function editarSolicitud(){
		$id_beneficiario = $this->input->post('id_beneficiario');
		$this->db->where('id_beneficiario',$id_beneficiario);
		$beneficiario = $this->db->get('beneficiario')->row();
		$id_solicitud = $this->input->post('id_solicitud');
		$data = array(
			'id_beneficiario' => $id_beneficiario,
			'id_apoyo' => $this->input->post('id_apoyo'),
			'cantidad' => $this->input->post('cantidad'),
			'fecha' => $this->input->post('fecha')
		);
		$this->db->where('id_solicitud',$id_solicitud);
		if($this->db->update('solicitud',$data))
			return "success";
		else
			return "error";
	}

	function eliminarSolicitud(){
		$id_solicitud = $this->input->post('id_solicitud');
		$this->db->where('id_solicitud',$id_solicitud);
		if($this->db->delete('solicitud')){
			return "success";
		}else{
			return "error";
		}
	}
	
}

	
