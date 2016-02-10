<?php
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

   // $objTpl = PHPExcel_IOFactory::load("./img/apc_dr.xlsx");
    $objTpl = PHPExcel_IOFactory::load("./img/apc_template.xls");

    $cellHolder = 2;

    $cell = $objTpl->setActiveSheetIndex(0);


//address
    $cell->setCellValue('A3',$toPrint[0]['Company']['Company']['company_name']);

    $cell->setCellValue('A4',$toPrint[0]['DeliveryDetail']['location']);
    
    $cell->setCellValue('H4',date('Y-m-d'));

    $start = 11;

    foreach ($toPrint as $key => $list) {
        
        $cell->setCellValue('A'.$start,$list['ClientOrder']['Product']['name']);

        $cell->setCellValue('C'.$start,$list['ClientOrder']['ClientOrder']['po_number']);

        $cell->setCellValue('E'.$start,$list['DeliveryDetail']['quantity']);

        $start++;
    }

    // $date = date('Y-m-d'); 
    // 
    //     ->setCellValue('A1', 'DR#'.$drData['Delivery']['dr_uuid'])
    //     ->setCellValue('A24', $fullname[$drData['Delivery']['created_by']])
    //     ->setCellValue('D24', $fullname[$prepared])
    //     ->setCellValue('F24', $fullname[$drData['Delivery']['created_by']])
    //     ->setCellValue('I5', $date)
    //     ->setCellValue('E11', $drData['DeliveryDetail']['quantity'] . " " . $measureList[$drData['DeliveryDetail']['measure']])
    //     ->setCellValue('A11', $clientData['Product']['name'])
    //     ->setCellValue('C11', $clientData['ClientOrder']['po_number'])
    //     ->setCellValue('F5',  date('F d, Y', strtotime($clientData['ClientOrderDeliverySchedule']['schedule'])));
   
    $filename = 'apc-'.date('ymd').mt_rand(1,100000).'.xlsx'; 
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007'); 
    $objWriter->save('php://output'); 
     
    exit;
?>