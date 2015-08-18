<?php 

 //pr('ds'); exit;
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/work_schedule.xls");

    if (!empty($workScheduleData)) {
        
        $addRow = 0;
        foreach ($workScheduleData as $key => $workScheduleList) {
            $addRow = $key + 1;
        }

        $objTpl->setActiveSheetIndex(0)->insertNewRowBefore(11,$addRow);

        $counter = 10;
        foreach ($workScheduleData as $key => $workScheduleList) {
            $key++;
           
            $objTpl->setActiveSheetIndex(0)
                        ->setCellValue('C8','Work Schedules /' .(new \DateTime())->format('m/d/Y'))
                        ->setCellValue('A'.$counter, $key)
                        ->setCellValue('B'.$counter, $workScheduleList['Employee']['code'])
                        ->setCellValue('C'.$counter, ucfirst($departmentList[$workScheduleList['Employee']['department_id']]))
                        ->setCellValue('D'.$counter, ucfirst($positionList[$workScheduleList['Employee']['position_id']]))
                        ->setCellValue('E'.$counter, ucwords($workScheduleList['Employee']['fullname']).' '.ucwords($workScheduleList['Employee']['suffix']))
                        ->setCellValue('F'.$counter, $workScheduleList['WorkSchedule']['day'])
                        ->setCellValue('G'.$counter, $workScheduleList['WorkShift']['name'])
                        ->setCellValue('H'.$counter, $workScheduleList['WorkSchedule']['type']);

            $counter++;  
            
        }
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