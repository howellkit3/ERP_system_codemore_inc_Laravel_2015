<?php

    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 10);

    $objTpl = PHPExcel_IOFactory::load("./img/reports/sss_contribution.xls");
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
           
          $premium = 0;
          $compensation = 0;
            
          $sheet->setCellValue('A'.$counter,$emp['SSS']['number']);
          $sheet->getStyle('A'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $sheet->getStyle('A'.$counter)->applyFromArray($styleArrayBorder);

          $sheet->setCellValue('B'.$counter,ucwords($emp['Employee']['last_name']));
          $sheet->getStyle('B'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $sheet->getStyle('B'.$counter)->applyFromArray($styleArrayBorder);

          $sheet->setCellValue('C'.$counter,ucwords($emp['Employee']['first_name']));
          $sheet->getStyle('C'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $sheet->getStyle('C'.$counter)->applyFromArray($styleArrayBorder);

          $sheet->setCellValue('D'.$counter,ucwords($emp['Employee']['middle_name'][1]));
          $sheet->getStyle('D'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $sheet->getStyle('D'.$counter)->applyFromArray($styleArrayBorder);

          $dateHired = !empty($emp['Employee']['date_hired']) ? date('F/d/Y',strtotime($emp['Employee']['date_hired'])) : '';
          $sheet->setCellValue('E'.$counter,$dateHired);
          $sheet->getStyle('E'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $sheet->getStyle('E'.$counter)->applyFromArray($styleArrayBorder);

          $status =  !empty($emp['Employee']['status']) ? $statuses[$emp['Employee']['status']] : ''; 
          $sheet->setCellValue('F'.$counter,$status);
          $sheet->getStyle('F'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $sheet->getStyle('F'.$counter)->applyFromArray($styleArrayBorder);


          $premium = $emp['SSS']['first_half'] + $emp['SSS']['second_half'];
            //!empty($emp['SSS']['first_half']) ? $emp['SSS']['first_half'] : 0;
         // $premium += !empty($emp['SSS']['second_half']) ? $emp['SSS']['second_half'] : 0;

          $sheet->setCellValue('G'.$counter,$premium);
          $sheet->getStyle('G'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $sheet->getStyle('G'.$counter)->applyFromArray($styleArrayBorder);

          $compensation = $emp['SSS']['first_half_compensation'] + $emp['SSS']['second_half_compensation'];


          $sheet->setCellValue('H'.$counter,$compensation);
          $sheet->getStyle('H'.$counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $sheet->getStyle('H'.$counter)->applyFromArray($styleArrayBorder);

          $counter++;         
    }


    //prepare download
    $filename = 'SSS-contribution-report-'.date('y-m-d').'-'.time().'.xls'; //just some random filename

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