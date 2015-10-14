<?php 
   echo $this->Html->css(array(
                      'HumanResource.default',
                      'HumanResource.select2.css',
                      'timepicker'
  )); 

  
  echo $this->Html->script(array(
            'jquery.maskedinput.min',
            'HumanResource.moment',
            'HumanResource.custom', 
            'sweet-alert.min',  
            'HumanResource.payroll'

  )); 

  echo $this->element('payroll_options');

	$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : '';
 ?>

 <div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
    		<?php echo $this->element('tab/salaries',array('active_tab' => $active_tab)); ?>
		<div class="main-box-body clearfix">
		 
			<div class="tabs-wrapper">
				<div class="tab-content">
					<div class="tab-pane active" id="tab-calendar">
					<?php echo $this->Form->create('Attendance',array('controller' => 'salaries','action' => 'compute_salaries', 'type'=> 'post')); ?>
						<header class="main-box-header clearfix"><!-- 
			                <h2 class="pull-left"><b>Salaries</b> </h2> -->
			                <div class="filter-block pull-left">
			              
                          <div class="form-group pull-left">
      			                 	<input type="text" type="date" id="MonthPayrollIndex" class="form-control monthpick" value="<?php echo date('m-Y') ?>">
      									         <i class="fa fa fa-calendar calendar-icon"></i>
      								    </div>

                          <div class="form-group pull-left">
                              <?php echo $this->Form->input('status',array(
                                'options' => array( 'process' => 'Process', 'pending' => 'Pending' ),
                                'class' => 'form-control autocomplete',
                                'empty' => '--- Status ---' ,
                                'id' => 'StatusPayrollIndex',
                                'label' => false

                                )); ?>
                          </div>

                      </div>
			               <div class="filter-block pull-right">
			               <div class="form-group">
			               		<!-- <a type="" href="#" id="exportData" data-url="" class="btn btn-primary pull-right" style="display:none" >
								<i class="fa fa-file-text-o fa-lg"></i> Export </a> -->
    								<?php echo $this->Html->link('<i class="fa fa-file-text-o fa-lg"></i> Create Payroll',array(
    								'controller' => 'salaries',
    								 'action' => 'payroll_create',),
    								array( 'class' => 'btn btn-primary pull-right',
                            'id' => 'createPayroll',
                            'escape' => false)	
    								 ); ?>
			               </div>
			               </div>

			            </header>
			            <?php $this->Form->end(); ?>

			          <div class="main-box-body clearfix">
			            	<div id="result-table">
			            		   <div class="table-responsive result-cont">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th><a href="#"><span>Date</span></a></th>
                      <th><a href="#" ><span>From</span></a></th>
                      <th><a href="#" ><span>To</span></a></th>
                    <th><a href="#"><span>Description</span></a></th>
                    <th><a href="#"><span>Type</span></a></th>
                    <th class="text-center"><a href="#"><span>Status</span></a></th>
                    <th class="text-center"><a href="#"><span>Action</span></a></th>
                </tr>
            </thead>


            <tbody aria-relevant="all" aria-live="polite" role="alert">
                                    <?php  if(!empty($payrolls)) { ?>

                                           <?php foreach ($payrolls as $key => $payroll): ?>
                                                    
                                                    <tr>
                                                       
                                                        <td class="">
                                                           <?php echo !empty($payroll['Payroll']['date']) ? date('Y/m/d', strtotime($payroll['Payroll']['date']))  : ''; ?>
                                                        </td>
                                                        <td class="">
                                                           <?php echo !empty($payroll['Payroll']['from']) ? date('Y/m/d', strtotime($payroll['Payroll']['from'])) : '';  ?>
                                                        </td>
                                                        <td class="">
                                                             <?php echo !empty($payroll['Payroll']['to']) ? date('Y/m/d', strtotime($payroll['Payroll']['to'])) : '';  ?>
                                                        </td>
                                                        <td class="">
                                                           <?php echo $payroll['Payroll']['description'] ?>
                                                        </td>
                                                        <td class="">
                                                          <?php echo Inflector::humanize($payroll['Payroll']['type']); ?> 
                                                        </td>

                                                        <td class="text-center" >
                                                            <?php if($payroll['Payroll']['status'] == 'process') : ?>
                                                            <span class="label label-success">Process</span>
                                                            <?php else : ?>
                                                            <span class="label label-warning">Pending</span>
                                                            <?php endif; ?> 
                                                        </td>

                                                        <td class="text-center">

                                                        <?php echo $this->Html->link('<span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span></span>',
                                                          array('controller' => 'salaries', 'action' => 'payroll_view', $payroll['Payroll']['id'] ), 
                                                          array('class' =>' table-link',
                                                        'data-id' => $payroll['Payroll']['id'], 
                                                        'escape' => false,
                                                        'data-toggle' => 'modal',
                                                        'title'=>'View Amorization'
                                                        ));
                                                        
                                                        if($payroll['Payroll']['status'] == 'pending') {

                                                          echo $this->Html->link('<span class="fa-stack">
                                                            <i class="fa fa-square fa-stack-2x"></i>
                                                            <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                                                            </span> ', array('controller' => 'salaries', 
                                                              'action' => 'payroll_edit',$payroll['Payroll']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information'));

                                                          }

                                                          echo $this->Html->link('<span class="fa-stack">
                                                            <i class="fa fa-square fa-stack-2x"></i>
                                                            <i class="fa fa-trash fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                                                            </span> ', array('controller' => 'salaries', 
                                                              'action' => 'payroll_delete',$payroll['Payroll']['id']),
                                                            array(
                                                              'class' =>' table-link',
                                                              'escape' => false,'title'=>'Edit Information',
                                                              'confirm' => 'Are you sure you want to delete this attendances ? ',
                                                              ));

                                                        ?>
                                                        </td>
                                                      
                                                    </tr>

                                                
                                        <?php  endforeach;  ?>
                                       <?php } ?> 
                                  </tbody>
                                  </table>
                                  <div class="paging" id="item_type_pagination">
                                  <?php
                                  echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
                                  echo $this->Paginator->numbers(array('separator' => ''));
                                  echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
                                  ?>
                                  </div>
                             </div>
			            	</div>
						</div>		
	            </div>
			</div>
		</div>	
		 </div>
    </div>
</div>
<?php echo $this->element('modals/personnal_attendance'); ?>

<?php echo $this->element('modals/time_in_attendance'); ?>

<script type="text/javascript">
  $(document).ready(function(){



  });
</script>