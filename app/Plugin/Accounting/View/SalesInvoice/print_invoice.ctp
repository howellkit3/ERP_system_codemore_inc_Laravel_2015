<?php
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/Invoice.xlsx");
 	
 	$totalQty = $drData['DeliveryDetail']['quantity'] * number_format($clientData['QuotationItemDetail']['unit_price'],4);
	
	$vatSale = '';
	if($clientData['QuotationItemDetail']['unit_price_currency_id'] == 1){
		$vatSale = number_format($totalQty,4);
	}

	$vatExem = '';
	if($clientData['QuotationItemDetail']['unit_price_currency_id'] == 2){

		$vatExem =  number_format($totalQty,4);

	}

	$vat12 = '';
	if($clientData['QuotationItemDetail']['unit_price_currency_id'] == 1){

		$totalVat = $totalQty * .12;
		$vat12 = number_format($totalVat,4);

	}

	$totalAmount = '';
	$currency = '';
    $unitPrice = $clientData['QuotationItemDetail']['unit_price'];

	if($clientData['QuotationItemDetail']['unit_price_currency_id'] == 1){

		$totalVat = $totalQty * .12;
		$fullVat = $totalQty + $totalVat;
		$currency = $currencyData[$clientData['QuotationItemDetail']['unit_price_currency_id']];
		$totalAmount = number_format($fullVat,4);

	}else{

		$currency = $currencyData[$clientData['QuotationItemDetail']['unit_price_currency_id']];
		$totalAmount = number_format($totalQty,4);

	}

   
    $words = explode(" ", $companyData['Address'][0]['address1']);
     //$part = $count($words);
    //pr($words); exit;
    $halfAddress = floor(count($words)/2);

    $r = array();
    for ($i = 0; $i <= $halfAddress; $i++) {

        if($i == 0){

            $Addresspart1 = $words[$i];
            $Addresspart2 = $words[$i + $halfAddress];

        }else{

            $Addresspart1 = $Addresspart1 . " " . $words[$i];
            $Addresspart2 = $Addresspart2 . " " . $words[$i + $halfAddress ];
        }

        
      //  pr($r); exit;
    }
   // return $halfAddress == 1 ? $r[0] : $r;

    //$fullAddress = $Addresspart1 . " " . $Addresspart2;

    //pr($fullAddress); exit;

    $objTpl->setActiveSheetIndex(0)
                ->setCellValue('C7', ucwords($Addresspart1))
                ->setCellValue('C8', ucwords($Addresspart2))
                ->setCellValue('J7', (new \DateTime())->format('m/d/Y'))
                ->setCellValue('J8', $companyData['Company']['tin'])
                ->setCellValue('C8', ucfirst($companyData['Address'][0]['address1']))
                ->setCellValue('J9', $paymentTermData[$clientData['ClientOrder']['payment_terms']])
                ->setCellValue('A12', $clientData['ClientOrder']['po_number'])
                ->setCellValue('F12', ucfirst($clientData['Product']['name']))
                ->setCellValue('D12', number_format($drData['DeliveryDetail']['quantity']))
                ->setCellValue('I12', number_format($unitPrice,4))
                ->setCellValue('K12', number_format($totalQty,4))
                ->setCellValue('D26', 'DR#'.$drData['Delivery']['dr_uuid'])
                ->setCellValue('K30', $vatSale)
                ->setCellValue('K31', $vatExem)
                ->setCellValue('K32', $vat12)
                ->setCellValue('K33', $currency.' '.$totalAmount);
      
    //prepare download
    $filename = mt_rand(1,100000).'.xlsx'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!
?>