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

    foreach ($employees as $key => $emp) {
        $key++;
        $employee_name = $this->CustomText->getFullname($emp['Employee']);

        $gross = $this->Salaries->gross_pay($emp,$emp['Salary']); echo number_format($gross['gross'],2); $total_gross = $gross['gross'];

        $sss = $this->Salaries->sss_pay($employee,$employee['Salary'],$payScheds,$gross['gross']); $total_gross -= $sss;

        $phil_health = $this->Salaries->philhealth_pay($employee,$employee['Salary'],$payScheds,$gross['gross']); $total_gross -= $phil_health; 

        $objTpl->setActiveSheetIndex(0)
        ->setCellValue('A'.$counter,$employee_name)
        ->setCellValue('B'.$counter,$gross['days'])
        ->setCellValue('C'.$counter,$gross['time_work'])
        ->setCellValue('T'.$counter,$gross['gross'])
        ->setCellValue('U'.$counter,$sss)
        ->setCellValue('V'.$counter,$phil_health)
         ->setCellValue('AL'.$counter,$total_gross)
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