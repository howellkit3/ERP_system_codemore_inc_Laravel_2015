<?php 

 //pr('ds'); exit;
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/breaktime_record.xls");
    $counter = 5;
    foreach ($breaktimeData as $key => $breakList) {
        $key++;
       
        $objTpl->setActiveSheetIndex(0)
                    ->setCellValue('A1',(new \DateTime())->format('m/d/Y'))
                    ->setCellValue('A'.$counter, $key)
                    ->setCellValue('B'.$counter, $breakList['BreakTime']['name'])
                    ->setCellValue('C'.$counter, $breakList['BreakTime']['from'])
                    ->setCellValue('D'.$counter, $breakList['BreakTime']['to']);

        $counter++;  
        
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