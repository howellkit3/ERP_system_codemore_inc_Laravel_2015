<?php
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/transmittal.xls");
     
    // add data
  //pr($contactPerson); exit;
    $counter = 10;
   
        $phpPrice = '';
        $usdPrice = '';
        $totalQty = $clientData['QuotationItemDetail']['quantity'] * $drData['DeliveryDetail']['quantity'];
        $preparedFName = ucwords($prepared['User']['first_name']) ;
        $preparedLName = ucwords($prepared['User']['last_name'])  ;
        $approvedFName = ucwords($approved['User']['first_name'])  ;
        $approvedLName = ucwords($approved['User']['last_name'])  ;
        $toBePrinted = date("M/d/Y");

      if(!empty($TRRePrint[0]['Transmittal']['created'])){   

       $printedDate = date("M/d/Y", strtotime($TRRePrint[0]['Transmittal']['created'])); 

        $toBePrinted =  $printedDate;
                
      }

        $objTpl->setActiveSheetIndex(0)
                    
                    
                    ->setCellValue('J'.'5', $toBePrinted)
                    ->setCellValue('C'.'6', $contactPerson)
                    ->setCellValue('I'.'8', $units[$clientData['QuotationItemDetail']['quantity_unit_id']])
                    ->setCellValue('B'.'8', ucfirst($clientData['Product']['name']))
                    ->setCellValue('J'.'8', $remarks )
                    ->setCellValue('F'.'8', $quantityTransmittal )
                    ->setCellValue('B'.'18', $preparedFName . " " .$preparedLName)
                    ->setCellValue('F'.'18', $approvedFName . " " .$approvedLName);

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