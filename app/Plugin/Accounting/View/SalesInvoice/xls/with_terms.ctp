<?php
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/templates.xlsx");

    $addRow = 0;
    foreach ($invoiceData as $key => $invoiceList) {
        $addRow = $key + 1;
    }

    $objTpl->setActiveSheetIndex(3)->insertNewRowBefore(8,$addRow);

    // add data
    $counter = 8;
    $fulltotalphp = 0;
    $fulltotalPhpSale = 0;
    $fullpercent = 0;
    foreach ($invoiceData as $key => $invoiceList) {

        $phpPrice = '';
        $totalphp = '';
        $usdPrice = '';
        //$phpTotal = '';
        $totalP = '';
        //$totalPhpSale = '';

        if ($invoiceList['SalesInvoice']['unit_price_currency_id'] == 1) {
            $phpPrice = number_format($invoiceList['SalesInvoice']['unit_price'],2);

            $totalphp = number_format($invoiceList['SalesInvoice']['unit_price'],2);
            $fulltotalphp = $fulltotalphp + $invoiceList['SalesInvoice']['unit_price'];
            $totalPhpSale = number_format($invoiceList['SalesInvoice']['unit_price'],2);
            $fulltotalPhpSale = $fulltotalPhpSale + $invoiceList['SalesInvoice']['unit_price'];
        } else {
            $usdPrice = number_format($invoiceList['SalesInvoice']['unit_price'],2);

            $phpTotal = 44.221 * $invoiceList['SalesInvoice']['unit_price'];
            
            $totalP = number_format($phpTotal,2);

            $totalPhpSale = number_format($phpTotal,2);
            $fulltotalPhpSale = $fulltotalPhpSale + $phpTotal;
        }

        $totalSale = 0;
        foreach ($invoiceData as $key => $invoice) { 
            if ($invoice['SalesInvoice']['unit_price_currency_id'] == 1) {
                $totalSale = $totalSale + $invoice['SalesInvoice']['unit_price'];
                
            } else {
                $phpTotal = 44.221 * $invoice['SalesInvoice']['unit_price'];
                $totalSale = $totalSale + $phpTotal;
                
            }
        }
        
        //$percent = '';
        $fulltotalSale = '';
        if ($invoiceList['SalesInvoice']['unit_price_currency_id'] == 1) {
            $fulltotalSale = $totalSale /  $invoiceList['SalesInvoice']['unit_price'];
            $percent = number_format($fulltotalSale,2);
            $fullpercent = $fullpercent = $fulltotalSale;
        } else {
            $phpTotal = 44.221 * $invoiceList['SalesInvoice']['unit_price'];
            $fulltotalSale = $totalSale /  $phpTotal;
            $percent = number_format($fulltotalSale,2);
            $fullpercent = $fullpercent = $fulltotalSale;
        }
        
        $objTpl->setActiveSheetIndex(3)
                ->setCellValue('C'.$counter, $companyData[$invoiceList['SalesInvoice']['company_id']])
                ->setCellValue('D'.$counter, $phpPrice)
                ->setCellValue('E'.$counter, $usdPrice)
                ->setCellValue('F'.$counter, $totalP)
                ->setCellValue('G'.$counter, $totalPhpSale)
                ->setCellValue('H'.$counter, $percent)
                ->setCellValue('J'.$counter, $paymentTermData[$invoiceList['SalesInvoice']['payment_terms']])
                ->setCellValue('K'.$counter, date('m/d/Y', strtotime($invoiceList['SalesInvoice']['schedule'])));

        $counter++;  
       
    }

    $totalIndex = $counter + 3;
    $objTpl->setActiveSheetIndex(3)
                    ->setCellValue('D'.$totalIndex, $fulltotalphp)
                    ->setCellValue('G'.$totalIndex, $fulltotalPhpSale)
                    ->setCellValue('H'.$totalIndex, $fullpercent);
 
    //prepare download
    $filename = mt_rand(1,100000).'.xlsx'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!

?>