<?php
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/invoice_multiple.xlsx");

    $unitPrice = 0;

    $quantity = 0;
 	
 	$totalQty = 0;

	$vatSale = '';
    
	// if($clientData['QuotationItemDetail']['unit_price_currency_id'] == 2 && $clientData['QuotationItemDetail']['vat_status'] == "Vatable Sale"){
	// 	$vatSale = number_format($totalQty,2);
	// }

	// $vatExem = '';
	// if($clientData['QuotationItemDetail']['vat_status'] == 'Vat Exempt'){

	// 	$vatExem =  number_format($totalQty,2);

	// }

	// $vat12 = '';
	// if($clientData['QuotationItemDetail']['unit_price_currency_id'] == 2 && $clientData['QuotationItemDetail']['vat_status'] == "Vatable Sale"){

	// 	$totalVat = $totalQty * .12;
	// 	$vat12 = number_format($totalVat,2);

	// }

 //    $zeroRated = '';
 //    if($clientData['QuotationItemDetail']['vat_status'] == 'Zero Rated Sale'){

 //        $zeroRated =  number_format($totalQty,2);

 //    }

	$totalAmount = '';
	$currency = '';
    $unitPrice = $drData[0]['QuotationItemDetail']['unit_price'];

	if($drData[0]['QuotationItemDetail']['unit_price_currency_id'] == 2 && $drData[0]['QuotationItemDetail']['vat_status'] == "Vatable Sale"){

		$totalVat = $totalQty * .12;
		$fullVat = $totalQty + $totalVat;
		$currency = $currencyData[$drData[0]['QuotationItemDetail']['unit_price_currency_id']];
		$totalAmount = number_format($fullVat,2);

	}else{

		$currency = $currencyData[$drData[0]['QuotationItemDetail']['unit_price_currency_id']];
		$totalAmount = number_format($totalQty,2);

	}

    $words = explode(" ", $drData[0]['DeliveryDetail']['location']);

    if(count($words) > 3){

        $halfAddress = floor(count($words)/3);
      
        $r = array();
        for ($i = 0; $i <= $halfAddress; $i++) {

            if($i == 0){

                $Addresspart1 = $words[$i];
                $Addresspart2 = $words[$i + $halfAddress + 1];
                $Addresspart3 = $words[$i + $halfAddress + $halfAddress + 1];

            }else{

                $addindex = $halfAddress + 1;
                $Addresspart1 = $Addresspart1 . " " . $words[$i];
    
               if(count($words) == ($i + $halfAddress + 1)){

                    if($i != $halfAddress){
                        $Addresspart2 = $Addresspart2 . " " . $words[$i + $halfAddress  ];
                        $Addresspart3 = $Addresspart3 . " " . $words[$i + $halfAddress + $halfAddress ];
                    }   

                }else{
                   
                    if($i != $halfAddress){

                        $Addresspart2 = $Addresspart2 . " " . $words[$i + $halfAddress + 1 ];

                        if(!empty($words[$i + $halfAddress + $halfAddress + 1 ])){

                            $Addresspart3 = $Addresspart3 . " " . $words[$i + $halfAddress + $halfAddress + 1 ];
                       
                        }else{

                            $Addresspart3 = $Addresspart3 . " " . $words[$i + $halfAddress + $halfAddress];
                        }
                    }

                }
            }
        }
    }else{

        $Addresspart1 = $drData[0]['DeliveryDetail']['location'];
        $Addresspart2 = "";
        $Addresspart3 = "";
      
    }

    $drNum = str_pad($drData[0]['Delivery']['dr_uuid'],5,'0',STR_PAD_LEFT);

    $sheet = $objTpl->setActiveSheetIndex(0);

    $sheet->setCellValue('C7', ucwords($drData[0]['Company']['company_name']));
    $sheet->setCellValue('C8', ucwords( $Addresspart1 ));
    $sheet->setCellValue('C9', ucwords( $Addresspart2 ));
    $sheet->setCellValue('C10', ucwords( $Addresspart3 ));

    $sheet->setCellValue('J8', $drData[0]['Company']['tin']);
    $sheet->setCellValue('J9', $paymentTermData[$drData[0]['ClientOrder']['payment_terms']]);
    
    $start = 12;

       $styleArrayHeader = array(
                  'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                  )
              );

        $total = 0;
        $delivery_date = $vat = $unitPriceID =array();

        
        $invoicedate = !empty($invoiceData['SalesInvoice']['invoice_date'] ) ?  date('m/d/Y', strtotime($invoiceData['SalesInvoice']['invoice_date'])) : '';  
             
        foreach ($drData as $key => $list) {

            $sheet->setCellValue('J7', !empty($invoicedate) ? $invoicedate : date('m/d/Y', strtotime($list['Delivery']['created'])));
            $sheet->setCellValue('B'.$start, $list['ClientOrder']['po_number']);
            $sheet->setCellValue('F'.$start, ucfirst($list['Product']['name']));
            $sheet->setCellValue('D'.$start, number_format($list['DeliveryDetail']['quantity']));
            $sheet->setCellValue('I'.$start, number_format($list['QuotationItemDetail']['unit_price'],4));

            $unitPrice = number_format($list['QuotationItemDetail']['unit_price'],4);
            $quantity = (float) $list['DeliveryDetail']['quantity'] ;
            $totalQty = $quantity * $unitPrice; $total += $totalQty;
            $sheet->setCellValue('K'.$start, number_format($totalQty,2)); 
           // $sheet->setCellValue('K'.$start, $totalQty);

            $vat[] = $list['QuotationItemDetail']['vat_status'];
            $unitPriceID[] = $list['QuotationItemDetail']['unit_price_currency_id'];
            
            $start++;
        }  


    $totalAmount = '';
    $currency = '';
    $unitPrice = $unitPrice;


    $vat12 = '';
    


    if (!in_array('Vatable Sale',$vat) && !in_array('Vatable Exempt',$vat) && !in_array('Zero Rated Sale', $vat))  {
         $vatSale = $total / 1.12;

           $totalVat = $vatSale * .12;
           $vat12 = number_format($totalVat,2);
           $vatSale = number_format($vatSale,2);
    }


    if (in_array('Vatable Sale', $vat) && !in_array('Zero Rated Sale', $vat)) {
        $vatSale = $total / 1.12; 
        $vat12 = number_format($totalVat,2);
        //number_format($total,2);
        $vatSale = number_format($vatSale,2);
    }

    $vatExem = '';
    if (in_array('Vat Exempt', $vat)) {
        $vatExem =  number_format($total,2);

    }
    // if (in_array('Vatable Sale', $vat) && in_array(2, $unitPriceID)) {

    //     $totalVat = $total * .12;
    //     $vat12 = number_format($totalVat,2);

    // }


    $zeroRated = '';
    if (in_array('Zero Rated Sale', $vat)) {
        $zeroRated =  number_format($total,2);

    }


  if (in_array('Vatable Sale', $vat) && in_array(2, $unitPriceID) && !in_array('Zero Rated Sale', $vat)) {
   
        $totalVat = $total * .12;
        $fullVat = $total + $totalVat;
        $currency = $currencyData[$drData[0]['QuotationItemDetail']['unit_price_currency_id']];
        $totalAmount = number_format($fullVat,2);

    }else{

        $currency = $currencyData[$drData[0]['QuotationItemDetail']['unit_price_currency_id']];
        $totalAmount = number_format($total,2);

    } 
         
        $sheet->setCellValue('K33', $currency.' '. $totalAmount); 
        $sheet->setCellValue('K29', $vatSale);
        $sheet->setCellValue('K30', $vatExem);
        $sheet->setCellValue('K31', $zeroRated);
        $sheet->setCellValue('K32', $vat12);
      //  $sheet->setCellValue('J7', $drData[0]['Delivery']['created']); 

        $dr = 26;

        if (!empty($invoiceData['SalesInvoice']['deliveries'])) {
             
             $drNum = json_decode($invoiceData['SalesInvoice']['deliveries']);

             $dr_multiple = '';
             
             foreach ($drNum as $key => $value) {
             
                 $dr_multiple .= 'DR#'.$value.', ';
            }
            
            $sheet->setCellValue('D'.$dr, $dr_multiple);


        } else {
            $sheet->setCellValue('D'.$dr, 'DR#'.$drNum); 
        }
   
        
        if ($invoiceData['SalesInvoice']['status'] == 0) {
             $sheet->setCellValue('D27', $drData[0]['DeliveryDetail']['remarks']);
        }
       
  // prepare download
    $filename = 'invoice-'.date('ymd').mt_rand(1,100000).'.xlsx'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!
?>