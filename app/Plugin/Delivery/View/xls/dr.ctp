<?php
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/delivery_template.xlsx");
     
    // add data
    $counter = 10;
    // foreach ($invoiceData as $key => $invoiceList) {
    //     $phpPrice = '';
    //     $usdPrice = '';
    //     if ($invoiceList['SalesInvoice']['unit_price_currency_id'] == 1) {
    //         $phpPrice = number_format($invoiceList['SalesInvoice']['unit_price'],2);
    //     } else {
    //         $usdPrice = number_format($invoiceList['SalesInvoice']['unit_price'],2);
    //     }

    //     $objTpl->setActiveSheetIndex(0)
    //                 ->setCellValue('B'.$counter, date('m/d/Y', strtotime($invoiceList['SalesInvoice']['created'])))
    //                 ->setCellValue('C'.$counter, $invoiceList['SalesInvoice']['dr_uuid'])
    //                 ->setCellValue('E'.$counter, $usdPrice)
    //                 ->setCellValue('F'.$counter, $phpPrice)
    //                 ->setCellValue('H'.$counter, $companyData[$invoiceList['SalesInvoice']['company_id']])
    //                 ->setCellValue('J'.$counter, $invoiceList['SalesInvoice']['quantity'])
    //                 ->setCellValue('K'.$counter, $invoiceList['SalesInvoice']['sales_invoice_no'])
    //                 ->setCellValue('L'.$counter, $invoiceList['SalesInvoice']['statement_no']);

    //     $counter++;  
    // }

    //$objTpl->setActiveSheetIndex(0)->insertNewRowBefore(17);

    //prepare download
    $filename = mt_rand(1,100000).'.xlsx'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!

?>