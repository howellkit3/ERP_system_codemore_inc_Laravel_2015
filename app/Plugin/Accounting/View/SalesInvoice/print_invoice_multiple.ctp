<?php
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/InvoiceMultiple.xlsx");

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

	// if($clientData['QuotationItemDetail']['unit_price_currency_id'] == 2 && $clientData['QuotationItemDetail']['vat_status'] == "Vatable Sale"){

	// 	$totalVat = $totalQty * .12;
	// 	$fullVat = $totalQty + $totalVat;
	// 	$currency = $currencyData[$clientData['QuotationItemDetail']['unit_price_currency_id']];
	// 	$totalAmount = number_format($fullVat,2);

	// }else{

	// 	$currency = $currencyData[$clientData['QuotationItemDetail']['unit_price_currency_id']];
	// 	$totalAmount = number_format($totalQty,2);

	// }

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

    $start = 12;

        $total = 0;
        $delivery_date = array();
        foreach ($drData as $key => $list) {

            $delivery_date[] = date('M d, Y', strtotime($list['Delivery']['created']));

            $sheet->setCellValue('B'.$start, $list['ClientOrder']['po_number']);
            $sheet->setCellValue('F'.$start, ucfirst($list['Product']['name']));
            $sheet->setCellValue('D'.$start, number_format($list['DeliveryDetail']['quantity']));
            $sheet->setCellValue('I'.$start, number_format($list['QuotationItemDetail']['unit_price'],2));

            $unitPrice = (float) $list['QuotationItemDetail']['unit_price'];
            $quantity = (float) $list['DeliveryDetail']['quantity'] ;
            $totalQty = $quantity * $unitPrice;
            $sheet->setCellValue('K'.$start, number_format($totalQty,2)); $total += $totalQty;
        $sheet->setCellValue('K'.$start, $totalQty);

            $start++;
        }   
        
        $sheet->setCellValue('K33', $currency.' '. number_format($total,2)); 
        
        $sheet->setCellValue('J7', $drData[0]['Delivery']['created']); 

        $sheet->setCellValue('D26', 'DR#'.$drData[0]['Delivery']['dr_uuid']);
        
                // ->setCellValue('C7', ucwords($drData[0]['Company']['company_name']))
                // ->setCellValue('C8', ucwords($Addresspart1))
                // ->setCellValue('C9', ucwords($Addresspart2))
                // ->setCellValue('C10', ucwords($Addresspart3))
                // ->setCellValue('J7', date('M d, Y', strtotime($drData['Delivery']['created'])))
                // ->setCellValue('J8', $clientData['Company']['tin'])
                // ->setCellValue('J9', $paymentTermData[$clientData['ClientOrder']['payment_terms']])
                // ->setCellValue('B12', $clientData['ClientOrder']['po_number'])
                // ->setCellValue('F12', ucfirst($clientData['Product']['name']))
                // ->setCellValue('D12', number_format($drData['DeliveryDetail']['quantity']))
                // ->setCellValue('I12', number_format($unitPrice,4))
                // ->setCellValue('K12', number_format($totalQty,2))
                // ->setCellValue('D26', 'DR#'.$drNum)
                // ->setCellValue('K29', $vatSale)
                // ->setCellValue('K30', $vatExem)
                // ->setCellValue('K31', $zeroRated)
                // ->setCellValue('K32', $vat12)
                // ->setCellValue('K33', $currency.' '. $totalAmount);  
              //  ->setCellValue('K33', 'd');      
   
   //prepare download
    $filename = mt_rand(1,100000).'.xlsx'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!
?>