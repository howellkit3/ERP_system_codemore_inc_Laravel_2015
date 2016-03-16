<?php $this->Html->addCrumb('Ware House', array('controller' => 'ware_house_systems', 'action' => 'index')); ?>
<div style="clear:both"></div>
<?php echo $this->element('ware_house_option');  ?>
<?php  echo $this->Html->script('Purchasing.modal_clone');?>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<?php echo $this->Session->flash(); ?>
			<header class="main-box-header clearfix">
				<h2>
					Receive of Receipts
					<?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'receivings', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
					
					<!-- <button style="margin-right:10px;" class="md-trigger btn btn-primary mrg-b-lg pull-right" data-modal="modal-1"><i class="fa fa-plus-circle fa-lg"></i> Add Customer</button> -->
					
					<div class="md-overlay"></div>

				</h2>
			</header>

				<?php echo $this->Form->create('ReceiveReceipts',array('url'=>(array('controller' => 'receivings','action' => 'receive_receipt')),'class' => 'form-horizontal'));?>
				
							<div class="main-box-body clearfix">
								<div class="form-horizontal">

			                        <div class="form-group">
										<label for="inputPassword1" class="col-lg-2 control-label">PO Number</label>
										<div class="col-lg-8">
											<?php 
				                                echo $this->Form->input('ReceiveReceipt.po_number', array('class' => 'form-control item_type',
				                                    'alt' => 'Address',
				                                    'label' => false,
				                                    'id' => 'address1'));
				                            ?>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Supplier</label>
										<div class="col-lg-8">
										<?php 
				                            echo $this->Form->input('ReceiveReceipt.supplier_id', array(
				                                'options' => array($supplierData),
				                                'type' => 'select',
				                                'label' => false,
				                                'class' => 'form-control col-lg-4 required',
				                                'empty' => '---Select Supplier---',
				                                'id' => 'select_company'
				                                
				                                 ));
				                        ?>

										</div>
									</div>

									<div class="form-group">
										<label for="inputPassword1" class="col-lg-2 control-label"> Item Type</label>
										<div class="col-lg-8">
											<?php 
				                                echo $this->Form->input('ReceiveReceipt.item_type', array('class' => 'form-control item_type',
				                                    'alt' => 'Address',
				                                    'label' => false,
				                                    'id' => 'address1'));
				                            ?>
										</div>
									</div>

									
								</div>
							</div>
							

								<div class="form-group">
                                    <label class="col-lg-2 control-label">Delivery Number</label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('ReceiveReceipt.dr_num', array(
                                                                            'class' => 'form-control item_type',
                                                                            'label' => false,
                                                                            'type' => 'number',
                                                                            'fields' =>array('name')
                                                                            ));
                                        ?>


                                    </div>
                                </div>      

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Sales Invoice Number</label>
                                    <div class="col-lg-8">
                                        <?php 
                                            echo $this->Form->input('ReceiveReceipt.si_num', array(
                                                                            'class' => 'form-control item_type',
                                                                            'label' => false,
                                                                            'type' => 'number',
                                                                            'fields' =>array('name')
                                                                            ));
                                        ?>


                                    </div>
                                </div>  

                                <div class="form-group">
                                        <label class="col-lg-2 control-label"><span style="color:red">*</span>Tracking Number</label>
                                        <div class="col-lg-8">
                                            <?php 
                                                echo $this->Form->input('DeliveredOrders.uuid',array( 
                                                                        'class' => 'form-control  required', 
                                                                        'label' => false,
                                                                        'placeholder' => 'Tracking Number',
                                                                        'id' => 'generate-poNumber' 
                                                                        ));
                                            ?>
                                        </div>
                                    </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label"></label>
                                <div class="col-lg-8">
                                    <div class="checkbox-nice">
                                        <input id="checkbox-1" type="checkbox" class="generate-poNumber">
                                        <label for="checkbox-1"> Generate Tracking Number </label>
                                    </div>
                                </div>
                            </div>

							<div class="main-box-body clearfix">

								<section class="cloneMe">
									
									<div class="main-box-body clearfix">
										<div class="form-horizontal item-category">

											<div class="form-group" >
												<label class="col-lg-2 control-label"><span style="color:red">*</span> Item </label>
												<div class="col-lg-7">
													<?php 
									                    echo $this->Form->input('requestPurchasingItem.0.nameToShow', 
																		array( 
															// 'options' => array($itemData),  
															'class' => 'form-control item_name required', 
									    					'label' => false,
									    					'readonly' => true,
									    					'placeholder' => 'Item',
									    					));
									                ?>

									                <?php 
									                    echo $this->Form->input('requestPurchasingItem.0.name', 
																		array( 
															 'type' => 'hidden',  
															'class' => 'form-control item_name required', 
									    					'label' => false,
									    					'readonly' => 'readonly'
									    					));
									                ?>

									                <?php 
									                    echo $this->Form->input('requestPurchasingItem.0.foreign_key', 
																		array( 
															'class' => 'form-control item_id required', 
															'type' => 'hidden',
									    					'label' => false,
									    					'readonly' => 'readonly'
									    					));
									                ?>

									                <?php 
									                    echo $this->Form->input('requestPurchasingItem.0.model', 
																		array( 
															'class' => 'form-control item_model required ', 
															'type' => 'hidden',
									    					'label' => false,
									    					'readonly' => 'readonly'
									    					));
									                ?>

									        	</div>



												<div class="col-lg-3">

													<a data-toggle="modal" href="#myModalItem" data-modal="1" class="modal-button btn btn-primary mrg-b-lg pull-left  "><i class="fa fa-search-plus fa-lg"></i> Select Item</a>
													&emsp;
													<button type="button" class="add-field1  table-link danger btn btn-success " onclick="cloneDatarequest('cloneMe', this)"><i class="fa fa-plus"></i></button>
													
													<button type="button" class="remove btn btn-danger hidden" onclick="removeClone('cloneMe')"><i class="fa fa-minus" ></i></button>

												</div>

											</div>

											<div class="form-group">
												<label for="inputPassword1" class="col-lg-2 control-label">No. Packs of Boxes</label>
												<div class="col-lg-3">
													<?php 
						                                echo $this->Form->input('requestPurchasingItem.0.pack_quantity', array('class' => 'form-control item_type',
						                                    'label' => false,
						                                    'class' => 'form-control quantitycode box',
						                                    'id' => 'email'
						                                    ));
						                            ?>
												</div>

												<label for="inputPassword1" class="col-lg-2 control-label">Quantity per box</label>
												<div class="col-lg-3">
													<?php 
														echo $this->Form->input('requestPurchasingItem.0.quantity_per_box', array(
									                        'label' => false,
									                        'class' => 'form-control quantitycode perbox',
									                        'empty' => '---Select Unit---'
									                         )); 
									                ?>
												</div>
											</div>

											<div class="form-group">
												<label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span>Quantity</label>
												<div class="col-lg-4">
													<?php 
						                                echo $this->Form->input('requestPurchasingItem.0.quantity', array('class' => 'form-control item_type',
						                                    'label' => false,
						                                    'class' => 'form-control required quantity',
						                                    'id' => 'email'
						                                    ));
						                            ?>
												</div>

												<div class="col-lg-4">
													<?php 
														echo $this->Form->input('requestPurchasingItem.0.quantity_unit_id', array(
									                        'options' => array($unitData),  
									                        'label' => false,
									                        'class' => 'form-control required',
									                        'empty' => '---Select Unit---'
									                         )); 
									                ?>
												</div>
											</div>


                               <!--  <div class="form-group">
                                        <label class="col-lg-2 control-label">Tracking Number</label>
                                        <div class="col-lg-8">
                                            <?php 
                                                echo $this->Form->input('ReceiveReceipt.tracking',array( 
                                                                        'class' => 'form-control ', 
                                                                        'label' => false,
                                                                        'placeholder' => 'Tracking Number',
                                                                        'id' => 'generate-poNumber' 
                                                                        ));
                                            ?>
                                        </div>
                                    </div> -->

									</div>
									    
									</div>
								</section>
									
								<div class="form-group">
									<label for="inputPassword1" class="col-lg-2 control-label"> Remarks</label>
									<div class="col-lg-8">
										<?php 
			                                echo $this->Form->textarea('ReceiveReceipt.remarks', array('class' => 'form-control item_type',
			                                    'alt' => 'Request Inquiry',
			                                    'label' => false,
			                                    'rows' => '6'));
			                            ?>
			                             
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-lg-offset-2 col-lg-10">
										<button type="submit" class="btn btn-success">Submit</button>
									
										<?php 
					                        echo $this->Html->link('Cancel ', array('controller' => 'customer_sales', 'action' => 'inquiry'),array('class' =>'btn btn-primary ','escape' => false));
					                    ?>
									</div>
								</div>
				</form>
			</div>
		</div>
	</div>
