
<a href="<?php echo base_url()?>category">List Categories</a>&nbsp;&nbsp;
<a href="<?php echo base_url()?>category/create_category">Create Category</a>&nbsp;&nbsp;
<a href="<?php echo base_url()?>category/create_category_group">Create Category Group</a><br><br>

<table class="table  table-striped table-bordered table-hover  table-condensed">

    <tr>
      <th class="text-info">ID</th>
      <th class="text-info">CATEGORY GROUP</th>
      <th class="text-info">TITLE</th>
      <th class="text-info">CATEGORIES</th>
      <th class="text-info">STATUS</th>
    </tr>


    <?php foreach ( $aCategory_group as $key => $data ):?>

        <form action="<?php echo base_url()?>category/edit_category_group" method="">
        <tr>
        <td> <?php echo ++$key ?> </td>
        <td> <?php echo $data->name.'<a href = "'.base_url().'category/edit_category_group?id='.$data->id.'">  edit</a>' ?> </td>
        <td> <?php echo $data->title ?> </td>
        <td>
            <ul>
                <?php foreach ( $aCategories as $category_data ):?>
                    <?php if( $category_data->group_id == $data->id ):?>
                        <li>
                            <?php echo $category_data->title.'<a href = "'.base_url().'category/edit_category?id='.$category_data->id.'">  Edit </a><a href = "'.base_url().'category/delete_category?id='.$category_data->id.'">  Delete</a>' ?>
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
