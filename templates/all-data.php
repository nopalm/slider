<style>
    .wrapper-form {
	background: #fff;
	padding: 45px 20px;
	max-width: 500px;
	display: flex;
	justify-content: center;
	border-radius: 10px;
}


.form-border {
  width: 85%;
}
.form-group {
  display: flex;
  flex-direction: column;
}
.form-group label {
  padding: 5px 0px;
  font-weight: 600;
}

.checkbox input {
  margin: 6px 0px;
}
.checkbox span {
  color: red;
}

#table{
    border-collapse: collapse;
  width: 100%;
  margin:20px 0px;
}
#table td, #table th {
  border: 1px solid #ddd;
  padding: 8px;
}

#table tr:nth-child(even){background-color: #f2f2f2;}

#table tr:hover {background-color: #ddd;}

#table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #0D1E62;
  color: white;
}

.table-img {
	width: 100px;
	height: 100px;
}

.wrapper-shortcode{
    display:flex;
    flex-direction:column;
    width:20%;
}
.wrapper-shortcode button {
	background: #080440;
	color: #fff;
	padding: 14px 28px;
	border-radius: 6px;
	border: 1px solid #0D1E62;
	margin-top: 14px;
}

.wrapper-shortcode button:hover {
    cursor:pointer;
	background: transparent;
	color: #080440;
	border: 1px solid #0D1E62;
}

.wrapper-shortcode input {
	padding: 8px;
	text-align: center;
	color: #262626;
	font-weight: 600;
	border: 1px solid #b0b0b0;
}

.form-button {
	background: #080440;
	color: #fff;
	padding: 14px 28px;
	border-radius: 6px;
	border: 1px solid #0D1E62;
	margin-top: 14px;
}

.form-button:hover {
    cursor:pointer;
	background: transparent;
	color: #080440;
	border: 1px solid #0D1E62;
}

.back-btn {
	background: #750f0f;
	color: #fff;
	padding: 14px 28px;
	border-radius: 6px;
	border: 1px solid #750f0f;
	margin-top: 14px;
	text-decoration: none;
    margin-right:10px;
}


.back-btn:hover {
    cursor:pointer;
	background: transparent;
	color: #750f0f;
	border: 1px solid #750f0f;
}
</style>

<h2>
    Menu Slider
</h2>

<div class="wrapper-form">
    
    <?php
        if($act == 'edit') {
            $andWhere = " AND id='".$id."' ";
            $edit_data = edit('slider',$andWhere);

            $id_row = $edit_data->id;
            $head_slider = $edit_data->head_slider;
            $desc_slider = $edit_data->desc_slider;
            $images = $edit_data->images;
            $status = $edit_data->status;
        }

    ?>


    <form action="" method="POST" enctype="multipart/form-data" class="form-border">

        <?php if($act == 'edit') : ?>
            <input type="hidden" name="id" value="<?= $id ?>">
        <?php endif;?>

        <div class="form-group">
            <label> Heading Slider </label>
            <input type="text" name="head_slider" placeholder="Insert Heading" value="<?= isset($head_slider) ? $head_slider : ''?>" ?>
        </div>
        <div class="form-group">
            <label> Description Slider </label>
            <textarea type="text" name="desc_slider" rows="5" col="2" placeholder="Insert Heading">
            <?= isset($desc_slider) ? $desc_slider : ''?>
            </textarea>
        </div>
        <div class="form-group checkbox">
            <label> Disable Text Slider</label>
            <?php if($act == 'edit') : ?>
            <input type="checkbox" name="checkbox" placeholder="Insert Heading" value="1" <?php echo ($status == 1 ? 'checked' : '');?> >
            <?php else : ?>
            <input type="checkbox" name="checkbox" placeholder="Insert Heading" value="1" >
            <?php endif;?>
            <span>Check for disable text in slider</span>
        </div>
        <div class="form-group">
            <label> Images </label>
            <input type="file" name="images">
            <?php $upload_dir = wp_upload_dir(); ?>
            <?php if( $act == 'edit') : ?> 
                <img src="<?php echo $upload_dir['baseurl'] .'/SliderDirectory/'. $images; ?>">
            <?php endif; ?>
        </div>
        <?php if( $act == 'edit') : ?>
            <a href="<?= admin_url() .'admin.php?page=slider' ?>" class="back-btn"> Back </a>
            <button type="submit" class="form-button">Edit Data</button>
        <?php else : ?>
            <button type="submit" class="form-button">Add Data</button>
        <?php endif; ?>
    </form>

</div>


<table id="table">
    <tr>
        <th>No</th>
        <th>Heading Slider</th>
        <th>Description Slider</th>
        <th>Images</th>
        <th>Actions</th>
    </tr>
    <?php
    $no = 1 ;
    $show_all_data = allData('slider');
    foreach($show_all_data as $data ) :
    ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $data->head_slider; ?></td>
        <td><?= $data->desc_slider ? strlen($data->desc_slider) > 60 ? substr($data->desc_slider, 0, 60) . '..' : $data->desc_slider : ''?></td>
        <td> 
            <?php if($data->images != NULL ) : ?>
            <img class="table-img" src="<?php echo $upload_dir['baseurl'] .'/SliderDirectory/'. $data->images; ?>">
            <?php else : ?>
            <span>no images</span>
            <?php endif ?>
        </td>
        <td><a href="<?= admin_url() .'admin.php?page=slider&act=edit&id='.$data->id ?>">Edit</a> <a href="<?= admin_url() .'admin.php?page=slider&act=delete&id='.$data->id ?>">delete</a></td>
    </tr>
    <?php endforeach; ?>

</table>

<div class="wrapper-shortcode">
    <input type="text" value="[simpleSlider]" id="myInput" disabled>
    <button onclick="copy()">Copy Shortcode</button>
</div>

<script>
function copy() {
  // Get the text field
  var copyText = document.getElementById("myInput");

  // Select the text field
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

  // Copy the text inside the text field
  navigator.clipboard.writeText(copyText.value);
  
  // Alert the copied text
  alert("Copied shortcode : " + copyText.value);
}
</script>