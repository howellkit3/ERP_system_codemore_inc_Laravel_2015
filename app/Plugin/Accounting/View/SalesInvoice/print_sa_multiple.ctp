<?php
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/statement_updated.xls");

    $statementnum = "SA".str_pad($invoiceData['SalesInvoice']['statement_no'], 6, '0', STR_PAD_LEFT); 
    $drnum = "DR".str_pad($drData[0]['Delivery']['dr_uuid'], 6, '0', STR_PAD_LEFT);

    $words = explode(" ", $drData[0]['DeliveryDetail']['location']);

    if(count($words) > 3){

        $halfAddress = floor(count($words)/2);
      
        $r = array();
        for ($i = 0; $i <= $halfAddress; $i++) {

            if($i == 0){

                $Addresspart1 = $words[$i];
                $Addresspart2 = $words[$i + $halfAddress + 1];

            }else{

                $addindex = $halfAddress + 1;
                $Addresspart1 = $Addresspart1 . " " . $words[$i];
               // pr(); exit;
               if(count($words) == ($i + $halfAddress + 1)){

                    if($i != $halfAddress){

                        $Addresspart2 = $Addresspart2 . " " . $words[$i + $halfAddress  ];
                    }   

                }else{
                   
                    if($i != $halfAddress){

                        $Addresspart2 = $Addresspart2 . " " . $words[$i + $halfAddress + 1 ];

                    }

                }
            }
        }
    }else{

        $Addresspart1 = $drData[0]['DeliveryDetail']['location'];
        $Addresspart2 = "";
      
    }


    $totalAmount = '';
    $currency = '';
    $unitPrice = $drData[0]['QuotationItemDetail']['unit_price'];

    if($drData[0]['QuotationItemDetail']['unit_price_currency_id'] == 2 && $drData[0]['QuotationItemDetail']['vat_status'] == "Vatable Sale"){

        $currency = $currencyData[$drData[0]['QuotationItemDetail']['unit_price_currency_id']];

    }else{

        $currency = $currencyData[$drData[0]['QuotationItemDetail']['unit_price_currency_id']];

    }


    $cell =  $objTpl->setActiveSheetIndex(0);
    $cell->setCellValue('C7', ucwords($drData[0]['Company']['company_name']));
    $cell->setCellValue('C8', $Addresspart1);
    $cell->setCellValue('C9', $Addresspart2);
    $cell->setCellValue('I6', $statementnum);

    $cell->setCellValue('I7', date('m/d/Y'));

    $cell->setCellValue('I8', $drData[0]['Company']['tin']);


    $cell->setCellValue('I9', ucfirst($paymentTermData[$drData[0]['ClientOrder']['payment_terms']]));


    $start = 12;
    
    $amount = 0;
    
    foreach ($drData as $key => $list) {

          $amount = 0;

          $cell->setCellValue('A'.$start, ucfirst($list['ClientOrder']['po_number']));

          $cell->setCellValue('C'.$start, ucfirst($list['Product']['name']));

          $cell->setCellValue('F'.$start, number_format($list['DeliveryDetail']['quantity']));

          $cell->setCellValue('H'.$start, $list['QuotationItemDetail']['unit_price']);
          
          $amount = $list['DeliveryDetail']['quantity'] * $list['QuotationItemDetail']['unit_price'];
          
          $cell->setCellValue('J'.$start,number_format($amount,2));
    
    }


    $cell->setCellValue('C25', $drnum);

    $cell->setCellValue('I31',$currency.' '.number_format($amount,2));
                   
    //prepare download
    $filename = 'statement-'.date('ymd').'-'.mt_rand(1,100000).'.xlsx'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!
?>