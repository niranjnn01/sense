<div class="container">

  <h2 class="text-primary">Edit Category</h2><br>
  <a href="<?php echo base_url()?>category">Create Category </a>
  <a href="<?php echo base_url()?>category/category_group">Create Category Group </a>
  <h4 class="text-success"><?php echo $this->session->flashdata('message'); ?></h4>
  <h4 class="text-danger"><?php echo validation_errors(); ?></h4><br>

  <?php foreach ( $aCategory as $data ):?>
	  <?php $id = $data->id ?>
  <?php endforeach; ?>

  <form class="forms" action="<?php echo base_url()?>category/edit_category?id=<?php echo $id ?>" method="post" style="width : 300px; height : 400px">

	<div class="form-group">
		<label>Group</label><br>
		<?php foreach ( $aCategory as $data ):?>
			<?php foreach ( $aCategory_groups as $group ):?>
				<?php if($data->group_id == $group->id):?>
					<label class="text-primary"><?php echo $group->title ?></label>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endforeach; ?>
	</div>

	  <div class="form-group">
		  <label>Name</label><br>
		  <?php foreach ( $aCategory as $data ):?>
			  <label class="text-primary"><?php echo $data->name ?></label>
		  <?php endforeach; ?>
	 </div>

	 <div class="form-group">
		<label>Title</label>
		<input type="text"
			   class="form-control"
			   placeholder=""
			   name="title"
			   value="<?php echo set_value('title'); ?>">
	 </div>

	 <div class="form-group">
		<label>Description</label>
		<textarea class    ="form-control"
				placeholder=""
				name       ="description"
				value      ="<?php echo set_value('description'); ?>"></textarea>
	</div>

	<div class="form-group">
		<label>Status</label>
		<select class="form-control" name="category_status">
			<?php foreach ( $aCategory_status as $data ):
				echo "<option value=".$data->id.">".$data->title."</option>";
			 endforeach;?>
		</select>
	</div>

	<button type="submit" class="btn btn-primary">Update</button>

</form>

</div>
