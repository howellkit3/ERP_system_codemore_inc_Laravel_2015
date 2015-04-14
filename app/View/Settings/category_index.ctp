<?php echo $this->element('setting_option');?><br><br>
<?php // echo $this->element('category_option');?><br><br>

<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					
                    
				
					<?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
				</header>

			</div>
		</div>
		<?php echo $this->Form->create('ItemCategoryHolder',array('url'=>(array('controller' => 'settings','action' => 'category'))));?>
			
			
		<?php echo $this->Form->end(); ?>

		
	</div>
</div>