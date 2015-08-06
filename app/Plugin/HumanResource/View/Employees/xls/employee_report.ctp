<?php 

 //pr('ds'); exit;
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/emp_record-1.xls");
    $counter = 5;
    foreach ($employeeData as $key => $employeeList) {
        $key++;
       
        $objTpl->setActiveSheetIndex(0)
                    ->setCellValue('A1',(new \DateTime())->format('m/d/Y'))
                    ->setCellValue('A'.$counter, $key)
                    ->setCellValue('B'.$counter, $employeeList['Department']['name'])
                    ->setCellValue('C'.$counter, $employeeList['Position']['name'])
                    ->setCellValue('D'.$counter, $employeeList['Employee']['last_name'])
                    ->setCellValue('E'.$counter, $employeeList['Employee']['first_name'])
                    ->setCellValue('F'.$counter, $employeeList['Employee']['middle_name'])
                    ->setCellValue('G'.$counter, 'hired')
                    ->setCellValue('H'.$counter, $employeeList['Status']['name'])
                    ->setCellValue('I'.$counter, 'to')
                    ->setCellValue('J'.$counter, 'from');

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