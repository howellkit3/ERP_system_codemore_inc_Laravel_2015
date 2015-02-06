<?php 
require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php');

echo $this->Html->css('bootstrap-theme.min');
echo $this->Html->css('bootstrap-theme');
echo $this->Html->css('bootstrap.min');
                
                
spl_autoload_register('DOMPDF_autoload');
$dompdf = new DOMPDF();
$dompdf->set_paper = 'A4';
$dompdf->load_html(utf8_decode($content_for_layout), Configure::read('App.encoding'));
$dompdf->render();
echo $dompdf->output();
