<?php 

 //pr('ds'); exit;
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/leave_report.xls");

    if (!empty($leaveData)) {
        
        $addRow = 0;
        foreach ($leaveData as $key => $leaveList) {
            $addRow = $key + 1;
        }

        $objTpl->setActiveSheetIndex(0)->insertNewRowBefore(11,$addRow);

        $counter = 10;
        foreach ($leaveData as $key => $leaveList) {
            $key++;
           if ($leaveList['Leave']['status'] == 8) {
                $status = 'Waiting';
            }
            if ($leaveList['Leave']['status'] == 1) {
                $status = 'Approved';
            }

            $objTpl->setActiveSheetIndex(0)
                        ->setCellValue('C8','Leave /' .(new \DateTime())->format('m/d/Y'))
                        ->setCellValue('A'.$counter, $key)
                        ->setCellValue('B'.$counter, $leaveList['Employee']['code'])
                        ->setCellValue('C'.$counter, ucwords($leaveList['Employee']['fullname']).' '.ucwords($leaveList['Employee']['suffix']))
                        ->setCellValue('D'.$counter, ucfirst($leaveList['LeaveType']['name']))
                        ->setCellValue('E'.$counter, $leaveList['Leave']['from'])
                        ->setCellValue('F'.$counter, $leaveList['Leave']['to'])
                        ->setCellValue('G'.$counter, $status)
                        ->setCellValue('G'.$counter, $leaveList['Leave']['remarks']);

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