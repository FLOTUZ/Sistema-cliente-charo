<?php
class Usuarios_model extends CI_Model {
	function __construct(){
	}

	public function iniciarSesion() {
		try {			
			$usuario  =	$this->input->post("usuario",TRUE);
			$password =	$this->input->post("password",TRUE);
			
			$sql='SELECT * from usuario where usuario=? ORDER By id_usuario';
			$user=$this->db->query($sql,array($usuario));
			
			if($user->num_rows()>0){
				if( (password_verify($password,$user->row()->password)==true)){
					$data= array(
						'id_usuario' => $user->row()->id_usuario,
						'usuario' => $user->row()->usuario,
						'nombre_usuario' => $user->row()->nombre,
						'tipo_usuario' => $user->row()->id_tipo_usuario
					);
					$this->session->unset_userdata("Charo2019");
					$this->session->set_userdata("Charo2019",$data);
					$this->db->where('id_usuario',$user->row()->id_usuario);
					$this->db->update('usuario',array('ultimo_ingreso' => date("Y-m-d H:i:s")));
					echo "success";					
				}	
				else{
					if($user->row()->estatus_usuario==0){
						echo "error4"; //el usuario no ha sido activado
					}else{
						echo "error1"; //error en password 
					}					
				}
			}
			else{
				echo "error2"; //error usuario no existe
			}
			
		} catch (Exception $e) {
			echo "error3";
		}
	}

	public function logOut(){
		$this->session->unset_userdata("Charo2019");
	}

