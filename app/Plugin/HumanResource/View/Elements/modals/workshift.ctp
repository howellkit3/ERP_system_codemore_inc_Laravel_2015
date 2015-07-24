<!-- Standard Bootstrap Modal -->
    <div class="modal fade" id="BreakTimeModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog breaktime">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"> Select Breaktime </h4>
                </div>
                <div class="modal-body">
                 <?php echo $this->Form->create('Breaktime',array('url'=>(array('controller' => 'breaktimes','action' => 'find')),'class' => 'form-horizontal','id' => 'breaktimeForm'));?>
                        <div class="form-group">
                          
                            <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label"> BreakTime </label>
                            
                            <div class="col-lg-6">
                                <?php 
                                    echo $this->Form->input('Tools.Name', array('class' => 'form-control item_type',
                                        'alt' => 'Employee name',
                                        'placeholder' => 'Item Name',
                                        'label' => false));
                                ?>
                            </div>
                             <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                        </div>
                        </div>

                        <div id="result_container">
                                
                                    <div class="breaktime_cont">
                                        <ul>
                                        <?php foreach ($breaktimes as $key => $time) : ?>

                                            <li class="parent_li">
                                            <div class="col-lg-3">
                                                <input type="checkbox" class="breaktime-checkbox" value="<?php echo $time['BreakTime']['id']?>" data="name['BreakTime']['selected_id']" >
                                                <span class="break_name">
                                                <?php echo $time['BreakTime']['name']; ?></span>
                                            </div>
                                            <div class="col-lg-9 time">
                                            <?php echo date('H:i: a',strtotime($time['BreakTime']['from'])); ?> - <?php echo date('H:i: a',strtotime($time['BreakTime']['to'])); ?> 
                                            </div>
                                        </li>        
                                        <?php endforeach; ?>
                                       </ul>
                                    </div>

                        </div>

                        <hr>
                        <div class="clearfix"></div>
                        <div class="right-dev">
                                 <div class="col-xs-2 col-md-2 2">
                                    <?php 
                                        // echo $this->Form->submit('Submit', array('class' => 'btn btn-success pull-right',  'title' => 'Click here to add the customer'));
                                    ?>

                                    <button class="btn btn-success pull-right submit_breaktime" data-dismiss="modal">Submit</button>
                                  
                                </div>
                                <div class="col-xs-2 col-md-2 2">

                                 <button class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                                   
                                </div>
                        </div>
                         <div class="clearfix"></div>
                    </form>
                        
                </div>
                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->  

