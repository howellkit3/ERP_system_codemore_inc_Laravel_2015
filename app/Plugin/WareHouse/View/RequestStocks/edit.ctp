<?php echo $this->element('ware_house_option');?>
    <?php echo $this->Form->create('RequestStock',array('url'=>(array('controller' => 'request_stocks','action' => 'edit',$data['RequestStock']['id']))));?>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix body-pad">
                    <div class="row" id="user-profile">
                        <div class="col-lg-12">
                            <div class="main-box clearfix">
                                <div class="tabs-wrapper profile-tabs">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab-newsfeed" data-toggle="tab">Request Stock</a></li>
                                    </ul>
                                    
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="tab-newsfeed">
                                            
                                            <div class="table-responsive">
                                                <div class="col-lg-12">
                                                    <div class="main-box">
                                                        <header class="main-box-header clearfix">
                                                            <br><br>
                                                            <h4>
                                                                We are pleased to submit our PO on your printing requirement under the following specifications:
                                                            </h4>
                                                        </header>
                                                        
                                                        <div class="main-box-body clearfix">
                                                            <div class="form-horizontal">
                                                       
  
                                                                  <div class="col-lg-11" >
                                                     
                                                            </div>
                                                              <?php 
                                                                        echo $this->Form->input('po', array('class' => 'form-control item_type test',
                                                                            'alt' => 'address0',
                                                                            'type' =>'hidden',
                                                                            'value' => $data['RequestStock']['po'],
                                                                            'label' => false));
                                                                    ?>  
                                                                     <?php 
                                                                        echo $this->Form->input('id', array('class' => 'form-control item_type',
                                                                            'alt' => 'address2',
                                                                            'value' => $data['RequestStock']['id'],
                                                                            'type' =>'hidden',
                                                                            'label' => false));
                                                                    ?>  
                                                              <div class="form-group">
                                                                    <div class="col-lg-3">
                                                                    <span style="color:red">*</span>
                                                                    Description</div>
                                                                    <div class="col-lg-8">
                                                                        <?php 
                                                                            echo $this->Form->textarea('description', array('class' => 'form-control item_type required',
                                                                                'alt' => 'address1',
                                                                                'value' => $data['RequestStock']['description'],
                                                                                'label' => false));
                                                                        ?>
                                                                      
                                                                    </div>
                                                                </div>

                                                          <div class="col-lg-11" >
                                                            <hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
                                                            </div>
                                                                <div class="form-group">
                                                                    <div class="col-lg-3">
                                                                        <button type="submit" class="btn btn-success pull-right">Submit Request</button>
                                                                    </div>
                                                                    <div class="col-lg-8">
                                                                        <?php 
                                                                            echo $this->Html->link('Cancel', array('controller' => 'request_stocks', 'action' => 'index'),array('class' =>'btn btn-primary','escape' => false));
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
                            </div>
                        </div>
                            </div>
                                </div>
                            </div>
    <?php echo $this->Form->end(); ?>
       <script>
                $("#RequestStocksAddForm").validate();
                </script>

    <?php echo $this->Html->script('WareHouse.posupplier')?>