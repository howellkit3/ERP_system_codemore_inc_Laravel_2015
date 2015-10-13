<?php  echo $this->Html->script('Purchasing.modal_clone');?>
<?php $this->Html->addCrumb('Ware House', array('controller' => 'ware_house_systems', 'action' => 'index')); ?>
<div style="clear:both"></div>
<?php echo $this->element('ware_house_option');  ?>

<div class="row">
    <div class="col-lg-12">

        <div class="main-box">
            <?php echo $this->Session->flash(); ?>
            <header class="main-box-header clearfix">
                <h2>

                    Receipt Details

                <div class="md-overlay"></div>

                </h2>
            </header>
            <?php echo $this->Form->create('Company',array('url'=>(array('controller' => 'receivings','action' => 'receive_receipt')),'class' => 'form-horizontal'));?>
                <div class="main-box-body clearfix">
                    <form class="form-horizontal" role="form">

                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span>P.O. Number</label>
                            <div class="col-lg-8">
                                <?php 
                                    echo $this->Form->input('ReceiveReceipt.po_number', array('class' => 'form-control item_type',
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
                                    'empty' => '---Select Company---',
                                    'id' => 'select_company'
                                     ));
                            ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span>Address</label>
                            <div class="col-lg-8">
                                <?php 
                                    echo $this->Form->textarea('ReceiveReceipt.address', array('class' => 'form-control item_type',
                                        'alt' => 'Address',
                                        'label' => false,
                                        'class' => 'form-control col-lg-4 required',
                                        'id' => 'address1'));
                                ?>
                            </div>
                        </div>

                       <div class="main-box">
                            <div class="top-space"></div>
                                <header class="main-box-header clearfix">
                                                    
                                    <h1 class="pull-left">
                                        Item Details
                                    </h1>
                                    <input type="hidden" value="1" name="getCounter" class="get-counter" />
                                </header>

                                <div class="main-box-body clearfix">

                                    <section class="cloneMe">
                                        
                                        <div class="main-box-body clearfix">
                                            <div class="form-horizontal">

                                                <div class="form-group" >
                                                    <label class="col-lg-2 control-label"><span style="color:red">*</span>Item Name</label>
                                                    <div class="col-lg-6">
                                                        
                                                        <?php 
                                                            echo $this->Form->input('ReceiveReceipt.itemdetails.0.item_name', 
                                                                            array( 
                                                                // 'options' => array($itemData),  
                                                                'class' => 'form-control col-lg-4 required item_name',
                                                                'label' => false,
                                                                'readonly' => true,
                                                                'placeholder' => 'Item'
                                                                ));
                                                        ?>

                                                        <?php 
                                                            echo $this->Form->input('ReceiveReceipt.itemdetails.0.foreign_key', 
                                                                            array( 
                                                                'class' => 'form-control item_id required', 
                                                                'type' => 'hidden',
                                                                'label' => false,
                                                                'readonly' => 'readonly'
                                                                ));
                                                        ?>

                                                        <?php 
                                                            echo $this->Form->input('ReceiveReceipt.itemdetails.0.model', 
                                                                            array( 
                                                                'class' => 'form-control item_model required ', 
                                                                'type' => 'hidden',
                                                                'label' => false,
                                                                'readonly' => 'readonly'
                                                                ));
                                                        ?>


                                                    </div>

                                                    <div class="col-lg-4">

                                                        <a data-toggle="modal" href="#myModalItem" data-modal="1" class="modal-button btn btn-primary mrg-b-lg pull-left  "><i class="fa fa-search-plus fa-lg"></i> Select Item</a>
                                                        &emsp;
                                                        <button type="button" class="add-field1  table-link danger btn btn-success " onclick="cloneDatarequest('cloneMe', this)"><i class="fa fa-plus"></i></button>
                                                        
                                                        <button type="button" class="remove btn btn-danger " onclick="removeClone('cloneMe')"><i class="fa fa-minus" ></i></button>

                                                    </div>

                                                     <div class="form-group">
                                                        <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span>Item Type</label>
                                                        <div class="col-lg-8">
                                                            <?php 
                                                                echo $this->Form->input('ReceiveReceipt.itemdetails.0.item_type', array('class' => 'form-control item_type',
                                                                    'alt' => 'Contact',
                                                                    'label' => false,
                                                                    'class' => 'form-control col-lg-4 required'
                                                                    ));
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span>Quantity</label>
                                                        <div class="col-lg-8">
                                                            <?php 
                                                                echo $this->Form->input('ReceiveReceipt.itemdetails.0.quantity', array('class' => 'form-control item_type',
                                                                    'alt' => 'Contact',
                                                                    'label' => false,
                                                                    'type' => 'number',
                                                                    'class' => 'form-control col-lg-4 required'
                                                                ));
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span>No. of Packs of Boxes</label>
                                                        <div class="col-lg-8">
                                                            <?php 
                                                                echo $this->Form->input('ReceiveReceipt.itemdetails.0.number_of_boxes', array('class' => 'form-control item_type',
                                                                    'label' => false,
                                                                    'type' => 'number',
                                                                    'class' => 'form-control col-lg-4 required'
                                                                    ));
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span>Quantity per box</label>
                                                        <div class="col-lg-8">
                                                            <?php 
                                                                echo $this->Form->input('ReceiveReceipt.itemdetails.0.quantity_per_boxes', array('class' => 'form-control item_type',
                                                                    'label' => false,
                                                                    'type' => 'number',
                                                                    'class' => 'form-control col-lg-4 required'
                                                                    ));
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span>Lot /Batch No.</label>
                                                        <div class="col-lg-8">
                                                            <?php 
                                                                echo $this->Form->input('ReceiveReceipt.itemdetails.0.lot', array('class' => 'form-control item_type',
                                                                    'label' => false,
                                                                    'type' => 'number',
                                                                    'class' => 'form-control col-lg-4 required'
                                                                    ));
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputPassword1" class="col-lg-2 control-label"> Remarks</label>
                                                        <div class="col-lg-8">
                                                            <?php 
                                                                echo $this->Form->textarea('ReceiveReceipt.itemdetails.0.remarks', array('class' => 'form-control item_type',
                                                                    'label' => false,
                                                                    'class' => 'form-control col-lg-4 ',
                                                                    'rows' => '4'));
                                                            ?>
                                                             
                                                        </div>
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

                        <!-- //</form> -->

                    </div>
                </div>
            </div>
        </div>  
            <?php echo $this->Form->end(); ?>

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

<script>



    jQuery(document).ready(function($){
        //masked inputs
        $("#CompanyTin").mask("999-999-999-999");
        jQuery('.remove').hide();
       $("#CompanyInquiryFormForm").validate();

    });
</script>   
