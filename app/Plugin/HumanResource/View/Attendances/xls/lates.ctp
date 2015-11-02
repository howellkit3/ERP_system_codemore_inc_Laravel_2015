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


            $sheet->setCellValue('A'.$counter,$dateNow);
             
        foreach ($list as $key => $employee) {

            // ->setCellValue('C8',)
            //
           


            $sheet->setCellValue('B'.$counter, $employee['Employee']['code']);

            $sheet->setCellValue('C'.$counter, ucwords($employee['Employee']['full_name']));


            $sheet->setCellValue('D'.$counter, ucwords($employee['MyWorkshift']['from']));

            $sheet->setCellValue('E'.$counter, ucwords($employee['MyWorkshift']['to']));


            $sheet->setCellValue('F'.$counter, ucwords($employee['Attendance']['in']));

            $sheet->setCellValue('G'.$counter, ucwords($employee['Attendance']['out']));

             $sheet->setCellValue('H'.$counter, ucwords($employee['Time']['status']));

            if ($employee['Time']['status'] == 'late') {

                $sheet->getStyle('H'.$counter)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF6600');

            } 
            if ($employee['Time']['status'] == 'absent') {

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