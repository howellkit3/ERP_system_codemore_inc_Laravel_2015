<?php $this->Html->addCrumb('Production', array('controller' => 'dashboards', 'action' => 'index')); ?>


<div class="main-box">
	<div class="main-box-body clearfix">
		<div class="row">
			<div class="col-md-12">
				<br>
				<?php 	//echo $this->element('production_options'); ?>
				<?php 
					$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : '';
				 	echo $this->element('tab/jobs',array('active_tab' => $active_tab)); 
				 ?>
			</div>
		</div>
	</div>
</div>