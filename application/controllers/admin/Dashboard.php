<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __Construct(){
		parent::__Construct();
		$this->load->model('MediosModel');
		$this->load->model('VentasModel');
		$this->load->model('EspectacularesModel');
		$this->load->model('Vallas_fijasModel');
		$this->load->model('Vallas_movilesModel');
		// $this->load->model('DashboardModel');
		

	}
	public function index()
	{
		if($this->session->userdata('is_logged')){
			$date = mktime(0,0,0, date("m"), date("d")-1, date("Y"));
			$ayer = date('Y/m/d', $date);
			// var_dump($ayer);
			$dentroDeUnMes = mktime(0,0,0, date("m")+1, date("d"), date("Y"));
			$UnMes = date('Y/m/d', $dentroDeUnMes);
			$hoy = date('Y/m/d');
	
			//obtiene los medios que estan apartados en una determinada fecha
			$apartados = $this->VentasModel->obtenerVenta_mediosPorFechaInicio($hoy);
			if(count($apartados)>0){
				for($i=0; $i<count($apartados); $i++){
					//cambia el estado de los medios apartados a ocupados
					$this->MediosModel->cambiarStatusApartadoAOcupado($apartados[$i]["id_medio"]);		
				}
			}

			//medios vendidos por en el sistema y que estaran disponibles dentro de un mes
			$disponiblesProximos = $this->VentasModel->obtenerVenta_mediosQueEstaranDisponiblesEnUnMes($UnMes);
			if(count($disponiblesProximos)>0){
				//modifica el estatus de los medios que estaran disponibles dentro de un mes	
				for($dP=0; $dP < count($disponiblesProximos); $dP++){
					$this->MediosModel->cambiarStatusOcupadoAProximo($disponiblesProximos[$dP]["id_medio"]);
			  	}
			 }

			 // Obtiene los Medios que tienen como fecha de termino la fecha de ayer
			$proximos = $this->VentasModel->obtenerVenta_mediosPorFechaTermino($ayer);
			// var_dump($proximos);
			if(count($proximos)>0){
			 	for($o=0; $o<count($proximos); $o++){
					 //cambia el estado del medio a disponible
			 		$this->MediosModel->cambiarStatusProximoADisponible($proximos[$o]["id_medio"]);		
			 	}
			 }

			 $mediosDisponibles = $this->MediosModel->obtenerMediosGeneralesDisponibles();
			 if(count($mediosDisponibles)>0){
				 for ($md=0; $md < count($mediosDisponibles); $md++) {
					 	$this->MediosModel->cambiarStatusMedio($mediosDisponibles[$md]["id_medio"]);
					 # code...
				 }
			 }

			// obtiene los medios que se registraron como apartados
			// $mediosApartados = $this->MediosModel->obtenerMediosApartadosSinVenta($hoy);
			// if(count($mediosApartados)>0){
			// 	//modifica el estatus de los medios seleccionado a ocupado
			// 	for($mA=0; $mA<count($mediosApartados); $mA++){
			// 		$this->MediosModel->CambiarApartadoAOcupado($mediosApartados[$mA]["id"]);
			// 	}
			// }

			 //obtiene los medios que se dieron de alta como ocupados y terminan dentro de un mes
			$mediosOcupados = $this->MediosModel->obtenerMediosOcupadosSinFechadeInicio($UnMes);
			// var_dump($mediosOcupados);
			// var_dump($UnMes);
			if(count($mediosOcupados)>0){
			 	//modifica el estatus de ocupado a proximo
			 	for($m=0; $m<count($mediosOcupados); $m++){
			 		$this->MediosModel->cambiarStatusOcupadoAProximo($mediosOcupados[$m]["id"]);
			 	}
			 }
			
			$mediosProximos = $this->MediosModel->obtenerMediosProximosSinFechadeInicio($ayer);
			 if(count($mediosProximos)>0){
			 	//modifica el estatus de proximo a Disponible
			 	for($m=0; $m<count($mediosProximos); $m++){
			 		$this->MediosModel->cambiarStatusProximoADisponible($mediosProximos[$m]["id"]);
			 	}
			 }

			/*
			*Esta funcion obtiene los medios que estan en venta, pero cambian a disponibles por una venta antes terminada
			*/
			// $mediosDisponibles = $this->MediosModel->obtenerMediosGeneralesDisponiblesQueEstanEnVenta($hoy);
			//  if(count($mediosDisponibles)>0){
			//  	for ($MD=0; $MD < count($mediosDisponibles); $MD++) { 
			// 		//cambia el estatus del medio a APARTADO
			//  		$this->MediosModel->cambiarStatusMedio($mediosDisponibles[$MD]["id_medio"]);
			//  	}
			//  }

			 //obtiene los medios que terminaron su contrato de arrendamiento
			$espectacularesTermino = $this->EspectacularesModel->obtenerEspectacularesTerminoRenta($ayer);
			$vallasTermino = $this->Vallas_fijasModel->obtenerVallasTerminoRenta($ayer);
			$mediosTermino = array_merge($espectacularesTermino,$vallasTermino);
			 if(count($mediosTermino)>0){
			  	for ($MT=0; $MT < count($mediosTermino) ; $MT++) {
			  		$this->MediosModel->cambiarStatusABloqueado($mediosTermino[$MT]["id_medio"]);
			  		# code...
			 	}
			 }

			$this->load->view('admin/templates/__head');
			$this->load->view('admin/templates/__nav');
			$this->load->view('admin/dashboard');
			$this->load->view('admin/templates/__footer');
		}else{
			redirect('login');
		}
		
	}

	public function obtenerMediosQueVanATerminarContrato(){
		$dentroDeUnMes = mktime(0,0,0, date("m")+1, date("d"), date("Y"));
		$UnMes = date('Y/m/d', $dentroDeUnMes);
		$espectaculares = $this->EspectacularesModel->espectacularesQueTerminaraSucontratoDentroDeUnMes($UnMes);
		$vallas_fijas = $this->Vallas_fijasModel->vallasQueTerminaraSucontratoDentroDeUnMes($UnMes);
		$medios = array_merge($espectaculares,$vallas_fijas);
		if(count($medios)>0){
			echo json_encode(array("medios"=> $medios, "total"=> count($medios)));		
		}
	}

	public function obtenerVentasPorMes(){
		$VM = $this->Vallas_movilesModel->obtenerVentas();
		echo json_encode($VM);
		
	}

}