<?php 

 //pr('ds'); exit;
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/emp_filter.xls");

    $addRow = 0;
    foreach ($employeeData as $key => $employeeList) {
        $addRow = $key + 1;
    }

    $objTpl->setActiveSheetIndex(0)->insertNewRowBefore(11,$addRow);

    $counter = 10;
    foreach ($employeeData as $key => $employeeList) {
        $key++;
       
        $objTpl->setActiveSheetIndex(0)
                    ->setCellValue('C8',(new \DateTime())->format('m/d/Y'))
                    ->setCellValue('A'.$counter, $key)
                    ->setCellValue('B'.$counter, $employeeList['Employee']['code'])
                    ->setCellValue('C'.$counter, $employeeList['Department']['name'])
                    ->setCellValue('D'.$counter, $employeeList['Position']['name'])
                    ->setCellValue('E'.$counter, $employeeList['Employee']['last_name'])
                    ->setCellValue('F'.$counter, $employeeList['Employee']['first_name'])
                    ->setCellValue('G'.$counter, $employeeList['Employee']['middle_name'])
                    ->setCellValue('H'.$counter, $employeeList['Employee']['suffix'])
                    ->setCellValue('I'.$counter, $employeeList['Status']['name'])
                    ->setCellValue('J'.$counter, date('m/d/Y', strtotime($employeeList['Status']['date_hired'])));
                    
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