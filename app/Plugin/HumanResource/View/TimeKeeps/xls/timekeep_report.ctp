<?php 

 //pr('ds'); exit;
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/time_keep.xls");

    if (!empty($timeKeepData)) {
        
        $addRow = 0;
        foreach ($timeKeepData as $key => $timeKeepList) {
            $addRow = $key + 1;
        }

        $objTpl->setActiveSheetIndex(0)->insertNewRowBefore(11,$addRow);

        $counter = 10;
        foreach ($timeKeepData as $key => $timeKeepList) {
            $key++;
           
            $objTpl->setActiveSheetIndex(0)
                        ->setCellValue('C8','Time Keep, Sign I/O -' .(new \DateTime())->format('m/d/Y'))
                        ->setCellValue('A'.$counter, $key)
                        ->setCellValue('B'.$counter, date('Y/m/d h:i:a',strtotime($timeKeepList['Timekeep']['date'].' '.$timeKeepList['Timekeep']['time'])))
                        ->setCellValue('C'.$counter, $timeKeepList['Employee']['code'])
                        ->setCellValue('D'.$counter, ucwords($timeKeepList['Employee']['fullname']).' '.ucwords($timeKeepList['Employee']['suffix']))
                        ->setCellValue('E'.$counter, $timeKeepList['Timekeep']['type'])
                        ->setCellValue('F'.$counter, $timeKeepList['Timekeep']['notes']);

            $counter++;  
            
        }
    }

    //prepare download
    $filename = mt_rand(1,100000).'.xls'; //just some random filename
    //header('Content-Type: application/vnd.ms-office');
    header('Content-Type: application/vnd.ms-office');
    
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
     
    $objWriter = PHPExcel_IOFactory::createWriter($objTpl, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
    ob_end_clean();
    $objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
     
    exit; //done.. exiting!

?>