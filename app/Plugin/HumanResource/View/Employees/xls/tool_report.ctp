<?php 

 //pr('ds'); exit;
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/tool_record.xls");
    $counter = 5;
    foreach ($toolingData as $key => $toolList) {
        $key++;
       
        $objTpl->setActiveSheetIndex(0)
                    ->setCellValue('A1',(new \DateTime())->format('m/d/Y'))
                    ->setCellValue('A'.$counter, $key)
                    ->setCellValue('B'.$counter, $toolList['Employee']['first_name'].' '.$toolList['Employee']['middle_name'].' '.$toolList['Employee']['last_name'].' '.$toolList['Employee']['suffix'])
                    ->setCellValue('C'.$counter, $toolList['Tool']['name'])
                    ->setCellValue('D'.$counter, $toolList['Tooling']['quantity'])
                    ->setCellValue('E'.$counter, $toolList['Tooling']['price'])
                    ->setCellValue('F'.$counter, $toolList['Tooling']['pay'])
                    ->setCellValue('G'.$counter, $toolList['Tooling']['status']);

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