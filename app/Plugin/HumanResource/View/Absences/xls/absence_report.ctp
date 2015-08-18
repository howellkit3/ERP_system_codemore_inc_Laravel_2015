<?php 

 //pr('ds'); exit;
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/absence_report.xls");

    if (!empty($absenceData)) {
        
        $addRow = 0;
        foreach ($absenceData as $key => $absenceList) {
            $addRow = $key + 1;
        }

        $objTpl->setActiveSheetIndex(0)->insertNewRowBefore(11,$addRow);

        $counter = 10;
        foreach ($absenceData as $key => $absenceList) {
            $key++;
           
            $objTpl->setActiveSheetIndex(0)
                        ->setCellValue('C8','Absence /' .(new \DateTime())->format('m/d/Y'))
                        ->setCellValue('A'.$counter, $key)
                        ->setCellValue('B'.$counter, $absenceList['Employee']['code'])
                        ->setCellValue('C'.$counter, ucwords($absenceList['Employee']['fullname']).' '.ucwords($absenceList['Employee']['suffix']))
                        ->setCellValue('D'.$counter, $absenceList['Absence']['from'])
                        ->setCellValue('E'.$counter, $absenceList['Absence']['to'])
                        ->setCellValue('F'.$counter, $absenceList['Absence']['total_time'])
                        ->setCellValue('F'.$counter, $absenceList['Absence']['reason']);

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