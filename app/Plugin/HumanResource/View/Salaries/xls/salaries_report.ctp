<?php

    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 10);

    //$objTpl = PHPExcel_IOFactory::load("./img/salaries/salaries_edited.xls");
   
    $objTpl = PHPExcel_IOFactory::load("./img/salaries/payroll_report.xlsx");

    $counter = 5;

    $objTpl->setActiveSheetIndex(0)
    ->setCellValue('A2','Payroll '.date('F d',strtotime($payroll['Payroll']['from'])).'-'.date('d',strtotime($payroll['Payroll']['to'])).' '. $payroll['Payroll']['year']);

    // ->getStyle('A4:AK4')
    // ->getFont()->setBold(true);
            
    $styleArrayHeader = array(
                  'font'  => array(
                  'color' => array('rgb' => '0070C0'),
                  'bold' =>true
                  ));

    $counter = 6;
    $header = 4;
    $next_header = 5;

    $sheet = $objTpl->getActiveSheet();
    $address = 'AI'.$header;
    //next row

   // pr($deductions);

    // //excemption
    // $exemption = array('Pagibig Loan (Calamity)','Pagibig Loan (MPL)');

    // if (!empty($deductions)) {
              
    //         $styleArray = array(
    //             'borders' => array(
    //               'allborders' => array(
    //                 'style' => PHPExcel_Style_Border::BORDER_THIN
    //               )
    //             )
    //           );

    //           foreach ($deductions as $key => $list) {
                
    //             $split = PHPExcel_Cell::coordinateFromString($address);
    //             ++$split[0];
    //             $nextRow = preg_replace('/\d/', $next_header ,$address);
                
    //             if (in_array($list, $exemption)) {

    //               $fields = explode(' ', $list);


    //             $sheet->setCellValue( $address, $fields[0].' '.$fields[1]);
    //             $sheet->getStyle($address)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    //             $sheet->setCellValue( $nextRow, $fields[2]);
    //             $sheet->getStyle($nextRow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

                 
    //             } else {
    //                $sheet->mergeCells($address.":".$nextRow);

    //              $sheet->setCellValue( $address, $list );
    //             }


    //             $sheet->getStyle($address.':'.$nextRow)->applyFromArray($styleArray);

               

    //             $sheet->getStyle($address.':'.$nextRow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
               
    //             $sheet->getStyle($address.':'.$nextRow)->applyFromArray($styleArrayHeader);
    //             $address = implode($split);

    //           }
    // }

   // exit();

     $styleArray = array(
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                  )
                )
              );
     
     //  //total decuction
     // $sheet->setCellValue( $address, 'Total Deduction' );

     //  //net pay's and total
     // $fields = array('Net Pay','Irrg OT','Allowances','Incentives/ Adj','Total Pay');

     // $next_field = $address;

     // foreach ($fields as $key => $list) {             
     //              $split = PHPExcel_Cell::coordinateFromString($next_field);
     //              ++$split[0];

     //              $nextRow = preg_replace('/\d/', $next_header ,$next_field);
     //              $sheet->mergeCells($next_field.":".$nextRow);

     //              $sheet->setCellValue( $next_field, $list );
                  
     //              $sheet->getStyle($next_field.':'.$nextRow)->applyFromArray($styleArray);
     //              $sheet->getStyle($next_field.':'.$nextRow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
     //              $sheet->getStyle($next_field.':'.$nextRow)->applyFromArray($styleArrayHeader);

     //             if ($list == 'Irrg OT') {
     //              $column = preg_replace('/[0-9]+/', '', $next_field);
     //              $sheet->getColumnDimension($column)->setVisible(false);
     //             }
                  
                 
     //              $next_field = implode($split);

     //  }
    //add color if value is negative
    $styleArray = array(
                'font'  => array(
                'color' => array('rgb' => 'F122CB'),
                ));

    $styleArrayBorder = array(
                'borders' => array(
                  'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                  )
                )
              );

    $countEmp = 1;

    foreach ($salaries as $key => $emp) {
        $key++;
        $employee_name = $this->CustomText->getFullname($emp['Employee']);

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

        $total_deduction = number_format(0,2);

        $night = number_format(0,2);

          $sheet = $objTpl->getActiveSheet();
         // $sheet->setCellValue('A'.$counter,$emp['EmployeeAdditionalInformation']['bank_account_number']);
          $sheet->setCellValue('A'.$counter,  $countEmp );
          $sheet->getStyle('A'.$counter)->applyFromArray($styleArrayBorder);

          $sheet->setCellValue('B'.$counter,  $emp['Employee']['code'] );
          $sheet->getStyle('B'.$counter)->applyFromArray($styleArrayBorder);


          $sheet->setCellValue('C'.$counter,  $employee_name );
          $sheet->getStyle('C'.$counter)->applyFromArray($styleArrayBorder);

          //check rate
          if ($emp['Salary']['employee_salary_type'] == 'monthly') {

            $rate = $emp['Salary']['basic_pay'] / 2;

          } else {
             $rate = $emp['Salary']['basic_pay'] / 2;

          }
          
          $sheet->setCellValue('D'.$counter,  $rate );
          $sheet->getStyle('D'.$counter)->applyFromArray($styleArrayBorder);

          //hours regular
          $sheet->setCellValue('E'.$counter,  $emp['hours_regular'] );
          $sheet->getStyle('E'.$counter)->applyFromArray($styleArrayBorder);

          // days
          $days =  $emp['hours_regular'] / 8;
          $sheet->setCellValue('F'.$counter,  $days  );
          $sheet->getStyle('F'.$counter)->applyFromArray($styleArrayBorder);

          $sheet->setCellValue('G'.$counter,  $emp['regular'] );
          $sheet->getStyle('G'.$counter)->applyFromArray($styleArrayBorder);

          //ctpa + sea days      
          if (empty($emp['ctpa']) && empty($emp['sea']) ) {

            $days = '-';

          }
          $sheet->setCellValue('H'.$counter,$days);
          $sheet->getStyle('H'.$counter)->applyFromArray($styleArrayBorder);
          
           //ctpa + sea
          $additional = $emp['ctpa'] + $emp['sea'];
          $sheet->setCellValue('I'.$counter, $additional);
          $sheet->getStyle('I'.$counter)->applyFromArray($styleArrayBorder);

           //Total Basic
          $basic = $emp['regular'] + $additional;
          $sheet->setCellValue('J'.$counter, $basic);
          $sheet->getStyle('J'.$counter)->applyFromArray($styleArrayBorder);

          //OVERTIME
          $sheet->setCellValue('K'.$counter, $emp['hours_ot']);
          $sheet->getStyle('K'.$counter)->applyFromArray($styleArrayBorder);

          $sheet->setCellValue('L'.$counter, $emp['OT']);
          $sheet->getStyle('L'.$counter)->applyFromArray($styleArrayBorder);


          //night differential
          $sheet->setCellValue('M'.$counter, $emp['hours_night_diff']);
          $sheet->getStyle('M'.$counter)->applyFromArray($styleArrayBorder);

          $sheet->setCellValue('N'.$counter, $emp['night_diff']);
          $sheet->getStyle('N'.$counter)->applyFromArray($styleArrayBorder);

          //nightdiff OT
          $sheet->setCellValue('O'.$counter, $emp['hours_night_diff_ot']);
          $sheet->getStyle('O'.$counter)->applyFromArray($styleArrayBorder);

          $sheet->setCellValue('P'.$counter, $emp['night_diff_ot']);
          $sheet->getStyle('P'.$counter)->applyFromArray($styleArrayBorder); 

          //legal holiday
          $sheet->setCellValue('Q'.$counter, $emp['hours_legal_holiday_work']);
          $sheet->getStyle('Q'.$counter)->applyFromArray($styleArrayBorder);

          //legal holiday 
          $lholiday = $emp['legal_holiday'] + $emp['legal_holiday_work'];

          $sheet->setCellValue('R'.$counter, $lholiday );
          $sheet->getStyle('R'.$counter)->applyFromArray($styleArrayBorder); 


          //legal holiday 
          $lholiday = $emp['legal_holiday'] + $emp['legal_holiday_work'];

          $sheet->setCellValue(''.$counter, $lholiday );
          $sheet->getStyle('R'.$counter)->applyFromArray($styleArrayBorder);   


        $countEmp++; 
        
    }

    //prepare download
    $filename = 'salaries-'.date('y-m-d').'-'.time().'.xls'; //just some random filename
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