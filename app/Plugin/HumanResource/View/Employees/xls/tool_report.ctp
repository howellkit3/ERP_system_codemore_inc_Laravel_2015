<?php 

 //pr('ds'); exit;
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()
        ->setDefaultFont('Calibri', 12);

    $objTpl = PHPExcel_IOFactory::load("./img/assign_tool.xls");

    if (!empty($toolingData)) {
       
        $addRow = 0;
        foreach ($toolingData as $key => $toolList) {
            $addRow = $key + 1;
        }

        $objTpl->setActiveSheetIndex(0)->insertNewRowBefore(11,$addRow);

        $counter = 10;
        foreach ($toolingData as $key => $toolList) {
            $key++;
           
            $objTpl->setActiveSheetIndex(0)
                        ->setCellValue('C8','Assigned Tools /' .(new \DateTime())->format('m/d/Y'))
                        ->setCellValue('A'.$counter, $key)
                        ->setCellValue('B'.$counter, $toolList['Employee']['code'])
                        ->setCellValue('C'.$counter, ucfirst($departmentList[$toolList['Employee']['department_id']]))
                        ->setCellValue('D'.$counter, ucfirst($positionList[$toolList['Employee']['position_id']]))
                        ->setCellValue('E'.$counter, ucwords($toolList['Employee']['fullname']).' '.ucwords($toolList['Employee']['suffix']))
                        ->setCellValue('F'.$counter, ucfirst($toolList['Tool']['name']))
                        ->setCellValue('G'.$counter, $toolList['Tooling']['quantity'])
                        ->setCellValue('H'.$counter, $toolList['Tooling']['price'])
                        ->setCellValue('I'.$counter, $toolList['Tooling']['pay'])
                        ->setCellValue('J'.$counter, $toolList['Tooling']['status']);

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