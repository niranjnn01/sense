
	<a href="<?php echo base_url()?>category">List Categories</a>&nbsp;&nbsp;
	<a href="<?php echo base_url()?>category/create_category">Create Category</a>&nbsp;&nbsp;
	<a href="<?php echo base_url()?>category/create_category_group">Create Category Group</a><br><br>&nbsp;&nbsp;
	<h4 class="text-success"><?php echo $this->session->flashdata('message'); ?></h4>
	<h4 class="text-danger"><?php echo validation_errors(); ?></h4><br>
		<form class="forms" action="<?php echo base_url()?>category/create_category_group" method="post" style="width : 250px; height : 200px">

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
