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
                                    <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Name</label>
                                    <div class="col-lg-8">
                                    	<?php
                                            echo $this->Form->input('LeaveType.id', array('class' => 'form-control col-lg-6 required','label' => false,'type' => 'hidden'));
                                        ?>
                                        <?php
                                            echo $this->Form->input('LeaveType.name', array('class' => 'form-control col-lg-6 required','label' => false));
                                        ?>
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span>Limit Hours</label>
                                    <div class="col-lg-8">
                                        <?php
                                           echo $this->Form->input('LeaveType.limit', array('class' => 'form-control col-lg-6 required number','label' => false));
                                        ?>
                                    </div>
                                </div> -->

                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>