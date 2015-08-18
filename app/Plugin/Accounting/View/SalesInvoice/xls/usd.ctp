<?php

    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/dr_sum.xlsx");

    if (!empty($invoiceData)) {
        $addRow = 0;
        foreach ($invoiceData as $key => $invoiceList) {
            $addRow = $key + 1;
        }

        $objTpl->setActiveSheetIndex(1)->insertNewRowBefore(6,$addRow);

        // add data
        $counter = 4;
        $totalusd = 0;
        $totalquantity = 0;
        foreach ($invoiceData as $key => $invoiceList) {

           if ($invoiceList['SalesInvoice']['unit_price_currency_id'] == 2) {

                $usd = $invoiceList['SalesInvoice']['quantity'] * $invoiceList['SalesInvoice']['unit_price'];
                $amountUsd = number_format($usd,1);
                $totalquantity = $totalquantity + $usd;
                $objTpl->setActiveSheetIndex(1)
                            ->setCellValue('B'.$counter, $companyData[$invoiceList['SalesInvoice']['company_id']])
                            ->setCellValue('A'.$counter, date('m/d/Y', strtotime($DeliveryDateData[$invoiceList['SalesInvoice']['dr_uuid']])))
                            ->setCellValue('C'.$counter, $invoiceList['SalesInvoice']['dr_uuid'])
                            ->setCellValue('D'.$counter, $invoiceList['SalesInvoice']['statement_no'])
                            ->setCellValue('E'.$counter, $invoiceList['SalesInvoice']['sales_invoice_no'])
                            ->setCellValue('F'.$counter, $termData[$clientOrderData[$DeliveryClientsOrderData[$invoiceList['SalesInvoice']['dr_uuid']]]])
                            ->setCellValue('G'.$counter, $usd);

                $counter++;  
            }
        }

        $totalIndex = $counter + 4;
        $objTpl->setActiveSheetIndex(1)
                        
                        ->setCellValue('G'.$totalIndex, $totalquantity)
                        ->setCellValue('H2', 42.12);
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

