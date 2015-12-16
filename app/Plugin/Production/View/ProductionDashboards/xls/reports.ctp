<?php
	
	$this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 10);

	$objTpl = PHPExcel_IOFactory::load("./img/production/production_reports.xls");
	$counter = 5;

	// $objTpl->setActiveSheetIndex(0)
	// ->setCellValue('A2','Yearly Salary Report: '. $year )->getStyle('A3:AK3')->getFont()->setBold(true);

	$sheet = $objTpl->getActiveSheet();
	$counter = 5;

   	$styleArrayBorder = array(
          'borders' => array(
            'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN
            )
          )
        );

    foreach ($tickets as $key => $ticket) {
          
          $sheet->setCellValue('A'.$counter,$ticket['RecievedTicket']['created']);
          $date = !empty($ticket['ClientOrderDeliverySchedule']['schedule']) ? date('Y-m-d',strtotime($ticket['ClientOrderDeliverySchedule']['schedule'])) : ''; 
          $sheet->setCellValue('B'.$counter,$ticket['ClientOrderDeliverySchedule']['schedule']);

         
          if (!empty($ticket['TicketProcessSchedule']['production_date_from']) && !empty($ticket['TicketProcessSchedule']['production_date_to']) ) {

          	 $production_date = !empty($ticket['TicketProcessSchedule']['production_date_from']) ? date('Y-m-d',strtotime($ticket['TicketProcessSchedule']['production_date_from'])).' - '.date('Y-m-d',strtotime($ticket['TicketProcessSchedule']['production_date_to'])) : '';

          	 $sheet->setCellValue('C'.$counter,$production_date);
          }
        

       	  $counter++;         
    }

 	$filename = 'production-plan-'.date('y-m-d').'-'.time().'.xls'; //just some random filename
    //header('Content-Type: application/vnd.ms-office');
    header('Content-Type: application/vnd.ms-office');
    
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    ob_end_clean();
    //$objWriter->setReadDataOnly( true );
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
         

    exit; //done.. exiting!