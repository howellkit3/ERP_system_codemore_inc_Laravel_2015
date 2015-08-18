<?php 

 //pr('ds'); exit;
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/daily_info.xls");
    
    if (!empty($dailyinfoData)) {
        
        $addRow = 0;
        foreach ($dailyinfoData as $key => $dailyinfoList) {
            $addRow = $key + 1;
        }

        $objTpl->setActiveSheetIndex(0)->insertNewRowBefore(11,$addRow);

        $counter = 10;
        foreach ($dailyinfoData as $key => $dailyinfoList) {
            $key++;
           
            $objTpl->setActiveSheetIndex(0)
                        ->setCellValue('C8','Daily Info / ' . (new \DateTime())->format('m/d/Y'))
                        ->setCellValue('A'.$counter, $key)
                        ->setCellValue('B'.$counter, $dailyinfoList['Employee']['code'])
                        ->setCellValue('C'.$counter, ucwords($dailyinfoList['Employee']['fullname']).' '.ucwords($dailyinfoList['Employee']['suffix']))
                        ->setCellValue('D'.$counter, $dailyinfoList['DailyInfo']['date'])
                        ->setCellValue('E'.$counter, $dailyinfoList['DailyInfo']['work'])
                        ->setCellValue('F'.$counter, $dailyinfoList['DailyInfo']['ot'])
                        ->setCellValue('G'.$counter, $dailyinfoList['DailyInfo']['ob'])
                        ->setCellValue('H'.$counter, $dailyinfoList['DailyInfo']['night'])
                        ->setCellValue('I'.$counter, $dailyinfoList['DailyInfo']['night_ot'])
                        ->setCellValue('J'.$counter, $dailyinfoList['DailyInfo']['leave'])
                        ->setCellValue('K'.$counter, $dailyinfoList['DailyInfo']['no_work'])
                        ->setCellValue('L'.$counter, $dailyinfoList['DailyInfo']['type'])
                        ->setCellValue('M'.$counter, $dailyinfoList['DailyInfo']['remark']);

            $counter++;  
            
        }
    }

    //prepare download
    $filename = mt_rand(1,100000).'.xls'; //just some random filename
    header('Content-Type: application/vnd.ms-office');
    //header('Content-Type: application/vnd.ms-excel');
    
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    ob_end_clean();
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!

?>