<?php

    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 10);

    $objTpl = PHPExcel_IOFactory::load("./img/salaries/salaries.xls");
    $counter = 5;
    
    $objTpl->setActiveSheetIndex(0)
    ->setCellValue('A2','Payroll ' )

    ->getStyle('A4:AK4')
    ->getFont()->setBold(true);
            

    $counter = 6;
    $header = 4;

    $sheet = $objTpl->getActiveSheet();


    $address = 'Z'.$header;

    if (!empty($deductions)) {
              

              foreach ($deductions as $key => $list) {
                
                $split = PHPExcel_Cell::coordinateFromString($address);
                ++$split[0];
                $sheet->setCellValue( $address, $list );
                $address = implode($split);

              }
    }

      //total decuction
     $sheet->setCellValue( $address, 'Total Deduction' );

      //net pay's and total
     $fields = array('Net Pay','Allowances','Incentives/ Adj','Total Pay');

     $next_field = PHPExcel_Cell::coordinateFromString($address);
                  ++$split[0];
     $next_field = implode($split);

     foreach ($fields as $key => $list) {              
                  $split = PHPExcel_Cell::coordinateFromString($next_field);
                  ++$split[0];
                  $sheet->setCellValue( $next_field, $list );
                  $next_field = implode($split);

      }


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

        // $night += $emp['night'];
        // $night += $emp['night_diff_ot'];
        // $night += $emp['night_diff_legal_holiday'];
        // $night += $emp['night_diff_legal_holiday_work'];
        // $night += $emp['night_diff_special_holday'];
        // $night += $emp['night_diff_special_holday_work'];
        // $night += $emp['night_diff_sunday_work'];
        // $night += $emp['night_diff_sunday_work_ot'];

          $sheet = $objTpl->getActiveSheet();
          $sheet->setCellValue('A'.$counter,$employee_name);
      //$sheet->setCellValue('A'.$counter,$emp['employee_id']);
          $sheet->setCellValue('B'.$counter,$emp['days']);
          $sheet->setCellValue('C'.$counter,number_format($emp['regular'],2));
          $sheet->setCellValue('D'.$counter,number_format($emp['OT'],2));
          $sheet->setCellValue('E'.$counter,number_format($emp['sunday_work'],2));
          $sheet->setCellValue('F'.$counter,number_format($emp['sunday_work_ot'],2));
          $sheet->setCellValue('G'.$counter,number_format($emp['legal_holiday'],2));
          $sheet->setCellValue('H'.$counter,number_format($emp['legal_holiday_work'],2));
          $sheet->setCellValue('I'.$counter,number_format($emp['regular_holiday_work_ot'],2));

          $sheet->setCellValue('J'.$counter,number_format($emp['regular_holiday_work_ot'],2));
          $sheet->setCellValue('L'.$counter,number_format($emp['special_holiday'],2));
          $sheet->setCellValue('M'.$counter,number_format($emp['special_holiday_work'],2));
          $sheet->setCellValue('N'.$counter,number_format($emp['special_holiday_work_ot'],2));

          $sheet->setCellValue('O'.$counter,number_format($emp['special_sunday_holiday_work'],2));
          $sheet->setCellValue('P'.$counter,number_format($emp['special_sunday_holiday_work_ot'],2));

          $sheet->setCellValue('Q'.$counter,number_format($night,2));
         
          $sheet->setCellValue('R'.$counter,number_format($emp['leave'],2));

          $sheet->setCellValue('S'.$counter,number_format($emp['ctpa'] ,2));
          $sheet->setCellValue('T'.$counter,number_format($emp['sea'],2));
          //gross pay
          $sheet->setCellValue('U'.$counter,number_format($emp['gross_pay'],2));
    
          $sheet->setCellValue('V'.$counter,number_format($emp['sss'],2));
          $sheet->setCellValue('W'.$counter,number_format($emp['philhealth'],2));
          $sheet->setCellValue('X'.$counter,number_format($emp['pagibig'],2));

          $total_deduction += $emp['sss'];
          $total_deduction += $emp['philhealth'];
          $total_deduction += $emp['pagibig'];

           //deductions
         
          if (!empty($deductions)) {
              
              $innerAddress = 'Z'.$counter;

              foreach ($deductions as $key => $list) {
                
                $split = PHPExcel_Cell::coordinateFromString($innerAddress);
                ++$split[0];
                $index = str_replace(' ','_',strtolower($list));
                $value =  !empty($salary[$index]) ? number_format($salary[$index],2) : number_format(0,2);
                $sheet->setCellValue( $innerAddress, $value );
                $innerAddress = implode($split);
                $total_deduction += $value;
                
              }

          }


          $sheet->setCellValue( $innerAddress, number_format($total_deduction,2));

          //net pay's and total
          $fields = array('net_pay' => 'Net Pay', 'allowances' => 'Allowances', 'incentives' => 'Incentives/ Adj','total_pay' => 'Total Pay');

          $next_field_inner = PHPExcel_Cell::coordinateFromString($innerAddress);
                      ++$split[0];
          $next_field_inner = implode($split);

          foreach ($fields as $fieldsKey => $list) {     

                      $split = PHPExcel_Cell::coordinateFromString($next_field_inner);
                      ++$split[0];
                      $cellValue = !empty($emp[$fieldsKey]) ? number_format($emp[$fieldsKey],2) : '0.00'; 
                      $sheet->setCellValue( $next_field_inner, $cellValue );
                      $next_field_inner = implode($split);
          }

          // $sheet->setCellValue('Z'.$counter,number_format($ca_fund,2));
          // $sheet->setCellValue('AA'.$counter,number_format($sss_loan,2));
          // $sheet->setCellValue('AB'.$counter,number_format($pagibig_loan,2));
          // $sheet->setCellValue('AC'.$counter,number_format($uniform,2));
          // $sheet->setCellValue('AD'.$counter,number_format($emp['other_1'],2));
          // $sheet->setCellValue('AE'.$counter,number_format($emp['medical'],2));
          // $sheet->setCellValue('AF'.$counter,number_format($emp['canteen'],2));
          // $sheet->setCellValue('AG'.$counter,number_format($emp['bank_loan'],2));
          // $sheet->setCellValue('AH'.$counter,number_format($emp['other_2'],2));
          // $sheet->setCellValue('AI'.$counter,number_format($emp['total_deduction'],2));
          
          // $sheet->setCellValue('AJ'.$counter,number_format($emp['net_pay'],2));

          // $sheet->setCellValue('AK'.$counter,number_format($emp['allowances'],2));

          // $sheet->setCellValue('AL'.$counter,number_format($emp['incentives'],2));


          //$sheet->setCellValue('AM'.$counter,number_format($emp['total_pay'],2));
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