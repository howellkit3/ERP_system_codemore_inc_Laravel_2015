<?php echo $this->Form->create('Employee',array('url'=>(array('controller' => 'employees','action' => 'edit_contract')),'class' => 'form-horizontal'));?>
<?php echo $this->Form->input('id'); ?>
        <div class="form-group">
            <label for="inputEmail1" class="col-lg-3 control-label"> Code </label>
                
            <div class="col-lg-6">
                    <?php echo !empty($this->request->data['Employee']['code']) ? $this->request->data['Employee']['code'] : ''; ?>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail1" class="col-lg-3 control-label"> Name </label>
                
            <div class="col-lg-6">
                    <?php echo !empty($this->request->data['Employee']['full_name']) ? $this->request->data['Employee']['full_name'] : ''; ?>
            </div>
        </div>
        <div class="form-group">
        <label for="inputEmail1" class="col-lg-3 control-label"><span style="color:red">*</span> Contract</label>
        <div class="col-lg-9">
            
            <?php echo $this->Form->input('contract_id',
                     array('class' => 'form-control required',
                    'options' => $contractList,
                    'placeholder' => 'Department name',
                    'empty' => 'Select Contract',
                    'default' => !empty($this->request->data['Employee']['contract_id']) ? $this->request->data['Employee']['contract_id'] : '',
                    'div' => 'col-lg-8',
                    'label' => false));
            ?>

        </div>
        </div>
         <div class="form-group">
            <label for="inputEmail1" class="col-lg-3 control-label"> <span style="color:red">*</span> Date Hired </label>
                
            <div class="col-lg-6">
            <?php echo $this->Form->input('date_hired',array(
                        'type' => 'text',
                        'class' => 'datepicker form-control',
                        'value' => !empty($this->request->data['Employee']['date_hired']) ? date('Y-m-d',strtotime($this->request->data['Employee']['date_hired'] )): '',
                        'label' => false
             )); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail1" class="col-lg-3 control-label"> <span style="color:red">*</span> Date Resigned </label>
                
            <div class="col-lg-6">
            <?php echo $this->Form->input('date_resigned',array(
                        'type' => 'text',
                        'class' => 'datepicker form-control',
                        'value' => !empty($this->request->data['Employee']['date_resigned']) ? $this->request->data['Employee']['date_resigned'] : '',
                        'label' => false
             )); ?>
            </div>
        </div>
         <div class="form-group">
        <label for="inputEmail1" class="col-lg-3 control-label"><span style="color:red">*</span> Status</label>
        <div class="col-lg-9">
            
            <?php 
                
                $status = array($statusList);
                
                echo $this->Form->input('status',
                         array('class' => 'form-control required',
                        'options' => $status,
                        'placeholder' => 'Status name',
                        'empty' => 'Select Status',
                        'default' => !empty($this->request->data['Employee']['status']) ? date('Y-m-d',strtotime($this->request->data['Employee']['status'])) : '',
                        'div' => 'col-lg-8',
                        'label' => false));  
            ?>

        </div>
        </div>

        <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Submit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            
        </div> 

<?php echo $this->Form->end(); ?>

<script type="text/javascript">
    
    $('.datepicker').datepicker({
                        format: 'yyyy-mm-dd'
                        });
</script>