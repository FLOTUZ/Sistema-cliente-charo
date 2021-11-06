<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
function pdf_create($html, $filename, $stream=TRUE) 
{
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->set_paper("a4", "portrait" );
    $dompdf->render(); 
    $dompdf->stream($filename . ".pdf", array("Attachment"=> 0));

}

function pdf_save($html, $filename, $path, $stream=TRUE) {
    $folder = $path.$filename; 
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->set_paper("a4", "portrait" );
    $dompdf->render();
	file_put_contents($folder, $dompdf->output());

} 