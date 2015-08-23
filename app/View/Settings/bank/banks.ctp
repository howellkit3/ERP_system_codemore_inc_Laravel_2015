<?php echo $this->element('setting_option');?><br><br>

<div class="row">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					
                    
					<h1 class="pull-left">
						Add Bank
					</h1>
					<?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
				</header>

			</div>
		</div>
		<?php echo $this->Form->create('Bank',array('url'=>(array('controller' => 'settings','action' => 'add_bank'))));?>
			
			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<div class="top-space"></div>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">

									<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span>Name</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Bank.name', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'placeholder' => 'Name'));
                                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span>Code</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Bank.code', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'placeholder' => 'Code'));
                                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Remarks</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Bank.remarks', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'placeholder' => 'Remarks'));
                                            ?>
										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-2"></div>
										<div class="col-lg-8">
											<button type="submit" class="btn btn-primary pull-left">Add Bank</button>&nbsp;
											<?php 
						                        echo $this->Html->link('Cancel', array('controller' => 'settings', 'action' => 'index'),array('class' =>'btn btn-default','escape' => false));
						                    ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php echo $this->Form->end(); ?>

		<div class="row">
			<div class="col-lg-12">
				<div class="main-box">
				  	<header class="main-box-header clearfix">
                        <h1>Bank List</h1>
                    </header>
					<div class="main-box-body clearfix">
		                <div class="table-responsive">
		                    <table class="table table-striped table-hover">
		                        <thead>
		                            <tr>
		                              
		                                <th><a href="#"><span>Name</span></a></th>
		                              	<th><a href="#"><span>Code</span></a></th>
		                              	<th><a href="#"><span>Remark</span></a></th>
		                                <th class="text-center"><a href="#"><span>Created</span></a></th>
		                                <th style="width:135px">Action</th>
		                            </tr>
		                        </thead>

		                        <?php foreach ($bankData as $bankList ):?>
    
								    <tbody aria-relevant="all" aria-live="polite" role="alert">

								        <tr class="">

								        	<td>
								               <?php  echo ucfirst($bankList['Bank']['name']) ?>
								            </td>
								            <td>
								               <?php  echo ucwords($bankList['Bank']['code']) ?>
								            </td>
								            <td>
								               <?php  echo ucfirst($bankList['Bank']['remarks']) ?>
								            </td>
								            <td class="text-center">
								                  <?php echo  date('M d, Y', strtotime($bankList['Bank']['created'])); ?>
								            </td>
								            <td>
								            
								                <?php
								                    echo $this->Html->link('<span class="fa-stack">
								                    <i class="fa fa-square fa-stack-2x"></i>
								                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
								                    </span> ', array('controller' => 'settings', 'action' => 'banks',$bankList['Bank']['id']),array('class' =>' table-link small-link-icon','escape' => false,'title'=>'Edit Information')); 
								                ?>
								                <?php
								                    echo $this->Html->link('<span class="fa-stack">
								                    <i class="fa fa-square fa-stack-2x"></i>
								                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
								                    </span>', array('controller' => 'settings', 'action' => 'deleteBank',$bankList['Bank']['id']),array('class' =>' table-link small-link-icon','escape' => false,'title'=>'Delete Information','confirm' => 'Do you want to delete this Bank ?'));
								                ?>

								            </td>    
								        </tr>

								    </tbody>
								<?php endforeach; ?> 
		                    </table>
		                    <hr>
								<div class="paging" id="unit_pagination">
									<?php

										echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'ItemTypeHolder','model' => 'Bank'), null, array('class' => 'disable','model' => 'Bank'));
										echo $this->Paginator->numbers(array('separator' => '','paginate' => 'Bank'), array('paginate' => 'Bank'));
										echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'Bank','model' => 'Bank'), null, array('class' => 'disable'));

									?>
								</div>
		                </div>
		            </div>
				</div>
			</div>
		</div>
	</div>
</div>