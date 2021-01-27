<?php
class Vallas_fijasModel extends CI_model
{
	
	 function __construct()
	{
		$this->load->database();
	}

	public function obtenerVallas_fijas(){
        $this->db->select("*");
        // $this->db->from("medios");
        $this->db->join("estados", "vallas_fijas.id_estado = estados.id");
        $this->db->select("estados.id as id_estado, estados.nombre as nombre_estado");
        $this->db->join("medios", "vallas_fijas.id_medio = medios.id");

		$sql = $this->db->get("vallas_fijas");
		return $sql->result_array();
    }


    public function obtenerVallasPorIdMedio($id_medio){
        $this->db->select("*");
        // $this->db->from("medios");
        $this->db->join("estados", "vallas_fijas.id_estado = estados.id");
        $this->db->select("estados.id as id_estado, estados.nombre");
        $this->db->join("propietarios", "vallas_fijas.id_propietario = propietarios.id");
        $this->db->select("propietarios.nombre as nombre_propietario, propietarios.telefono, propietarios.celular");
        $this->db->join("medios", "vallas_fijas.id_medio = medios.id");
        $this->db->select("tipos_pago.nombre as nombre_pago");
        $this->db->join("tipos_pago", "vallas_fijas.id_tipo_pago = tipos_pago.id");
        $this->db->join("periodo_pago", "vallas_fijas.id_periodo_pago = periodo_pago.id");
        $this->db->where('medios.id', $id_medio);

        $sql = $this->db->get("vallas_fijas");
		return $sql->result_array();

    }
    
    public function agregarValla_fija($numcontrol,$costoimpresion,$costoInstalacion,$calle,$numero,$colonia,$localidad,$municipio,$estado,$latitud,$longitud,$referencias,$ancho,$alto,$material,$renta,$observaciones,$acabados,$imagen1,$imagen2,$imagen3,$id_prop,$id_medio,$iniciocontrato,$fincontrato,$tipopago,$periodo,$monto){

        $data = array(
            'nocontrol'=>$numcontrol,
            'costo_impresion'=>$costoimpresion,
            'costo_instalacion'=>$costoInstalacion,
            'calle'=>$calle,
            'numero'=>$numero,
            'colonia'=>$colonia,
            'localidad'=>$localidad,
            'municipio'=>$municipio,
            'id_estado'=>$estado,
            'latitud'=>$latitud,
            'longitud'=>$longitud,
            'referencias'=>$referencias,
            'ancho'=>$ancho,
            'alto'=>$alto,
            'material'=>$material,
            "costo_renta" => $renta,
            'observaciones'=>$observaciones,
            'acabados'=>$acabados,
            'vista_corta'=>$imagen1,
            'vista_media'=>$imagen2,
            'vista_larga'=>$imagen3,
            "id_propietario" => $id_prop,
            "id_medio" => $id_medio,
            'fecha_inicio'=>$iniciocontrato,
            'fecha_termino'=>$fincontrato,
            'id_tipo_pago'=>$tipopago,
            'id_periodo_pago'=>$periodo,
            'monto'=>$monto,
        );

        $sql = $this->db->insert('vallas_fijas', $data);
        if($sql){
            return true;
        }else{
            return false;
        }
    }    


    public function eliminarVallaFija($id_medio){
        $sql = $this->db->delete("vallas_fijas", array("id_medio" => $id_medio));
        if($sql){
            return true;
        }else{
            return false;
        }
    }

     public function editarValla_fija($id_medio,$numcontrol,$costoimpresion,$costoInstalacion,$calle,$numero,$colonia,$localidad,$municipio,$estado,$latitud,$longitud,$referencias,$ancho,$alto,$material,$observaciones,$acabados,$imagen1,$imagen2,$imagen3,$iniciocontrato,$fincontrato,$tipopago,$periodo,$monto){
         $data = array(
        'nocontrol'=>$numcontrol,
        'costo_impresion'=>$costoimpresion,
        'costo_instalacion'=>$costoInstalacion,
        'calle'=>$calle,
        'numero'=>$numero,
        'colonia'=>$colonia,
        'localidad'=>$localidad,
        'municipio'=>$municipio,
        'id_estado'=>$estado,
        'latitud'=>$latitud,
        'longitud'=>$longitud,
        'referencias'=>$referencias,
        'ancho'=>$ancho,
        'alto'=>$alto,
        'material'=>$material,
        'observaciones'=>$observaciones,
        'acabados'=>$acabados,
        'fecha_inicio'=>$iniciocontrato,
        'fecha_termino'=>$fincontrato,
        'id_tipo_pago'=>$tipopago,
        'id_periodo_pago'=>$periodo,
        'monto'=>$monto
         );

         if($imagen1 != ""){
            $data += [ "vista_corta" => $imagen1];
        }
        if($imagen2 != ""){
            $data += [ "vista_media" => $imagen2];

        }
        if($imagen3 != ""){
            $data += ['vista_larga' => $imagen3];
        }


         $this->db->where("id_medio", $id_medio);
         $sql = $this->db->update("vallas_fijas",$data);
         if($sql){
             return true;
         }else{
             return false;
         }
         
     }


    function vallasQueTerminaraSucontratoDentroDeUnMes($dentroDeUnMes){
        $hoy= Date("Y:m:d");
        $this->db->select("*");
        $this->db->join("medios","vallas_fijas.id_medio = medios.id");
        $this->db->join("propietarios", "vallas_fijas.id_propietario = propietarios.id");
        $this->db->where('vallas_fijas.fecha_termino <=', $dentroDeUnMes);
        $this->db->where('vallas_fijas.fecha_termino >', $hoy);
        
        $sql = $this->db->get("vallas_fijas");
        if($sql){
            return $sql->result_array();
        }else{
            return false;
        }
    }

    //obtiene las vallas_fijas cuya fecha de termino sea hoy 
    public function obtenerVallasTerminoRenta($hoy){
        $sql = $this->db->get_where("vallas_fijas",array("fecha_termino" => $hoy));
        if($sql){
            return $sql ->result_array();
        }else{
            return false;
        }
    }


}