<?php 

 //pr('ds'); exit;
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/reports/employee_report.xls");

    $addRow = 0;
    foreach ($employeeData as $key => $employeeList) {
        $addRow = $key + 1;
    }

    $objTpl->setActiveSheetIndex(0)->insertNewRowBefore(11,$addRow);

      $objTpl->setActiveSheetIndex(0)
                    ->setCellValue('B3',(new \DateTime())->format('m/d/Y'));

    $counter = 6;

    $sheet = $objTpl->getActiveSheet();

    $number['tel'] = 0;
    $number['fax'] = 0;

    $number['mobile'] = 0;

    foreach ($employeeData as $key => $employeeList) {
        $key++;
        
                $sheet->setCellValue('A'.$counter, $key);
                $sheet->setCellValue('B'.$counter, $employeeList['Employee']['code']);
                $sheet->setCellValue('C'.$counter, $employeeList['Employee']['last_name']);
                $sheet->setCellValue('D'.$counter, $employeeList['Employee']['first_name']);
                $sheet->setCellValue('E'.$counter, $employeeList['Employee']['middle_name']);
                $sheet->setCellValue('F'.$counter, $employeeList['EmployeeAdditionalInformation']['gender']);
                $sheet->setCellValue('G'.$counter, $employeeList['EmployeeAdditionalInformation']['status']);
                $sheet->setCellValue('H'.$counter, $employeeList['Address'][0]['address1']);
                $sheet->setCellValue('I'.$counter, $employeeList['Address'][0]['city']);
                $sheet->setCellValue('J'.$counter, $employeeList['Address'][0]['zipcode']);


                //contact
                foreach ($employeeList['Contact'] as $key => $contact) {
                    if (!$contact['type'] == 0) {
                        $number['tel'] = $contact['number'];
                    }
                    if (!$contact['type'] == 1) {
                        $number['fax'] = $contact['number'];
                    }
                    if (!$contact['type'] == 2) {
                        $number['mobile'] = $contact['number'];
                    }
                }
                $sheet->setCellValue('K'.$counter, $number['tel'] );

                $sheet->setCellValue('L'.$counter, $number['mobile'] );

                $sheet->setCellValue('M'.$counter,$employeeList['Address']);

                $sheet->setCellValue('N'.$counter,$employeeList['Address'][0]['zipcode']);
                    
        $counter++;  
        
    }
    
            
    //prepare download
    $filename = 'employee_reports_'.date('Ymdhis').'.xls'; //just some random filename
    //header('Content-Type: application/vnd.ms-office');
    header('Content-Type: application/vnd.ms-office');
    
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    ob_end_clean();
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!

?>