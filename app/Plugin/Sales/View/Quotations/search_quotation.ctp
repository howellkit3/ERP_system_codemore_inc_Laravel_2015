
<div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><a href="#"><span>Quotation No.</span></a></th>
                                <th><a href="#"><span>Item Name</span></a></th>
                                <th><a href="#"><span>Company</span></a></th>
                                <th class="text-center"><a href="#"><span>Validity Date</span></a></th>
                                <th class="text-center"><a href="#"><span>Status</span></a></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <!--nocache-->
                        <tbody aria-relevant="all" aria-live="polite" class="quotationFields" role="alert">
                                
                            

<?php if (!empty($quotationData)) { ?>
    <?php foreach ($quotationData as $quotationList): 
        if($quotationList['Quotation']['status'] != 2 ){ 
            if($quotationList['Quotation']['status'] != 3 ){ ?>
        
            <tr class="">
                 <td class="">
                    PQ-<?php echo  $quotationList['Quotation']['uuid'] ?>  
                </td>
                <td class="">
                    <?php echo ucfirst($quotationList['Product']['name']) ?>  
                </td>
                <td class="">
                    <?php echo !empty($quotationList['Quotation']['company_id']) ? ucfirst($companyData[$quotationList['Quotation']['company_id']]) : ucfirst($companyData[$inquiryId[$quotationList['Quotation']['inquiry_id']]]) ?>
                </td>
                <td class="text-center">
                      <?php echo !empty($quotationList['Quotation']['validity']) ? date('M d, Y', strtotime($quotationList['Quotation']['validity'])) : 'No validity date'; ?>
                </td>
                <td class="text-center">
               <?php
                if ( !empty($quotationList['Quotation']['status']) ) {
                    if ($quotationList['Quotation']['status'] == '1') {
                        echo "<span class='label label-success'>Approved</span>";
                    } 
                    else {
                        if ($quotationList['Quotation']['status'] == 'Terminated') {
                        echo "<span class='label label-danger'>Terminated</span>";

                        }else{
                        echo "<span class='label label-default'>";
                            echo ucwords($quotationList['Quotation']['status']);
                        echo "</span>";
                        }
                     }
                } else  {
                    echo "<span class='label label-warning'>Pending</span>";
                }
                ?>
                </td>
                <td>
                <?php
                    if ( !empty($rolesPermissionData) ) {
                         if(in_array('1', $rolesPermissionData)){
                            echo $this->Html->link('<span class="fa-stack">
                                <i class="fa fa-square fa-stack-2x"></i>
                                <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Review </font></span>
                                </span> ', array('controller' => 'quotations', 'action' => 'view',$quotationList['Quotation']['id'],!empty($quotationList['Quotation']['company_id']) ? $quotationList['Quotation']['company_id'] : $inquiryId[$quotationList['Quotation']['inquiry_id']]),array('class' =>' table-link','escape' => false,'title'=>'Review Quotation'));

                        }else{
                              echo $this->Html->link('<span class="fa-stack">
                                <i class="fa fa-square fa-stack-2x"></i>
                                <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Review </font></span>
                                </span> ', array('controller' => 'quotations', 'action' => 'view',$quotationList['Quotation']['id'],!empty($quotationList['Quotation']['company_id']) ? $quotationList['Quotation']['company_id'] : $inquiryId[$quotationList['Quotation']['inquiry_id']]),array('class' =>' table-link not-active','escape' => false,'title'=>'Review Quotation'));
                        }
                    }else  {
                       echo $this->Html->link('<span class="fa-stack">
                                <i class="fa fa-square fa-stack-2x"></i>
                                <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Review </font></span>
                                </span> ', array('controller' => 'quotations', 'action' => 'view',$quotationList['Quotation']['id'],!empty($quotationList['Quotation']['company_id']) ? $quotationList['Quotation']['company_id'] : $inquiryId[$quotationList['Quotation']['inquiry_id']]),array('class' =>' table-link not-active','escape' => false,'title'=>'Review Quotation'));
                    } 

                    echo $this->Html->link('<span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-trash fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Remove </font></span>
                        </span>', array('controller' => 'quotations', 'action' => 'remove',$quotationList['Quotation']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information','confirm' => 'Do you want to remove this Quotation?'));

                    ?>
                </td>
            </tr>
        
    <?php } }
    endforeach; ?> 
<?php }else{
    echo "<font color='red'><b>No result..</b></font>";
    } ?> 

                                
                        </tbody>
                        <tbody aria-relevant="all" aria-live="polite" class="searchAppend" role="alert" style="display:none;">
                        </tbody>
                        <!--/nocache-->
                    </table>
                   
                    <hr>

                    <div class="paging">
                    <?php

                    // echo $this->Paginator->prev('< ' . __('previous'), null, null, array('class' => 'disable'));
                    // echo $this->Paginator->numbers(array('separator' => ''));
                    // echo $this->Paginator->next(__('next') . ' >', null, null, array('class' => 'disable'));
                    ?>
</div>
