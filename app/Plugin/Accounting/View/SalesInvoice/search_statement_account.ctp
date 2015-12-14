<?php  
foreach ($invoiceData as $invoiceDataList){

    if($invoiceDataList['SalesInvoice']['status'] == '2'){ ?>    
     <tr class="">

        <td class="">
            <?php echo $invoiceDataList['SalesInvoice']['statement_no'];?> 
        </td>

        <td class="">
            <?php echo $invoiceDataList['SalesInvoice']['dr_uuid'];?>
        </td>

        <td class="">
            <?php echo $invoiceDataList['Company']['company_name'];?>
        </td>
        
        <td>
            <?php

                echo $this->Html->link('<span class="fa-stack">
                <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span></span> ', array('controller' => 'sales_invoice', 'action' => 'view',$invoiceDataList['SalesInvoice']['id'],'sa_no'), array('class' =>' table-link','escape' => false, 'title'=>'View Sales Invoice'
                ));

                echo $this->Html->link('<span class="fa-stack">
                <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-paper-plane  fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> Move</font></span></span> ', array('controller' => 'sales_invoice', 'action' => 'move',$invoiceDataList['SalesInvoice']['id'],'sa_no'), array('class' =>' table-link','escape' => false, 'title'=>'Move to Sales Invoice',  'confirm' => 'Do you want to move this  Statement of Account to Sales Invoice?'
            ));

            ?>
        </td>
    </tr>

<?php }
} ?>