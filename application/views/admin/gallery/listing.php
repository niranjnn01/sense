<?php showMessage();?>


<?php if($aPictures):?>
<table class="table table-condensed">

    <thead>
		<tr>
			<th>SI</th>
			<th>Image</th>
			<th>Details</th>
            <th>Category</th>
			<th>Actions</th>
		</tr>
    </thead>

    <tbody>
	<?php foreach($aPictures AS $iKey=>$oItem):?>
    <tr>

	    <td>
			<?php echo $iKey + $iOffset + 1;?>
		</td>

	    <td>
			<?php echo getImage('picture_gallery', $oItem->image_name, 'display_image',array("only_url"=>true));?>
		</td>
		<td>
            <h4><?php echo $oItem->title;?></h4>
            <?php echo $oItem->description;?>
		</td>

        <td>
            <?php echo $oItem->category_title;?>
        </td>

        <td>
			<div>
                <a href="<?php echo $c_base_url, 'gallery/edit/', $oItem->id;?>">Edit</a>
            </div>
			<div>
                <a href="#" class="delete_image" data-id="<?php echo $oItem->id;?>">Delete</a>
            </div>
		</td>

    </tr>
	<?php endforeach;?>
    </tbody>
</table>
<div class="row">
	<?php echo $sPagination;?>
</div>

<?php else:?>
<div class="col-md-10 text-center">There are no Images</div>
<?php endif;?>
