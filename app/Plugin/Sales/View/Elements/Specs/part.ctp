<?php $plusCounter = $counter + 1; ?>
<!-- <input type="hidden" value="<?php echo $formatDataSpecs['ProductSpecificationPart']['id'] ?>" class="form-control part_name<?php echo $plusCounter ;?> editMe" maxlenght="500" name="data[IdHolder][ProductSpecificationPart][<?php echo $counter ;?>][id]" /> -->

<div class="form-group">
    <label class="col-lg-2 control-label"><span style="color:red">*</span>Material</label>
    <div class="col-lg-6 materialName<?php echo $plusCounter ;?>" >
        <input type="text" value="<?php echo $formatDataSpecs['ProductSpecificationPart']['material'] ?>" class="required partnameMe form-control part_name<?php echo $plusCounter ;?> editMe" maxlenght="500" name="data[ProductSpecificationPart][<?php echo $counter ;?>][material]" disabled />
    </div>
    <div class="col-lg-3">
        <button type="button" data-toggle="modal" href="#myModal<?php echo $plusCounter ;?>" class="btn btn-primary edit-button<?php echo $plusCounter ;?> editMeBtn" style="display:none;">
        <i class="fa fa-pencil fa-lg"></i> Edit Material</button>
    </div>
</div>
<section class="parentSection allFieldPart<?php echo $plusCounter ;?>" >
    <div class="form-group">
        <label class="col-lg-2 control-label">Part</label>
        <div class="col-lg-3">
            <input type="text" value="<?php echo $formatDataSpecs['ProductSpecificationPart']['part'] ?>" class="form-control" name="data[ProductSpecificationPart][<?php echo $counter ;?>][part]" readonly />
        </div>
        <label class="col-lg-2 control-label"><span style="color:red">*</span>Rate</label>
        <div class="col-lg-3">
            <input type="number" value="<?php echo $formatDataSpecs['ProductSpecificationPart']['rate'] ?>" class="rateMe form-control rate<?php echo $plusCounter ;?> editMe" name="data[ProductSpecificationPart][<?php echo $counter ;?>][rate]" disabled />
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label"><span style="color:red">*</span>Size</label>
        <div class="col-lg-3">
            <input type="text" value="<?php echo $formatDataSpecs['ProductSpecificationPart']['size1'] ?>" class="form-control editMe" name="data[ProductSpecificationPart][<?php echo $counter ;?>][size1]" disabled/>
        </div>
        <label class="col-lg-1 control-label left-text">mm &emsp;&emsp; x</label>
        <div class="col-lg-3">
            <input type="number" value="<?php echo $formatDataSpecs['ProductSpecificationPart']['size2'] ?>" class="form-control editMe" name="data[ProductSpecificationPart][<?php echo $counter ;?>][size2]" disabled/>
        </div>
        <label class="col-lg-1 control-label left-text">mm</label>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label"><span style="color:red">*</span>Quantity</label>
        <div class="col-lg-2">
            <input type="number" value="<?php echo $formatDataSpecs['ProductSpecificationPart']['quantity'] ?>" class="allQuantity quantityMe form-control quantity<?php echo $plusCounter ;?>" name="data[ProductSpecificationPart][<?php echo $counter ;?>][quantity]" readonly />
        </div>
        <div class="col-lg-3">
           
            <?php 
                echo $this->Form->input('ProductSpecificationPart.quantity_unit_id', array(
                    'options' => array($unitData),
                    'label' => false,
                    'style' => 'text-transform:capitalize',
                    'class' => 'form-control dropUnit editMe',
                    'disabled' => true,
                    //'name' => $process,
                    //'id' => $dynamicId,
                    'name' => 'data[ProductSpecificationPart]['.$counter.'][quantity_unit_id]',
                    'empty' => '--Select Unit--',
                    'default' => $formatDataSpecs['ProductSpecificationPart']['quantity_unit_id']
                ));

            ?>
        </div>
        <label class="col-lg-1 control-label"><span style="color:red">*</span>Paper Qty</label>
        <div class="col-lg-2">
            <input type="text" value="<?php echo $formatDataSpecs['ProductSpecificationPart']['paper_quantity'] ?>" class="allPaperQuantity paper_qtyMe form-control paper_qty<?php echo $plusCounter ;?>" name="data[ProductSpecificationPart][<?php echo $counter ;?>][paper_quantity]" readonly />
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label"><span style="color:red">*</span>Color</label>
        <div class="col-lg-4">
            <input type="text" value="<?php echo $formatDataSpecs['ProductSpecificationPart']['color'] ?>" class="form-control editMe" name="data[ProductSpecificationPart][<?php echo $counter ;?>][color]" disabled/>
        </div>
        <label class="col-lg-1 control-label">Allowance</label>
        <div class="col-lg-3">
            <input type="text" value="<?php echo $formatDataSpecs['ProductSpecificationPart']['allowance'] ?>" class="editMe form-control allowance<?php echo $plusCounter ;?>" name="data[ProductSpecificationPart][<?php echo $counter ;?>][allowance]" disabled/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label"><span style="color:red">*</span>Outs</label>
        <div class="col-lg-2">
            <input type="number" value="<?php echo $formatDataSpecs['ProductSpecificationPart']['outs1'] ?>" class="outsMe form-control number outs<?php echo $plusCounter ;?> editMe" name="data[ProductSpecificationPart][<?php echo $counter ;?>][outs1]" disabled/>
        </div>
        <label class="col-lg-1 control-label">x</label>
        <div class="col-lg-2">
            <input type="number" value="<?php echo $formatDataSpecs['ProductSpecificationPart']['outs2'] ?>" class="outs_1Me form-control outs_1<?php echo $plusCounter ;?> editMe" name="data[ProductSpecificationPart][<?php echo $counter ;?>][outs2]" disabled/>
        </div>
    </div>
