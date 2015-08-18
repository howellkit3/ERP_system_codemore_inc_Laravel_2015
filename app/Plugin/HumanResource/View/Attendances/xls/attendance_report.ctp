<?php 

 //pr('ds'); exit;
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/attendance_list.xls");
    
    if (!empty($attendanceData)) {
        
        $addRow = 0;
        foreach ($attendanceData as $key => $attendanceList) {
            $addRow = $key + 1;
        }

        $objTpl->setActiveSheetIndex(0)->insertNewRowBefore(11,$addRow);

        $counter = 10;
        foreach ($attendanceData as $key => $attendanceList) {
            $key++;
           
            $objTpl->setActiveSheetIndex(0)
                        ->setCellValue('C8','Attendace List/' .$departmentList[$departmentId]. ' / ' . (new \DateTime())->format('m/d/Y'))
                        ->setCellValue('A'.$counter, $key)
                        ->setCellValue('B'.$counter, $attendanceList['Employee']['code'])
                        ->setCellValue('C'.$counter, ucwords($attendanceList['Employee']['fullname']).' '.ucwords($attendanceList['Employee']['suffix']))
                        ->setCellValue('D'.$counter, 'work')
                        ->setCellValue('E'.$counter, $attendanceList['WorkShift']['from'])
                        ->setCellValue('F'.$counter, $attendanceList['WorkShift']['to'])
                        ->setCellValue('G'.$counter, $attendanceList['Attendance']['in'])
                        ->setCellValue('H'.$counter, $attendanceList['Attendance']['out'])
                        ->setCellValue('I'.$counter, ' ')
                        ->setCellValue('J'.$counter, ' ')
                        ->setCellValue('K'.$counter, $attendanceList['Attendance']['status'])
                        ->setCellValue('L'.$counter, ' ');

            $counter++;  
            
        }
    }

    //prepare download
    $filename = mt_rand(1,100000).'.xls'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    //header('Content-Type: application/vnd.ms-excel');
    
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    ob_end_clean();
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!

?>