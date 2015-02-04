<?php foreach ($quotationData as $quotationList): ?>

    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td class="">
                <?php echo $companyData[$quotationList['Inquiry']['company_id']] ?>  
            </td>
            <td class="">
                <?php echo $quotationList['Inquiry']['quotes'] ?>
            </td>
            
            <td>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                        </span> ', array('controller' => 'quotations', 'action' => 'view',$quotationList['Inquiry']['id']),array('class' =>' table-link','escape' => false,'title'=>'View Quotation'));
                ?>
                <?php
                    // echo $this->Html->link('<span class="fa-stack">
                    // <i class="fa fa-square fa-stack-2x"></i>
                    // <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                    // </span> ', array('controller' => 'customer_sales', 'action' => 'edit',$customerlist['Company']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information'));
                ?>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-print fa-stack-1x fa-inverse"></i>
                    </span>', array('controller' => 'qouotations', 'action' => 'print'),array('class' =>' table-link','escape' => false,'title'=>'Print Quotation'));
                ?>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                    </span>', array('controller' => 'qouotations', 'action' => 'delete',$quotationList['Inquiry']['id']),array('class' =>' table-link','escape' => false,'title'=>'Delete Quotation'));
                ?>
                
            </td>
        </tr>

    </tbody>
<?php endforeach; ?> 