<?php 

 //pr('ds'); exit;
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/cause_memo.xls");

    if (!empty($causeMemoData)) {
        
        $addRow = 0;
        foreach ($causeMemoData as $key => $causeMemoList) {
            $addRow = $key + 1;
        }

        $objTpl->setActiveSheetIndex(0)->insertNewRowBefore(11,$addRow);

        $counter = 10;
        foreach ($causeMemoData as $key => $causeMemoList) {
            $key++;
           
            $objTpl->setActiveSheetIndex(0)
                        ->setCellValue('C8','Absence /' .(new \DateTime())->format('m/d/Y'))
                        ->setCellValue('A'.$counter, $key)
                        ->setCellValue('B'.$counter, $causeMemoList['Employee']['code'])
                        ->setCellValue('C'.$counter, ucwords($causeMemoList['Employee']['fullname']).' '.ucwords($causeMemoList['Employee']['suffix']))
                        ->setCellValue('D'.$counter, $causeMemoList['CauseMemo']['description'])
                        ->setCellValue('E'.$counter, $violationData[$causeMemoList['CauseMemo']['violation_id']])
                        ->setCellValue('F'.$counter, $disciplinaryAction[$causeMemoList['CauseMemo']['disciplinary_action_id']])
                        ->setCellValue('G'.$counter, $causeMemoList['CauseMemo']['status_id'])
                        ->setCellValue('G'.$counter, ucwords($noted[$causeMemoList['CauseMemo']['noted_user_id']]));

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