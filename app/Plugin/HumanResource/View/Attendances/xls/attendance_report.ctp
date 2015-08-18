<?php 

 //pr('ds'); exit;
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./exportexcel/attendance_report.xlsx");
    //$objTpl = PHPExcel_IOFactory::load("./img/Invoice.xlsx");
    $counter = 7;
    foreach ($attendanceData as $key => $attendanceList) {
        $key++;
       
        $objTpl->setActiveSheetIndex(0)
                    ->setCellValue('D5','Attendace /' .$departmentList[$departmentId]. ' / ' . (new \DateTime())->format('m/d/Y'))
                    ->setCellValue('A'.$counter, $key)
                    ->setCellValue('B'.$counter, $attendanceList['Employee']['code'])
                    ->setCellValue('C'.$counter, ucfirst($attendanceList['Employee']['first_name']).' '.ucfirst($attendanceList['Employee']['middle_name']).' '.ucfirst($attendanceList['Employee']['last_name']).' '.ucwords($attendanceList['Employee']['suffix']))
                    ->setCellValue('D'.$counter, 'work')
                    ->setCellValue('E'.$counter, $attendanceList['WorkShift']['from'])
                    ->setCellValue('F'.$counter, $attendanceList['WorkShift']['to'])
                    ->setCellValue('G'.$counter, $attendanceList['Attendance']['in'])
                    ->setCellValue('H'.$counter, $attendanceList['Attendance']['out'])
                    ->setCellValue('I'.$counter, 'ot')
                    ->setCellValue('J'.$counter, 'duration')
                    ->setCellValue('K'.$counter, $attendanceList['Attendance']['status'])
                    ->setCellValue('L'.$counter, 'remarks');

        $counter++;  
        
    }
         
    //prepare download
    $filename = mt_rand(1,100000).'.xlsx'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    //header('Content-Type: application/vnd.ms-excel');
    
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    //ob_end_clean();
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!

?>