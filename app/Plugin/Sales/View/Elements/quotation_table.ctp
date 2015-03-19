<?php foreach ($quotationData as $quotationList): ?>
   
    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td class="">
                <?php echo ucfirst($quotationList['Product']['product_name']) ?>  
            </td>
            <td class="">
               
                <?php echo !empty($quotationList['Quotation']['company_id']) ? ucfirst($companyData[$quotationList['Quotation']['company_id']]) : ucfirst($companyData[$inquiryId[$quotationList['Quotation']['inquiry_id']]]) ?>
            </td>
            <td class="text-center">
                <?php foreach ($quotationList['QuotationField'] as $validity):
                    if ($validity['custom_fields_id'] == 12) {
                        echo $validity['description'];
                        # code...
                    }
                endforeach;?>
            </td>
            <td class="text-center">
            <?php 
                if($quotationList['Quotation']['status'] == (1)) {
                   echo '<span class="label label-default">Pending</span>'; 
                }
                if($quotationList['Quotation']['status'] == (2)) {
                   echo '<span class="label label-success">Approved</span>'; 
                }
                if($quotationList['Quotation']['status'] == (3)) {
                   echo '<span class="label label-danger">terminate</span>'; 
                }
                if($quotationList['Quotation']['status'] == (4)) {
                   echo '<span class="label label-warning">withdraw</span>'; 
                }



            //echo $quotationList['Quotation']['status'] != (1) ? '<span class="label label-success">Approved</span>' : '<span class="label label-danger">Pending</span>' ; ?>
           <?php
                if(!empty($salesStatus[$quotationList['Quotation']['id']])){
                    echo "<span class='label label-success'>Sales Order</span>";
                     //echo $salesStatus[$quotationList['Quotation']['id']];
                }
               
            ?>
            </td>
            
            <td>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Review </font></span>
                        </span> ', array('controller' => 'quotations', 'action' => 'view',$quotationList['Quotation']['id'],!empty($quotationList['Quotation']['company_id']) ? $quotationList['Quotation']['company_id'] : $inquiryId[$quotationList['Quotation']['inquiry_id']]),array('class' =>' table-link','escape' => false,'title'=>'Review Quotation'));
                ?>

                <?php
                if ($quotationList['Quotation']['status'] != (1)) {

                   echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                    </span> ', array('controller' => 'quotations', 'action' => 'edit',$quotationList['Quotation']['id'],!empty($quotationList['Quotation']['company_id']) ? $quotationList['Quotation']['company_id'] : $inquiryId[$quotationList['Quotation']['inquiry_id']]),array('class' =>' table-link','escape' => false,'title'=>'Review Quotation'));
                }

                ?>
              
                <?php
                    // echo $this->Html->link('<span class="fa-stack">
                    // <i class="fa fa-square fa-stack-2x"></i>
                    // <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                    // </span>', array('controller' => 'quotations', 'action' => 'delete',$quotationList['Quotation']['id']),array('class' =>' table-link','escape' => false,'title'=>'Delete Quotation','confirm' => 'Do you want to delete Quotaion ?'));
                ?>
                
            </td>
        </tr>

    </tbody>
<?php endforeach; ?> 