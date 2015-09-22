<?php

    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 10);

    $objTpl = PHPExcel_IOFactory::load("./img/reports/sss_report_list.xls");
    $counter = 5;
    
    // $objTpl->setActiveSheetIndex(0)
    // ->setCellValue('A2','Yearly Salary Report: '. $year )->getStyle('A3:AK3')->getFont()->setBold(true);

     $sheet = $objTpl->getActiveSheet();
     $counter = 5;

       $styleArrayBorder = array(
              'borders' => array(
                'allborders' => array(
                  'style' => PHPExcel_Style_Border::BORDER_THIN
                )
              )
            );

    foreach ($employees as $key => $emp) {
          
          $sheet->setCellValue('A'.$counter,$emp['GovernmentRecord']['value']);
          $sheet->getStyle('A'.$counter)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('99CCFF');
          $sheet->getStyle('A'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $sheet->getStyle('A'.$counter)->applyFromArray($styleArrayBorder);

          $sheet->setCellValue('B'.$counter,ucwords($emp['Employee']['last_name']));
          $sheet->getStyle('B'.$counter)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('99CCFF');
          $sheet->getStyle('B'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $sheet->getStyle('B'.$counter)->applyFromArray($styleArrayBorder);

          $sheet->setCellValue('C'.$counter,ucwords($emp['Employee']['first_name']));
          $sheet->getStyle('C'.$counter)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('99CCFF');
          $sheet->getStyle('C'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $sheet->getStyle('C'.$counter)->applyFromArray($styleArrayBorder);

          $sheet->setCellValue('D'.$counter,ucwords($emp['Employee']['middle_name'][1]));
          $sheet->getStyle('D'.$counter)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('99CCFF');
          $sheet->getStyle('D'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $sheet->getStyle('D'.$counter)->applyFromArray($styleArrayBorder);

          $sheet->setCellValue('E'.$counter,date('Y/m/d',strtotime($emp['EmployeeAdditionalInformation']['birthday'])));
          $sheet->getStyle('E'.$counter)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('99CCFF');
          $sheet->getStyle('E'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $sheet->getStyle('E'.$counter)->applyFromArray($styleArrayBorder);

       	  $counter++;         
    }


    //prepare download
    $filename = 'SSS-report-'.date('y-m-d').'-'.time().'.xls'; //just some random filename

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