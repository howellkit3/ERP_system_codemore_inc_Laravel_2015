    <div class="main-box-body clearfix">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <!-- <th><a href="#"><span>Statement of Account No.</span></a></th> -->
                            <th><a href="#"><span>Name</span></a></th>
                            <th><a href="#"><span>Actions</span></a></th>
                        </tr>
                    </thead>

                    <?php 
                        if(!empty($tools)){
                            foreach ($tools as $key => $tool): ?>
                                <tbody aria-relevant="all" aria-live="polite" role="alert">
                                    <tr class="text-left">
                                      
                                        <td class="employee">
                                            <?php echo $tool['Tool']['name'];  ?>
                                        </td>
                                      
                                        <td>
                                        <button class="btn btn-success tool_select" data-dismiss="modal" data-id="<?php echo $tool['Tool']['id'] ?>" > Select </button>
                                        </td>
                                    </tr>

                                </tbody>
                        <?php  endforeach;
                         } ?> 
                
                </table>
            </div>
       </div>