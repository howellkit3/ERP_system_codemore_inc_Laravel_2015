<?php $this->Html->addCrumb('WareHouse', array('controller' => 'ware_house_systems', 'action' => 'index')); ?>
<?php echo $this->Html->script('Sales.inquiry');?>
<?php echo $this->element('ware_house_option');?>
<div style="clear:both"></div>

<br>
<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Settings</b></h2>

                
            </header>
            	<?php echo $this->element('tabs/warehouse_settings'); ?>
        </div>


        	<?php // echo $this->element('tabs/item_group'); ?>
    </div>
</div>
