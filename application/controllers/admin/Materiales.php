<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materiales extends CI_Controller {

	public function __Construct(){
		parent::__Construct();
		 $this->load->model('MaterialesModel');
		 $this->load->model('EspectacularesModel');
		 $this->load->model('Vallas_fijasModel');
		 $this->load->model('Vallas_movilesModel');

	}
	public function index()
	{
		if($this->session->userdata('is_logged')){
		$data['materiales']= $this->MaterialesModel->obtenerMateriales();
			
		$this->load->view('admin/templates/__head');
		$this->load->view('admin/templates/__nav');
		$this->load->view('admin/materiales/materiales', $data);
		$this->load->view('admin/templates/__footer');
		}else{
			redirect('login');
		}
	}

	public function agregarMaterial()
	{
		if($this->session->userdata('is_logged')){
			$nombre = $this->input->post('nombrematerial');
			$precio = $this->input->post('preciomaterial');
			$unidad = $this->input->post('unidadmaterial');
			$observacion = $this->input->post('observacionmaterial');

			if(!$datos = $this->MaterialesModel->agregarMaterial($nombre,$precio,$unidad,$observacion)){
				echo json_encode(array("error" => "Error al insertar los datos"));
			}else{
				echo json_encode(array("success" =>"Material agregago correctamente"));
			}
			
		}else{
			redirect('login');
		}
	}

	public function obtenerMaterialPorId($id){
		if($this->session->userdata('is_logged')){
			if($data = $this->MaterialesModel->obtenerMaterialPorId($id)){
				echo json_encode($data);
			}else{
				echo json_encode(array("error" => "Ocurrio un error"));
			}
		}else{
			redirect("login");
		}
	}

	public function editarMaterial()
	{
		if($this->session->userdata('is_logged')){
			$id_material = $this->input->post("id");
			$nombre = $this->input->post("nombre");
			$precio = $this->input->post("precio");
			$unidad = $this->input->post("unidad");
			$descripcion = $this->input->post("descripcion");
			 $this->actualizarLosPreciosDeImpresion($id_material, $precio);

			if(!$datos = $this->MaterialesModel->editarMaterial($id_material,$nombre,$precio,$unidad, $descripcion)){
				echo json_encode(array("error" => "ha ocurrido un error, intenta mas tarde"));
			}else{
				echo json_encode(array("success" => "Material agregago correctamente"));
			}
			
		}else{
			redirect('login');
		}
	}

	public function eliminarMaterial()
	{
		if($this->session->userdata('is_logged')){
			$id = $this->input->post();
			// echo json_encode($id);
			if(!$datos = $this->MaterialesModel->eliminarMaterial($id['id'])){
				echo json_encode(array("error" => "Error al eliminar el material"));
			}else{
			 	echo json_encode(array("success" => "Material Eliminado correctamente"));
			}
			
		}else{
			redirect('login');
		}
	}

	public function actualizarLosPreciosDeImpresion($id_material,$precio){
		if($espectaculares = $this->EspectacularesModel->obtenerEspectacularesByIdMaterial($id_material)){
			foreach($espectaculares as $esp){
				$costoImpresion = round(($esp["ancho"] * $esp["alto"]) * $precio, 0);
				$costoTotal = round($costoImpresion + $esp['costo_instalacion'] + $esp["costo_renta"]);
				$this->MaterialesModel->actualizarPreciosDeImpresionEsp($esp['id'],$costoImpresion);
				$this->MaterialesModel->actualizarCostoTotal($esp['id_medio'],$costoTotal);
			}
		}
		// if($vallas = $this->VallasModel->obtenerVallasByIdMaterial($id_material)){
		// 	if(count($vallas)>0){
		// 		foreach($vallas as $valla){
		// 			$costoImpresionv = round(($valla["ancho"] * $valla["alto"]) * $precio, 0);
		// 			$costoTotalv = round($costoImpresionv + $valla['costo_instalacion'] + $valla["costo_renta"]);
		// 			$this->MaterialesModel->actualizarPreciosDeImpresionVall($valla['id'],$costoImpresionv);
		// 			$this->MaterialesModel->actualizarCostoTotal($valla['id_medio'],$costoTotalv);
		// 		}
		// 	}
		// }
	}



	
}