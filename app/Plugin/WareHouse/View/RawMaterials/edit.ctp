<?php $this->Html->addCrumb('WareHouse', array('controller' => 'recievings', 'action' => 'index','plugin' => 'warehouse ')); ?>

<?php $this->Html->addCrumb('Raw Materials', array('controller' => 'raw_materials', 'action' => 'index')); ?>

<?php $this->Html->addCrumb('Add', array('controller' => 'raw_materials', 'action' => 'add')); ?>

<div style="clear:both"></div>

<?php 


 $page = !empty($this->params['named']['page']) ? $this->params['named']['page'] : ''; 

echo $this->element('ware_house_option');?>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box">
            <?php //echo $this->Session->flash(); ?>
            <header class="main-box-header clearfix">
               
                    <h1>
                        <u>
                           Add Raw Material
                        </u>
                         <?php 
                            echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'raw_materials', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                        ?>
             
            </header>
            <div class="main-box-body clearfix">

                <?php echo $this->Form->create('Item',array('url'=>(array('controller' => 'raw_materials','action' => 'edit','page' => $page )),'class' => 'form-horizontal'));?>

                 <?php 

                    echo $this->Form->input('id');

                    echo $this->Form->input('category_type_id', array( 
                                            'alt' => 'type',
                                            'label' => false,
                                            'class' => 'form-control',
                                            'value' => 2,
                                            'type' => 'hidden'
                                             ));
                ?>


                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-box">
                                <section class="cloneMe1 contactPersonAddress_section">
                                    <div class="main-box-body clearfix">
                                <br/>            
                                            
                                  <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label"> <span style="color:red">*</span> Item </label>
                                        <div class="col-lg-9"> 
                                            <?php echo $this->Form->input('name', array( 
                                                                        'alt' => 'type',
                                                                        'label' => false,
                                                                        'class' => 'form-control required',
                                                                ));
                                            ?>
                                        </div>
                                    </div> 

                                      <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label"> <span style="color:red">*</span> Type </label>
                                            
                                            <div class="col-lg-9"> 
                                                       <?php 

                                                        $items = array( 'rolls' => 'Rolls', 'sheets' => 'Sheets');

                                                        echo $this->Form->input('type', array(
                                                                                    'class' => 'form-control',
                                                                                    'options' =>  $items , 
                                                                                    'alt' => 'type',
                                                                                    'empty' => '--- Select Type ---',
                                                                                    'label' => false,
                                                                            ));
                                                        ?>
                                                    <span class="help-block" style= "color:white"> &nbsp </span>
                                            </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label"> <span style="color:red">*</span> GSM </label>
                                            
                                            <div class="col-lg-9"> 
                                                       <?php //$items = array( 'rolls' => 'Rolls', 'sheets' => 'Sheets');

                                                        echo $this->Form->input('gsm', array(
                                                                                    'class' => 'form-control',
                                                                                    'alt' => 'type',
                                                                                    'label' => false,
                                                                                    'type' => 'number'
                                                                            ));
                                                        ?>
                                                    <span class="help-block" style= "color:white"> &nbsp </span>
                                            </div>

                                    </div>


                                   
                     

                                         <?php 
                                          if (!empty($this->request->data['ItemSpec'][0])) :  ?>

                                         <?php foreach ($this->request->data['ItemSpec']as $key => $value) :

                                            $this->request->data['ItemSpec'][$key] = $value

                                          ?>
                                           <div class="form-group mesurement_section">
                                              <label for="inputPassword1" class="col-lg-2 control-label"> <span style="color:red">*</span> Width </label>
                                            
                                            <div class="col-lg-1"> 
                                                       <?php //$items = array( 'rolls' => 'Rolls', 'sheets' => 'Sheets');

                                                        echo $this->Form->input('ItemSpec.'.$key.'.width', array(
                                                                                    'class' => 'form-control',
                                                                                    'alt' => 'type',
                                                                                    'label' => false,
                                                                                    'type' => 'number',
                                                                                    'placeholder' => '00'
                                                                            ));
                                                        ?>
                                                    <span class="help-block" style= "color:white"> &nbsp </span>
                                            </div>


                                            <div class="col-lg-1"> 

                                                       <?php 

                                                            $items = array( 'inch' => 'Inch', 'mm' => 'mm');

                                                            echo $this->Form->input('ItemSpec.'.$key.'.unit_width', array(
                                                                                        'class' => 'form-control required',
                                                                                        'alt' => 'type',
                                                                                        'label' => false,
                                                                                        'options' => $items,
                                                                                        'empty' => 'Unit'
                                                                                ));
                                                        ?>
                                                    <span class="help-block" style= "color:white"> &nbsp </span>
                                            </div>

                                            <label for="inputPassword1" class="col-lg-1 control-label"> <span style="color:red">*</span> Length </label>
                                                 
                                            <div class="col-lg-1"> 

                                                     <?php //$items = array( 'rolls' => 'Rolls', 'sheets' => 'Sheets');

                                                        echo $this->Form->input('ItemSpec.'.$key.'.length', array(
                                                                                    'class' => 'form-control',
                                                                                    'alt' => 'type',
                                                                                    'label' => false,
                                                                                    'type' => 'number',
                                                                                    'placeholder' => '00',

                                                                            ));
                                                        ?>
                                                    <span class="help-block" style= "color:white"> &nbsp </span>
                                            </div>
                                               <div class="col-lg-1"> 

                                                       <?php $items = array( 'inch' => 'Inch', 'mm' => 'mm');

                                                            echo $this->Form->input('ItemSpec.'.$key.'.unit_length', array(
                                                                                        'class' => 'form-control',
                                                                                        'alt' => 'type',
                                                                                        'label' => false,
                                                                                        'options' => $items,
                                                                                        'empty' => 'Unit'
                                                                                ));
                                                        ?>
                                                    <span class="help-block" style= "color:white"> &nbsp </span>
                                            </div>
                                                <?php $style = 'display:none'; ?>
                                                <div class="col-lg-2">
                                                    <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneContactData('mesurement_section', this)"><i class="fa fa-plus"></i></button>
                                                    <button type="button" style="<?php echo $key == 0 ? $style : ''?>" class="remove-field btn btn-danger remove" onclick="removeClone('mesurement_section')"><i class="fa fa-minus"></i> </button>
                                                </div>

                                                <div class="clearfix"></div>

                                            </div>
                                         <?php endforeach; ?>

                                         <?php else: ?>
                                            <div class="form-group mesurement_section">
                                         <div class="clearfix"></div>
                                        <label for="inputPassword1" class="col-lg-2 control-label"> <span style="color:red">*</span> Width </label>
                                            
                                            <div class="col-lg-1"> 
                                                       <?php //$items = array( 'rolls' => 'Rolls', 'sheets' => 'Sheets');

                                                        echo $this->Form->input('ItemSpec.0.width', array(
                                                                                    'class' => 'form-control',
                                                                                    'alt' => 'type',
                                                                                    'label' => false,
                                                                                    'type' => 'number',
                                                                                    'placeholder' => '00'
                                                                            ));
                                                        ?>
                                                    <span class="help-block" style= "color:white"> &nbsp </span>
                                            </div>
                                              <div class="col-lg-1"> 

                                                       <?php 

                                                            $items = array( 'inch' => 'Inch', 'mm' => 'mm');

                                                            echo $this->Form->input('ItemSpec.0.unit_width', array(
                                                                                        'class' => 'form-control required',
                                                                                        'alt' => 'type',
                                                                                        'label' => false,
                                                                                        'options' => $items,
                                                                                        'empty' => 'Unit'
                                                                                ));
                                                        ?>
                                                    <span class="help-block" style= "color:white"> &nbsp </span>
                                            </div>
                                            <label for="inputPassword1" class="col-lg-1 control-label"> <span style="color:red">*</span> Length </label>
                                                 
                                            <div class="col-lg-1"> 

                                                     <?php //$items = array( 'rolls' => 'Rolls', 'sheets' => 'Sheets');

                                                        echo $this->Form->input('ItemSpec.0.length', array(
                                                                                    'class' => 'form-control required',
                                                                                    'alt' => 'type',
                                                                                    'label' => false,
                                                                                    'type' => 'number',
                                                                                    'placeholder' => '00',

                                                                            ));
                                                        ?>
                                                    <span class="help-block" style= "color:white"> &nbsp </span>
                                            </div>
                                                <div class="col-lg-1"> 

                                                       <?php $items = array( 'inch' => 'Inch', 'mm' => 'mm');

                                                            echo $this->Form->input('ItemSpec.0.unit_length', array(
                                                                                        'class' => 'form-control',
                                                                                        'alt' => 'type',
                                                                                        'label' => false,
                                                                                        'options' => $items,
                                                                                        'empty' => 'Unit'
                                                                                ));
                                                        ?>
                                                    <span class="help-block" style= "color:white"> &nbsp </span>
                                            </div>
                                                <div class="col-lg-2">
                                                    <button type="button" class="add-field1 table-link danger btn btn-success" onclick="cloneContactData('mesurement_section', this)"><i class="fa fa-plus"></i></button>
                                                    <button type="button" style="display:none;" class="remove-field btn btn-danger remove" onclick="removeClone('mesurement_section')"><i class="fa fa-minus"></i> </button>
                                                </div>

                                    </div>
                                        <?php endif; ?> 
                                      
                                      
                                     

                                <!--     <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label"> Measure </label>
                                                <div class="col-lg-9">
                                                   <?php 
                                                        echo $this->Form->input('measure', array('class' => 'form-control','label' => false,'type' => 'text'));
                                                    ?>
                                                </div>
                                            </div>
 -->


                                       <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label"> <span style="color:red">*</span> Item Group </label>
                                        <div class="col-lg-9"> 
                                                   <?php
                                                    
                                                    $itemGroups = array(
                                                        'CorrugatedPaper' => 'Corrugated Paper',
                                                        'GeneralItem' => 'General Item',
                                                        'Substrate' => 'Substrate'
                                                    );

                                                    echo $this->Form->input('item_group', array(
                                                                                'options' => $itemGroups , 
                                                                                'alt' => 'type',
                                                                                'label' => false,
                                                                                'class' => 'form-control required',
                                                                                'empty' => '--- Select Item Group---',
                                                                                'data-alt' => 'supplier_others',
                                                                        ));
                                                    ?>
                                                    <span class="help-block" style= "color:white"> &nbsp </span>
                                        </div>
                                    </div>
                                      
                                       <!--  <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Category / Department </label>
                                            <div class="col-lg-9"> 
                                                <?php 

                                                       $categoryDataDropList = array_merge($categoryDataDropList,array('others' => 'Others' ));
                                                       
                                                       echo $this->Form->input('department_id',array( 
                                                                                    'options' => $categoryDataDropList,
                                                                                    'alt' => 'type',
                                                                                    'label' => false,
                                                                                    'class' => 'form-control select_option required tment_select',
                                                                                    'empty' => '--- Select Department ---',
                                                                                    'data-alt' => 'department_others'
                                                                            ));

                                                ?>
                                                <span class="help-block" style= "color:white"> &nbsp </span>
                                           </div>
                                       </div> -->

