<li class="ui-state-default">
    <section class="dragField">
        <header class="main-box-header dragHeader clearfix">
            <h2 class="pull-left">Process</h2>
            <a href="#" class="remove_process pull-right">
                <i class="fa fa-times-circle fa-fw fa-lg"></i>
            </a>
        </header>
        <div class="form-group">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-reorder"></i></span>
                    <!-- <select name="<?php echo $process ;?>" class="form-control select-group<?php echo $dynamicId ;?>" id="<?php echo $dynamicId ;?>">
                        <option value="">--Select Process--</option> -->
                        <?php 
                            echo $this->Form->input('Specification.process', array(
                                'options' => array($processData),
                                'label' => false,
                                'style' => 'text-transform:capitalize',
                                'class' => 'required form-control processMe select-group"'.$dynamicId.'"',
                                //'name' => $process,
                                'id' => $dynamicId,
                                'empty' => '--Select Process--'
                            ));

                        ?>
                    </select>
                </div>
            </div>
        </div>
        <section class="dropItem">
            <div class="form-group">
                <div class="col-lg-2"></div>
                <div class="col-lg-4">
                    <section class="check-item<?php echo $dynamicId ;?>">
                    </section>
                </div>
                <div class="col-lg-4">
                    <div class="row grid span8 check-fields-sort<?php echo $dynamicId ;?>">
                    </div>
                </div>
            </div>
        </section>
    </section>
    <input type="hidden" name="data[ProductSpecificationDetail][]" value="Process">
</li>
