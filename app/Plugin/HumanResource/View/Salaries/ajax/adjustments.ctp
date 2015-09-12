<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Edit Adjustments </h4>
                </div>
                  <?php echo $this->Form->create('Adjustment',array('url' => array('controller' => 'salaries','action' => 'adjustments_add'))); ?>
                   
                <div class="modal-body">
                      <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label"> <span style="color:red">*</span> Employee </label>
                            <div class="col-lg-10">
                                <?php 
                                    
                                    echo $this->Form->input('id',array('type' => 'hidden'));

                                    echo $this->Form->input('employee_id', array(
                                        'options' => $employeeList,
                                        'alt' => 'type',
                                        'label' => false,
                                        'class' => 'form-control col-lg-12',
                                        'empty' => '--- All ---',
                                        'data-name' => 'Employee'
                                    ));
                                ?>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Amount </label>
                            <div class="col-lg-10">
                                <?php echo $this->Form->input('amount', array(
                                       	'alt' => 'amount',
                                        'label' => false,
                                        'class' => 'form-control col-lg-12 required',
                                        'data-name' => 'Address'
                                    ));
                                ?>
                            </div>
                        <div class="clearfix"></div> 

                            <br>
                            <label for="inputEmail1" class="col-lg-2 control-label"> <span style="color:red">*</span> Payroll Date </label>
                            <div class="col-lg-3">
                            	 <?php echo $this->Form->input('month', array(
                                       	'alt' => 'month',
                                        'label' => false,
										'options' => array(
												'01' => 'Jan',
												'02' => 'Feb',
												'03' => 'Mar',
												'04' => 'Apr',
												'05' => 'May',
												'06' => 'Jun',
												'07' => 'Jul',
												'08' => 'Aug',
												'09' => 'Sep',
												'10' => 'Oct',
												'11' => 'Nov',
												'12' => 'Dec'
										),
										'class' => 'form-control pull-left',
                                        'data-name' => 'Address'
                                    ));
                                ?>
                            </div>
                            <div class="col-lg-4">
                               <div class="form-group pull-left">
								<div class="radio inline-block">
									<input type="radio" name="data[Adjustment][days]" id="optionsRadios1" value="1:15" checked="">
									<label for="optionsRadios1">
										1 - 15
									</label>
								</div>
								<div class="radio inline-block">
									<input type="radio" name="data[Adjustment][days]" id="optionsRadios2" value="16:31">
									<label for="optionsRadios2">
										16 - 31
									</label>
								</div>
							</div>
                            </div>
                            <div class="col-lg-3">
                            	 <?php 

                            	$firstYear = (int)date('Y') - 10;
								$lastYear = $firstYear + 20;
								$years = array();
								for($i=$firstYear;$i<=$lastYear;$i++)
								{
									$years[$i]  = $i;
								}


                            	 echo $this->Form->input('year', array(
                                       	'alt' => 'month',
                                        'label' => false,
										'options' => $years,
										'class' => 'form-control pull-left',
                                        'data-name' => 'Address'
                                    ));
                                ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>   
                       	 <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label"> Reason </label>
                         	<div class="col-lg-10">
                                <?php 
                                     echo $this->Form->input('reason', array(
                                     		 'class' => 'form-control col-lg-12',
                                     		 'label' => false,
                                     		 'type' => 'textarea'

                                     ));

                                  
                                ?>
                            </div>
                         </div>
                        <div class="clearfix"></div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Add Ajustments </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle"></i>  Close</button>
                </div>

                <?php echo $this->Form->end(); ?>