
<div class="main-box-body clearfix">
	<div class="form-horizontal">

		<div class="form-group" >
			<label class="col-lg-2 control-label"><span style="color:red">*</span>Item</label>
			<div class="col-lg-5">
				<?php 
                    echo $this->Form->input('PurchasingItem.'.$getCounter.'.nameToShow', 
									array( 
						// 'options' => array($itemData),  
						'class' => 'form-control item_name'.$getCounter.' required', 
    					'label' => false,
    					'readonly' => 'readonly',
    					'placeholder' => 'Item',
    					));
                ?>

                <?php 
                    echo $this->Form->input('PurchasingItem.'.$getCounter.'.name', 
									array( 
						 'type' => 'hidden',  
						'class' => 'form-control item_id'.$getCounter.' required', 
    					'label' => false,
    					'readonly' => 'readonly',
    					'placeholder' => 'Item',
    					));
                ?>

        	</div>

			<div class="col-lg-3">

				<a data-toggle="modal" href="#myModalItem<?php echo $getCounter; ?>" class="btn btn-primary mrg-b-lg pull-left  "><i class="fa fa-search-plus fa-lg"></i> Select Item</a>
				&emsp;&emsp;&emsp;&emsp;
				<!-- <button type="button" class="add-field1  table-link danger btn btn-success " onclick="cloneData('cloneMe', this)"><i class="fa fa-plus"></i></button> -->
				<button type="button" class="add-field1sd proxy-counter add-request-section table-link danger btn btn-success" ><i class="fa fa-plus"></i></button>
				&emsp;&emsp;&emsp;&emsp;
				<button type="button" class="remove btn btn-danger " onclick="removeClone('cloneMe')"><i class="fa fa-minus" ></i></button>

			</div>

		</div>

		<div class="form-group">

			<label class="col-lg-2 control-label">Size</label>
			<div class="col-lg-3">
				<?php 
                    echo $this->Form->input('PurchasingItem.'.$getCounter.'.size1', array(
						'class' => 'form-control item_type',
                        'label' => false,
                        'placeholder' => 'Size'));
                ?>
			</div>

			<div class="col-lg-3">
				<?php 
					echo $this->Form->input('PurchasingItem.'.$getCounter.'.size1_unit_id', array(
                        'options' => array($unitData),  
                        'label' => false,
                        'class' => 'form-control required',
                        'empty' => '---Select Unit---'
                         )); 
                ?>

         		<?php 
                    echo $this->Form->input('PurchasingItem.'.$getCounter.'.foreign_key', 
									array( 
						'class' => 'form-control item_id required item_id', 
						'type' => 'hidden',
    					'label' => false,
    					'readonly' => 'readonly',
    					'placeholder' => 'Item',
    					));
                ?>

                <?php 
                    echo $this->Form->input('PurchasingItem.'.$getCounter.'.model', 
									array( 
						'class' => 'form-control item_model'.$getCounter.' required ', 
						'type' => 'hidden',
    					'label' => false,
    					'readonly' => 'readonly',
    					'placeholder' => 'Item',
    					));
                ?>

			</div>

			<label class="col-lg-3 sizeWith">&emsp;&emsp;x </label>

		</div>

		<div class="form-group">
			<label class="col-lg-2 control-label"> </label>
			<div class="col-lg-3">
				<?php 
					echo $this->Form->input('PurchasingItem.'.$getCounter.'.size2', array(
						'class' => 'form-control item_type',
                        'label' => false,
                        'placeholder' => 'Size'));

                ?>
			</div>

			<div class="col-lg-3">
				<?php 
					echo $this->Form->input('PurchasingItem.'.$getCounter.'.size2_unit_id', array(
                        'options' => array($unitData),  
                        'label' => false,
                        'class' => 'form-control required',
                        'empty' => '---Select Unit---'
                         )); 

                ?>
			</div>

			<label class="col-lg-3 sizeWith">&emsp;&emsp;x </label>

		</div>

		<div class="form-group">
			<label class="col-lg-2 control-label"> </label>
			<div class="col-lg-3">
				<?php 
					echo $this->Form->input('PurchasingItem.'.$getCounter.'.size3', array(
						'class' => 'form-control item_type',
                        'label' => false,
                        'placeholder' => 'Size'));

                ?>
			</div>

			<div class="col-lg-3">
				<?php 
					echo $this->Form->input('PurchasingItem.'.$getCounter.'.size3_unit_id', array(
                        'options' => array($unitData),  
                        'label' => false,
                        'class' => 'form-control required',
                        'empty' => '---Select Unit---'
                         )); 

                ?>
			</div>

			<label class="col-lg-3 sizeWith">&emsp;&emsp;x </label>

		</div>

		<div class="form-group">
			<label class="col-lg-2 control-label"><span style="color:red">*</span>Quantity</label>
			<div class="col-lg-3">
				<?php 
					echo $this->Form->input('PurchasingItem.'.$getCounter.'.quantity', array(
						'class' => 'form-control item_type number required',
						'type' => 'number',
                        'label' => false,
                        'data' => 0,
                        'placeholder' => 'Quantity',
                        'value' => 0));

                ?>
			</div>

			<div class="col-lg-3">
				<?php 
					echo $this->Form->input('PurchasingItem.'.$getCounter.'.quantity_unit_id', array(
                        'options' => array($unitData),  
                        'label' => false,
                        'class' => 'form-control required',
                        'empty' => '---Select Unit---'
                         )); 

                ?>
			</div>

		</div>

		<hr>

	</div>
    <div class="modal fade" id="myModalItem<?php echo $getCounter; ?>" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

    <div class="md-overlay"></div>
</div>



