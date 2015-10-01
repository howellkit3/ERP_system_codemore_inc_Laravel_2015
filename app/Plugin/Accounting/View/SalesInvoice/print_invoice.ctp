<?php
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/Invoice.xlsx");
 	
 	$totalQty = $drData['DeliveryDetail']['quantity'] * number_format($clientData['QuotationItemDetail']['unit_price'],2);
	
	$vatSale = '';
	if($clientData['QuotationItemDetail']['unit_price_currency_id'] == 1){
		$vatSale = number_format($totalQty,2);
	}

	$vatExem = '';
	if($clientData['QuotationItemDetail']['unit_price_currency_id'] == 2){

		$vatExem =  number_format($totalQty,2);

	}

	$vat12 = '';
	if($clientData['QuotationItemDetail']['unit_price_currency_id'] == 1){

		$totalVat = $totalQty * .12;
		$vat12 = number_format($totalVat,2);

	}

	$totalAmount = '';
	$currency = '';
	if($clientData['QuotationItemDetail']['unit_price_currency_id'] == 1){

		$totalVat = $totalQty * .12;
		$fullVat = $totalQty + $totalVat;
		$currency = $currencyData[$clientData['QuotationItemDetail']['unit_price_currency_id']];
		$totalAmount = number_format($fullVat,2);

	}else{

		$currency = $currencyData[$clientData['QuotationItemDetail']['unit_price_currency_id']];
		$totalAmount = number_format($totalQty,2);

	}

    $objTpl->setActiveSheetIndex(0)
                ->setCellValue('C7', ucfirst($companyData['Company']['company_name']))
                ->setCellValue('I7', (new \DateTime())->format('m/d/Y'))
                ->setCellValue('I8', $companyData['Company']['tin'])
                ->setCellValue('C8', ucfirst($companyData['Address'][0]['address1']))
                ->setCellValue('I9', $paymentTermData[$clientData['ClientOrder']['payment_terms']])
                ->setCellValue('A12', $clientData['ClientOrder']['po_number'])
                ->setCellValue('C12', ucfirst($clientData['Product']['name']))
                ->setCellValue('F12', number_format($drData['DeliveryDetail']['quantity']))
                ->setCellValue('H12', $clientData['QuotationItemDetail']['unit_price'])
                ->setCellValue('J12', number_format($totalQty,2))
                ->setCellValue('C22', 'DR#'.$drData['Delivery']['dr_uuid'])
                ->setCellValue('J26', $vatSale)
                ->setCellValue('J31', $vatExem)
                ->setCellValue('J32', $vat12)
                ->setCellValue('J33', $currency.' '.$totalAmount);
      
    //prepare download
    $filename = mt_rand(1,100000).'.xlsx'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!
?>