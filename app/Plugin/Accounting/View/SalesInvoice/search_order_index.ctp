<?php 
foreach ($invoiceData as $invoiceDataList): 

    if($invoiceDataList['SalesInvoice']['status'] != '2'){

    ?>    
    <tr class="">

        <td class="">
            <?php echo $invoiceDataList['SalesInvoice']['sales_invoice_no'];?> 
        </td>

       <!--  <td class="">
           <?php echo $invoiceDataList['SalesInvoice']['statement_no'];?>
        </td> -->

        <td class="">
            <?php echo $invoiceDataList['SalesInvoice']['dr_uuid'];?>
        </td>

        <td class="">
            <?php  

            echo $invoiceDataList['Company']['company_name'];?>
        </td> 
        
        <td class="text-center">
            <?php 
                                                if ($invoiceDataList['SalesInvoice']['status'] == 1) {

                                                    echo "<span class='label label-success'>Invoice</span>";

                                                } else if($invoiceDataList['SalesInvoice']['status'] == 5){

                                                    echo "<span class='label label-danger'>Terminated</span>";

                                                } else if($invoiceDataList['SalesInvoice']['status'] == 3){

                                                    echo "<span class='label label-danger'>Cancel</span>";


                                                }else{

                                                    echo "<span class='label label-info'>Pre-Invoice</span>";
                                                }
                                            ?>
        </td>

        <td>
            <?php
                echo $this->Html->link('<span class="fa-stack">
                <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span></span> ', array('controller' => 'sales_invoice', 'action' => 'view',$invoiceDataList['SalesInvoice']['id']), array('class' =>' table-link','escape' => false, 'title'=>'View Sales Invoice'
                ));
            ?>

             <?php

                echo $this->Html->link('<span class="fa-stack">
                <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-paper-plane  fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> Move</font></span></span> ', array('controller' => 'sales_invoice', 'action' => 'move',$invoiceDataList['SalesInvoice']['id']), array('class' =>' table-link','escape' => false, 'title'=>'Move to Statement of Acccount'
                ));

            ?>

            <?php

                echo $this->Html->link('<span class="fa-stack">
                <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-trash  fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> Cancel </font></span></span> ', array('controller' => 'sales_invoice', 'action' => 'cancel',$invoiceDataList['SalesInvoice']['id']), array('class' =>' table-link','escape' => false, 'title'=>'View Sales Invoice'
                ));

            ?>
        </td>
    </tr>

<?php 
     }
        endforeach; ?>