<?php 
if(!empty($employeeData)){
foreach ($employeeData as $key => $employee): ?>
		<tr class="">
			<td class="">
			<?php
			$style = '';
				$serverPath = $this->Html->url('/',true);	
			if (!empty($employee['Employee']['image'])) {

		
			$background =  $serverPath.'img/uploads/employee/'.$employee['Employee']['image'].'?d='.rand(0,1000).time();	
			} else {

				$background =  $serverPath.'img/default-profile.png';	
			}

			?>
				<img src="<?php echo $background; ?>" width="35" height="35" />
            </td>

			<td class="">
                <?php echo $employee['Employee']['code'];?> 
            </td>
			<td class="">
                <?php echo $employee['Employee']['fullname']; //$this->CustomText->getFullname($employee['Employee']);  ?>
            </td>
            <td class="">
                <?php echo !empty($employee['Employee']['date_hired']) ? date('Y-m-d',strtotime($employee['Employee']['date_hired']))  : '' ?>
            </td>
              <td class="">
               <?php 

               		if (!empty($employee['Employee']['date_resigned'])) {

               			echo date('Y-m-d',strtotime($employee['Employee']['date_resigned']));

               		} else if(!empty($employee['end_contract'])) {

               			echo date('Y-m-d',strtotime($employee['end_contract']));

               		} else {

               		}

                ?>
            </td>
              <td class="">
               <?php 

				//$status = $employee['Contract']['name'] == 'Resigned' ? 'label-danger' : 'label-success';

				echo !empty($employee['Contract']['name']) ? ' <span class="label label-success">'.ucwords($employee['Contract']['name']).'</span>'  : '';  ?>
            </td>

            <td class="text-center">
															<?php 

															$status = $employee['Status']['name'] == 'Resigned' ? 'label-danger' : 'label-success';

															echo !empty($employee['Employee']['status']) ? ' <span class="label '.$status.' ">'.ucwords($employee['Status']['name']).'</span>'  : '';  ?>
								                        </td>
            
      
           	<td>
                <?php 

                if (!empty($this->params['named']['page'])) {
                	$view_url = array('controller' => 'employees', 'action' => 'view',$employee['Employee']['id'
                    	],
                    	'page' => $page .'?'.rand(1000,9999).'='.date("is")
                    	);
                	$edit_url = array('controller' => 'employees', 'action' => 'edit',$employee['Employee']['id'],'page' => $page.'?'.rand(1000,9999).'='.date("is")
                	);
                } else {
                	$view_url = array('controller' => 'employees', 'action' => 'view',$employee['Employee']['id'
                    	].'?'.rand(1000,9999).'='.date("is")
                    );
                	$edit_url = array('controller' => 'employees', 'action' => 'edit',$employee['Employee']['id'].'?'.rand(1000,9999).'='.date("is")
                		);

                }

             echo $this->Html->link('<span class="fa-stack">
				<i class="fa fa-square fa-stack-2x"></i>
				<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
				</span> ',
				'#changeStatus',
				array(
					'class' =>' table-link edit_contract',
					'escape' => false,
					'title' => 'Edit Information',
					'data-toggle' => 'modal',
					'data-id' => $employee['Employee']['id']
					));

             echo $this->Html->link('<span class="fa-stack">
		                            <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span></span> ', array('controller' => 'contracts', 'action' => 'view',$employee['Employee']['id']), array('class' =>' table-link','escape' => false, 'title'=>'View Contract'
		                            ));
			?>
		</td>
       </tr>

<?php 
endforeach; 
} ?> 