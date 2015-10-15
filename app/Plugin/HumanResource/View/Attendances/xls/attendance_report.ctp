<?php

    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 10);

    $objTpl = PHPExcel_IOFactory::load("./img/attendance_report_list.xls");
    
    $objTpl->setActiveSheetIndex(0)
    ->setCellValue('A2','DATE : '. date('Y-m-d'))->getStyle('A3:AK3')->getFont()->setBold(true);

    $counter = 5;
      $sheet = $objTpl->getActiveSheet();
        foreach ($attendanceData as $key => $employee) {
            $key++;
           
                       // ->setCellValue('C8',)
                         $sheet->setCellValue('A'.$counter,$key);
                         $sheet->setCellValue('B'.$counter, $employee['Employee']['code']);
                        $sheet->setCellValue('C'.$counter, ucwords($employee['Employee']['first_name']));

                        $sheet->setCellValue('D'.$counter, ucwords($employee['Employee']['last_names']));

                        $sheet->setCellValue('E'.$counter, ucwords($employee['Employee']['middle_name']));
                        // ->setCellValue('D'.$counter, 'work')

                        $sheet->setCellValue('F'.$counter, ucwords($employee['Attendance']['date']));

                           $in = !empty($employee['Attendance']['in']) ? date('H:i a',strtotime($employee['Attendance']['in'])) : ''; 
                        $sheet->setCellValue('G'.$counter, $in);


                        $out = !empty($employee['Attendance']['out']) ? date('H:i a',strtotime($employee['Attendance']['out'])) : ''; 
                        $sheet->setCellValue('H'.$counter, $out);


                   $timeWork =  $this->CustomTime->getDurationSchedule($employee['Attendance']['in'],$schedule['Attendance']['out'],$employee['MyWorkshift'],$employee['MyBreakTime']); 

                        $sheet->setCellValue('I'.$counter, $timeWork);


                        //ot
                        $out = !empty($employee['Attendance']['out']) ? date('H:i a',strtotime($employee['Attendance']['out'])) : ''; 
                        $sheet->setCellValue('J'.$counter, '-');

                        $sheet->setCellValue('K'.$counter, $employee['Attendance']['remarks']);

                        // ->setCellValue('D'.$counter, 'work')
                        // ->setCellValue('E'.$counter, $attendanceList['WorkShift']['from'])
                        // ->setCellValue('F'.$counter, $attendanceList['WorkShift']['to'])
                        // ->setCellValue('G'.$counter, $attendanceList['Attendance']['in'])
                        // ->setCellValue('H'.$counter, $attendanceList['Attendance']['out'])
                        // ->setCellValue('I'.$counter, ' ')
                        // ->setCellValue('J'.$counter, ' ')
                        // ->setCellValue('K'.$counter, $attendanceList['Attendance']['status'])
                        // ->setCellValue('L'.$counter, ' ');

            $counter++;  
            
        }


    //prepare download
    $filename = 'monthly-report-'.date('y-m-d').'-'.time().'.xls'; //just some random filename
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