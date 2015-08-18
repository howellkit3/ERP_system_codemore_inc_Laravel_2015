<?php 

 //pr('ds'); exit;
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/delivery_template.xls");
     
    // add data

    // pr($measureList); exit;
    $counter = 10;
   
        $phpPrice = '';
        $usdPrice = '';
        $totalQty = $clientData['QuotationItemDetail']['quantity'] * $drData['DeliveryDetail']['quantity'];
        $dividend = $drData['DeliveryDetail']['quantity'] / $drData['DeliveryDetail']['pieces'];
        $difference = $drData['DeliveryDetail']['quantity'] - (floor($dividend) * $drData['DeliveryDetail']['pieces']);
        $preparedFName = ucwords($prepared['User']['first_name']) ;
        $preparedLName = ucwords($prepared['User']['last_name'])  ;
        $approvedFName = ucwords($approved['User']['first_name'])  ;
        $approvedLName = ucwords($approved['User']['last_name'])  ;
        $toBePrinted = date("M/d/Y");
        $quantity = $drData['DeliveryDetail']['quantity'];
        $remarks = $drData['DeliveryDetail']['remarks'];
       
        if(!empty($drQuantity)){

            $quantity = $drQuantity;

            if(!empty($drRemarks)){

                $remarks = $drRemarks;

            }else{

                $remarks = " ";

            }               
        }

        $objTpl->setActiveSheetIndex(0)
                    

                    ->setCellValue('J'.'4', '')
                    ->setCellValue('I'.'6', $drData['Delivery']['id'])
                    ->setCellValue('C'.'6', ucwords($companyData['Company']['company_name']))
                    ->setCellValue('A'.'9', $clientData['ClientOrder']['po_number'])
                    ->setCellValue('C'.'7', ucwords($drData['DeliveryDetail']['location']))
                    ->setCellValue('C'.'9', ucfirst($clientData['Product']['name']))
                    ->setCellValue('C'.'10', $remarks)
                    ->setCellValue('J'.'9', $drData['DeliveryDetail']['quantity'])
                    ->setCellValue('A'.'21', $preparedFName . " " .$preparedLName)
                    ->setCellValue('E'.'21', $approvedFName . " " .$approvedLName)
                    ->setCellValue('I'.'5', $toBePrinted);

        if($difference == 0){

        $objTpl->setActiveSheetIndex(0)
                    
                    ->setCellValue('H'.'9', $drData['DeliveryDetail']['pieces'] . " x " .  floor($dividend) . " / " . $measureList[$drData['DeliveryDetail']['measure']] );

        }else{

        $objTpl->setActiveSheetIndex(0)
                    
                    ->setCellValue('H'.'9', $drData['DeliveryDetail']['pieces'] . " x " .  floor($dividend)  . " + " . floor($difference) . " / " . $measureList[$drData['DeliveryDetail']['measure']] );

        }

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