	function getListado(){
		$query = $this->db->query("
			SELECT u.*,tipo_usuario.tipo_usuario
			from usuario as u 
			join tipo_usuario on u.id_tipo_usuario = tipo_usuario.id_tipo_usuario
			order by u.nombre ASC");
		if($query->num_rows()>0){
	      	foreach($query->result() as $usuario){
		      	$data[] = array(
		      			'usuario'=>$usuario->usuario,
		      			'nombre'=>$usuario->nombre,
		      			'tipo'=>$usuario->tipo_usuario,
		      			'ultimo_ingreso'=>$usuario->ultimo_ingreso,		      			
		      			'accion'=>'<a href="javascript:;" class="btn btn-sm btn-success" onclick="editar('.$usuario->id_usuario.')"><i class="fa fa-edit"></i></a>'
		      		);
	      	}
	      	return json_encode($data);	
	    }else{
			return 0;
	    }	
	}

	public function ifExisUser(){
		$idUsuario = $this->input->post('id_usuario');
		$user = $this->input->post("usuario");	
		$sql='SELECT usuario, id_usuario from usuario where usuario=?';
		$name = $this->db->query($sql,array($user));						
		if($name->num_rows()>0){
			if($name->row()->id_usuario==$idUsuario)				
				return "false";
			else
				return "success";
		}
		else{
			return "false";
		}		
	}

	public function addUser() {
		try {				
			$this->load->helper("date");
			$data = array(
				'id_usuario'	=>	NULL,
				'usuario'	=>	$this->input->post("usuario",TRUE),
				'nombre'	=>	$this->input->post("nombre",TRUE),
				'password'	=>	password_hash($this->input->post('password'),PASSWORD_DEFAULT),
				'fecha_registro'	=>	date('Y-m-d'),
				'id_tipo_usuario'	=>	$this->input->post('tipo_usuario'),
				'estatus_usuario'	=>	1,
			 );
				if ($this->db->insert('usuario',$data)){
					return 'success';
				}else{
					$error = $this->db->error();					
					if($error["code"]==1062){
						echo "Este <b>Email</b> ya se encuentra registrado";
					}else{
						echo "Error";						
					}
				}					
		} catch (Exception $e) {
			$error = $this->db->error();
			if($error["code"]==1062){
				echo "Este mail ya esta registrado.";
			}else{
				$message= $e->getMessage();
			}
		}	
	}

	function dataUsuario(){
		$id_usuario = $this->input->post('id_usuario');
		$usuario = $this->db->query('select * from usuario where id_usuario = '.$id_usuario)->row();
		$data = array(
			'id_usuario' => $usuario->id_usuario,
			'usuario' => $usuario->usuario,
			'password'=> '',
			'nombre' => $usuario->nombre,
			'id_tipo_usuario' => $usuario->id_tipo_usuario
		);
		return json_encode($data);
	}

	

	function updateUser(){
		$data = array(
			'usuario'	=>	$this->input->post("usuario",TRUE),
			'nombre'	=>	$this->input->post("nombre",TRUE),
			'password'	=>	password_hash($this->input->post('password'),PASSWORD_DEFAULT),
			'id_tipo_usuario'	=>	$this->input->post('tipo_usuario'),
			'estatus_usuario'	=>	1
		 );
		$this->db->where('id_usuario',$this->input->post('id_usuario'));
		if($this->db->update('usuario',$data)){
			return "success";
		}
		else
			return 'Error';
	}

	function getBitacora(){
		$query = $this->db->query('SELECT bitacora.*, usuarios.nombre FROM bitacora JOIN usuarios ON usuarios.id_usuario = bitacora.id_usuario ORDER BY fecha DESC');
		foreach($query->result() as $bitacora){
			$data[] = array(
				'usuario' => $bitacora->nombre,
				'accion' => $bitacora->accion,
				'fecha' => $bitacora->fecha
			);
		}
		return json_encode($data);
	}

	function bloquearUsuario(){
		$usuario = $this->input->post('usuario');
		$this->db->where('usuario',$usuario);
		$this->db->update('usuarios',array('status'=>0));
	}

	function getTipoUsuario(){
		$this->db->order_by("tipo_usuario", "asc");
		return $this->db->get('tipo_usuario');
	}

	function getAreasList(){
		$query = $this->db->query("select * from area order by area ASC");
		if($query->num_rows()>0){
	      	foreach($query->result() as $area){
		      	$data[] = array(
		      			'area'=>$area->area,     			
		      			'accion'=>'<a href="javascript:;" class="btn btn-sm btn-success" onclick="editarArea('.$area->id_area.')"><i class="fa fa-edit"></i></a> <a href="javascript:;" class="btn btn-sm btn-info" onclick="estadisticas('.$area->id_area.')"><i class="fa fa-exclamation-circle"></i></a>'
		      		);
	      	}
	      	return json_encode($data);	
	    }else{
			return 0;
	    }	
	}

	function dataArea(){
		$id_area = $this->input->post('id_area');
		$usuario = $this->db->query('select * from area where id_area = '.$id_area)->row();
		$data = array(
			'area' => $usuario->area
		);
		return json_encode($data);
	}

	function saveArea(){
		$id_area = $this->input->post('id_area');
		$data = array('area'=>$this->input->post('area'));
		if($id_area==0){
			$this->db->where('area',$this->input->post('area'));
			$area = $this->db->get('area');
			if($area->num_rows()==0){
				$this->db->insert('area',$data);
				return "success";
			}else{
				return "Nombre de área ya se encuentra registrado";
			}
		}else{
			$this->db->where('id_area',$id_area);
			$this->db->update('area',$data);
			return "success";
		}
	}

	function estadisticasArea(){
		$id_area = $this->input->post('id_area');
		$data = array(
			'pendientes' => $this->totalEstatus($id_area,1),
			'rechazados' => $this->totalEstatus($id_area,2),
			'autorizados' => $this->totalEstatus($id_area,3),
			'entregados' => $this->totalEstatus($id_area,4),
		); 
		return json_encode($data);
	}

	function totalEstatus($id_area,$id_estatus){
		$sql = 'SELECT COUNT(*) AS total
				FROM solicitud AS s
				JOIN usuario AS u ON u.`id_usuario` = s.`id_usuario`
				WHERE u.`id_area` = '.$id_area.' AND s.`id_estatus_solicitud` ='.$id_estatus;
		$query = $this->db->query($sql);
		return $query->row()->total;
	}

	function miinfo(){
		$id_usuario = $this->session->Charo2019['id_usuario'];
		$query = "SELECT u.*, tu.`tipo_usuario`
			FROM usuario AS u
			JOIN tipo_usuario AS tu ON tu.`id_tipo_usuario` = u.`id_tipo_usuario`
			WHERE u.`id_usuario` = ".$id_usuario;
		return $this->db->query($query)->row();
	}

	function cambiarPass(){
		$id_usuario = $this->input->post('id_usuario');
		$password = password_hash($this->input->post('password'),PASSWORD_DEFAULT);
		$this->db->where('id_usuario',$id_usuario);
		$this->db->update('usuario',array('password'=>$password));
		return "success";
	}

	function getUsers(){
		$this->db->order_by('nombre','asc');
		return $this->db->get('usuario');
	}

	function getUsersArea(){
		$query = $this->db->query('select u.id_usuario, u.nombre, a.area from usuario as u join area as a on a.`id_area` = u.id_area order by nombre asc');
		return $query;
	}

}

	
