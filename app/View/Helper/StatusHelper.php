<?php
App::uses('HtmlHelper', 'View/Helper');

class StatusHelper extends HtmlHelper {
    
    
      function isQuotationApproved($status = null) {
        
        $return = false;

        if ($status == 1) {

            $return = true;
        }
       
       return $return;

      }         
          
    
    function isQuotationDraft($status = null) {
        
        $return = false;

        if ($status == 'draft') {

            $return = true;
        }
        
        return $return;
       
    }   			
    
}
?>