</div>			


	<div class="modal fade" id="myModalItem" role="dialog" data-item="" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog specModal">
			        <div class="modal-content">
			            <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                <h4 class="modal-title">Material</h4>
			            </div>

			            <div class="modal-body">
			                <div class="form-group">
			                    <div class="col-lg-3"></div>
			                    <div class="col-lg-6">
			                        <div class="input-group">
			                            <span class="input-group-addon"><i class="fa fa-reorder"></i></span>
			                            <select  class="form-control select-group ItemGroup" >
			                                <option value="0">--Select Item Group--</option>
			                                <option value="1">General Items</option>
			                                <option value="2">Substrates</option>
			                                <option value="3">Compound Substrates</option>
			                                <option value="4">Corrugated Papers</option>
			                            </select>
			                        </div>
			                    </div>
			                </div>

			                <header class="main-box-header clearfix">
			                    <h1 class="pull-left">Item List</h1>
			                    <div class="filter-block pull-right">
			                        <div class="form-group">

			                            <input placeholder="Search..."  class="form-control searchItem" type="search" disabled="disabled" />
			                            <i class="fa fa-search search-icon"></i>
			                         
			                        </div>  
			                    </div>
			                </header>

			                <input type="hidden" class="current_page" />

			                <input type="hidden" class="show_per_page" />

			                <table class="table table-striped table-hover">
			                    <thead>
			                        <tr>
			                            <th><a href="#"><span>Select</span></a></th>
			                            <th style="width:200px;"><a href="#"><span>Item Number</span></a></th>
			                            <th><a href="#"><span>Name</span></a></th>
			                        </tr>
			                    </thead>
			                    <tbody class="tableProduct" aria-relevant="all" id="scrollTable" aria-live="polite" role="alert" >
			                    </tbody>

			                    <tbody class="Itemtable" aria-relevant="all" id="scrollTable" aria-live="polite" role="alert" >
			                    </tbody>

			                    
			                </table>

			                <div class="table-responsive">
			                    <header class="main-box-header clearfix">
			                        <h1 class="pull-left">Item List</h1>
			                        <div class="filter-block pull-right">
			                            <div class="form-group pull-left">

			                            </div>
			                        </div>
			                    </header>
			                </div>

			                <div class="form-group">
			                    <div class="col-lg-10"></div>
			                    <div class="col-lg-2">
			                    </div>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
