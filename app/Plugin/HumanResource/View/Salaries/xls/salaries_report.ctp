<?php

    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 10);

    $objTpl = PHPExcel_IOFactory::load("./img/salaries/salaries.xls");
    $counter = 5;
    
    $objTpl->setActiveSheetIndex(0)
    ->setCellValue('A2','Payroll '.$payrollDate )

    ->getStyle('A4:AK4')
    ->getFont()->setBold(true);
            

    $counter = 6;

    foreach ($salaries as $key => $emp) {
        $key++;
        $employee = $this->CustomEmployee->findEmployee($emp['employee_id']);
        $employee_name = $this->CustomText->getFullname($employee['Employee']);

        
         $objTpl->setActiveSheetIndex(0)
        ->setCellValue('A'.$counter,$employee_name)
        ->setCellValue('B'.$counter,$emp['days'])
        ->setCellValue('C'.$counter,number_format($emp['regular_work'],2))
        ->setCellValue('D'.$counter,number_format($emp['regular_work_ot'],2))
        ->setCellValue('G'.$counter,number_format($emp['regular_holiday'],2))
        ->setCellValue('H'.$counter,number_format($emp['regular_holiday_work'],2))
        ->setCellValue('I'.$counter,number_format($emp['regular_holiday_work_ot'],2))

        ->setCellValue('P'.$counter,number_format($emp['ctpa'],2))

        ->setCellValue('Q'.$counter,number_format($emp['sea'],2))


        ->setCellValue('R'.$counter,number_format($emp['gross_pay'],2))
        ->setCellValue('S'.$counter,number_format($emp['sss'],2))
        ->setCellValue('T'.$counter,number_format(0,2))
         ->setCellValue('AH'.$counter,number_format($emp['allowance'],2))
         ->setCellValue('AJ'.$counter,number_format($emp['total_pay'],2))
        ;

        $counter++;  
        
    }

    //prepare download
    $filename = 'salaries-'.date('y-m-d').'-'.time().'.xls'; //just some random filename
    //header('Content-Type: application/vnd.ms-office');
    header('Content-Type: application/vnd.ms-office');
    
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    ob_end_clean();
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!



?>