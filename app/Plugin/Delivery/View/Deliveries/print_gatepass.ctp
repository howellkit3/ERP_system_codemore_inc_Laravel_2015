<?php
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/gatepass1.xlsx");
 	
 	$objTpl->setActiveSheetIndex(0)
                        ->setCellValue('J3', $gateData['GatePass']['id'])
                        ->setCellValue('J6', (new \DateTime())->format('l, F d, Y '))
                        ->setCellValue('B8', ucwords($clientData['Product']['name']))
                        ->setCellValue('F8', $drData['DeliveryDetail']['quantity'])
                        ->setCellValue('I8', $units[$clientData['QuotationItemDetail']['quantity_unit_id']])
                        ->setCellValue('J8', $gateData['GatePass']['remarks'])
                        ->setCellValue('C10', ucwords(strtoupper($truckList[$gateData['GatePass']['truck_id']])))
                        ->setCellValue('C11', ucwords($driverList[$gateData['GatePass']['driver_id']]));
    $counter =  12;                   
    foreach ($assistData as $key => $helperlist) {
        $objTpl->setActiveSheetIndex(0)
                        ->setCellValue('C'.$counter, ucwords($assList[$helperlist['GatePassAssistant']['helper_id']]));
        $counter++;
    }
                       
    //prepare download
    $filename = mt_rand(1,100000).'.xlsx'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
    
    //header("location:".base_url()."../view/".$deliveryScheduleId."/".$quotationId."/".$clientsOrderUuid);
    exit; //done.. exiting!
?>