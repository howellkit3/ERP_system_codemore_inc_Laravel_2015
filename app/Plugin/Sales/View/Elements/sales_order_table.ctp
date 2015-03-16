<?php foreach ($salesOder as $salesOderlist): ?>

    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td class="">
                <?php echo ucfirst($salesOderlist['Quotation']['unique_id']) ?>  
            </td>
            <td class="">
                <?php echo !empty($salesOderlist['Quotation']['company_id']) ? ucfirst($companyData[$salesOderlist['Quotation']['company_id']]) : ucfirst($companyData[$inquiryId[$salesOderlist['Quotation']['inquiry_id']]]) ?>
            </td> 
            <td class="text-center">
                <?php echo $salesOderlist['SalesOrder']['status'] != (0) ? '<span class="label label-success">Approved</span>' : '<span class="label label-danger">Pending</span>' ; ?>
            </td>

            <td class="text-center">
                <?php echo date('M d, Y', strtotime($salesOderlist['SalesOrder']['created'])); ?>
            </td>
            <td>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> View </font></span>
                        </span> ', array('controller' => 'quotations', 'action' => 'view',$salesOderlist['Quotation']['id'],!empty($salesOderlist['Quotation']['company_id']) ? $salesOderlist['Quotation']['company_id'] : $inquiryId[$salesOderlist['Quotation']['inquiry_id']]),array('class' =>' table-link','escape' => false,'title'=>'View Information'));

                ?>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                                            <i class="fa fa-square fa-stack-2x"></i>
                                            <i class="fa fa-truck fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> Create </font></span>
                                            </span> ', 
                                                        array( 
                                            'controller' => 'requestDeliverySchedules', 
                                            'action' => 'add',
                                             $salesOderlist['Quotation']['id'],'sales'
                                             ),
                                            
                                                        array(
                                            'class' =>' table-link',
                                            'escape' => false,
                                            'title'=>'Request Delivery'
                                            ));
                            
                ?>
            </td>
        </tr>

    </tbody>
<?php endforeach; ?> 