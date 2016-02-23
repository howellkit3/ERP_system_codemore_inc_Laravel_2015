<?php

    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 10);

   $objTpl = PHPExcel_IOFactory::load("./img/salaries/payroll_report.xlsx");

    $counter = 5;

    $objTpl->setActiveSheetIndex(0)
    ->setCellValue('A2','Payroll '.date('F d',strtotime($payroll['Payroll']['from'])).'-'.date('d',strtotime($payroll['Payroll']['to'])).' '. $payroll['Payroll']['year']);

    // ->getStyle('A4:AK4')
    // ->getFont()->setBold(true);
            
    $styleArrayHeader = array(
                  'font'  => array(
                  'color' => array('rgb' => '000000'),
                  'bold' => true,
                  'name' => 'arial',
                  'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                  )
              ));

    $styleArrayBorder = array(
            'borders' => array(
              'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
              )
            )
          );


    $counter = 6;
    $header = 4;
    $next_header = 5;

    $sheet = $objTpl->getActiveSheet();
    $address = 'AQ'.$header;

   //load all the deductions needed
    foreach ($deductions as $deduction_key => $list) : 

        $split = PHPExcel_Cell::coordinateFromString($address);
        ++$split[0];
        
        $nextRow = preg_replace('/\d/', $next_header ,$address);

        $sheet->setCellValue($address,$list['Loan']['name']);
        
        $sheet->getStyle($address)->applyFromArray($styleArrayHeader);

        $sheet->getStyle($address)->applyFromArray($styleArrayBorder);   

        if (!empty($list['Loan']['description']) ) {

          $sheet->setCellValue($nextRow,$list['Loan']['description']);

          $sheet->getStyle($nextRow)->applyFromArray($styleArrayHeader); 

          $sheet->getStyle($nextRow)->applyFromArray($styleArrayBorder);   

        }

          $sheet->getStyle($address)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $sheet->getStyle($address)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF99');

          $sheet->getStyle($nextRow)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF99');

        $address = implode($split);

    endforeach; 


    $counter = 6;
    $header = 4;
    $next_header = 5;

    $sheet = $objTpl->getActiveSheet();


    $nextFields = array('Net Pay','Irreg OT','Adjustments','Total NET PAY','Tax Status');

    foreach ($nextFields as $key => $list) :
        
        $split = PHPExcel_Cell::coordinateFromString($address);
        ++$split[0];
        
        $nextRow = preg_replace('/\d/', $next_header ,$address);

        $sheet->mergeCells($address.":".$nextRow);

        $sheet->setCellValue($address,$list);
        
        $sheet->getStyle($address)->applyFromArray($styleArrayHeader);

        $sheet->getStyle($address.":".$nextRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle($address.":".$nextRow)->applyFromArray($styleArrayBorder);   


          $sheet->getStyle($address)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF99');

        $address = implode($split);

    endforeach;

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

    $sheet = $objTpl->getActiveSheet();

    foreach ($salaries as $key => $emp) {

        //pr($emp);
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

       // $sheet->setCellValue('A'.$counter,$emp['EmployeeAdditionalInformation']['bank_account_number']);
        $sheet->setCellValue('A'.$counter,  $countEmp );
        $sheet->getStyle('A'.$counter)->applyFromArray($styleArrayBorder);

        $sheet->setCellValue('B'.$counter,  $emp['Employee']['code'] );
        $sheet->getStyle('B'.$counter)->applyFromArray($styleArrayBorder);

        $sheet->setCellValue('C'.$counter,  $employee_name );
        $sheet->getStyle('C'.$counter)->applyFromArray($styleArrayBorder);


           $monthly_rate = $daily_rate =  0;
           //check rate
          if ($emp['Salary']['employee_salary_type'] == 'monthly') {

           
             $monthly_rate = $emp['Salary']['basic_pay'] / 2;
             $daily_rate = $monthly_rate / 13;


          } else {
            $monthly_rate = 0;
             $daily_rate =  $emp['Salary']['basic_pay'];


          }
          
           
          $sheet->setCellValue('D'.$counter,  $monthly_rate );
          $sheet->getStyle('D'.$counter)->applyFromArray($styleArrayBorder);

          $sheet->setCellValue('E'.$counter,  $daily_rate );
          $sheet->getStyle('E'.$counter)->applyFromArray($styleArrayBorder);

         
          //hours regular
          $sheet->setCellValue('F'.$counter,  $emp['hours_regular'] );
          $sheet->getStyle('F'.$counter)->applyFromArray($styleArrayBorder);

          // days
          $days =  $emp['hours_regular'] / 8;
          $sheet->setCellValue('G'.$counter,  $days  );
          $sheet->getStyle('G'.$counter)->applyFromArray($styleArrayBorder);

          $sheet->setCellValue('H'.$counter,  $emp['regular'] );
          $sheet->getStyle('H'.$counter)->applyFromArray($styleArrayBorder);

          //ctpa + sea days      
          if (empty($emp['ctpa']) && empty($emp['sea']) ) {

            $days = '-';

          }
          $sheet->setCellValue('I'.$counter,$days);
          $sheet->getStyle('I'.$counter)->applyFromArray($styleArrayBorder);
          
           //ctpa + sea
          $additional = $emp['ctpa'] + $emp['sea'];
          $sheet->setCellValue('J'.$counter, $additional);
          $sheet->getStyle('J'.$counter)->applyFromArray($styleArrayBorder);

           //Total Basic
          $basic = $emp['regular'] + $additional;
          $sheet->setCellValue('K'.$counter, $basic);
          $sheet->getStyle('K'.$counter)->applyFromArray($styleArrayBorder);

          //OVERTIME
          $sheet->setCellValue('L'.$counter, $emp['hours_ot']);
          $sheet->getStyle('L'.$counter)->applyFromArray($styleArrayBorder);

          $sheet->setCellValue('M'.$counter, number_format($emp['OT'],2));
          $sheet->getStyle('M'.$counter)->applyFromArray($styleArrayBorder);

          //night differential
          $sheet->setCellValue('N'.$counter, $emp['hours_night_diff']);
          $sheet->getStyle('N'.$counter)->applyFromArray($styleArrayBorder);

          $sheet->setCellValue('O'.$counter, $emp['night_diff']);
          $sheet->getStyle('O'.$counter)->applyFromArray($styleArrayBorder);

          //nightdiff OT
          $sheet->setCellValue('P'.$counter, $emp['hours_night_diff_ot']);
          $sheet->getStyle('P'.$counter)->applyFromArray($styleArrayBorder);

          $sheet->setCellValue('Q'.$counter, $emp['night_diff_ot']);
          $sheet->getStyle('Q'.$counter)->applyFromArray($styleArrayBorder); 

          //legal holiday
          $sheet->setCellValue('R'.$counter, $emp['hours_legal_holiday_work']);
          $sheet->getStyle('R'.$counter)->applyFromArray($styleArrayBorder);

          //legal holiday 
          $lholiday = $emp['legal_holiday'] + $emp['legal_holiday_work'];
          $sheet->setCellValue('S'.$counter, $lholiday );
          $sheet->getStyle('S'.$counter)->applyFromArray($styleArrayBorder); 

          //legal holiday 
          $lholiday = $emp['legal_holiday'] + $emp['legal_holiday_work'];
          $sheet->setCellValue('T'.$counter, $lholiday );
          $sheet->getStyle('T'.$counter)->applyFromArray($styleArrayBorder);   

          //special holiday
          $sholiday = $emp['special_holiday'] + $emp['special_holiday_work'];

          $sheet->setCellValue('U'.$counter, $sholiday);
          $sheet->getStyle('U'.$counter)->applyFromArray($styleArrayBorder);   

          //special holiday work night diff
          $sheet->setCellValue('V'.$counter, $emp['hours_special_holiday_work_night_diff']);
          $sheet->getStyle('V'.$counter)->applyFromArray($styleArrayBorder);


          $sheet->setCellValue('W'.$counter, $emp['special_holiday_work_night_diff']);
          $sheet->getStyle('W'.$counter)->applyFromArray($styleArrayBorder);
        
          //hours legal holiday work night diff
          $sheet->setCellValue('X'.$counter, $emp['hours_legal_holiday_work_night_diff']);
          $sheet->getStyle('X'.$counter)->applyFromArray($styleArrayBorder);

          //hours for legal holiday night diff
          $sheet->setCellValue('Y'.$counter, $emp['legal_holiday_work_night_diff']);
          $sheet->getStyle('Y'.$counter)->applyFromArray($styleArrayBorder);

          //hours for legal holiday night diff_ot
          $sheet->setCellValue('Z'.$counter, $emp['hours_legal_holiday_work_night_diff_ot']);
          $sheet->getStyle('Z'.$counter)->applyFromArray($styleArrayBorder);

          //for legal holiday night diff_ot
          $sheet->setCellValue('AA'.$counter, $emp['legal_holiday_work_night_diff_ot']);
          $sheet->getStyle('AA'.$counter)->applyFromArray($styleArrayBorder);

          //sunday work hours
          $sheet->setCellValue('AB'.$counter, $emp['hours_sunday_work']);
          $sheet->getStyle('AB'.$counter)->applyFromArray($styleArrayBorder);

          //sunday work
          $sheet->setCellValue('AC'.$counter, $emp['sunday_work']);
          $sheet->getStyle('AC'.$counter)->applyFromArray($styleArrayBorder);

          //hours sunday work ot
          $sheet->setCellValue('AD'.$counter, $emp['hours_sunday_work_ot']);
          $sheet->getStyle('AD'.$counter)->applyFromArray($styleArrayBorder);

          //sunday work ot
          $sheet->setCellValue('AE'.$counter, $emp['sunday_work_ot']);
          $sheet->getStyle('AE'.$counter)->applyFromArray($styleArrayBorder);

          //hours sunday work night diff
          $sheet->setCellValue('AF'.$counter, $emp['hours_sunday_work_night_diff']);
          $sheet->getStyle('AF'.$counter)->applyFromArray($styleArrayBorder);

          //sunday work night diff
          $sheet->setCellValue('AG'.$counter, $emp['sunday_work_night_diff']);
          $sheet->getStyle('AG'.$counter)->applyFromArray($styleArrayBorder);

          //hours sunday work night diff ot
          $sheet->setCellValue('AH'.$counter, $emp['hours_sunday_work_night_diff']);
          $sheet->getStyle('AH'.$counter)->applyFromArray($styleArrayBorder);

          //sunday work night diff ot
          $sheet->setCellValue('AI'.$counter, $emp['sunday_work_night_diff']);
          $sheet->getStyle('AI'.$counter)->applyFromArray($styleArrayBorder);

          //sunday ctpa + sea days
          $sheet->setCellValue('AJ'.$counter, $emp['sunday_days']);
          $sheet->getStyle('AJ'.$counter)->applyFromArray($styleArrayBorder);
        
          //sunday ctpa + sea days
          $cptasea = $emp['sunday_ctpa'] + $emp['sunday_sea'];
          $sheet->setCellValue('AK'.$counter, $cptasea);
          $sheet->getStyle('AK'.$counter)->applyFromArray($styleArrayBorder);

          //gross pay
          $sheet->setCellValue('AL'.$counter, $emp['gross_pay']);
          $sheet->getStyle('AL'.$counter)->applyFromArray($styleArrayBorder);
          
          //philhealth
          $sheet->setCellValue('AM'.$counter, $emp['philhealth']);
          $sheet->getStyle('AM'.$counter)->applyFromArray($styleArrayBorder);

          //pagibig
          $sheet->setCellValue('AN'.$counter, $emp['pagibig']);
          $sheet->getStyle('AN'.$counter)->applyFromArray($styleArrayBorder); 

          //sss
          $sss = 0;
          if (is_numeric($emp['sss'])) {
            $sss = $emp['sss'];
          }
          $sheet->setCellValue('AO'.$counter, number_format($sss,2));
          $sheet->getStyle('AO'.$counter)->applyFromArray($styleArrayBorder); 

          //withholding tax
          $tax = !empty($emp['with_holding_tax']) ? number_format($emp['with_holding_tax'],2) : 0;
          $sheet->setCellValue('AP'.$counter, $tax );
          $sheet->getStyle('AP'.$counter)->applyFromArray($styleArrayBorder);   

          //last porsition
          $address = 'AQ'.$counter;

          $next_field = $address;

          //load all the deductions needed
          foreach ($deductions as $deduction_key => $list) : 

               $split = PHPExcel_Cell::coordinateFromString($next_field);
                ++$split[0];


              $nextRow = preg_replace('/\d/', $next_header ,$address);

              $field = $list['Loan']['name'];

              if (!empty($list['Loan']['description'])) {

                $field .= ' '.$list['Loan']['description'];
              }
              
              $index = str_replace(' ','_',strtolower($field));

              $value = !empty($emp[$index]) ? $emp[$index] : '0';

              $sheet->setCellValue($next_field, number_format($value,2));

             // $sheet->setCellValue($next_field,$list['Loan']['name']);
              
              $sheet->getStyle($next_field)->applyFromArray($styleArrayBorder);   



              $next_field = implode($split);
      
          endforeach; 

          $nextFields = array('net_pay','excess_ot','adjustments','total_pay');

          foreach ($nextFields as $key => $value) {

             $split = PHPExcel_Cell::coordinateFromString($next_field);
                ++$split[0];

              
             $list_value = !empty($emp[$value]) ? $emp[$value] : '0';

             $sheet->setCellValue($next_field, number_format($list_value,2));


              $sheet->getStyle($next_field)->applyFromArray($styleArrayBorder);   

             $next_field = implode($split);
          }


        //withholding tax
        $sheet->setCellValue($next_field, $emp['EmployeeAdditionalInformation']['status']);
        $sheet->getStyle($next_field)->applyFromArray($styleArrayBorder);  

        $key++;
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
    //$objWriter->setReadDataOnly( true );
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
         

    exit; //done.. exiting!



?>