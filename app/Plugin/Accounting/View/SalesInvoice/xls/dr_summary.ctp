<?php
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/dr_sum.xls");

    if (!empty($invoiceData)) {
     
        $addRow = 0;
        foreach ($invoiceData as $key => $invoiceList) {
            $addRow = $key + 1;
        }

        $objTpl->setActiveSheetIndex(0)->insertNewRowBefore(5,$addRow);
        // add data
        $counter = 3;
        $totalUsd = 0;
        $totalphp = 0;
        $totalquantity = 0;
        $vat = 0;
        $totalVat = 0;
        foreach ($invoiceData as $key => $invoiceList) {
            $phpPrice = '';
            $usdPrice = '';
            if ($invoiceList['SalesInvoice']['unit_price_currency_id'] == 1) {
                $phpPrice = number_format($invoiceList['SalesInvoice']['unit_price'],2);
                $totalphp = $totalphp + $invoiceList['SalesInvoice']['unit_price'];
                $vat = number_format($totalphp * 0.12,4);
            } else {
                $usdPrice = number_format($invoiceList['SalesInvoice']['unit_price'],2);
                $totalUsd = $totalUsd + $invoiceList['SalesInvoice']['unit_price'];
                $vat = number_format($totalUsd * 0.12,4);
            }
           
            $totalquantity =  $totalquantity + $invoiceList['SalesInvoice']['quantity']  ;
            $totalVat = $totalVat + $vat ;
            
            $objTpl->setActiveSheetIndex(0)
                        ->setCellValue('A'.$counter, date('m/d/Y', strtotime($invoiceList['SalesInvoice']['created'])))
                        ->setCellValue('D'.$counter, $invoiceList['SalesInvoice']['dr_uuid'])
                        ->setCellValue('F'.$counter, $usdPrice)
                        ->setCellValue('G'.$counter, $phpPrice)
                        ->setCellValue('B'.$counter, $companyData[$invoiceList['SalesInvoice']['company_id']])
                        ->setCellValue('H'.$counter, $vat)
                        ->setCellValue('C'.$counter, $companyTinData[$invoiceList['SalesInvoice']['company_id']])
                        // ->setCellValue('I'.$counter, $invoiceList['SalesInvoice']['quantity'])
                        ->setCellValue('E'.$counter, $invoiceList['SalesInvoice']['sales_invoice_no']);
                        // ->setCellValue('K'.$counter, $invoiceList['SalesInvoice']['statement_no'])
            
            $counter++;  
        }
        $totalIndex = $counter + 2 ;
        $objTpl->setActiveSheetIndex(0)
                        // ->setCellValue('A'.$totalIndex, 'SUBTOTAL')
                        // ->setCellValue('F'.$totalIndex, $totalUsd)
                        // ->setCellValue('G'.$totalIndex, $totalphp)
                        ->setCellValue('H'.$totalIndex, $totalVat);
                       // ->setCellValue('I'.$totalIndex, $totalquantity);


    }                 
    //prepare download
    $filename = mt_rand(1,100000).'.xlsx'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!

?>