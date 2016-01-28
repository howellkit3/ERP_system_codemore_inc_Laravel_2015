  <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><a href="#"><span>Supplier</span></a></th>
                                <th><a href="#"><span>Website</span></a></th>
                                <th><a href="#"><span>Tin</span></a></th>
                                <th class="text-center"><a href="#"><span>Contact Person</span></a></th>
                                <th class="text-center"><a href="#"><span>Created</span></a></th>
                                <th>Action</th>
                            </tr>
                        </thead>

                         <tbody aria-relevant="all" aria-live="polite" class="supplierFields" role="alert" >
      
<?php if (!empty($suppliers)) : ?>                    
<?php foreach ($suppliers  as $key => $list) { ?>
	<tr>
		<td>
			<?php echo $list['Supplier']['name'] ?>
		</td>
		<td>
			<?php echo $list['Supplier']['website'] ?>
		</td>
		<td>
			<?php echo $list['Supplier']['tin'] ?>
		</td>
		<td class="text-center">
			<?php 
                if(!empty($list['SupplierContactPerson'])) { 
                    
                    echo ucfirst($list['SupplierContactPerson'][0]['firstname']);  
                    echo '&nbsp';
                    echo ucfirst($list['SupplierContactPerson'][0]['middlename']); 
                    echo '&nbsp';
                    echo ucfirst($list['SupplierContactPerson'][0]['lastname']); 
                } 
            ?>
		</td>
		<td class="text-center">
			 <?php echo date('M d, Y', strtotime($list['Supplier']['created'])); ?>
		</td>
		<td class="">
		 <?php
                echo $this->Html->link('<span class="fa-stack">
	                    <i class="fa fa-square fa-stack-2x"></i>
	                    <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
	                    </span> ',
                    array('controller' => 'suppliers',
                    	'action' => 'view',
                    	$list['Supplier']['id'],'plugin' => 'purchasing'),
                    array('class' =>' table-link',
                    	'escape' => false
                    	,'title'=>'View Information'));
            ?>
            <?php
                echo $this->Html->link('<span class="fa-stack">
		                <i class="fa fa-square fa-stack-2x"></i>
		                <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
		                </span> ',
	                 array('controller' => 'suppliers',
	                  	'action' => 'edit',
	                 	 $list['Supplier']['id'],'plugin' => 'purchasing'),
	                 array('class' =>' table-link',
	                 	'escape' => false,
	                 	'title'=>'Edit Information'));
            ?>
            <?php
                // echo $this->Html->link('<span class="fa-stack">
		              //   <i class="fa fa-square fa-stack-2x"></i>
		              //   <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
		              //   </span>', 
		              //   array('controller' => 'suppliers', 
		              //   	'action' => 'delete',
		              //   	$list['Supplier']['id']),
	               //  	array('class' =>' table-link',
	               //  		'escape' => false,
	               //  		'list'=>'Delete Information',
	               //  		'confirm' => 'Do you want to delete Customer?'));
            ?>
        </td>
	</tr>
<?php  } ?>

<?php else : ?>
	<tr>
	<td colspan="6">	<span style="color:red"> No Result </span> </td>
	
	</tr>
<?php endif; ?>
 </tbody>
                        <tbody aria-relevant="all" aria-live="polite" class="searchAppend" role="alert" >
                        </tbody>

                        
                            
                     </table>
                    <hr>
                </div>

    <ul class="pagination pull-right">
            <?php 
             echo $this->Paginator->prev('< ' . __('previous'), array('before' => 'a','tag' => 'li','currentClass' => 'current-link'), null, array('class' => 'prev disabled'));
             echo $this->Paginator->numbers(array('separator' => '','tag' => 'li'));
             echo $this->Paginator->next(__('next') . ' >', array('tag' => 'li','currentClass' => 'current-link'), null, array('class' => 'next disabled')); ?>
       
      </ul>


      <script type="text/javascript">
      $(function(){

      	$current = $('.current').text();
      	$('.current').html('<a href="#">'+$current +'</a>');
      		$disabled = $('.disabled').text();
      	$('.disabled').html('<a href="#">'+$disabled +'</a>');
      });
      </script>