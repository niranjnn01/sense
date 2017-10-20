
<?php showMessage();?>

<?php echo form_open_multipart('gallery/upload', 'id="pictureUpload"')?>


	<div class="form-group">
		<label for="category">Category</label>
		<?php echo form_dropdown('category', $aPictureGalleryCategoriesTitles, NULL, 'class="form-control"');?>
	</div>

	<div class="form-group">
		<label for="title">Title</label>
		<input type="text" name="title" class="form-control">
	</div>

	<div class="form-group">
		<label for="description">Description</label>
		<textarea name="description" class="form-control"></textarea>
	</div>

	<div class="form-group">
		<label for="">Upload Picture</label>
		<input type="file" name="gallery_picture">
	</div>

	<div class="form-group">
		<label class="col-md-3">&nbsp;</label>
		<div  class="col-md-9">
			<input type="submit" name="Upload" class="btn btn-primary"/>
			<?php echo backButton('admin', 'Cancel');?>
		</div>
	</div>
</form>
