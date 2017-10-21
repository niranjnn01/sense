<div class="container">



	<h2 class="text-primary">Category Groups</h2><br>
	<h4 class="text-success"><?php echo $this->session->flashdata('message'); ?></h4>
	<h4 class="text-danger"><?php echo validation_errors(); ?></h4><br>
		<form class="forms" action="<?php echo base_url()?>category/category_group" method="post" style="width : 250px; height : 200px">

			<div class="form-group">
				<label>Group Name</label>
				<input type       ="text"
					   class      ="form-control"
					   placeholder=""
					   name       ="group_name"
					   value      ="<?php echo set_value('group_name'); ?>">
			</div>

			<div class="form-group">
				<label>Group Title</label>
				<input type       ="text"
					   class      ="form-control"
					   placeholder=""
					   name       ="group_title"
					   value      ="<?php echo set_value('group_title'); ?>">
			</div>

			<button type="submit" class="btn btn-primary">Add</button>

		</form>

				<table class="table  table-striped table-bordered table-hover  table-condensed">

					<tr>
					  <th class="text-info">ID</th>
					  <th class="text-info">NAME</th>
					  <th class="text-info">TITLE</th>
					  <th class="text-info">CATEGORIES</th>
					  <th class="text-info">STATUS</th>
					</tr>


					<?php foreach ( $aCategory_group as $key => $data ):?>

						<form action="<?php echo base_url()?>category/edit_category_group" method="">
						<tr>
						<td> <?php echo ++$key ?> </td>
						<td> <?php echo '<a href = "'.base_url().'category/edit_category_group?id='.$data->id.'">'.$data->name ?> </td>
						<td> <?php echo $data->title ?> </td>
						<td>
							<ul>
								<?php foreach ( $aCategories as $category_data ):?>
									<?php if( $category_data->group_id == $data->id ):?>
										<li>
											<?php echo '<a href = "'.base_url().'category/edit_category?id='.$category_data->id.'">'.$category_data->title.'</a>' ?>
										</li>
									<?php endif;?>
								<?php endforeach; ?>
							</ul>
						</td>
						<td><?php foreach ( $aCategory_group_status as $status ):?>

								<?php if( $data->status == $status->id ):?>
									<?php echo $status->title ?>
								<?php endif;?>
								
							 <?php endforeach;?>
						</td>
					<?php endforeach;?>
					</table>
					</form>

</div>
