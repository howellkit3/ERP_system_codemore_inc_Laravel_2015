<?php foreach ($inquiryList as $list ): ?>

    <?php foreach ($list['Inquiry'] as $inquirylist ): ?>
    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td class="">
                <?php echo $list['Company']['company_name'] ?>  
            </td>
            <td class="">
                <?php echo $inquirylist['quotes'] ?>
            </td>
            <td class="">
                <?php echo $inquirylist['remarks'] ?>
            </td>

            <td>
                <?php echo date('M d, Y', strtotime($inquirylist['created'])); ?>
            </td>
            <td>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                        </span> ', array('controller' => 'customer_sales', 'action' => 'review_inquiry',$inquirylist['id']),array('class' =>' table-link','escape' => false,'title'=>'Review Inquiry'));
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
                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                    </span>', array('controller' => 'customer_sales', 'action' => 'deleteInquiry',$inquirylist['id']),array('class' =>' table-link','escape' => false,'title'=>'Delete Information'));
                ?>
                
            </td>
        </tr>

    </tbody>
    <?php endforeach; ?> 
<?php endforeach; ?> 