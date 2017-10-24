<div class="container">

	<h2 class="text-primary">Edit Category Groups</h2><br>
	<a href="<?php echo base_url()?>category">Create Category </a>
	<a href="<?php echo base_url()?>category/category_group">Create Category Group </a>
	<h4 class="text-success"><?php echo $this->session->flashdata('message'); ?></h4>
	<h4 class="text-danger"><?php echo validation_errors(); ?></h4><br>

		<?php $id = $_GET['id'];?>

	<form class="forms" action="<?php echo base_url()?>category/edit_category_group?id=<?php echo $id ?>" method="post" style="width : 250px; height : 400px">

		<div class="form-group">
			<label>Group Name</label><br>

			<?php foreach ( $aCategory_groups as $group ):?>
				<?php if($group->id == $id): ?>
					<label class="text-primary"><?php echo $group->name ?></label>
				<?php endif ?>
			<?php endforeach; ?>

		</div>

		<div class="form-group">
			<label>Group Title *</label>
			<input type       ="text"
				   class      ="form-control"
				   placeholder=""
				   name       ="group_title"
				   value      ="">
		</div>

		<div class="form-group">
			<label>Status</label>
			<select class="form-control" name="category_group_status">

				<?php foreach ( $aCategory_group_status as $data ):
					echo "<option value=".$data->id.">".$data->title."</option>";
				 endforeach;?>

			</select>
		</div>

		<button type="submit" class="btn btn-primary">Update / Back</button>
	</form>
</div>
