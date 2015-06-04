<?php if (!empty($quotationData)) { ?>
    <?php foreach ($quotationData as $quotationList): ?>
        
            <tr class="">
                 <td class="">
                    PQ-<?php echo $quotationList['Quotation']['uuid'] ?>  
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
                    ?>
                </td>
            </tr>
        
    <?php endforeach; ?> 
<?php }else{
    echo "<font color='red'><b>No result..</b></font>";
    } ?> 
