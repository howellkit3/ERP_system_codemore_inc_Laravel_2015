<?php 

 //pr('ds'); exit;
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./exportexcel/attendance_report.xls");
    // $counter = 5;
    // foreach ($workScheduleData as $key => $workScheduleList) {
    //     $key++;
       
    //     $objTpl->setActiveSheetIndex(0)
    //                 ->setCellValue('A1',(new \DateTime())->format('m/d/Y'))
    //                 ->setCellValue('A'.$counter, $key)
    //                 ->setCellValue('B'.$counter, $workScheduleList['Employee']['first_name'].' '.$workScheduleList['Employee']['middle_name'].' '.$workScheduleList['Employee']['last_name'].' '.$toolList['Employee']['suffix'])
    //                 ->setCellValue('C'.$counter, $workScheduleList['WorkShift']['name'])
    //                 ->setCellValue('D'.$counter, date('m/d/Y', strtotime($workScheduleList['WorkSchedule']['day'])));

    //     $counter++;  
        
    // }
         
    //prepare download
    $filename = mt_rand(1,100000).'.xls'; //just some random filename
    //header('Content-Type: application/vnd.ms-office');
    header('Content-Type: application/vnd.ms-office');
    
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    //ob_end_clean();
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!

?>