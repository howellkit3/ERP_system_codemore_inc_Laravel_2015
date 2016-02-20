<ul class="nav nav-tabs">
	<li class="<?php echo ($indicator == 'sa_no') ? 'active' : '' ?>" alt="tab-category">
		<a href="<?php echo $this->Html->url('/'); ?>/accounting/sales_invoice/add/sa_no" >Single</a></li>
		<li class="<?php echo ($indicator == 'sa_dr_num') ? 'active' : '' ?>" alt="tab-type">
		<a href="<?php echo $this->Html->url('/'); ?>/accounting/sales_invoice/add/sa_dr_num" 	id = 'itemType' >Delivery Reciept</a></li> 
</ul>