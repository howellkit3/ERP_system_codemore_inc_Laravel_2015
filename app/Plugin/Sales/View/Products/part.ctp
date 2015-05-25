<li class="ui-state-default">
    <section class="dragField">
        <header class="main-box-header dragHeader clearfix">
            <h2 class="pull-left">Part</h2>
            <a href="#" class="remove_part pull-right">
                <i class="fa fa-times-circle fa-fw fa-lg"></i>
            </a>
        </header>
        <div class="form-group">
            <label class="col-lg-2 control-label">Material</label>
            <div class="col-lg-6 materialName<?php echo $varCounter ;?>" style="display:none;">
                <input type="text" class="form-control part_name<?php echo $varCounter ;?>" name="material_name" readonly />
            </div>
            <div class="col-lg-3">
                <button type="button" data-toggle="modal" href="#myModal<?php echo $varCounter ;?>" class="btn btn-primary edit-button<?php echo $varCounter ;?>">
                <i class="fa fa-plus-circle fa-lg"></i> Select Material</button>
            </div>
        </div>
        <section class="allFieldPart<?php echo $varCounter ;?>" style="display:none;">
            <div class="form-group">
                <label class="col-lg-2 control-label">Part</label>
                <div class="col-lg-3">
                    <input type="text" value="<?php echo $varCounter ;?>" class="form-control" name="part<?php echo $varCounter ;?>" readonly />
                </div>
                <label class="col-lg-2 control-label">Rate</label>
                <div class="col-lg-3">
                    <input type="number" value="<?php echo $varCounter ;?>" class="form-control rate<?php echo $varCounter ;?>" name="rate<?php echo $varCounter ;?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">Size</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control" name="size<?php echo $varCounter ;?>" />
                </div>
                <label class="col-lg-1 control-label left-text">mm &emsp;&emsp; x</label>
                <div class="col-lg-3">
                    <input type="number" class="form-control" name="size_1<?php echo $varCounter ;?>" />
                </div>
                <label class="col-lg-1 control-label left-text">mm</label>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">Quantity</label>
                <div class="col-lg-2">
                    <input type="number" value="<?php echo $quantitySpec ;?>" class="form-control quantity<?php echo $varCounter ;?>" name="quantity<?php echo $varCounter ;?>" readonly />
                </div>
                <div class="col-lg-3">
                    <select class="form-control dropUnit" name="quantity_unit<?php echo $varCounter ;?>" />
                        <option value=""></option>
                    </select>
                </div>
                <label class="col-lg-1 control-label">Paper Qty</label>
                <div class="col-lg-2">
                    <input type="text" value="<?php echo $quantitySpec ;?>" class="form-control paper_qty<?php echo $varCounter ;?>" name="paper_qty<?php echo $varCounter ;?>" readonly />
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">Color</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="color<?php echo $varCounter ;?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">Outs</label>
                <div class="col-lg-2">
                    <input type="number" value="1" class="form-control number outs<?php echo $varCounter ;?>" name="outs<?php echo $varCounter ;?>"/>
                </div>
                <label class="col-lg-1 control-label">x</label>
                <div class="col-lg-2">
                    <input type="number" value="1" class="form-control outs_1<?php echo $varCounter ;?>" name="outs_1<?php echo $varCounter ;?>" />
                </div>
            </div>
        </section>
        <div class="modal fade" id="myModal<?php echo $varCounter ;?>" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog specModal">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Material</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-reorder"></i></span>
                                    <select name="<?php echo $itemgroupName ;?>" class="form-control select-group productItemGroup" id="<?php echo $dynamicId ;?>">
                                        <option value="0">--Select Item Group--</option>
                                        <option value="1">General Items</option>
                                        <option value="2">Substrates</option>
                                        <option value="3">Compound Substrates</option>
                                        <option value="4">Corrugated Papers</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <!-- <section class="dropItem">
                            <div class="form-group">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-7">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-reorder"></i></span>
                                        <select name="<?php echo $category ;?>" class="form-control selectProductcategory<?php echo $dynamicId ;?>">
                                            <option value="">--Select Category--</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-7">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-reorder"></i></span>
                                        <select name="<?php echo $item ;?>" class="form-control selectProductItem<?php echo $dynamicId ;?>">
                                            <option value="">--Select Item--</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </section> -->
                        <section class="scrollsection">
                            <header class="main-box-header clearfix">
                                <h1 class="pull-left">Product List</h1>
                                <div class="filter-block pull-right">
                                    <div class="form-group">

                                        <input placeholder="Search..." id="product_search<?php echo $dynamicId ;?>" name="product_name" class="form-control" type="search" />
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
                                        <th><a href="#"><span>Item Number</span></a></th>
                                        <th><a href="#"><span>Name</span></a></th>
                                    </tr>
                                </thead>
                                <tbody class="tableProduct<?php echo $dynamicId ;?>" aria-relevant="all" id="scrollTable" aria-live="polite" role="alert" >
                                </tbody>
                            </table>
                        </section>
                        <section id="productTableInModal<?php echo $dynamicId ;?>" style="display:none;">
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
    </section>
</li>