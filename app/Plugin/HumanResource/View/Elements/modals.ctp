<!-- Standard Bootstrap Modal -->
    <div class="modal fade" id="EmployeeModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"> Select  Employee </h4>
                </div>
                <div class="modal-body">
                 <?php echo $this->Form->create('Employee',array('url'=>(array('controller' => 'employees','action' => 'find')),'class' => 'form-horizontal'));?>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label"> Position</label>
                            <div class="col-lg-3">
                                <?php 
                                $department = array(
                                    '0' => 'All',  
                                    '1' => 'Accounting',
                                    '2' => 'Sales',
                                    '3' => 'Delivery');

                                    echo $this->Form->input('Employee.Position', array(
                                        'options' =>   $department,
                                        'alt' => 'type',
                                        'label' => false,
                                        'class' => 'form-control col-lg-4',
                                        'data-name' => 'Address'
                                    ));
                                ?>
                            </div>
                            <div class="col-lg-6">
                                <?php 
                                    echo $this->Form->input('Employee.Name', array('class' => 'form-control item_type',
                                        'alt' => 'Employee name',
                                        'placeholder' => 'Employee name',
                                        'label' => false));
                                ?>
                            </div>
                        </div>

                        <div id="result_container"></div>
                        <div class="modal-footer">
                             <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                        </div>

                        
                    </form>
                        
                </div>
                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->  

    <!-- Standard Bootstrap Modal -->
    <div class="modal fade" id="ToolsModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"> Select Tools </h4>
                </div>
                <div class="modal-body">
                 <?php echo $this->Form->create('Tools',array('url'=>(array('controller' => 'tools','action' => 'find')),'class' => 'form-horizontal'));?>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label"> Tools</label>
                            
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

                        <div id="result_container">
                            <?php if (!empty($tools)) : ?>

                             <div class="main-box-body clearfix">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <!-- <th><a href="#"><span>Statement of Account No.</span></a></th> -->
                                                    <th><a href="#"><span>Name</span></a></th>
                                                    <th><a href="#"><span>Actions</span></a></th>
                                                </tr>
                                            </thead>

                                            <?php 
                                                if(!empty($tools)){
                                                    foreach ($tools as $key => $tool): ?>
                                                        <tbody aria-relevant="all" aria-live="polite" role="alert">
                                                            <tr class="text-left">
                                                              
                                                                <td class="employee">
                                                                    <?php echo $tool['Tool']['name'];  ?>
                                                                </td>
                                                              
                                                                <td>
                                                                <button class="btn btn-success tool_select" data-dismiss="modal" data-id="<?php echo $tool['Tool']['id'] ?>" > Select </button>
                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                <?php  endforeach;
                                                 } ?> 
                                        
                                        </table>
                                    </div>
                                </div>    

                                <hr>
 
    <div class="paging text-left" id="item_type_pagination">
            <?php
           
            echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'Employee','model' => 'Employee'), null, array('class' => 'disable','model' => 'ClientOrder'));
            echo $this->Paginator->numbers(array('separator' => '','paginate' => 'Employee'), array('paginate' => 'Employee'));
            echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'Employee','model' => 'Employee'), null, array('class' => 'disable'));

            ?>
    </div>
                            <?php endif; ?>    
                        </div>
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                        </div>

                        
                    </form>
                        
                </div>
                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->  

     <div class="modal fade" id="myEmployeeReport" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"> Select Department </h4>
                </div>
                <div class="modal-body">
                 <?php echo $this->Form->create('Employee',array('url'=>(array('controller' => 'employees','action' => 'print_employee')),'class' => 'form-horizontal'));?>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label"> Department</label>
                            
                            <div class="col-lg-6">
                                <?php 
                                       echo $this->Form->input('Department.department_id', array(
                                                                    'type' => 'select',
                                                                    'label' => false,
                                                                    'class' => 'form-control required',
                                                                    'empty' => '---Select Department---',
                                                                    'options' => array($departmentData)

                                                                  ));
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label"> Department</label>

                           <div class="col-lg-6">
                                <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        <input  placeholder="Date Range" name="from_date" data="1" type="text" class="form-control required myDateRange datepickerDateRange high-z-index" id="datepickerDateRange" >
                                                    </div>
                            </div>

                           
                        </div>

                        <div class="modal-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-share-square-o fa-lg"></i> Export</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                        </div>  
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .datepicker-hide .ui-datepicker-year
    {
        display:none;   
    }

    .datepickerDateRange{

        z-index: 10000;
    }

    .daterangepicker { z-index: 999999;!important}
</style>
<script>
    
jQuery(document).ready(function($){
       //datepicker

       $("#EmployeeIndexForm").validate();
        // $('.datepick').datepicker({
            
        //     changeYear: false,
        //     autoClose: true
        // });

        // $("#HolidayDate").click(function() {
        //     $(".datepicker-days .day").click(function() {
        //         $('.datepicker').hide();
        //     });
        // });

        $('.datepickerDateRange').daterangepicker();
});

 </script>