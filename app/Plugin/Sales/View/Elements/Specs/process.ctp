<?php $plusCounter = $counter + 1; ?>
<input type="hidden" name="data[IdHolder][ProductSpecificationProcess][]" value="<?php echo $formatDataSpecs['ProductSpecificationProcess']['id'] ?>" class="form-control"  />
<input type="hidden" name="getMe" value="<?php echo $counter ?>" class="getMe form-control"  />
<div class="form-group">
    <div class="col-lg-2"><span class="pull-right" style="color:red">*</span></div>
    <div class="col-lg-8">
        <!-- <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-reorder"></i></span> -->
            
                <?php 
              
                    echo $this->Form->input('Specification.process', array(
                        'options' => array($processData),
                        'label' => false,
                        'style' => 'text-transform:capitalize',
                        'class' => 'form-control processMe editMe select-groupProcess"'.$counter.'"',
                        //'class' => 'form-control select-group editMe',
                        //'name' => $process,
                        'id' => 'Process'.$counter,
                        'disabled' => true,
                        'empty' => '--Select Process--',
                        'default' => 2
                    ));

                ?>
            </select>
        <!-- </div> -->
    </div>
</div>
<section class="dropItem">
    <div class="form-group">
        <div class="col-lg-2"></div>
        <div class="col-lg-4">
            <section class="check-itemMe check-itemProcess<?php echo $counter ;?>">
            </section>
        </div>
        <div class="col-lg-4">
            <div class="row span8 check-fieldsMe check-fields-sortProcess<?php echo $counter ;?> fieldGrid">

                <?php foreach ($formatDataSpecs['ProductSpecificationProcess']['ProcessHolder'] as $key => $processList) { 

                    $nameNoSpace = str_replace(' ', '-', $subProcess[$processList['ProductSpecificationProcessHolder']['sub_process_id']]);

                    //pr($processList);die;
                    ?>
                    <div class="removeMeNow well span2 tile appendField appendFieldProcess<?php echo $counter ;?>" id="field<?php echo $nameNoSpace.'Process'.$counter ;?>">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-reorder"></i>
                            </span>
                            <input type="text" name="<?php echo $plusCounter ;?>" value="<?php echo $subProcess[$processList['ProductSpecificationProcessHolder']['sub_process_id']] ?>" class="form-control" disabled="disabled" />
                            <input type="hidden" name="data[ProductSpecificationProcess][<?php echo $counter ;?>][]" value="<?php echo $processList['ProductSpecificationProcessHolder']['sub_process_id'].'-'.$processList['ProductSpecificationProcessHolder']['process_id'] ?>" class="form-control dragFieldsName" />
                            <input type="hidden" name="data[IdHolder][ProcessHolder][]" value="<?php echo $processList['ProductSpecificationProcessHolder']['id'] ?>" class="form-control" />
                        </div>
                        <div class="input-group xbtn">
                            <a href="#" data-field="<?php echo $nameNoSpace ?>" class="removeMe remove_sort_fieldProcess<?php echo $counter ;?> remove_sort_field pull-right editMeBtn" style="display:none;">
                                <i class="fa fa-times-circle fa-lg"></i>
                            </a>
                        </div>
                    </div>
                <?php }  ?>

            </div>
        </div>
    </div>
</section>

<script>

    jQuery(document).ready(function($){
        
        $(".grid").sortable({
            tolerance: 'pointer',
            revert: 'invalid',
            placeholder: 'span2 well placeholder tile',
            forceHelperSize: true
        });
        
    });

</script>