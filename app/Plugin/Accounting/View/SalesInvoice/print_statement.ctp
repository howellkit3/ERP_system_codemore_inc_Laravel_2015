<?php
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/Statement.xlsx");

    $totalQty = $drData['DeliveryDetail']['quantity'] * number_format($clientData['QuotationItemDetail']['unit_price'],2);;
	$totalQ = number_format($totalQty,2);
	$currency = $currencyData[$clientData['QuotationItemDetail']['unit_price_currency_id']];

    $objTpl->setActiveSheetIndex(0)
                ->setCellValue('I6', $invoiceData['SalesInvoice']['statement_no'])
                ->setCellValue('C7', ucfirst($companyData['Company']['company_name']))
                ->setCellValue('I7', (new \DateTime())->format('m/d/Y'))
                ->setCellValue('I8', $companyData['Company']['tin'])
                ->setCellValue('C9', ucfirst($companyData['Address'][0]['address1']))
                ->setCellValue('I9', $paymentTermData[$clientData['ClientOrder']['payment_terms']])
                ->setCellValue('A12', $clientData['ClientOrder']['po_number'])
                ->setCellValue('C12', ucfirst($clientData['Product']['name']))
                ->setCellValue('F12', number_format($drData['DeliveryDetail']['quantity']))
                ->setCellValue('H12', number_format($clientData['QuotationItemDetail']['unit_price'],2))
                ->setCellValue('J12', $totalQ)
                ->setCellValue('I31', $currency.' '.$totalQ)
                ->setCellValue('A36', strtoupper($approved['User']['first_name']).' '.strtoupper($approved['User']['last_name']));

    //prepare download
    $filename = mt_rand(1,100000).'.xlsx'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!
?>