</section>
<div class="modal fade" id="myModal<?php echo $plusCounter ;?>" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog specModal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Material</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-reorder"></i></span>
                            <select name="data[Specification][itemgroupName][<?php echo $counter ;?>]" class="groupMe form-control select-group productItemGroup" id="ItemGroup<?php echo $counter ;?>">
                                <option value="0">--Select Item Group--</option>
                                <option value="1">General Items</option>
                                <option value="2">Substrates</option>
                                <option value="3">Compound Substrates</option>
                                <option value="4">Corrugated Papers</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <section class="scrollsection">
                    <header class="main-box-header clearfix">
                        <h1 class="pull-left">Product List</h1>
                        <div class="filter-block pull-right">
                            <div class="form-group">

                                <input placeholder="Search..." id="product_searchItemGroup<?php echo $counter ;?>" name="product_name" class="searchProductMe form-control searchProduct" type="search" disabled="disabled" />
                                <i class="fa fa-search search-icon"></i>
                             
                            </div>  
                        </div>
                    </header>
                    <input type="hidden" class="current_page" />
                    <input type="hidden" class="show_per_page" />
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><a href="#"><span>Select</span></a></th>
                                <th style="width:200px;"><a href="#"><span>Item Number</span></a></th>
                                <th><a href="#"><span>Name</span></a></th>
                            </tr>
                        </thead>
                        <tbody class="tableProductMe tableProductItemGroup<?php echo $counter ;?>" aria-relevant="all" id="scrollTable" aria-live="polite" role="alert" >
                        </tbody>
                    </table>
                </section>
                <section id="productTableInModalItemGroup<?php echo $counter ;?>" style="display:none;">
                    <div class="table-responsive">
                        <header class="main-box-header clearfix">
                            <h1 class="pull-left">Product List</h1>
                            <div class="filter-block pull-right">
                                <div class="form-group pull-left">

                                </div>
                            </div>
                        </header>
                    </div>
                </section>
                <div class="form-group">
                    <div class="col-lg-10"></div>
                    <div class="col-lg-2">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
