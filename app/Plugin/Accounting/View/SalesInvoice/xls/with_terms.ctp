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

        $objTpl->setActiveSheetIndex(3)->insertNewRowBefore(5,$addRow);

        // add data
        $counter = 3;
        $fulltotalphp = 0;
        $fulltotalusd = 0;
        $fulltotalPhpSale = 0;
        $fullpercent = 0;
        $SubSum = '';
        $PhpSum = '';
        $TotalSum = '';
        $phpPrice = '';
        $totalphp = '';
        $phptotal = '';
        $usdPrice = '';
        $Pricephp = '';
        $Priceusd = '';
        //$phpTotal = '';
        $totalP = '';
        $arrayAmount = array();

        foreach ($invoiceData as $key => $invoiceList) {

            if ($invoiceList['SalesInvoice']['unit_price_currency_id'] == 1) {

                $Pricephp = number_format($invoiceList['SalesInvoice']['unit_price'],2);

                array_push($arrayAmount,$Pricephp);

            } else {

                $Priceusd = number_format($invoiceList['SalesInvoice']['unit_price'],2);

                array_push($arrayAmount,$Priceusd);

            }

        } 

        foreach ($invoiceData as $key => $invoiceList) {

            if ($invoiceList['SalesInvoice']['unit_price_currency_id'] == 1) {
                $phpPrice = number_format($invoiceList['SalesInvoice']['unit_price'],2);
                $totalphp = number_format($invoiceList['SalesInvoice']['unit_price'],2);
                $fulltotalphp = number_format($fulltotalphp + $invoiceList['SalesInvoice']['unit_price'],2);
                $totalPhpSale = number_format($invoiceList['SalesInvoice']['unit_price'],2);
                $fulltotalPhpSale = $fulltotalPhpSale + $invoiceList['SalesInvoice']['unit_price'];
                $usdPrice = " ";

            } else {

                $usdPrice = number_format($invoiceList['SalesInvoice']['unit_price'],2);
                $fulltotalusd = number_format($fulltotalusd + $invoiceList['SalesInvoice']['unit_price'],2);
                $phpTotal = 44.221 * $invoiceList['SalesInvoice']['unit_price'];
                $totalP = number_format($phpTotal,2);
                $totalPhpSale = number_format($phpTotal,2);
                $fulltotalPhpSale = $fulltotalPhpSale + $phpTotal;
                $phpPrice = " ";

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
                    ->setCellValue('B'.$counter, $companyData[$invoiceList['SalesInvoice']['company_id']])
                    ->setCellValue('D'.$counter, $phpPrice)
                    ->setCellValue('C'.$counter, $usdPrice)
                    ->setCellValue('E'.$counter, $phpPrice + $usdPrice)
                   // ->setCellValue('F'.$counter, $fullpercent )
                    //->setCellValue('F'.$counter, $totalP)
                    ->setCellValue('F'.$counter, ($phpPrice + $usdPrice)/array_sum ($arrayAmount));
                    //->setCellValue('G'.$counter, $totalPhpSale)
                    //->setCellValue('H'.$counter, $percent);
                    //->setCellValue('J'.$counter, $paymentTermData[$invoiceList['SalesInvoice']['payment_terms']])
                    //->setCellValue('K'.$counter, date('m/d/Y', strtotime($invoiceList['SalesInvoice']['schedule'])));

            $counter++;  
           
        }

        $totalIndex = $counter + 2;
        $objTpl->setActiveSheetIndex(3)
                        ->setCellValue('D'.$totalIndex, $fulltotalphp)
                        ->setCellValue('C'.$totalIndex, $fulltotalusd)
                        ->setCellValue('E'.$totalIndex, array_sum ( $arrayAmount ))
                        ->setCellValue('G'.$totalIndex, $fulltotalPhpSale)
                        ->setCellValue('H'.$totalIndex, $fullpercent); 
    }
    
    $filename = mt_rand(1,100000).'.xlsx'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!

?>