 <?php if(!empty($positionData)) {
                                                    foreach ($positionData as $key => $positionList): $key++ ?>
                                                                <tr class="">
                                                                    <td class="">
                                                                        <?php echo $key;?> 
                                                                    </td>
                                                                    <td class="">
                                                                        <?php echo ucfirst($positionList['Position']['name']);  ?>
                                                                    </td>
                                                                    
                                                                    <td class="text-center">
                                                                       <?php echo ucfirst($positionList['Position']['description']);  ?>
                                                                    </td>

                                                                     <td class="text-center">
                                                                      <?php echo ucfirst($positionList['Position']['specification']);  ?>
                                                                    </td>

                                                                    <td class="text-center">
                                                                       <?php echo !empty($positionList['Position']['notes']) ? $positionList['Position']['notes'] : '';  ?>
                                                                    </td>

                                                                    <td>
                                                                        <?php 
                                                                        echo $this->Html->link('<span class="fa-stack">
                                                                            <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span></span> ', array('controller' => 'positions', 'action' => 'view',$positionList['Position']['id']), array('class' =>' table-link','escape' => false, 'title'=>'View Position'
                                                                            ));

                                                                        ?>

                                                                    <?php
                                                                    echo $this->Html->link('<span class="fa-stack">
                                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                                                                    </span> ', array('controller' => 'positions', 'action' => 'edit',$positionList['Position']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Position'));


                                                                    echo $this->Form->postLink('<span class="fa-stack">
                                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                                                                    </span>', array(
                                                                            'controller' => 'positions',
                                                                            'action' => 'delete',
                                                                            'plugin' => 'human_resource',
                                                                            $positionList['Position']['id']),
                                                                                    array('escape' => false,'class'=> 'table-link'), 
                                                                                    __('Are you sure you want to delete %s?', 
                                                                                    $positionList['Position']['name'])
                                                                            ); 
                                                                    ?>
                                                                    </td>
                                                                </tr>

    <?php endforeach;  } else { 
           echo '<font color="red"><b>No result..</b></font>';
     } ?>