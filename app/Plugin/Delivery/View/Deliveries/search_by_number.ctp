   <div class="main-box-body clearfix ">
                <div class="table-responsive">
                    <table class="table table-striped table-hover ">
                        <thead>
                            <tr >
                                <th class="text-center"><a href="#"><span>Delivery # </span></a></th>
                                <th class="text-center"><a href="#"><span>PO Number</span></a></th>
                                <th class="text-center"><a href="#"><span>Quantity</span></a></th>
                                <th class="text-center"><a href="#"><span>Remarks</span></a></th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody aria-relevant="all" aria-live="polite" class="OrderFields" role="alert" >
                              <?php 
                               
                                if(!empty($delivery)) { ?>
                                    <?php 
                                    $old_value = '';
                                    foreach ($delivery as $list):

                                     $clientOrder  = $this->DeliveryFunction->getClientsOrder($list['Delivery']['clients_order_id']);
                                
                                      ?>

                                         <tr class=" <?php echo ( $list['Delivery']['dr_uuid'] != $old_value )  ? 'main' : ''; ?>">
                                              <td class="text-center">

                                                <?php 
                                                  if ( $list['Delivery']['dr_uuid'] != $old_value ) :
                                                    echo $list['Delivery']['dr_uuid'];
                                                  endif;
                                                 ?>      
                                               </td>
                                               <td class="text-center">
                                                <?php echo !empty($clientOrder['ClientOrder']['po_number']) ? $clientOrder['ClientOrder']['po_number'] : '' ?>      
                                               </td>
                                              
                                              <td class="text-center">
                                                  <?php echo $list['DeliveryDetail']['quantity']; ?>      
                                              </td>
                                               <td class="text-center">
                                                <?php echo $list['DeliveryDetail']['remarks'];  ?>      
                                               </td>
                                                 <td class="text-center">
                                                <?php  if ( $list['Delivery']['dr_uuid'] != $old_value ) : 
                                                
                                                echo $this->Html->link('<span class="fa-stack">
                                                <i class="fa fa-square fa-stack-2x"></i>
                                                <i class="fa fa-print fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Print </font></span>
                                                </span>', array('controller' => 'deliveries', 'action' => 'multiple_dr',$list['Delivery']['dr_uuid']),array('class' =>' table-link  refresh ','escape' => false,
                                                  'title'=>'Print Delivery Receipt'));  

                                                    endif; ?>   
                                               </td>

                                          </tr> 
                                    <?php 
                                     $old_value = $list['Delivery']['dr_uuid'];
                                    endforeach; ?>
                              <?php } ?> 

                        </tbody>
                        <tbody aria-relevant="all" aria-live="polite" class="searchAppend" role="alert" >
                        </tbody>

                       <!--  <tbody aria-relevant="all" aria-live="polite" class="" role="alert" style="display:none;">
                        </tbody> -->

                    </table>
                    <hr>
                        <div class="paging" id="item_type_pagination">
                            <?php
                            echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
                            echo $this->Paginator->numbers(array('separator' => ''));
                            echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
                            ?>
                    </div>
                </div>
            </div>
   