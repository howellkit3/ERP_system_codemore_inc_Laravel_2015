<div class="form-group">
	<label class="col-lg-2 control-label"><span style="color:red">*</span>Requestor</label>
	<div class="col-lg-8">
		<?php echo $this->Form->input('PurchaseOrder.received_by', array(
            'options' => array($userData),
            'type' => 'select',
            'value' => $preparedby,
            'label' => false,
            'class' => 'form-control required ',
            'empty' => '---Select Requestor---'
             )); 

        ?>

        <?php 
        $today = date("Y-m-d H:i:s");
        echo $this->Form->input('PurchaseOrder.received', array(
            'type' => 'hidden',
            'label' => false,
            'class' => 'form-control required ',
            'value' => $today

             )); 

        ?>
	</div>
</div>