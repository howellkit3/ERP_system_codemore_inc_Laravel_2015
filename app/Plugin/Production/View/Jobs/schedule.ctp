<?php $this->Html->addCrumb('Production', array('controller' => 'dashboards', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Jobs', array('controller' => 'jobs', 'action' => 'plans')); ?>
<?php $this->Html->addCrumb('Schedule', array('controller' => 'jobs', 'action' => 'schedule')); 
	$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : '';
?>

<?php 	echo $this->element('production_options'); ?>

<br><br><br>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
    		<?php //echo $this->element('tab/jobs',array('active_tab' => $active_tab)); ?>
			<div class="main-box-body clearfix">
			 
				<div class="tabs-wrapper">
					<div class="tab-content">
						<div class="tab-pane active" id="tab-calendar">
							<header class="main-box-header clearfix">
				                <h2 class="pull-left"><b>Scheduling</b> </h2>
				            </header>
				            
				        </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>