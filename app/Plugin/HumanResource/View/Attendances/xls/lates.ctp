<?php 

 //pr('ds'); exit;
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/reports/lates.xls");

    $objTpl->setActiveSheetIndex(0)
    ->setCellValue('A2','Date : '. $selectedDate)->getStyle('A3:AK3')->getFont()->setBold(true);


    $counter = 6;
    $sheet = $objTpl->getActiveSheet();
       
    $workingTime = array(); 

    foreach ($filter as $key => $list) {

        $dateNow = date('Y-m-d',strtotime($key));


             
        foreach ($list as $key => $employee) {

            // ->setCellValue('C8',)
            //
            $full_name = '';

            $sheet->setCellValue('A'.$counter,$dateNow);
           

            $code = !empty($employee['Employee']['code']) ? $employee['Employee']['code'] : '';

            $sheet->setCellValue('B'.$counter,$code);

            $full_name  = !empty($employee['Employee']['last_name']) ?  ucfirst($employee['Employee']['last_name']).' ': '';

            $full_name  .= !empty($employee['Employee']['first_name']) ?  ucfirst($employee['Employee']['first_name']).' ' : '';

            $full_name  .= !empty($employee['Employee']['middle_name']) ? ucfirst($employee['Employee']['middle_name'][0]) : '';

            $full_name  .= !empty($employee['Employee']['suffix']) ?  ucfirst($employee['Employee']['suffix']) : '';

            $sheet->setCellValue('C'.$counter,$full_name);

            $from = !empty($employee['MyWorkshift']['from']) ?  $employee['MyWorkshift']['from']  : '';
            $sheet->setCellValue('D'.$counter,  $from );

            $to = !empty($employee['MyWorkshift']['to']) ?  $employee['MyWorkshift']['to']  : '';
            $sheet->setCellValue('E'.$counter, $to);

            $in = !empty($employee['Attendance']['in']) ? $employee['Attendance']['in']  : '';

            $sheet->setCellValue('F'.$counter, $in);

            $out = !empty($employee['Attendance']['in']) ? $employee['Attendance']['in']  : '';

            $sheet->setCellValue('G'.$counter,$out);

             $sheet->setCellValue('H'.$counter, ucwords($employee['Time']['status']));

            if ($employee['Time']['status'] == 'late') {

                $sheet->getStyle('H'.$counter)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF6600');

            } else if ($employee['Time']['status'] == 'no_attendance') {

                $sheet->getStyle('H'.$counter)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF0000');

            }

            //  if ($employee['Time']['status'] == 'no_in') {

            //     $sheet->getStyle('H'.$counter)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF0000');

            // }
           

            $counter++;  

          $key++;

        }
    }

    //prepare download
    $filename = 'attendance_lates_report'.date('ymdhis').time().'.xls'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    //header('Content-Type: application/vnd.ms-excel');
    
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    ob_end_clean();
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!

?>