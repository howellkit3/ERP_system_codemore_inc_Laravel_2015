<ul class="nav nav-tabs">
		<li class="<?php echo ($indicator == 'si_num') ? 'active' : '' ?>" alt="tab-category">
		<a href="<?php echo $this->Html->url('/'); ?>/accounting/sales_invoice/add/si_num" >Single</a></li>
		<li class="<?php echo ($indicator == 'dr_num') ? 'active' : '' ?>" alt="tab-type">
		<a href="<?php echo $this->Html->url('/'); ?>/accounting/sales_invoice/add/dr_num" 	id = 'itemType' >Delivery Reciept</a></li> 

		<li class="<?php echo ($indicator == 'apc_dr') ? 'active' : '' ?>" alt="tab-type">
		<a href="<?php echo $this->Html->url('/'); ?>/accounting/sales_invoice/add_by_apc" 	id = 'itemType' >APC DR </a></li> 
</ul>