<?php
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/Invoice.xlsx");

    $unitPrice = (float) $clientData['QuotationItemDetail']['unit_price'];

    $quantity = (float) $drData['DeliveryDetail']['quantity'] ;
 	
 	$totalQty = $quantity * $unitPrice;

	$vatSale = '';
    
	if($clientData['QuotationItemDetail']['unit_price_currency_id'] == 2  || $clientData['QuotationItemDetail']['vat_status']  == "Vatable Sale"){
		$vatSale = number_format($totalQty,4);
	}

	$vatExem = '';
	if($clientData['QuotationItemDetail']['unit_price_currency_id'] == 2 && $clientData['QuotationItemDetail']['vat_status']  == "Vat Exempted"){

		$vatExem =  number_format($totalQty,4);

	}

	$vat12 = '';
	if($clientData['QuotationItemDetail']['unit_price_currency_id'] == 2 ){

		$totalVat = $totalQty * .12;
		$vat12 = number_format($totalVat,4);

	}

    $zeroRated = '';
    if($clientData['QuotationItemDetail']['unit_price_currency_id'] == 1 || $clientData['QuotationItemDetail']['vat_status']  == "Zero Rated"){

        $zeroRated =  number_format($totalQty,4);

    }

	$totalAmount = '';
	$currency = '';
    $unitPrice = $clientData['QuotationItemDetail']['unit_price'];

	if($clientData['QuotationItemDetail']['unit_price_currency_id'] == 2){

		$totalVat = $totalQty * .12;
		$fullVat = $totalQty + $totalVat;
		$currency = $currencyData[$clientData['QuotationItemDetail']['unit_price_currency_id']];
		$totalAmount = number_format($fullVat,2);

	}else{

		$currency = $currencyData[$clientData['QuotationItemDetail']['unit_price_currency_id']];
		$totalAmount = number_format($totalQty,2);

	}


    $words = explode(" ", $companyData['Address'][0]['address1']);
     //$part = $count($words);
    //pr($words); exit;
    $halfAddress = floor(count($words)/2);
    //pr(count($words)); exit;
    $r = array();
    for ($i = 0; $i <= $halfAddress; $i++) {

        if($i == 0){

            $Addresspart1 = $words[$i];
            $Addresspart2 = $words[$i + $halfAddress + 1];

        }else{
            $addindex = $halfAddress + 1;
            $Addresspart1 = $Addresspart1 . " " . $words[$i];

            if($i != $halfAddress){
            $Addresspart2 = $Addresspart2 . " " . $words[$i + $halfAddress + 1];
            }   
        }

    }
 
    $objTpl->setActiveSheetIndex(0)
                ->setCellValue('C7', ucwords($companyData['Company']['company_name']))
                ->setCellValue('C8', ucwords($Addresspart1))
                ->setCellValue('C9', ucwords($Addresspart2))
                ->setCellValue('J7', (new \DateTime())->format('m/d/Y'))
                ->setCellValue('J8', $companyData['Company']['tin'])
                ->setCellValue('J9', $paymentTermData[$clientData['ClientOrder']['payment_terms']])
                ->setCellValue('B12', $clientData['ClientOrder']['po_number'])
                ->setCellValue('F12', ucfirst($clientData['Product']['name']))
                ->setCellValue('D12', number_format($drData['DeliveryDetail']['quantity']))
                ->setCellValue('I12', number_format($unitPrice,4))
                ->setCellValue('K12', number_format($totalQty,4))
                ->setCellValue('D26', 'DR#00'.$drData['Delivery']['dr_uuid'])
                ->setCellValue('K29', $vatSale)
                ->setCellValue('K30', $vatExem)
                ->setCellValue('K31', $zeroRated)
                ->setCellValue('K32', $vat12)
                ->setCellValue('K33', $currency.' '. $totalAmount);
      
    //prepare download
    $filename = mt_rand(1,100000).'.xlsx'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!
?>