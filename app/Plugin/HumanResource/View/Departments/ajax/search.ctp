<?php 
                                            if(!empty($departmentData)){
                                                foreach ($departmentData as $key => $departmentList): $key++ ?>
                                                        <tr class="">
                                                            <td class="">
                                                                <?php echo $key;?> 
                                                            </td>
                                                            <td class="">
                                                                <?php echo ucfirst($departmentList['Department']['name']);  ?>
                                                            </td>
                                                            
                                                            <td class="text-center">
                                                               <?php echo ucfirst($departmentList['Department']['description']);  ?>
                                                            </td>

                                                             <td class="text-center">
                                                              <?php echo ucfirst($departmentList['Department']['specification']);  ?>
                                                            </td>

                                                            <td class="text-center">
                                                               <?php echo !empty($departmentList['Department']['notes']) ? $departmentList['Department']['notes'] : '';  ?>
                                                            </td>

                                                            <td>
                                                                <?php 
                                                                echo $this->Html->link('<span class="fa-stack">
                                                                    <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span></span> ', array('controller' => 'departments', 'action' => 'view',$departmentList['Department']['id']), array('class' =>' table-link','escape' => false, 'title'=>'View Sales Invoice'
                                                                    ));

                                                                ?>

                                                            <?php
                                                            echo $this->Html->link('<span class="fa-stack">
                                                            <i class="fa fa-square fa-stack-2x"></i>
                                                            <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                                                            </span> ', array('controller' => 'departments', 'action' => 'edit',$departmentList['Department']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Department'));


                                                            echo $this->Form->postLink('<span class="fa-stack">
                                                            <i class="fa fa-square fa-stack-2x"></i>
                                                            <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                                                            </span>', array(
                                                                    'controller' => 'departments',
                                                                    'action' => 'delete',
                                                                    'plugin' => 'human_resource',
                                                                    $departmentList['Department']['id']),
                                                                            array('escape' => false,'class'=> 'table-link'), 
                                                                            __('Are you sure you want to delete %s?', 
                                                                            $departmentList['Department']['name'])
                                                                    ); 
                                                            ?>
                                                            </td>
                                                        </tr>

                                                   
                                            <?php  endforeach; 
                                            }  else { 

                                                    echo '<font color="red"><b>No result..</b></font>';
                                             } ?> 