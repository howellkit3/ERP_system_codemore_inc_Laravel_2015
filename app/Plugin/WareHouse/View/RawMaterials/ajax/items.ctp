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
                                    <?php 

                                        if (!empty($list['ItemSpec'][0]['id'])) {

                                                    foreach ($list['ItemSpec'] as $key => $measure) {

                                                            $size = '';

                                                            $size .=  !empty($measure['width']) ? $measure['width'] : '';

                                                            $size .= !empty($measure['unit_width']) ? ' '.$measure['unit_width'] : '';

                                                            if ($measure['length'] > 0) {

                                                                $size .= !empty($measure['length']) ? ' X '.$measure['length'] : '';

                                                               $size .= !empty($measure['unit_length']) ? ' '.$measure['unit_length'] : '';

                                                            } 

                                                         echo  $size;

                                                         echo  ($key >= 0) ? '<br>' : '';
                                                    }
                                        } else {

                                        if (!empty($list['Item']['width']) && !empty($list['Item']['length'])) {


                                            echo $list['Item']['width'].' mm'.' X '. $list['Item']['length'].' mm';




                                        } else {

                                            if (!empty($list['Item']['measure'])) {

                                                echo  $list['Item']['measure'];
                                            }
                                        }

                                        }
                                      
                                  ?>
                                </td>
                                
                                <td>
                                    <?php 
                                    if (!empty($list['ItemCategory']['name'])) {
                                         echo $list['ItemCategory']['name'];
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php echo !empty($list['Item']['quantity']) ?  $list['Item']['quantity'] : '-' ?>
                                </td>
                                <td>
                                    <?php echo !empty($list['Item']['remaining_stocks']) ? $list['Item']['remaining_stocks'] : '-';  ?>
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
                                    array('controller' => 'raw_materials',
                                    'action' => 'edit',
                                    $list['Item']['id'],
                                    'page' => $page
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
                                    array('controller' => 'raw_materials', 
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
                    <?php endif; ?>