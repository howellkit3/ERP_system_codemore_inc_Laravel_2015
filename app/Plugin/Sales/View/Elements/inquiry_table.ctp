<?php foreach ($inquiryData as $inquiryList ):?>
    
    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td class="">
                <?php echo ucfirst($companyData[$inquiryList['Inquiry']['company_id']]) ?>  
            </td>
            <td class="">
                <?php echo substr(ucfirst($inquiryList['Inquiry']['quotes']),0,25) ?>...
                
            </td>
            <td class="">
                <?php echo substr(ucfirst($inquiryList['Inquiry']['remarks']),0,25) ?>..
            </td>
            <td class="text-center">
                <span class="label label-success">
                    <?php echo count($inquiryList['Quotation']); ?>
                </span>
            </td>
            <td>
                <?php echo date('M d, Y', strtotime($inquiryList['Inquiry']['created'])); ?>
            </td>
            <td>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> View </font></span>
                        </span> ', array('controller' => 'customer_sales', 'action' => 'review_inquiry',$inquiryList['Inquiry']['id']),array('class' =>' table-link','escape' => false,'title'=>'Review Inquiry'));
                ?>
                <?php
                    // echo $this->Html->link('<span class="fa-stack">
                    // <i class="fa fa-square fa-stack-2x"></i>
                    // <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                    // </span> ', array('controller' => 'customer_sales', 'action' => 'edit',$inquirylist['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information'));
                ?>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                    </span>', array('controller' => 'customer_sales', 'action' => 'delete_inquiry',$inquiryList['Inquiry']['id']),array('class' =>' table-link','escape' => false,'title'=>'Delete Information','confirm' => 'Do you want to delete Inquiry ?'));
                ?>
                
            </td>
        </tr>

    </tbody>
<?php endforeach; ?> 