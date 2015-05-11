<!-- Standard Bootstrap Modal -->
    <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Address</h4>
                </div>
                <div class="modal-body">
                 <?php echo $this->Form->create('CustomerSale',array('url'=>(array('controller' => 'customer_sales','action' => 'add_data')),'class' => 'form-horizontal'));?>
                    <?php 
                        echo $this->Form->input('Company.id', array('class' => 'form-control item_type required',
                            'type' => 'hidden',
                            'value' => $company['Company']['id']));
                        echo $this->Form->input('Address.model', array('class' => 'form-control item_type required',
                            'type' => 'hidden',
                            'value' => 'Company'));
                    ?>

                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Address(1)</label>
                            <div class="col-lg-2">
                                <?php 
                                    echo $this->Form->input('Address.type', array(
                                        'options' => array('Work', 'Home', 'Business','Plant'),
                                        'alt' => 'type',
                                        'label' => false,
                                        'class' => 'form-control col-lg-4 required',
                                        'empty' => false,
                                        'data-name' => 'Address'
                                    ));
                                ?>
                            </div>
                            <div class="col-lg-7">
                                <?php 
                                    echo $this->Form->input('Address.address1', array('class' => 'form-control item_type',
                                        'alt' => 'address1',
                                        'label' => false));
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label"> City</label>
                            <div class="col-lg-9">
                                <?php 
                                    echo $this->Form->input('Address.city', array('class' => 'form-control ',
                                        'alt' => 'city',
                                        'label' => false));
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label">State Province</label>
                            <div class="col-lg-9">
                                <?php 
                                    echo $this->Form->input('Address.state_province', array('class' => 'form-control ',
                                        'alt' => 'state_province',
                                        'label' => false));
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label"> Zip Code</label>
                            <div class="col-lg-9">
                                <?php 
                                    echo $this->Form->input('Address.zip_code', array('class' => 'form-control number',
                                        'alt' => 'zip_code',
                                        'label' => false,'type' => 'text'));
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label">Country</label>
                            <div class="col-lg-9">
                                <?php echo( $this->Country->select('Address.country',null,array('class' => 'form-control required')));?> 
                            </div>
                        </div>
                   
                        <div class="modal-footer">
                             <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i> Add Address</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                        </div>
                    </form>
                    
                </div>
                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->  
    <!-- Standard Bootstrap Modal -->
    <div class="modal fade" id="myModalContact" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Contact Number</h4>
                </div>
                <div class="modal-body">
                 <?php echo $this->Form->create('CustomerSale',array('url'=>(array('controller' => 'customer_sales','action' => 'add_data')),'class' => 'form-horizontal'));?>
                    <?php 
                        echo $this->Form->input('Company.id', array('class' => 'form-control item_type required',
                            'type' => 'hidden',
                            'value' => $company['Company']['id']));
                        echo $this->Form->input('Contact.model', array('class' => 'form-control item_type required',
                            'type' => 'hidden',
                            'value' => 'Company'));
                    ?>

                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label">Contact Number</label>
                            <div class="col-lg-2">
                                <?php 
                                    echo $this->Form->input('Contact.type', array(
                                        'options' => array('Work', 'Home', 'Business'),
                                        'label' => false,
                                        'alt' => 'type',
                                        'class' => 'form-control',
                                        'empty' => false
                                    ));

                                ?>
                               
                            </div>
                            
                            <div class="col-lg-7">
                                <?php 
                                    echo $this->Form->input('Contact.number', array('class' => 'form-control',
                                        'alt' => 'number',
                                        'label' => false,
                                        ));

                                ?>
                                 <!-- <span class="lighter-color">Ex. (02)-565-2056</span> -->
                            </div>
                        </div>
       
                        <div class="modal-footer">
                             <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i> Add Contact Number</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                        </div>
                    </form>
                    
                </div>
                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal --> 


      <div class="modal fade" id="myModalProduct" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
         <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Product</h4>
                </div>
        <?php echo $this->Form->create('Product',array('url'=>(array('controller' => 'products','action' => 'create_product','redirect_uri' => array(
            'controller' => $this->params['controller'],
            'action' => $this->params['action'],
            'id' => $this->params['pass'][0]
         ) ))));?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="main" style="padding:5px">
                        <div class="top-space"></div>
                        <div class="main-box-body clearfix">
                            <div class="main-box-body clearfix">
                                <div class="form-horizontal">                                   
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Name</label>
                                        <div class="col-lg-8">
                                            <?php 
                                                echo $this->Form->input('Product.name', array(
                                                                                'class' => 'form-control item_type',
                                                                                'label' => false,
                                                                                'required' => 'required',
                                                                                'placeholder' => 'Item Name'));
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Customer</label>
                                        <div class="col-lg-8">
                                            <input type="hidden" id="selected_type" value="">
                                            <?php echo $this->Form->input('Product.company_id', array(
                                                    'options' => array($companyData),
                                                    'type' => 'select',
                                                    'label' => false,
                                                    //'readonly' => 'readonly',
                                                    'class' => 'form-control required categorylist',
                                                    'empty' => '---Select Customer---',
                                                    'required' => 'required'
                                                     )); 
                                                ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Item Category</label>
                                        <div class="col-lg-8">
                                            <input type="hidden" id="selected_type" value="">
                                            <?php echo $this->Form->input('Product.item_category_holder_id', array(
                                                    'options' => array($itemCategoryData),
                                                    'type' => 'select',
                                                    'label' => false,
                                                    //'readonly' => 'readonly',
                                                    'class' => 'form-control required categorylist',
                                                    'empty' => '---Select Item Category---',
                                                    'required' => 'required'
                                                     )); 


                                                ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Item Type</label>
                                        <div class="col-lg-8">
                                             <?php echo $this->Form->input('Product.item_type_holder_id', array(
                                                    // 'type' => 'select',
                                                    'label' => false,
                                                    //'readonly' => 'readonly',
                                                    'class' => 'form-control required',
                                                    'empty' => '---Select Item Type---',
                                                    'id' => 'item_type_holder_id',
                                                    'required' => 'required'
                                                     )); 

                                                ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Remarks</label>
                                        <div class="col-lg-8">
                                            <?php 
                                                echo $this->Form->textarea('Product.remarks', array(
                                                                                'class' => 'form-control item_type',
                                                                                'label' => false,
                                                                                'placeholder' => 'Remarks'));
                                            ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i> Submit Product</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
            </div>
                  
        <?php echo $this->Form->end(); ?>


            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal --> 

    <div class="modal fade" id="myModalEmail" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Email</h4>
                </div>
                <div class="modal-body">
                 <?php echo $this->Form->create('CustomerSale',array('url'=>(array('controller' => 'customer_sales','action' => 'add_data')),'class' => 'form-horizontal'));?>
                    <?php 
                        echo $this->Form->input('Company.id', array('class' => 'form-control item_type required',
                            'type' => 'hidden',
                            'value' => $company['Company']['id']));
                        echo $this->Form->input('Email.model', array('class' => 'form-control item_type required',
                            'type' => 'hidden',
                            'value' => 'Company'));
                    ?>

                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label"> Email Address</label>
                            <div class="col-lg-2">
                                <?php 
                                    echo $this->Form->input('Email.type', array(
                                        'options' => array('Work', 'Home', 'Business'),
                                        'label' => false,
                                        'class' => 'form-control ',
                                        'empty' => false
                                    )); ?>
                            </div>
                            <div class="col-lg-7">
                                <?php 
                                    echo $this->Form->input('Email.email', array('class' => 'form-control email required','label' => false));
                                ?>
                                <span class="lighter-color2">Ex. example@email.com</span>
                            </div>
                        </div>
       
                        <div class="modal-footer">
                             <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i> Add Email</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                        </div>
                    </form>
                    
                </div>
                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal --> 

    <div class="modal fade" id="myModalContactPerson" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Contact Person</h4>
                </div>
                <div class="modal-body">
                 <?php echo $this->Form->create('CustomerSale',array('url'=>(array('controller' => 'customer_sales','action' => 'add_data')),'class' => 'form-horizontal'));?>
                    <?php 
                        echo $this->Form->input('Company.id', array('class' => 'form-control item_type required',
                            'type' => 'hidden',
                            'value' => $company['Company']['id']));
                        echo $this->Form->input('Contact.model', array('class' => 'form-control item_type required',
                            'type' => 'hidden',
                            'value' => 'ContactPerson'));
                        echo $this->Form->input('Email.model', array('class' => 'form-control item_type required',
                            'type' => 'hidden',
                            'value' => 'ContactPerson'));


                    ?>

                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Firstname</label>
                            <div class="col-lg-9">
                                <?php 
                                    echo $this->Form->input('ContactPerson.firstname', array('class' => 'form-control','label' => false,'required' => true));
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label">Middlename</label>
                            <div class="col-lg-9">
                                <?php 
                                    echo $this->Form->input('ContactPerson.middlename', array('class' => 'form-control',
                                        'label' => false));
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Lastname</label>
                            <div class="col-lg-9">
                                <?php 
                                    echo $this->Form->input('ContactPerson.lastname', array('class' => 'form-control','label' => false,'required' => true));
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label">Position</label>
                            <div class="col-lg-9">
                                <?php 
                                    echo $this->Form->input('ContactPerson.position', array('class' => 'form-control required','label' => false));
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label">Contact Number</label>
                            <div class="col-lg-3">
                                <?php 
                                    echo $this->Form->input('Contact.type', array(
                                        'options' => array('Work', 'Home', 'Business'),
                                        'label' => false,
                                        'class' => 'form-control',
                                        'empty' => false
                                    ));

                                ?>
                            </div>
                            <div class="col-lg-6">
                                <?php 
                                    echo $this->Form->input('Contact.number', array('class' => 'form-control','label' => false, ));
                                ?>
                            </div>
                           
                        </div>

                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label">Email</label>
                            <div class="col-lg-3">
                                <?php 
                                    echo $this->Form->input('Email.type', array(
                                        'options' => array('Work', 'Home', 'Business'),
                                        'label' => false,
                                        'class' => 'form-control',
                                        'empty' => false
                                    ));

                                ?>
                            </div>
                            <div class="col-lg-6">
                                <?php 
                                    echo $this->Form->input('Email.email', array('class' => 'form-control email','label' => false));
                                ?>
                                <span class="lighter-color2">Ex. example@email.com</span>
                            </div>
                        
                        </div>

                        <div class="modal-footer">
                             <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i> Add Contact Person</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                        </div>
                    </form>
                    
                </div>
                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal --> 

    <div class="modal fade" id="myModalDelivery" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Delivery Schedule</h4>
                </div>
                <div class="modal-body">
                 <?php echo $this->Form->create('ClientOrderDeliverySchedule',array('url'=>(array('controller' => 'sales_orders','action' => 'add_schedule')),'class' => 'form-horizontal'));?>
                    <?php 
                        echo $this->Form->input('ClientOrderDeliverySchedule.client_order_id', array('class' => 'form-control item_type required',
                            'type' => 'hidden',
                            'value' => $clientOrderData['ClientOrder']['id']
                            ));
                    ?>

                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Schedule</label>
                            <div class="col-lg-9">
                                <?php 
                                    echo $this->Form->input('ClientOrderDeliverySchedule.schedule', array(
                                                                                                            'class' => 'form-control required',
                                                                                                            'label' => false,
                                                                                                            'required' => 'required',
                                                                                                            'class' => 'form-control item_type datepick',
                                                                                                            'type' => 'text'
                                                                                                        ));
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span>Location</label>
                            <div class="col-lg-9">
                                <?php 
                                    echo $this->Form->input('ClientOrderDeliverySchedule.location', array('class' => 'form-control',
                                                                                                           'required' => 'required', 
                                                                                                            'label' => false));
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Quantity</label>
                            <div class="col-lg-9">
                                <?php 
                                    echo $this->Form->input('ClientOrderDeliverySchedule.quantity', array('class' => 'form-control required addquantityLimit number',
                                                                                                        'label' => false,
                                                                                                        'required' => 'required'));
                                ?>
                            </div>
                        </div>

                        <div class="modal-footer">
                             <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i> Submit</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                        </div>
                    </form>
                    
                </div>
                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal --> 



    <div class="md-overlay"></div>

    <script>
        
        
        jQuery(document).ready(function($){
            $("#CustomerSaleViewForm").validate();
          
        });

     </script>