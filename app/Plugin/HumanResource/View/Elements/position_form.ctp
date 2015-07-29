<?php $employeeData = !empty($this->request->data) ? $this->request->data : ''; ?>
 <div class="row">
    <div class="col-lg-12">
        <div class="main-box">
           <!--  <h1>Personal Info</h1> -->
            <div class="top-space"></div>
            <div class="main-box-body clearfix">
                <div class="main-box-body clearfix">
                    <div class="form-horizontal">
                        <div class="form-group">
                        	<div class="col-lg-12">
                         		<div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Position Name</label>
                                    <div class="col-lg-8">
                                    	<?php
                                            echo $this->Form->input('Position.id', array('class' => 'form-control col-lg-6 required','label' => false,'type' => 'hidden'));
                                        ?>
                                        <?php
                                            echo $this->Form->input('Position.name', array('class' => 'form-control col-lg-6 required','label' => false));
                                        ?>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span>Description</label>
                                    <div class="col-lg-8">
                                        <?php
                                            echo $this->Form->input('Position.description', array('class' => 'form-control col-lg-6 required','label' => false));
                                        ?>
                                    </div>
                                 </div>

                                 <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Specification</label>
                                        <div class="col-lg-8">
                                            <?php
                                                echo $this->Form->input('Position.specification', array('class' => 'form-control col-lg-6 required','label' => false));
                                            ?>
                                        </div>
                                 </div>

                                  <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label"> Notes</label>
                                        <div class="col-lg-8">
                                            <?php
                                                echo $this->Form->input('Position.notes', array('class' => 'form-control col-lg-6','label' => false));
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