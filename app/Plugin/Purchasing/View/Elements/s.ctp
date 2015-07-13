<tbody>
<?php foreach ($requestData  as $key => $list) { ?>
	<tr>
		<td>
			<?php echo $list['Request']['uuid'] ?>
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
</tbody>