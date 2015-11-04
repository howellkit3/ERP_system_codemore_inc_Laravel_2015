<?php


function copyRowFull(&$ws_from, &$ws_to, $row_from, $row_to) {
  $ws_to->getRowDimension($row_to)->setRowHeight($ws_from->getRowDimension($row_from)->getRowHeight());
  $lastColumn = $ws_from->getHighestColumn();
  ++$lastColumn;
  for ($c = 'A'; $c != $lastColumn; ++$c) {
    $cell_from = $ws_from->getCell($c.$row_from);
    $cell_to = $ws_to->getCell($c.$row_to);
    $cell_to->setXfIndex($cell_from->getXfIndex()); // black magic here
    $cell_to->setValue($cell_from->getValue());
  }
}


// $objPHPExcel = PHPExcel_IOFactory::load("./img/salaries/test_payslip.xls");
           

    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 10);

    $objTpl = PHPExcel_IOFactory::load("./img/salaries/test_payslip.xls");

    #first_tab 
    $first_tab = 
    $foreach ($salaries as $key => $list) {
        # code...
    }

    //prepare download
    $filename = 'salaries-'.date('y-m-d').'-'.time().'.xls'; //just some random filename
    //header('Content-Type: application/vnd.ms-office');
    header('Content-Type: application/vnd.ms-office');
    
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    ob_end_clean();
    //$objWriter->setReadDataOnly( true );
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
         

    exit; //done.. exiting!