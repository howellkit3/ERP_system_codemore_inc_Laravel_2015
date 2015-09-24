<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Add', array('controller' => 'customer_sales', 'action' => 'add')); ?>

<div style="clear:both"></div>

<?php echo $this->element('ware_house_option');?>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box">
            <?php //echo $this->Session->flash(); ?>
            <header class="main-box-header clearfix">
                <center>
                    <h1>
                       <!--  <u>
                            Raw Material
                        </u> -->
                         <?php 
                            echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'items', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                        ?>
                    </h1>
                </center>
            </header>
            <div class="main-box-body clearfix">

                <?php echo $this->Form->create('Item',array('url'=>(array('controller' => 'items','action' => 'add')),'class' => 'form-horizontal'));?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-box">
                                <section class="cloneMe1 contactPersonAddress_section">
                                    <div class="main-box-body clearfix">
                                <br/>            
                                            
                                  <div class="form-group">
						                <label for="inputPassword1" class="col-lg-2 control-label"> <span style="color:red">*</span> Item</label>
						                <div class="col-lg-9"> 
						                	<?php echo $this->Form->input('name', array( 
					                           							'alt' => 'type',
												    					'label' => false,
												   						'class' => 'form-control',
																));
			                        		?>
			                        	</div>
			                        </div>    

			                        <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Measure </label>
                                                <div class="col-lg-9">
                                                   <?php 
                                                        echo $this->Form->input('measure', array('class' => 'form-control required','label' => false,'type' => 'text'));
                                                    ?>
                                                </div>
                                            </div>


						            	<div class="form-group">
						            	    <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Category / Department </label>
							                <div class="col-lg-9"> 
												<?php 

													echo $this->Form->input('department_id',
																			array( 
																					'options' => $categoryDataDropList,
								                           							'alt' => 'type',
															    					'label' => false,
															   						'class' => 'form-control',
															   						'empty' => '--- Select Department ---'
																			));
						                        ?>
													<span class="help-block" style= "color:white"> &nbsp </span>
							               </div>
							           </div>

							           <div class="form-group">
						            	    <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Category Type </label>
							                <div class="col-lg-9"> 
												<?php 

													echo $this->Form->input('category_type_id',
																			array( 
																					'options' => $itemsCategory,
								                           							'alt' => 'type',
															    					'label' => false,
															   						'class' => 'form-control',
															   						'empty' => '--- Select Department ---'
																			));
						                        ?>
													<span class="help-block" style= "color:white"> &nbsp </span>
							               </div>
							           </div>

									   <div class="form-group">
						                <label for="inputPassword1" class="col-lg-2 control-label"> <span style="color:red">*</span> Supplier </label>
						                <div class="col-lg-9"> 
												   <?php
					                           		
					                           		$suppliers = array_merge($suppliers,array('other' => 'Other'));

					                           		echo $this->Form->input('supplier', array(
					                           									'options' => $suppliers, 
							                           							'alt' => 'type',
														    					'label' => false,
														   						'class' => 'form-control',
														   						'empty' => '--- Select Supplier---'
																		));
					                        		?>
													<span class="help-block" style= "color:white"> &nbsp </span>
						                </div>
						        	</div>
                                           
                                        
                                            <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span>Stocks</label>
                                                <div class="col-lg-9">
                                                    <?php 
                                                        echo $this->Form->input('remaining_stocks', array('class' => 'form-control required number','label' => false,'type' => 'text'));
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label">Description</label>
                                                <div class="col-lg-9">
                                                     <?php 
                                                        echo $this->Form->textarea('description', array('class' => 'form-control required','label' => false));
                                                    ?>
                                                </div>
                                            </div>
                                    
                                           <!--  <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-10 control-label"></label>
                                                <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneContactData('contactPersonAddress_section',this)"><i class="fa fa-plus"></i></button>
                                                <button type="button" class="remove-field btn btn-danger" onclick="removeClone('contactPersonAddress_section')"><i class="fa fa-minus"></i> </button>
                                            </div> -->
                                         
                                    </div>
                                </section>
                             
                        </div>
                    </div>  
                </div>
                    

                <div class="row">
                    <div class="multi-field-wrapper clearfix">
                        <div class="multi-fields clearfix">
                            <div class="multi-field clearfix">
                                <div class="col-xs-2 col-md-8"></div>
                                <div class="col-xs-2 col-md-2 2">
                                    <?php 
                                        echo $this->Form->submit('Submit', array('class' => 'btn btn-success pull-right',  'title' => 'Click here to add the customer'));
                                    ?>
                                 
                                </div>
                                <div class="col-xs-2 col-md-2 2">
                                    <?php 
                                        echo $this->Html->link('Cancel ', array('controller' => 'raw_materials', 'action' => 'index'),array('class' =>'btn btn-primary','escape' => false));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php echo $this->Form->end(); ?>
                <script>
                $("#RawMaterialAddForm").validate();
                </script>

            </div>
        </div>
    </div>
</div>