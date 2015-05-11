<?php 
require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php');

echo $this->Html->css('bootstrap-theme.min');
echo $this->Html->css('bootstrap-theme');
echo $this->Html->css('bootstrap.min');
                
                
spl_autoload_register('DOMPDF_autoload');
$dompdf = new DOMPDF();
$dompdf->set_paper("A4");

$dompdf->load_html(utf8_decode($content_for_layout), Configure::read('App.encoding'));
$dompdf->render();
$canvas = $dompdf->get_canvas();
$font = Font_Metrics::get_font("helvetica", "bold");
$canvas->page_text(16, 800, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));
echo $dompdf->output();