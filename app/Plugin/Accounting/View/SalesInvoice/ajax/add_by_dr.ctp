<table class="table footable toggle-circle-filled" data-page-size="6" data-filter="#filter" data-filter-text-only="true">
        <thead>
        <tr>
        <th>Delivery Number</th>
        <th>Delivery Sched</th>
        <th data-hide="phone">Company</th>
        <th data-hide="phone,tablet" class="text-center">Action</th>

        <th data-hide="all" class="text-right"> 
        &nbsp </th>
        </tr>
        </thead>
        <tbody>
        <?php 
            $dr = '';
            foreach ($deliveryData as $deliveryDataList ):
            //pr($deliveryDataList['Delivery']['clients_order_id']); exit;
            if($deliveryDataList['Delivery']['status'] != 2 ){ 

            $clientData = $this->AccountingFunction->getDetails($deliveryDataList['Delivery']['clients_order_id']);

            $items = $this->AccountingFunction->getItems($deliveryDataList['Delivery']['dr_uuid']);

         ?>
        <tr>
        <td>
        <a href="#"> #<?php echo str_pad($deliveryDataList['Delivery']['dr_uuid'],5,'0',STR_PAD_LEFT); ?> </a>
        </td>
        <td>
        <?php echo !empty($clientData[0]['ClientOrderDeliverySchedule']['schedule']) ? $clientData[0]['ClientOrderDeliverySchedule']['schedule'] : '' ?>
        </td>
        <td>
        <a href="#"><?php echo !empty($clientData[0]['Company']['company_name']) ? $clientData[0]['Company']['company_name'] : '' ?></a>
        </td>
        <td class="text-center">

        <a href="#processModal" class="modal_button" data-toggle="modal" data-id="<?php echo $deliveryDataList['Delivery']['id'] ?>" data-uuid="<?php echo $deliveryDataList['Delivery']['dr_uuid'] ?>">
        <button class="btn btn-success" href="print_sales_invoice">
                PRINT S.I
        </button>
        </a>
        </td>
        <td class="text-right">
                        
                        <?php if (!empty($items) && is_array($items)) { ?>


                                    <table class="table table-striped table-hover ">
                                        <thead>
                                            <tr>
                                                <th><span>CLients Order # </span></th>
                                                <th><span>DR #</span></th>
                                                <th><span>PO number </span></th>
                                                <th class="text-center"><span>Schedule</span></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php foreach ($items as $key => $value) : ?>
                                                    
                                                <tr>
                                                <td>
                                               <?php echo $value['ClientOrder']['uuid']?>
                                                </td>
                                                <td>
                                                    <?php echo $value['Delivery']['dr_uuid']?>
                                                </td>
                                                 <td>
                                                    <?php echo $value['ClientOrder']['po_number']?>
                                                </td>
                                                
                                                <td class="text-center">
                                                  <?php echo !empty($value['ClientOrderDeliverySchedule']['schedule']) ? date('Y-m-d', strtotime($value['ClientOrderDeliverySchedule']['schedule'])) : '' ?>
                                                </td>
                                                </tr>

                                        <?php endforeach; ?>
                                         </tbody>
                                            </table>

                                   
                                   <?php  }  ?> 
        </td>
        </tr>

        <?php } ?>
        <?php endforeach; ?>
        </tbody>
        </table>
<section class = "indicator" value = "<?php echo $indicator;?>"> </section>

	<div class="paging" id="dr_pagination">
	    <?php

	    echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'Delivery','model' => 'Delivery'), null, array('class' => 'disable','model' => 'Delivery'));
	    echo $this->Paginator->numbers(array('separator' => '','paginate' => 'Delivery'), array('paginate' => 'Delivery'));
	    echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'Delivery','model' => 'Delivery'), null, array('class' => 'disable'));
	    ?>

	</div>