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
            <?php //echo $invoiceDataList['SalesInvoice']['dr_uuid'];?>

              <?php 
                    if (!empty($invoiceDataList['SalesInvoice']['deliveries'])) {
                        
                    $drList = json_decode($invoiceDataList['SalesInvoice']['deliveries']);


                    foreach ($drList as $key => $value) {
                        echo $value.'<br>';
                      }                                       //  echo str_pad($invoiceDataList['SalesInvoice']['dr_uuid'],5,'0',STR_PAD_LEFT);

                    } else {

                    echo str_pad($invoiceDataList['SalesInvoice']['dr_uuid'],5,'0',STR_PAD_LEFT);
                    
                    } 
             ?>
        </td>

        <?php if($indicator == 'si') : ?>


                                        <td>
                                            <?php 

                                                if (!empty($invoiceDataList['SalesInvoice']['apc_dr'])) {

                                                    echo $invoiceDataList['SalesInvoice']['apc_dr'];
                                                }

                                            ?>
                                        </td>
    <?php endif; ?>

        <td class="">
            <?php  

            //echo $invoiceDataList['Company']['company_name']; 


              if (!empty($invoiceDataList['SalesInvoice']['deliveries'])) {

                 echo $companyData[$clientDataHolder[$deliveryNumHolder[$drList[0]]]];
              } else {
                 echo $companyData[$clientDataHolder[$deliveryNumHolder[$invoiceDataList['SalesInvoice']['dr_uuid']]]];
              }

            ?>




        </td> 

        
                                        <td>
                                            <?php echo !empty($invoiceDataList['SalesInvoice']['invoice_date']) ?  date('m/d/Y',strtotime($invoiceDataList['SalesInvoice']['invoice_date'])) :  date('m/d/Y',strtotime($invoiceDataList['SalesInvoice']['created'])); ?>                                        </td>

        
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