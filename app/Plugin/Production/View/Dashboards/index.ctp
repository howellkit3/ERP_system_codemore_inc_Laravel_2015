<?php $this->Html->addCrumb('Production', array('controller' => 'dashboards', 'action' => 'index')); ?>


<div class="main-box">
	<div class="main-box-body clearfix">
		<div class="row">
			<div class="col-md-9">
				<?php 	echo $this->element('production_options'); ?>
			</div>
		</div>
	</div>
</div>