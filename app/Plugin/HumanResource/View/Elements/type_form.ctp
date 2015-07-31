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
                                    <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Type Name</label>
                                    <div class="col-lg-8">
                                    	<?php
                                            echo $this->Form->input('Type.id', array('class' => 'form-control col-lg-6 required','label' => false,'type' => 'hidden'));
                                        ?>
                                        <?php
                                            echo $this->Form->input('Type.name', array('class' => 'form-control col-lg-6 required','label' => false,'div' => 'col-lg-12'));
                                        ?>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span>Category</label>
                                    <div class="col-lg-8">
                                        <?php
                                            //echo $this->Form->input('Type.category_id', array('class' => 'form-control col-lg-6 required','label' => false));
                                        ?>
                                        <?php
                                                            
                                            $category = array($categoryList);

                                        ?>
                                        <?php echo $this->Form->input('Type.category_id',
                                                 array('class' => 'autocomplete required',
                                                'options' => $category,
                                                'placeholder' => 'Category name',
                                                'empty' => 'Select Category',
                                                'default' => !empty($this->request->data['Type']['category_id']) ? $employeeData['Type']['category_id'] : '',
                                                'div' => 'col-lg-11',
                                                'label' => false));

                                        ?>

                                    </div>
                                 </div>

                                 <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span>Description</label>
                                    <div class="col-lg-8">
                                        <?php
                                            echo $this->Form->input('Type.description', array('class' => 'form-control col-lg-6 required','label' => false,'div' => 'col-lg-12'));
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