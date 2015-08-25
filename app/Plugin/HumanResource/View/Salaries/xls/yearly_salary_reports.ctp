<?php

    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 10);

    $objTpl = PHPExcel_IOFactory::load("./img/salaries/yearly_salary.xls");
    $counter = 5;
    
    $objTpl->setActiveSheetIndex(0)
    ->setCellValue('A2','Yearly Salary Report: '. $year )->getStyle('A3:AK3')->getFont()->setBold(true);

    $sheet = $objTpl->getActiveSheet();
    $counter = 4;

    foreach ($employees as $key => $emp) {
         $key++;

          $employee_name =  $this->CustomText->getFullname($emp['Employee']);
          $sheet->setCellValue('A'.$counter, $employee_name );
          $sheet->setCellValue('B'.$counter,$emp['total_deduction']);
          $sheet->setCellValue('C'.$counter,$emp['total_pay']);

       	  $counter++;         
    }

    //prepare download
    $filename = 'yearly-report-'.date('y-m-d').'-'.time().'.xls'; //just some random filename
    //header('Content-Type: application/vnd.ms-office');
    header('Content-Type: application/vnd.ms-office');
    
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    ob_end_clean();
    //$objWriter->setReadDataOnly( true );
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
         

    exit; //done.. exiting!



?>