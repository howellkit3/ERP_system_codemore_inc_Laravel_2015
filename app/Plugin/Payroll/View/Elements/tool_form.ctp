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
                                    <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Tool Name</label>
                                    <div class="col-lg-8">
                                    	<?php
                                            echo $this->Form->input('Tool.id', array('class' => 'form-control col-lg-6 required','label' => false,'type' => 'hidden'));
                                        ?>
                                        <?php
                                            echo $this->Form->input('Tool.name', array('class' => 'form-control col-lg-6 required','label' => false));
                                        ?>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span>Brand</label>
                                    <div class="col-lg-8">
                                        <?php
                                            echo $this->Form->input('Tool.brand', array('class' => 'form-control col-lg-6 required','label' => false));
                                        ?>
                                    </div>
                                 </div>

                                 <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span>Type</label>
                                    <div class="col-lg-8">
                                        <?php
                                            echo $this->Form->input('Tool.type', array('class' => 'form-control col-lg-6 required','label' => false));
                                        ?>
                                    </div>
                                 </div>

                                 <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span>Quantity</label>
                                    <div class="col-lg-8">
                                        <?php
                                            echo $this->Form->input('Tool.quantity', array('class' => 'form-control col-lg-6 required','label' => false));
                                        ?>
                                    </div>
                                 </div>

                                 <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span>Status</label>
                                    <div class="col-lg-8">
                                        <?php
                                            echo $this->Form->input('Tool.status', array('class' => 'form-control col-lg-6 required','label' => false));
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