<?php //echo $this->element('item_modal'); ?>

<?php echo $this->Form->end(); ?>

<script>
	

	$("body").on('keyup','.quantitycode', function(e){
        
       box = $('.box').val();

       perbox = $('.perbox').val(); 

       product = box * perbox;

       quantity = $('.quantity').val(product); 

    });

    $("body").on('keyup','.quantity', function(e){
        
       quantity = $('.quantity').val();

       box = $('.box').val();

       perbox = $('.perbox').val(); 

       quotient = quantity / perbox;

       if(quotient != perbox){

       		$('.box').val("");

       		$('.perbox').val(""); 

       }

      // quantity = $('.quantity').val(product); 

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

  $('.generate-poNumber').change(function(){

        var currentTime = new Date()
    var month = currentTime.getMonth() + 1
    var year = currentTime.getFullYear()
    var hour = currentTime.getHours()
    var minute = currentTime.getMinutes()
    var seconds = currentTime.getSeconds()

    year = year.toString().substr(2,2);

    month = month + "";

    hour = hour + "";

    minute = minute + "";

    seconds = seconds + "";

    if (month.length == 1)
    {
        month = "0" + month;
    }

    if (hour.length == 1)
    {
        hour = "0" + hour;
    }

    if (minute.length == 1)
    {
        minute = "0" + minute;
    }

    if (seconds.length == 1)
    {
        seconds = "0" + seconds;
    }

    timestamp = jQuery.now();
    var timeToString = timestamp.toString();

    timeSlice = timeToString.slice(-6);

    var ranDom = Math.floor(Math.random()*9000) + 1000;
    var code = year.concat( month, timeSlice);
        
        if($(this).is( ":checked" ) == true){
            
            var data = "RCV-" + code;
            
            $('#generate-poNumber').val(data);
            
            $('#generate-poNumber').attr('readonly','true');
        }
        
        if($(this).is( ":checked" ) == false){
            
            $('#generate-poNumber').val('');
            $('#generate-poNumber').removeAttr("readonly");
           
        }
    
    });

</script>