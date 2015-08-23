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

        //deductions 
        $ca_fund = !empty($emp['ca_fund']) ? $emp['ca_fund'] : number_format(0,2);
        $sss_loan = !empty($emp['sss_loan']) ? $emp['sss_loan'] : number_format(0,2);
        $pagibig_loan = !empty($emp['pagibig_loan']) ? $emp['pagibig_loan'] : number_format(0,2);
        $uniform = !empty($emp['uniform']) ? $emp['uniform'] : number_format(0,2);
        
        $other_1 = 0;
        $other_2 = 0;
        $medical = 0;
        $canteen = 0;
        $bank_loan = 0;
        $incentives = 0;


        $night = number_format(0,2);

        $night += $emp['night'];
        $night += $emp['night_diff_ot'];
        $night += $emp['night_diff_legal_holiday'];
        $night += $emp['night_diff_legal_holiday_work'];
        $night += $emp['night_diff_special_holday'];
        $night += $emp['night_diff_special_holday_work'];
        $night += $emp['night_diff_sunday_work'];
        $night += $emp['night_diff_sunday_work_ot'];

 
         $objTpl->setActiveSheetIndex(0)
        ->setCellValue('A'.$counter,$employee_name)
        ->setCellValue('B'.$counter,$emp['days'])
        ->setCellValue('C'.$counter,number_format($emp['regular'],2))
        ->setCellValue('D'.$counter,number_format($emp['OT'],2))
        ->setCellValue('E'.$counter,number_format($emp['sunday_work'],2))
        ->setCellValue('F'.$counter,number_format($emp['sunday_work_ot'],2))
        ->setCellValue('G'.$counter,number_format($emp['legal_holiday'],2))
        ->setCellValue('H'.$counter,number_format($emp['legal_holiday_work'],2))
        ->setCellValue('I'.$counter,number_format($emp['regular_holiday_work_ot'],2))

        ->setCellValue('J'.$counter,number_format($emp['regular_holiday_work_ot'],2))
        ->setCellValue('N'.$counter,number_format( $night,2))
        ->setCellValue('P'.$counter,number_format($emp['ctpa'],2))
        ->setCellValue('Q'.$counter,number_format($emp['sea'],2))
        //deductions
        ->setCellValue('W'.$counter,number_format($ca_fund,2))
        ->setCellValue('X'.$counter,number_format($sss_loan,2))
        ->setCellValue('Y'.$counter,number_format($pagibig_loan,2))
        ->setCellValue('Z'.$counter,number_format($uniform,2))
        ->setCellValue('Z'.$counter,number_format($uniform,2))

        ->setCellValue('R'.$counter,number_format($emp['gross_pay'],2))
        ->setCellValue('S'.$counter,number_format($emp['sss'],2))
        ->setCellValue('T'.$counter,number_format($emp['pagibig'],2))

        ->setCellValue('T'.$counter,number_format($emp['pagibig'],2))
        ->setCellValue('AF'.$counter,number_format($emp['total_deduction'],2))
        ->setCellValue('AH'.$counter,number_format($emp['allowance'],2))
        ->setCellValue('AG'.$counter,number_format($emp['total_pay'],2))
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