
	  <h2 class="text-primary">Create New Category</h2><br>
	  <h4 class="text-success"><?php echo $this->session->flashdata('message'); ?></h4>
	  <h4 class="text-danger"><?php echo validation_errors(); ?></h4><br>

	  <form class="forms" action="<?php echo base_url()?>category" method="post" style="width : 300px; height : 400px">

		  <div class="form-group">
			  <label>Name</label>
			  <input type       ="text"
					 class      ="form-control"
					 placeholder=""
					 name       ="name"
					 value      ="<?php echo set_value('name'); ?>">
		 </div>

		 <div class="form-group">
			 <label>Title</label>
			 <input type       ="text"
					class      ="form-control"
					placeholder=""
					name       ="title"
					value      ="<?php echo set_value('title'); ?>">
		</div>

		<div class="form-group">
			<label>Description</label>
			<textarea class    ="form-control"
					placeholder=""
					name       ="description"
					value      ="<?php echo set_value('description'); ?>"></textarea>
		</div>

		<div class="form-group">
			<label>Category Group</label>
			<select class="form-control" name="category_group">
				<?php foreach ( $aCategory_group as $key => $data ):?>
					<option value="<?php echo $key ?>"><?php echo $data ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<button type="submit" class="btn btn-primary">Submit</button>

	</form>