<!-- 
                                       <div class="form-group department_others others hide">
                                            <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Other Department </label>
                                            <div class="col-lg-9"> 
                                                <?php 

                                                    echo $this->Form->input('department_id_others',
                                                                            array( 'alt' => 'type',
                                                                                    'label' => false,
                                                                                    'class' => 'form-control required',
                                                                                   
                                                                            ));
                                                ?>
                                                    <span class="help-block" style= "color:white"> &nbsp </span>
                                           </div>
                                       </div> -->


                                       <div class="form-group">
                                        <label for="inputPassword1" class="col-lg-2 control-label"> Supplier </label>
                                        <div class="col-lg-9"> 
                                                   <?php
                                                    

                                                    echo $this->Form->input('supplier', array(
                                                                                'options' => $supplierList, 
                                                                                'alt' => 'type',
                                                                                'label' => false,
                                                                                'class' => 'form-control select_option supplier_select',
                                                                                'empty' => '--- Select Supplier---',
                                                                                'data-alt' => 'supplier_others',
                                                                                'default' => $this->request->data['Item']['supplier']
                                                                        ));
                                                    ?>
                                                    <span class="help-block" style= "color:white"> &nbsp </span>
                                        </div>
                                    </div>

                                    <div class="form-group supplier_others others hide">
                                            <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Other Supplier </label>
                                            <div class="col-lg-9"> 
                                                <?php 

                                                    echo $this->Form->input('supplier_id_others',
                                                                            array( 'alt' => 'type',
                                                                                    'label' => false,
                                                                                    'class' => 'form-control',
                                                                                   
                                                                            ));
                                                ?>
                                                    <span class="help-block" style= "color:white"> &nbsp </span>
                                           </div>
                                       </div>
                                           
                                       <!--  
                                            <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span>Stocks</label>
                                                <div class="col-lg-9">
                                                    <?php 
                                                        echo $this->Form->input('remaining_stocks', array('class' => 'form-control required number','label' => false,'type' => 'text'));
                                                    ?>
                                                </div>
                                            </div> -->

                                          <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Quantity / KGS </label>
                                                <div class="col-lg-9">
                                                    <?php 
                                                        echo $this->Form->input('quantity', array('class' => 'form-control required number','label' => false,'type' => 'text'));
                                                    ?>
                                                </div>
                                            </div> 

                                            <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Stocks  </label>
                                                <div class="col-lg-9">
                                                    <?php 
                                                        echo $this->Form->input('remaining_stocks', array('class' => 'form-control required number','label' => false,'type' => 'text'));
                                                    ?>
                                                </div>
                                            </div> 
                                                                                        
                                            <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> Location </label>
                                                <div class="col-lg-9">
                                                    <?php 
                                                        echo $this->Form->input('location', array('class' => 'form-control required','placeholder' => 'Address','label' => false,'type' => 'text'));
                                                    ?>
                                                </div>
                                            </div> 

                                            <div class="form-group">
                                                <label for="inputPassword1" class="col-lg-2 control-label">Remarks</label>
                                                <div class="col-lg-9">
                                                     <?php 
                                                        echo $this->Form->textarea('description', array('class' => 'form-control ','label' => false));
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
                                <div class="col-xs-2 col-md-4">
                                    <?php 
                                        echo $this->Form->submit('Submit', array('class' => 'btn btn-success pull-right',  'title' => 'Click here to add the customer'));
                                    ?>
                                 
                                </div>
                                <div class="col-xs-2 col-md-2 2">
                                    <?php 
                                        echo $this->Html->link('Cancel ', array('controller' => 'raw_materials', 'action' => 'index','page' => $page),array('class' =>'btn btn-primary','escape' => false));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php echo $this->Form->end(); ?>
                <script>
                //$("#RawMaterialAddForm").validate();

                $(document).ready(function(e){

                    $('.supplier_select').change(function(){
                        $this = $(this);

                        $(this).parents('.form-group').next().addClass('hide');

                        if ($this.val() == 'others') {

                            $('.'+ $this.data('alt')).removeClass('hide');
                        } 
                    });
                    $('.department_select').change(function(){
                        $this = $(this);
                        
                        $(this).parents('.form-group').next().addClass('hide');

                        if ($this.val() == 'others') {

                            $('.'+ $this.data('alt')).removeClass('hide');
                        } 
                    });
                });
                </script>

            </div>
        </div>
    </div>
</div>