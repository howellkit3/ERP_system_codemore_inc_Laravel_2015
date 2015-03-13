<div class="col-lg-6">
	<div class="main-box">
		<header class="main-box-header clearfix">
			<h2><b>Add Category</b></h2>
		</header>
		
		<div class="main-box-body clearfix">
			<?php echo $this->Form->create('Category', 
													array( 
											'url' => (
													array(
											'controller' => 'itemCategories', 
											'action' => 'add'
												)), 
											'class' => 'form-horizontal'
											));
			?>
				<div class="form-group">
					<label for="inputEmail1" class="col-lg-2 control-label">Name</label>
					<div class="col-lg-8">
						<?php 
                            echo $this->Form->input('category_name', array('class' => 'form-control item_type',
                            	'required' => true,
                                'alt' => 'category_name',
                                'label' => false));
                        ?>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-10">
						<?php 
                            echo $this->Form->input( 'Save Category', 
                            										array( 
                            						'class' => 'btn btn-success',
                            						'type' => 'submit',
                            						'label'=> false
                                                    ));
                        ?>
		
					</div>
				</div>
			<?php echo $this->Form->end(); ?>
		</div>								
	</div>
</div>

<div class="col-lg-6 col-md-4 col-sm-4">
	<div class="main-box clearfix">
		<header class="main-box-header clearfix">
			<h1>Category List</h1>
		</header>
		<table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th><a href="#"><span>Category</span></a></th>
                    <th>Action</th>
                </tr>
            </thead>
			<?php  foreach ($category as $categoryList ):?>
			    
			    <tbody aria-relevant="all" aria-live="polite" role="alert">

			        <tr class="">

			            <td class="">
			                <?php echo $categoryList ?>
			            </td>
			            <td>
			               <?php
			                    echo $this->Html->link('<span class="fa-stack">
									                    <i class="fa fa-square fa-stack-2x"></i>
									                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
									                    </span>', 
									                    		array(
									                   'controller' => 'itemCategories', 
									                   'action' => 'delete_item',
									                   $categoryList
									                   			), 
									                    		array(
									                    'class' =>' table-link', 
									                    'escape' => false, 
									                    'title'=>'Delete Information', 
									                    'confirm' => 'Do you want to delete Custom Field Label ?'
									                    ));
			                ?>
			               
			                
			            </td>
			        </tr>

			    </tbody>
			<?php endforeach; ?> 

        </table>
		
	</div>
</div>