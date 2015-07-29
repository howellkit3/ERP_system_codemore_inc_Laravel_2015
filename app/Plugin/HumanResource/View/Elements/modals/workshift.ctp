<!-- Standard Bootstrap Modal -->
    <div class="modal fade" id="BreakTimeModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog breaktime">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"> Select Breaktime </h4>
                </div>
                <div class="modal-body">
           

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

                        <div class="clearfix"></div>

                     <div class="modal-footer">
                            <button class="btn btn-success  submit_breaktime" data-dismiss="modal">Submit</button>
                            &nbsp 
                           <button class="btn btn-default " data-dismiss="modal">Cancel</button>
                            
                 </div>
                </div>
               

                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->  

