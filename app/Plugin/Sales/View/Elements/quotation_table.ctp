<?php foreach ($quotationData as $quotationList): 
   if($quotationList['Quotation']['status'] != 2 ){
        if($quotationList['Quotation']['status'] != 3 ){ ?>

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
                // if($quotationList['Quotation']['status'] == (1)) {
                //    echo '<span class="label label-default">Pending</span>'; 
                // }
                // if($quotationList['Quotation']['status'] == (2)) {
                //    echo '<span class="label label-success">Approved</span>'; 
                // }
                // if($quotationList['Quotation']['status'] == (3)) {
                //    echo '<span class="label label-danger">terminate</span>'; 
                // }
                // if($quotationList['Quotation']['status'] == (4)) {
                //    echo '<span class="label label-warning">withdraw</span>'; 
                // }



            //echo $quotationList['Quotation']['status'] != (1) ? '<span class="label label-success">Approved</span>' : '<span class="label label-danger">Pending</span>' ; ?>
           <?php
                // if(!empty($salesStatus[$quotationList['Quotation']['id']])){
                //     echo "<span class='label label-success'>Sales Order</span>";
                //      //echo $salesStatus[$quotationList['Quotation']['id']];
                // }

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

               // pr($rolesPermissionData);
                // if ($quotationList['Quotation']['status'] == '1') {
                //     echo "<span class='label label-success'>Approved</span>";
                // } else {
                //     echo "<span class='label label-default'>";
                //         echo ucwords($quotationList['Quotation']['status']);
                //     echo "</span>";
                // }


                if ( !empty($rolesPermissionData) ) {
                  //if (isset($rolesPermissionData ['1'])) {
                     if(in_array('1', $rolesPermissionData)){
                   //  if ($rolesPermissionData['RolesPermission']['permission_id'] == 1  ) {

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

                <?php
                // if ($quotationList['Quotation']['status'] != (1)) {

                //    echo $this->Html->link('<span class="fa-stack">
                //     <i class="fa fa-square fa-stack-2x"></i>
                //     <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                //     </span> ', array('controller' => 'quotations', 'action' => 'edit',$quotationList['Quotation']['id'],!empty($quotationList['Quotation']['company_id']) ? $quotationList['Quotation']['company_id'] : $inquiryId[$quotationList['Quotation']['inquiry_id']]),array('class' =>' table-link','escape' => false,'title'=>'Review Quotation'));
                // }

                ?>
              
                <?php
                    // echo $this->Html->link('<span class="fa-stack">
                    // <i class="fa fa-square fa-stack-2x"></i>
                    // <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                    // </span>', array('controller' => 'quotations', 'action' => 'delete',$quotationList['Quotation']['id']),array('class' =>' table-link','escape' => false,'title'=>'Delete Quotation','confirm' => 'Do you want to delete Quotaion ?'));
                ?>
                
            </td>
        </tr>

<?php
        }}
        endforeach; ?> 



