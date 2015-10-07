
 <div class="modal fade" id="Camera" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   
        
    <div class="modal-dialog" style="width:755px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Take A Picture</h4>
            </div>
            <div class="modal-body" >
            	<div id="result-table" style="width:100% !important">


    	  <form action="<?php echo $this->Html->url('/') ?>human_resource/employees/saveImage" id="submitImage" enctype="multipart/form-data" method="POST">
    	  	
                <table width="100%" class="TF">

                    <tr><td rowspan="9"><table cellpadding="3"><tr><td><p id="status" style="height:12px; color:#c00;font-weight:bold;"></p><div id="webcam">
                </div>
                <p style="width:250px;text-align:center; ">
                    <a href="#" class="btn btn-success" onclick="webcam.capture(3);void(0);" >Take Photo </a>
                     <input type="hidden" name="save_image" id="saveImage"/>
                             <input type="hidden" name="employeeId" value="<?php echo !empty($this->request->data['Employee']['id']) ? $this->request->data['Employee']['id'] : '' ?>"/>
                           
                    <button class="btn btn-success" type="submit" > SAVE </button>

                </p></td><td><p><canvas id="canvas" height="240" width="320"></canvas></p></td></tr></table></td></tr>
                           <tr><td></td><td>
                           
                            
                        </td></tr>           
                </table>


     </form>

            			
            	</div>
			</div>
            
        </div>

    </div>
</div>
