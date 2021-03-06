<style type="text/css">#QuotationField12Description{background-color:#fff;}</style>
<div style="clear:both"></div>
<?php  echo $this->Html->script('Purchasing.modal_clone');?>
<?php  echo $this->Html->script('Purchasing.category_purchase');?>
<?php echo $this->element('purchasings_option'); ?><br><br>

<?php if(!empty($inquiry['Inquiry']['id'])) {

	echo $this->element('inquiry_quotation');

} else { ?>
	
	<div class="row">
		<div class="col-lg-12">
			
			<div class="row">
				<div class="col-lg-12">
					<header class="main-box-header clearfix">
							                    
						<h1 class="pull-left">
							Create Purchase Request
						</h1>
						<?php 
	                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'requests', 'action' => 'create'),array('class' =>'btn btn-primary pull-right','escape' => false));
	                    ?>
					</header>

				</div>
			</div>

			<?php echo $this->Form->create('Request',array('url'=>(array('controller' => 'requests','action' => 'create'))));?>
				<div class="row">
					<div class="col-lg-12">
					  	<div class="main-box">
							<div class="top-space"></div>
							<div class="main-box-body clearfix">
								<div class="main-box-body clearfix">
									<div class="form-horizontal">
	                                    <div class="form-group">
											<label class="col-lg-2 control-label">Name</label>
											<div class="col-lg-8">
												<?php 
		                                            echo $this->Form->input('Request.name', array(
		                                            								'class' => 'form-control item_type',
								                                                    'label' => false,
								                                                    'placeholder' => 'Request Name'));
	                                            ?>
											</div>
										</div>

										<div class="form-group" id="existing_items">
											<label class="col-lg-2 control-label"><span style="color:red">*</span>Type</label>
											<div class="col-lg-8">
												<?php 
	                                                echo $this->Form->input('Request.pur_type_id', 
	                                                						array( 
	                                                						'options' => array($purchasingTypeData),	
	                                                						'type' => 'select',
	                                                						'class' => 'form-control item_type categorylist required', 
	                                                    					'label' => false, 
	                                                    					'placeholder' => 'Item',
	                                                    					'empty' => '--Select Category--'
	                                                    					));
	                                            ?>
											</div>
										</div>

										<div class="form-group">
											<label for="inputPassword1" class="col-lg-2 control-label"> Remarks</label>
											<div class="col-lg-8">
												<?php 
												echo $this->Form->textarea('Request.remarks', array('class' => 'form-control item_type',
												'alt' => 'Request Inquiry',
												'label' => false,
												'rows' => '6'));
												?>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					

						<div class="main-box">
							<div class="top-space"></div>
								<header class="main-box-header clearfix">
								                    
									<h1 class="pull-left">
										Purchase Item
									</h1>
									<input type="hidden" value="1" name="getCounter" class="get-counter" />
								</header>

								<div class="main-box-body clearfix">

									<section class="cloneMe">
										
										<div class="main-box-body clearfix">
											<div class="form-horizontal item-category">

												<div class="form-group" >
													<label class="col-lg-2 control-label"><span style="color:red">*</span>Item </label>
													<div class="col-lg-5">
														<?php 
										                    echo $this->Form->input('RequestItem.0.nameToShow', 
																			array( 
																// 'options' => array($itemData),  
																'class' => 'form-control item_name required', 
										    					'label' => false,
										    					'readonly' => true,
										    					'placeholder' => 'Item',
										    					));
										                ?>

										                <?php 
										                    echo $this->Form->input('RequestItem.0.name', 
																			array( 
																 'type' => 'hidden',  
																'class' => 'form-control item_name required', 
										    					'label' => false,
										    					'readonly' => 'readonly'
										    					));
										                ?>

										                <?php 
										                    echo $this->Form->input('RequestItem.0.foreign_key', 
																			array( 
																'class' => 'form-control item_id required', 
																'type' => 'hidden',
										    					'label' => false,
										    					'readonly' => 'readonly'
										    					));
										                ?>

										                <?php 
										                    echo $this->Form->input('RequestItem.0.model', 
																			array( 
																'class' => 'form-control item_model required ', 
																'type' => 'hidden',
										    					'label' => false,
										    					'readonly' => 'readonly'
										    					));
										                ?>

										                <?php 
										                    echo $this->Form->input('RequestItem.0.status_id', 
																			array( 
																'class' => 'form-control item_model required ', 
																'type' => 'hidden',
										    					'label' => false,
										    					'value' => 0
										    					));
										                ?>

										        	</div>

													<div class="col-lg-4">

														<a data-toggle="modal" href="#myModalItem" data-modal="1" class="modal-button btn btn-primary mrg-b-lg pull-left  "><i class="fa fa-search-plus fa-lg"></i> Select Item</a>
														&emsp;
														<button type="button" class="add-field1  table-link danger btn btn-success " onclick="cloneDatarequest('cloneMe', this)"><i class="fa fa-plus"></i></button>
														
														<button type="button" class="remove btn btn-danger " onclick="removeClone('cloneMe')"><i class="fa fa-minus" ></i></button>

													</div>

												</div>

												<div class="form-group">

													<label class="col-lg-2 control-label">Category</label>
													
													<div class="col-lg-6">
														<?php 
															echo $this->Form->input('RequestItem.0.category', array(
										                        'options' => array('No Amount Items', 'General Items'),  
										                        'label' => false,
										                        'class' => 'form-control category',
										                        'empty' => '---Select Category---'
										                         )); 
										                ?>

													</div>

												</div>

												<div class="form-group other-items">

													<label class="col-lg-2 control-label">Size</label>
													<div class="col-lg-3">
														<?php 
										                    echo $this->Form->input('RequestItem.0.size1', array(
																'class' => 'form-control item_type other-element',
										                        'label' => false,
										                        'type' => 'number',
										                        'placeholder' => 'Size'));
										                ?>
													</div>

													<div class="col-lg-3">
														<?php 
															echo $this->Form->input('RequestItem.0.size1_unit_id', array(
										                        'options' => array($unitData),  
										                        'label' => false,
										                        'class' => 'form-control other-element',
										                        'empty' => '---Select Unit---'
										                         )); 
										                ?>

													</div>

													<label class="col-lg-3 sizeWith">&emsp;&emsp;x </label>

												</div>

												<div class="form-group other-items">
													<label class="col-lg-2 control-label"> </label>
													<div class="col-lg-3">
														<?php 
															echo $this->Form->input('RequestItem.0.size2', array(
																'class' => 'form-control item_type other-element',
										                        'label' => false,
										                        'type' => 'number',
										                        'placeholder' => 'Size'));

										                ?>
													</div>

													<div class="col-lg-3">
														<?php 
															echo $this->Form->input('RequestItem.0.size2_unit_id', array(
										                        'options' => array($unitData),  
										                        'label' => false,
										                        'class' => 'form-control other-element',
										                        'empty' => '---Select Unit---'
										                         )); 

										                ?>
													</div>

													<label class="col-lg-3 sizeWith">&emsp;&emsp;x </label>

												</div>

												<div class="form-group other-items">
													<label class="col-lg-2 control-label"> </label>
													<div class="col-lg-3">
														<?php 
															echo $this->Form->input('RequestItem.0.size3', array(
																'class' => 'form-control item_type other-element',
										                        'label' => false,
										                        'type' => 'number',
										                        'placeholder' => 'Size'));

										                ?>
													</div>

													<div class="col-lg-3 ">
														<?php 
															echo $this->Form->input('RequestItem.0.size3_unit_id', array(
										                        'options' => array($unitData),  
										                        'label' => false,
										                        'class' => 'form-control other-element',
										                        'empty' => '---Select Unit---'
										                         )); 

										                ?>
													</div>

													<label class="col-lg-3 sizeWith">&emsp;&emsp;x </label>

												</div>

												<div class="form-group rolls">
													<label class="col-lg-2 control-label"> Width</label>
													<div class="col-lg-3">
														<?php 
															echo $this->Form->input('RequestItem.0.width', array(
																'class' => 'form-control item_type roll-element',
										                        'label' => false,
										                        'type' => 'number',
										                        'placeholder' => 'Width'));

										                ?>
													</div>

													<div class="col-lg-3 ">
														<?php 
															echo $this->Form->input('RequestItem.0.width_unit_id', array(
										                        'options' => array($unitData),  
										                        'label' => false,
										                        'class' => 'form-control roll-element',
										                        'empty' => '---Select Unit---'
										                         )); 

										                ?>
													</div>

												</div>

												<div class="form-group">
													<label class="col-lg-2 control-label"><span style="color:red">*</span>Quantity</label>
													<div class="col-lg-3">
														<?php 
															echo $this->Form->input('RequestItem.0.quantity', array(
																'class' => 'form-control item_type number  select-drop required',
																'type' => 'number',
										                        'label' => false,
										                        'data' => 0,
										                        'placeholder' => 'Quantity'));

										                ?>
													</div>

													<div class="col-lg-3">
														<?php 
															echo $this->Form->input('RequestItem.0.quantity_unit_id', array(
										                        'options' => array($unitData),  
										                        'label' => false,
										                        'class' => 'form-control required',
										                        'empty' => '---Select Unit---'
										                         )); 

										                ?>
													</div>

												</div>

												<div class="form-group">
													<label class="col-lg-2 control-label"><span style="color:red">*</span>Date Needed</label>
													<div class="col-lg-6">
														<?php 
                                   						 echo $this->Form->input('RequestItem.0.date_needed', array(
					                                        'type' => 'text',
					                                        'label' => false,
					                                        'required' => 'required',
					                                        'class' => 'form-control item_type datepick required',
					                                        ));
                              	
			                                            ?>
													</div>
												</div>

												<div class="form-group">
													<label class="col-lg-2 control-label"> Purpose </label>
													<div class="col-lg-6">
														<?php 
				                                            echo $this->Form->textarea('RequestItem.0.purpose', array(
				                                            								'class' => 'form-control item_type',
										                                                    'label' => false,
										                                                    'placeholder' => 'Request Purpose'));
			                                            ?>
													</div>
												</div>

												<div class="form-group">
													<label class="col-lg-2 control-label">Remarks</label>
													<div class="col-lg-6">
														<?php 
				                                            echo $this->Form->textarea('RequestItem.0.remarks', array(
				                                            								'class' => 'form-control item_type ',
										                                                    'label' => false,
										                                                    'placeholder' => 'Remarks'));
			                                            ?>
													</div>
												</div>

												<hr>

											</div>
										    
										</div>
									</section>
									<div class="form-group">
										<div class="col-lg-2"></div>
										<div class="col-lg-8">
											<?php echo $this->Form->submit('Submit Request',array('class' => 'btn btn-primary','div' => false,'name' => 'submit','value' => 'pending')); ?>

											&nbsp;
											<?php echo $this->Html->link('<button type="submit" class="btn btn-default">Cancel</button>', array('controller' => 'quotations', 'action' => 'index'),array('escape' => false));
											?>
											
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		<?php echo $this->element('item_modal'); ?>

	<script>
		
	jQuery(document).ready(function($){

		$(".rolls").hide();	

		$(".remove").hide();

		$("#QuotationCreateForm").validate();
			//datepicker
			$('.datepick').datepicker({
				format: 'yyyy-mm-dd'


			});
		
	});

	$("body").on('click','.remove-field', function(e){
		 	
		 	$(this).parents('.removeItem').remove();
		 	
		});

	$("body").on('hover','#idhover', function(e){
		 	
		 	$(this).parents('.removeItem').remove();
		 	
		});

		$("body").on('change','.selectSpecProduct', function(e){
	        var partName = $(this).val();
	        var itemModel = $(this).attr('name');
	        //var name = $data['Requests']['name'];
	        var itemName = $(this).attr('data-name');
	        //console.log(test);
	        //alert(test);
	        if ($(this).is(":checked")) {
	            console.log(name);
	            console.log($(this).attr('class'));
	            // $('.item_model').val(itemModel);
	            // $('.item_id').val(partName);
	            // $('.item_name').val(itemName);
	            // $('.item_model').val(itemModel);
	            $(this).parents('.cloneMe').find('.item_model').val(itemModel);
	            $(this).parents('.cloneMe').find('.item_name').val(itemName);
	            $(this).parents('.cloneMe').find('.item_id').val(partName);
	            //$(this).parents('.item_name').val(itemName);
	            $( '.close' ).trigger( 'click' );
	          

	        }
	        
	    });

	$("body").on('keyup','.searchItem', function(e){
        var searchInput = $(this).val();
        var thisMe = $(this);
        var itemGroup = $('.ItemGroup').val();

        if(searchInput != ''){

            thisMe.parents('.modal-body').find('.tableProduct').hide();
            thisMe.parents('.modal-body').find('.Itemtable').show();
            //alert('hide');

        }else{
            thisMe.parents('.modal-body').find('.tableProduct').show();
            thisMe.parents('.modal-body').find('.Itemtable').hide();
            //alert('show');
        }

        if(searchInput){
            $.ajax({
                type: "GET",
                url: serverPath + "purchasing/requests/product_search/"+itemGroup+"/"+searchInput+"/"+itemGroup,
                dataType: "html",
                success: function(data) {
                   
                    if(data){
                       
                        thisMe.parents('.modal-body').find('.Itemtable').html(data); 
                    }else{
                         
                        thisMe.parents('.modal-body').find('.Itemtable').html('<font color="red"><b>No result..</b></font>'); 
                    }
                    
                }
            });

        }
        
    });


	 </script>


		
<?php } ?>

