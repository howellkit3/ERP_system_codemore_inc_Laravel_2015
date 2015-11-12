<?php

    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/dr_sum.xls");

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
        foreach ($receivedItemData as $key => $invoiceList) {

        

                
                $objTpl->setActiveSheetIndex(1)
                            ->setCellValue('B'.$counter, 's')
                            ->setCellValue('A'.$counter, 'd')
                            ->setCellValue('C'.$counter, 'ss')
                            ->setCellValue('D'.$counter, 'sss')
                            ->setCellValue('E'.$counter, 'x')
                            ->setCellValue('F'.$counter,'dd')
                            ->setCellValue('G'.$counter,'s');

                $counter++;  
           
        }

        $totalIndex = $counter + 4;

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

