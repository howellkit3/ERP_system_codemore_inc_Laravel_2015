<?php foreach ($quotationData as $quotationList): ?>
   
    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td class="">
                <?php echo $quotationList['Quotation']['name'] ?>  
            </td>
            <td class="">
               
                <?php echo !empty($quotationList['Quotation']['company_id']) ? $companyData[$quotationList['Quotation']['company_id']] : $companyData[$inquiryId[$quotationList['Quotation']['inquiry_id']]] ?>
            </td>
            <td class="text-center">
            <?php echo $quotationList['Quotation']['status'] != (0) ? '<span class="label label-success">Approved</span>' : '<span class="label label-danger">Pending</span>' ; ?>
           
            </td>
            
            <td>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                        </span> ', array('controller' => 'quotations', 'action' => 'view',$quotationList['Quotation']['id'],!empty($quotationList['Quotation']['company_id']) ? $quotationList['Quotation']['company_id'] : $inquiryId[$quotationList['Quotation']['inquiry_id']]),array('class' =>' table-link','escape' => false,'title'=>'Review Quotation'));
                ?>
              
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                    </span>', array('controller' => 'quotations', 'action' => 'delete',$quotationList['Quotation']['id']),array('class' =>' table-link','escape' => false,'title'=>'Delete Quotation'));
                ?>
                
            </td>
        </tr>

    </tbody>
<?php endforeach; ?> 