<li class="ui-state-default">
  <section class="dragField">
      <header class="main-box-header dragHeader clearfix">
          <h2 class="pull-left">Component</h2>
          <!-- <a href="#" class="remove_field pull-right">
              <i class="fa fa-times-circle fa-fw fa-lg"></i>
          </a> -->
      </header>
      <div class="form-group">
          <div class="col-lg-2"></div>
          <div class="col-lg-8">
              <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-reorder"></i></span>
                  <input name="data[ProductSpecificationComponent][0][name]" class="required form-control label1" type="text">
                  <div class="top-pad"></div>
              </div>
          </div>
      </div>
  </section>
  <input type="hidden" name="data[ProductSpecificationDetail][]" value="Component">
</li>


<li class="ui-state-default">
    <section class="dragField">
        <header class="main-box-header dragHeader clearfix">
            <h2 class="pull-left">Part</h2>
            <!-- <a href="#" class="remove_part pull-right">
                <i class="fa fa-times-circle fa-fw fa-lg"></i>
            </a> -->
        </header>
        <div class="form-group">
            <label class="col-lg-2 control-label">Material</label>
            <div class="col-lg-6 materialName1" style="display:none;">
                <input type="text" class="form-control part_name1" maxlenght="500" name="data[ProductSpecificationPart][0][material]" readonly />
            </div>
            <div class="col-lg-3">
                <button type="button" data-toggle="modal" href="#myModal1" class="btn btn-primary edit-button1">
                <i class="fa fa-plus-circle fa-lg"></i> Select Material</button>
            </div>
        </div>
        <section class="allFieldPart1" style="display:none;">
            <div class="form-group">
                <label class="col-lg-2 control-label">Part</label>
                <div class="col-lg-3">
                    <input type="text" value="1" class="form-control" name="data[ProductSpecificationPart][0][part]" readonly />
                </div>
                <label class="col-lg-2 control-label">Rate</label>
                <div class="col-lg-3">
                    <input type="number" value="1" class="form-control rate1" name="data[ProductSpecificationPart][0][rate]" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">Size</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control" name="data[ProductSpecificationPart][0][size1]" />
                </div>
                <label class="col-lg-1 control-label left-text">mm &emsp;&emsp; x</label>
                <div class="col-lg-3">
                    <input type="number" class="form-control" name="data[ProductSpecificationPart][0][size2]" />
                </div>
                <label class="col-lg-1 control-label left-text">mm</label>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">Quantity</label>
                <div class="col-lg-2">
                    <input type="number" value="" class="form-control quantity1" name="data[ProductSpecificationPart][0][quantity]" readonly />
                </div>
                <div class="col-lg-3">
                    <?php 
                        echo $this->Form->input('ProductSpecificationPart.quantity_unit_id', array(
                            'options' => array($unitData),
                            'label' => false,
                            'style' => 'text-transform:capitalize',
                            'class' => 'form-control dropUnit',
                            //'name' => $process,
                            //'id' => $dynamicId,
                            'name' => 'data[ProductSpecificationPart][0][quantity_unit_id]',
                            'empty' => '--Select Unit--'
                        ));

                    ?>
                </div>
                <label class="col-lg-1 control-label">Paper Qty</label>
                <div class="col-lg-2">
                    <input type="text" value="" class="form-control paper_qty1" name="data[ProductSpecificationPart][0][paper_quantity]" readonly />
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">Color</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="data[ProductSpecificationPart][0][color]" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">Outs</label>
                <div class="col-lg-2">
                    <input type="number" value="1" class="form-control number outs1" name="data[ProductSpecificationPart][0][outs1]"/>
                </div>
                <label class="col-lg-1 control-label">x</label>
                <div class="col-lg-2">
                    <input type="number" value="1" class="form-control outs_11" name="data[ProductSpecificationPart][0][outs2]" />
                </div>
            </div>
        </section>
        <div class="modal fade" id="myModal1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    <select name="data[Specification][itemgroupName][0]" class="form-control select-group productItemGroup" id="ItemGroup0">
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

                                        <input placeholder="Search..." id="product_searchItemGroup0" name="product_name" class="form-control searchProduct" type="search" disabled="disabled" />
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
                                <tbody class="tableProductItemGroup0" aria-relevant="all" id="scrollTable" aria-live="polite" role="alert" >
                                </tbody>
                            </table>
                        </section>
                        <section id="productTableInModalItemGroup0" style="display:none;">
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
    <input type="hidden" name="data[ProductSpecificationDetail][]" value="Part">
</li>


<li class="ui-state-default">
    <section class="dragField">
        <header class="main-box-header dragHeader clearfix">
            <h2 class="pull-left">Process</h2>
            <!-- <a href="#" class="remove_process pull-right">
                <i class="fa fa-times-circle fa-fw fa-lg"></i>
            </a> -->
        </header>
        <div class="form-group">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-reorder"></i></span>
                        <?php 
                            echo $this->Form->input('Specification.process', array(
                                'options' => array($processData),
                                'label' => false,
                                'style' => 'text-transform:capitalize',
                                'class' => 'form-control processMe select-group',
                                //'name' => $process,
                                'id' => 'Process0',
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
                    <section class="check-itemProcess0">
                    </section>
                </div>
                <div class="col-lg-4">
                    <div class="row grid span8 check-fields-sortProcess0">
                    </div>
                </div>
            </div>
        </section>
    </section>
    <input type="hidden" name="data[ProductSpecificationDetail][]" value="Process">
</li>
