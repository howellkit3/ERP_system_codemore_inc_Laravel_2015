<?php     //pr($deliveryEdit); exit;
                        if(!empty($deliveryEdit)){
              ?>
              <?php //foreach ($deliveryEdit as $deliveryDataList): ?>

                                <tbody aria-relevant="all" aria-live="polite" role="alert">

                                    <tr class="">

                                        <td class="">
                                              <?php echo $deliveryEdit['Delivery']['dr_uuid']; ?>
                                        </td>

                                        <td class="">

                                            <?php echo date('M d, Y',strtotime($deliveryEdit['DeliveryDetail']['schedule'])); ?>
                                        
                                        </td>

                                        <td class="">

                                            <?php echo $deliveryEdit['DeliveryDetail']['quantity']; ?>

                                        
                                        </td>

                                        <td class="">
                              
                                           <?php echo  $deliveryEdit['DeliveryDetail']['location']; ?>    
                                           
                                           
                                        </td>

                                       

                                       
                                    </tr>

                                </tbody>
                        <?php 
                           // endforeach; 
                        } ?> 
