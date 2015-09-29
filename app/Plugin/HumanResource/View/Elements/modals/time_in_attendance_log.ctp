<div class="modal fade" id="timeKeepAttendance" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"> Pressence Record </h4>
                </div>
                <div class="modal-body">
                 <?php echo $this->Form->create('Attendance',array('url'=>(array('controller' => 'attendances','action' => 'add')),'class' => 'form-horizontal','id' => 'updateTimeForm'));?>
                       
                        <div class="clearfix"></div>

                        <div id="result_container_append"></div>
                        
                        <div class="modal-footer">
                             <button type="submit" class="btn btn-primary"><i class="fa fa-clock-o"></i> Log Time </button>
                             <button type="button" class="btn btn-default close-modal" data-dismiss="modal"> <i class="fa fa-times"></i> Close </button>
                        </div>
                   
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
</div>