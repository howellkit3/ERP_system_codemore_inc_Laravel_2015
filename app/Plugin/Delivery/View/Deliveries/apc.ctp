<?php
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/apc_dr.xlsx");

    $cellHolder = 2;

    $date = date('Y-m-d'); 
    $objTpl->setActiveSheetIndex(0)

        ->setCellValue('A1', 'DR#'.$drData['Delivery']['dr_uuid'])
        ->setCellValue('A24', $fullname[$drData['Delivery']['created_by']])
        ->setCellValue('D24', $fullname[$prepared])
        ->setCellValue('F24', $fullname[$drData['Delivery']['created_by']])
        ->setCellValue('I5', $date)
        ->setCellValue('E11', $drData['DeliveryDetail']['quantity'] . " " . $measureList[$drData['DeliveryDetail']['measure']])
        ->setCellValue('A11', $clientData['Product']['name'])
        ->setCellValue('C11', $clientData['ClientOrder']['po_number'])
        ->setCellValue('F5',  date('F d, Y', strtotime($clientData['ClientOrderDeliverySchedule']['schedule'])));
   
    $filename = mt_rand(1,100000).'.xlsx'; 
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007'); 
    $objWriter->save('php://output'); 
     
    exit;
?>