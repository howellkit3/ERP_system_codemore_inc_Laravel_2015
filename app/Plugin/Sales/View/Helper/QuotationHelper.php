<?php
App::uses('HtmlHelper', 'View/Helper');

class QuotationHelper extends HtmlHelper {
    
    
    function findProduct($status = null) {
        

        ClassRegistry::init('Sales.Product');

        $return = false;

        if ($status == 1) {

            $return = true;
        }
       
       return $return;

    }	

    
    
}
?>