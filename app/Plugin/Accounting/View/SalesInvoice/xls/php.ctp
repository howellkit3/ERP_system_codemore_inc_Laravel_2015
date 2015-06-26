<?php
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/templates.xlsx");

    $addRow = 0;
    foreach ($invoiceData as $key => $invoiceList) {
        $addRow = $key + 1;
    }

    $objTpl->setActiveSheetIndex(1)->insertNewRowBefore(11,$addRow);

    // add data
    $counter = 10;
    $totalphp = 0;
    $totalquantity = 0;
    foreach ($invoiceData as $key => $invoiceList) {

       if ($invoiceList['SalesInvoice']['unit_price_currency_id'] == 1) {

            $php = $invoiceList['SalesInvoice']['quantity'] * $invoiceList['SalesInvoice']['unit_price'];
            $amountPhp = number_format($php,2);
            $totalquantity = $totalquantity + $php;
            $objTpl->setActiveSheetIndex(1)
                        ->setCellValue('A'.$counter, $companyData[$invoiceList['SalesInvoice']['company_id']])
                        ->setCellValue('B'.$counter, date('m/d/Y', strtotime($invoiceList['SalesInvoice']['created'])))
                        ->setCellValue('C'.$counter, $invoiceList['SalesInvoice']['dr_uuid'])
                        ->setCellValue('D'.$counter, $invoiceList['SalesInvoice']['statement_no'])
                        ->setCellValue('E'.$counter, $invoiceList['SalesInvoice']['sales_invoice_no'])
                        ->setCellValue('F'.$counter, $php)
                        ->setCellValue('F15', 'PHP '. $amountPhp);

            $counter++;  
        }
    }
    $totalIndex = $counter + 3;
    $objTpl->setActiveSheetIndex(1)
                    ->setCellValue('F'.$totalIndex, $totalquantity);
 
    //prepare download
    $filename = mt_rand(1,100000).'.xlsx'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!

?>
















?>