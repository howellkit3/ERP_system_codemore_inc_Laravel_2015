<?php
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/templates.xlsx");

    if (!empty($invoiceData)) {
     
        $addRow = 0;
        foreach ($invoiceData as $key => $invoiceList) {
            $addRow = $key + 1;
        }

        $objTpl->setActiveSheetIndex(0)->insertNewRowBefore(11,$addRow);
        // add data
        $counter = 10;
        $totalUsd = 0;
        $totalphp = 0;
        $totalquantity = 0;
        foreach ($invoiceData as $key => $invoiceList) {
            $phpPrice = '';
            $usdPrice = '';
            if ($invoiceList['SalesInvoice']['unit_price_currency_id'] == 1) {
                $phpPrice = number_format($invoiceList['SalesInvoice']['unit_price'],2);
                $totalphp = $totalphp + $invoiceList['SalesInvoice']['unit_price'];
            } else {
                $usdPrice = number_format($invoiceList['SalesInvoice']['unit_price'],2);
                $totalUsd = $totalUsd + $invoiceList['SalesInvoice']['unit_price'];
            }
           
            $totalquantity = $totalquantity + $invoiceList['SalesInvoice']['quantity'] ;
            
            $objTpl->setActiveSheetIndex(0)
                        ->setCellValue('B'.$counter, date('m/d/Y', strtotime($invoiceList['SalesInvoice']['created'])))
                        ->setCellValue('C'.$counter, $invoiceList['SalesInvoice']['dr_uuid'])
                        ->setCellValue('E'.$counter, $usdPrice)
                        ->setCellValue('F'.$counter, $phpPrice)
                        ->setCellValue('H'.$counter, $companyData[$invoiceList['SalesInvoice']['company_id']])
                        ->setCellValue('I'.$counter, $invoiceList['SalesInvoice']['quantity'])
                        ->setCellValue('J'.$counter, $invoiceList['SalesInvoice']['sales_invoice_no'])
                        ->setCellValue('K'.$counter, $invoiceList['SalesInvoice']['statement_no']);
            
            $counter++;  
        }
        $totalIndex = $counter + 3;
        $objTpl->setActiveSheetIndex(0)
                        ->setCellValue('B'.$totalIndex, 'Total')
                        ->setCellValue('E'.$totalIndex, $totalUsd)
                        ->setCellValue('F'.$totalIndex, $totalphp)
                        ->setCellValue('I'.$totalIndex, $totalquantity);
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