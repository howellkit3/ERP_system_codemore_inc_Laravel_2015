<?php

    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 10);

    $objTpl = PHPExcel_IOFactory::load("./img/attendance_list_pay.xls");
    
    $objTpl->setActiveSheetIndex(0)
    ->setCellValue('A2','Date : '. date('Y-m-d'))->getStyle('A3:AK3')->getFont()->setBold(true);

    $counter = 5;
    $sheet = $objTpl->getActiveSheet();
       
    $workingTime = array(); 

    foreach ($salaries as $key => $employee) {
            $key++;
           
                       // ->setCellValue('C8',)
                        $sheet->setCellValue('A'.$counter,$key);
                        
                        $sheet->setCellValue('B'.$counter, $employee['Employee']['code']);


                        $sheet->setCellValue('C'.$counter, ucwords($employee['Employee']['last_name']));
                        
                        $sheet->setCellValue('D'.$counter, ucwords($employee['Employee']['first_name']));


                        $sheet->setCellValue('E'.$counter, ucwords($employee['Employee']['middle_name']));
                        // ->setCellValue('D'.$counter, 'work')

                        $sheet->setCellValue('F'.$counter, $employee['days']);


                        $sheet->setCellValue('G'.$counter, $employee['hours_regular']);

                        $sheet->setCellValue('H'.$counter, $employee['hours_night_diff']);

                        $sheet->setCellValue('I'.$counter, $employee['hours_ot']);

                        $sheet->setCellValue('J'.$counter, $employee['hours_sunday_work']);
                        
                        $sheet->setCellValue('K'.$counter, $employee['hours_sunday_work_ot']);


                        $sheet->setCellValue('L'.$counter,$employee['hours_sunday_night_diff']);

                         $sheet->setCellValue('M'.$counter,$employee['sunday_ctpa']);

                         $sheet->setCellValue('N'.$counter,$employee['sunday_sea']);

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

     $total = $counter + 2;

        //ot


    //prepare download
    $filename = 'attendance-user-report-'.date('y-m-d').'-'.time().'.xls'; //just some random filename
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