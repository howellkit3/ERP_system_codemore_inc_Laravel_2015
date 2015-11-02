<?php

    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 10);

   // $objTpl = PHPExcel_IOFactory::load("./img/salaries/salaries_edited.xls");
    $counter = 5;

    $objTpl->setActiveSheetIndex(0)
    ->setCellValue('A2','Payroll '.date('F d',strtotime($payroll['Payroll']['from'])).'-'.date('d',strtotime($payroll['Payroll']['to'])).' '. $payroll['Payroll']['year']);

    // ->getStyle('A4:AK4')
    // ->getFont()->setBold(true);
            
    $styleArrayHeader = array(
                  'font'  => array(
                  'color' => array('rgb' => '0070C0'),
                  'bold' =>true
                  ));

    $counter = 6;
    $header = 4;
    $next_header = 5;

    $sheet = $objTpl->getActiveSheet();
    $address = 'AI'.$header;


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