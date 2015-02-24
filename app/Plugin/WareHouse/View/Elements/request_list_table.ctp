<tbody>
<?php foreach ($resquestList  as $key => $list) { ?>
	<tr>
		<td>
			<?php echo $list['RequestStock']['description'] ?>
		</td>
		<td>
			<?php echo $list['RequestStock']['po'] ?>
		</td>
	
		<td class="text-center">
			 <?php echo date('M d, Y', strtotime($list['RequestStock']['created'])); ?>
		</td>
		<td  class="text-center">
		 <?php
                // echo $this->Html->link('<span class="fa-stack">
	               //      <i class="fa fa-square fa-stack-2x"></i>
	               //      <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
	               //      </span> ',
                //     array('controller' => 'ware_house',
                //     	'action' => 'view',
                //     	),
                //     array('class' =>' table-link',
                //     	'escape' => false
                //     	,'title'=>'View Information'));
            ?>
            <?php
                echo $this->Html->link('<span class="fa-stack">
		                <i class="fa fa-square fa-stack-2x"></i>
		                <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
		                </span> ',
	                 array('controller' => 'request_stocks',
	                  	'action' => 'edit',$list['RequestStock']['id']
	                 	),
	                 array('class' =>' table-link',
	                 	'escape' => false,
	                 	'title'=>'Edit Information'));
            ?>
            <?php
                echo $this->Html->link('<span class="fa-stack">
		                <i class="fa fa-square fa-stack-2x"></i>
		                <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
		                </span>', 
		                array('controller' => 'request_stocks', 
		                	'action' => 'delete',$list['RequestStock']['id']
		                	),
	                	array('class' =>' table-link',
	                		'escape' => false,
	                		'list'=>'Delete Information',
	                		'confirm' => 'Do you want to delete Request Stock?'));
            ?>
        </td>
	</tr>
<?php  } ?>
</tbody>