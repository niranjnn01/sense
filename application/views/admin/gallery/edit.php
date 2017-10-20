
<?php showMessage();?>

<?php echo form_open_multipart('gallery/edit/' . $oImage->id, 'id="pictureUpload"')?>

<div class="row">
	<div class="col-md-8">
		<?php echo form_open_multipart('gallery/edit' . $oImage->id, 'id="pictureUpload"')?>
			<div class="form-group">
				<label for="category">Category</label>
				<?php $iDefault = set_value('category') ? set_value('category') : NULL;?>
				<?php echo form_dropdown('category', $aPictureGalleryCategoriesTitles, $iDefault, 'class="form-control"');?>
			</div>

			<div class="form-group">
				<label for="title">Title</label>
				<input type="text" name="title" class="form-control" value="<?php echo set_value('title') ? set_value('title') : $oImage->title;?>">
			</div>

			<div class="form-group">
				<label for="description">Description</label>
				<textarea name="description" class="form-control"><?php echo set_value('description') ? set_value('description') : $oImage->description;?></textarea>
			</div>
			
			<div class="form-group">
				<label for="category">Category</label>
				<?php $iDefault = set_value('status') ? set_value('status') : NULL;?>
				<?php echo form_dropdown('status', $aImageGalleryItemStatusTitles, $iDefault, 'class="form-control"');?>
			</div>


			<div class="form-group">
				<label class="col-md-3">&nbsp;</label>
				<div  class="col-md-9">
					<input type="submit" name="Update" class="btn btn-primary"/>
					<?php echo backButton('admin', 'Cancel');?>
				</div>
			</div>
		</form>

	</div>
	<div class="col-md-4">
		<?php echo getImage('picture_gallery', $oImage->image_name, 'normal');?>
	</div>
</div>
