<?php
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/delivery_template.xlsx");
     
    // add data
    $counter = 10;
   
        $phpPrice = '';
        $usdPrice = '';
        $totalQty = $clientData['QuotationItemDetail']['quantity'] * $drData['DeliveryDetail']['quantity'];
        $preparedFName = ucwords($prepared['User']['first_name']) ;
        $preparedLName = ucwords($prepared['User']['last_name'])  ;
        $approvedFName = ucwords($approved['User']['first_name'])  ;
        $approvedLName = ucwords($approved['User']['last_name'])  ;

        $objTpl->setActiveSheetIndex(0)
                    
                    ->setCellValue('J'.'4', '')
                    ->setCellValue('J'.'5', (new \DateTime())->format('m/d/Y'))
                    ->setCellValue('J'.'6', $drData['Delivery']['dr_uuid'])
                    ->setCellValue('C'.'6', ucwords($companyData['Company']['company_name']))
                    ->setCellValue('C'.'7', ucwords($drData['DeliveryDetail']['location']))
                    ->setCellValue('C'.'9', ucfirst($clientData['Product']['name']))
                    ->setCellValue('C'.'10', $drData['DeliveryDetail']['remarks'] )
                    ->setCellValue('H'.'9', $drData['DeliveryDetail']['quantity'] . " x " . $clientData['QuotationItemDetail']['quantity'] . " / " . $units[$clientData['QuotationItemDetail']['quantity_unit_id']] )
                    ->setCellValue('J'.'9', $totalQty)
                    ->setCellValue('A'.'21', $preparedFName . " " .$preparedLName)
                    ->setCellValue('E'.'21', $approvedFName . " " .$approvedLName);

        $counter++;  

    //$objTpl->setActiveSheetIndex(0)->insertNewRowBefore(17);

    //prepare download
    $filename = mt_rand(1,100000).'.xlsx'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!

?>