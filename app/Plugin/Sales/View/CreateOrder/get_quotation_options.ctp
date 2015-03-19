<div class="col-lg-12">
	<div class="form-group" >
		<div class="col-lg-3">Qty</div>
		<div class="col-lg-8">
			<?php 
	            echo $this->Form->input('qty', array( 
	                						'type' => 'text',
	                						'value' => $data[0]['QuotationOption']['description'],
	                						'class' => 'form-control item_type required', 
	                    					'label' => false, 
	                    					'id' => 'qty',
	                					));
	        ?>
	        <?php 
	            echo $this->Form->input('QuotationOption.0.id', array( 
	                						'type' => 'hidden',
	                						'value' => $data[0]['QuotationOption']['id'],
	                						'class' => 'form-control item_type required', 
	                    					'label' => false, 
	                    					
	                					));
	        ?>
			
		</div>
	</div>
</div>

<div class="col-lg-12">
<div class="form-group">
	<div class="col-lg-3">Unit Price</div>
	<div class="col-lg-8">
		<?php 
            echo $this->Form->input('unit_price', array( 
                						'type' => 'text',
                						'value' => $data[1]['QuotationOption']['description'],
                						'class' => 'form-control item_type required', 
                    					'label' => false, 
                    					'id' => 'unit_price',
                					));
        ?>
        <?php 
	            echo $this->Form->input('QuotationOption.1.id', array( 
	                						'type' => 'hidden',
	                						'value' => $data[1]['QuotationOption']['id'],
	                						'class' => 'form-control item_type required', 
	                    					'label' => false, 
	                    					
	                					));
	        ?>
		
	</div>
</div>
</div>

<div class="col-lg-12">
<div class="form-group">
	<div class="col-lg-3">Material</div>
	<div class="col-lg-8">
		<?php 
            echo $this->Form->input('material', array( 
                						'type' => 'text',
                						'value' => $data[2]['QuotationOption']['description'],
                						'class' => 'form-control item_type required', 
                    					'label' => false, 
                    					'id' => 'material',
                					));
        ?>
        <?php 
	            echo $this->Form->input('QuotationOption.2.id', array( 
	                						'type' => 'hidden',
	                						'value' => $data[2]['QuotationOption']['id'],
	                						'class' => 'form-control item_type required', 
	                    					'label' => false, 
	                    					
	                					));
	        ?>
		
	</div>
</div>
</div>