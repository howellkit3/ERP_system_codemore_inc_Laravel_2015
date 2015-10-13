<!-- Standard Bootstrap Modal -->
 <div class="modal fade" id="myModalItem" role="dialog" data-item="" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                        <select  class="form-control select-group ItemGroup" >
                                            <option value="0">--Select Item Group--</option>
                                            <option value="1">General Items</option>
                                            <option value="2">Substrates</option>
                                            <option value="3">Compound Substrates</option>
                                            <option value="4">Corrugated Papers</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <header class="main-box-header clearfix">
                                <h1 class="pull-left">Item List</h1>
                                <div class="filter-block pull-right">
                                    <div class="form-group">

                                        <input placeholder="Search..."  class="form-control searchItem" type="search" disabled="disabled" />
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
                                <tbody class="tableProduct" aria-relevant="all" id="scrollTable" aria-live="polite" role="alert" >
                                </tbody>

                                <tbody class="Itemtable" aria-relevant="all" id="scrollTable" aria-live="polite" role="alert" >
                                </tbody>

                                
                            </table>

                            <div class="table-responsive">
                                <header class="main-box-header clearfix">
                                    <h1 class="pull-left">Item List</h1>
                                    <div class="filter-block pull-right">
                                        <div class="form-group pull-left">

                                        </div>
                                    </div>
                                </header>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-10"></div>
                                <div class="col-lg-2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md-overlay"></div>  