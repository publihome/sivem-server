<?php
		require FCPATH.'/vendor/autoload.php';

		use Spipu\Html2Pdf\Html2Pdf;
		use Spipu\Html2Pdf\Exception\Html2PdfException;
		use Spipu\Html2Pdf\Exception\ExceptionFormatter;
class Models extends CI_model
{
	
	 function __construct()
	{
		$this->load->database();
	}

	function obtenerTiposdePago(){
		$sql = $this->db->get('tipos_pago');
		return $sql->result_array();
	}

	function obtenerPeriodosDePago(){
		$sql = $this->db->get('periodo_pago');
		return $sql->result_array();

	}

	function obtenerEstados(){
		$sql = $this->db->get('estados');
		return $sql->result_array();
	}


	/*------------------------------- P D F -------------------------------- */

	
	public function generatePdf($html){

		// Get output html
		$html = $this->output->get_output();
		// Load pdf library
		$this->load->library('pdf');
		// Load HTML content
		$this->dompdf->loadHtml($html);
	
		// (Optional) Setup the paper size and orientation
		$this->dompdf->setPaper('A4', 'landscape');
	
		// Render the HTML as PDF
		$this->dompdf->render();
	
		// Output the generated PDF (1 = download and 0 = preview)
		$this->dompdf->stream("Catalogo.pdf", array("Attachment"=>0));
						$f;
				$l;
				if(headers_sent($f,$l))
				{
					echo $f,'<br/>',$l,'<br/>';
					die('now detect line');
				}
	
	}

	public function generateOrdenCompra($html){

		// Get output html
		$html = $this->output->get_output();
		// Load pdf library
		$this->load->library('pdf');
		// Load HTML content
		$this->dompdf->loadHtml($html);
	
		// (Optional) Setup the paper size and orientation
		$this->dompdf->setPaper('A4', 'portrait');
	
		// Render the HTML as PDF
		$this->dompdf->render();
	
		// Output the generated PDF (1 = download and 0 = preview)
		$this->dompdf->stream("olv.pdf", array("Attachment"=>0));
	
	}

	public function generatePdfs($medios){
		// return $html;
		ob_start();
		include dirname(__FILE__).'./../views/admin/catalogos/catPdf.php';
		// $html = $data;
		$this->load->view('admin/catalogos/catPdf',$medios);
		$content = ob_get_clean();

		// var_dump($content);
		// exit;
		$html2pdf = new Html2Pdf('l', 'A4', 'fr');
		$html2pdf->writeHTML($content);
		$html2pdf->output();


	}

	

	

}