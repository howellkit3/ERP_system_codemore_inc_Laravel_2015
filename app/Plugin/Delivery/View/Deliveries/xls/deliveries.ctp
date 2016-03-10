<?php
    //Configure::write('debug',2);
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/delivery_report.xlsx");

    $sheet = $objTpl->setActiveSheetIndex(0);
    

    $sheet->setCellValue('B4', $selectedDate);

     $sheet->setCellValue('H3', count($deliveries));

    $start = 7;

    foreach ($deliveries as $key => $delivery) {

          $sheet->setCellValue('A'.$start, date('Y/m/d',strtotime($delivery['DeliveryDetail']['schedule'])));

          $sheet->setCellValue('B'.$start, $delivery['Delivery']['dr_uuid']);

          $sheet->setCellValue('C'.$start, $delivery['Delivery']['schedule_uuid']);

          $sheet->setCellValue('D'.$start, $delivery['Delivery']['clients_order_id']);

          //get clients order

          $clientsOrder = $this->DeliveryFunction->getClientsOrder( $delivery['Delivery']['clients_order_id'] );

    
          if (!empty($clientsOrder['ClientOrder']['po_number'])) {
             $sheet->setCellValue('E'.$start, $clientsOrder['ClientOrder']['po_number']);
          
          }
          if (!empty($clientsOrder['Company']['company_name'])) {
          $sheet->setCellValue('F'.$start, $clientsOrder['Company']['company_name']);
          }

          if (!empty($clientsOrder['Product']['name'])) {
          $sheet->setCellValue('G'.$start, $clientsOrder['Product']['name']);
          }
 
          $sheet->setCellValue('H'.$start, !empty($delivery['DeliveryDetail']['delivered_quantity']) ? $delivery['DeliveryDetail']['delivered_quantity'] : '');


          $status = 'Pending';

          if (!empty($delivery['DeliveryDetail']['status'])) {  

              if($delivery['DeliveryDetail']['status'] == '4' && $delivery['Delivery']['status'] == '2'){

                 $status = 'Deleted';

              } 

              else if($delivery['DeliveryDetail']['status'] == '4'){

              $status = 'Delivered';

              }else if($delivery['DeliveryDetail']['status'] == '2'){   

              $status = 'Incomplete';

              }else if($delivery['DeliveryDetail']['status'] == '3' ){

              $status = 'Delivered';

              }else if($delivery['DeliveryDetail']['status'] == '5'){

               $status = 'Terminated';

              }else if($delivery['DeliveryDetail']['status'] == '11'){

               $status = 'Replaced';

              }

          } else {

            $status = 'Pending';

          } 


          $sheet->setCellValue('I'.$start,  $status );
                                    
          
          $start++;
    }

    //exit();
    //prepare download
    $filename = 'deliveries'.date('ymd').mt_rand(1,100000).'.xlsx'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!

?>