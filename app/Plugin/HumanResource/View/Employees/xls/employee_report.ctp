<?php 

 //pr('ds'); exit;
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/employee_pattern.xls");
    $counter = 5;
    foreach ($employeeData as $key => $employeeList) {
        $key++;
       
        $objTpl->setActiveSheetIndex(0)
                    ->setCellValue('A'.$counter, $key)
                    ->setCellValue('B'.$counter, 'section')
                    ->setCellValue('C'.$counter, 'N/A')
                    ->setCellValue('D'.$counter, $employeeList['Employee']['position_id'])
                    ->setCellValue('E'.$counter, $employeeList['Employee']['last_name'])
                    ->setCellValue('F'.$counter, $employeeList['Employee']['first_name'])
                    ->setCellValue('G'.$counter, $employeeList['Employee']['middle_name'])
                    ->setCellValue('H'.$counter, 'hired')
                    ->setCellValue('I'.$counter, $employeeList['Employee']['status'])
                    ->setCellValue('J'.$counter, 'to')
                    ->setCellValue('K'.$counter, 'from');

        $counter++;  
        
    }
    
            
    //prepare download
    $filename = mt_rand(1,100000).'.xls'; //just some random filename
    //header('Content-Type: application/vnd.ms-office');
    header('Content-Type: application/vnd.ms-office');
    
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    ob_end_clean();
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!

?>