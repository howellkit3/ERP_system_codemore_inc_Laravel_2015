  <?php if (!empty($items)) :  ?>
                            <?php foreach ($items  as $key => $list) { ?>
                       
                            <tr>
                                <td>
                                    <?php echo $list['Item']['name'] ?>
                                </td>
                                <td>
                                    <?php echo $list['Item']['description'] ?>
                                </td>
                                <td>
                                    <?php echo $list['Item']['measure'] ?>
                                </td>
                                
                                <td>
                                    <?php 
                                    if (!empty($list['ItemCategory']['name'])) {
                                         echo $list['ItemCategory']['name'];
                                    }
                                    ?>
                                </td>

                                <td>
                                    <?php echo $list['Item']['remaining_stocks'] ?>
                                </td>
                              
                                <td  class="text-center">
                                <?php
                                // echo $this->Html->link('<span class="fa-stack">
                                //      <i class="fa fa-square fa-stack-2x"></i>
                                //      <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                                //      </span> ',
                                //     array('controller' => 'ware_house',
                                //      'action' => 'view',
                                //      ),
                                //     array('class' =>' table-link',
                                //      'escape' => false
                                //      ,'title'=>'View Information'));
                                ?>
                                <?php
                                    echo $this->Html->link('<span class="fa-stack">
                                    <i class="fa fa-square fa-stack-2x"></i>
                                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                    </span> ',
                                    array('controller' => 'items',
                                    'action' => 'edit',$list['Item']['id']
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
                                    array('controller' => 'items', 
                                    'action' => 'delete',$list['Item']['id']
                                    ),
                                    array('class' =>' table-link',
                                    'escape' => false,
                                    'list'=>'Delete Information',
                                    'confirm' => 'Do you want to delete this Item?'));
                                ?>
                                </td>
                            </tr>
                                
                            <?php  } ?>
                          <?php else : ?>
                          
                           <font color="red"><b>No result..</b></font>
                    <?php endif; ?>