<?php

add_action('admin_menu' , 'slider_menu_action');

function slider_menu_action() {

    add_menu_page(
		'Slider',
		'Slider',
		'manage_options',
        'slider',
		'slider_setting_page',
		'dashicons-admin-generic',
		6
	);

}

function slider_setting_page() {

    global $wp_filesystem;
    WP_Filesystem();

    $act = isset($_GET['act']) ? $_GET['act'] : '';
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    $head = isset($_POST['head_slider']) ? $_POST['head_slider'] : '';
    $desc = isset($_POST['desc_slider']) ? $_POST['desc_slider'] : '';
    $button_link = isset($_POST['button_link']) ? $_POST['button_link'] : '';
    $checkbox = isset($_POST['checkbox']) ? 1 : 0;
    $status_btn = isset($_POST['status_btn']) ? 1 : 0;
    $images = isset($_FILES['images']['name']) ? $_FILES['images']['name'] : '';
    $images_tmp = isset($_FILES['images']['tmp_name']) ? $_FILES['images']['tmp_name'] : '';

    $dt=date("Y-m-d H:i:s");

    $content_directory = $wp_filesystem->wp_content_dir() . 'uploads/';
    $wp_filesystem->mkdir( $content_directory . 'SliderDirectory' );
    
    $target_dir_location = $content_directory . 'SliderDirectory/';
     
    if(isset($_FILES['images']) && $act != 'edit' || $act == 'edit' ) {
     
        $name_file = isset($_FILES['images']['name']) ? $_FILES['images']['name'] : '';
        $tmp_name = isset($_FILES['images']['tmp_name']) ? $_FILES['images']['tmp_name'] : '';
     
        if( move_uploaded_file( $tmp_name, $target_dir_location.$name_file ) ) {
            echo "File was successfully uploaded";
        } else {
            echo "The file was not uploaded";
        }
        $data = [
            'head_slider' => $head,
            'desc_slider' => $desc,
            'images' => $name_file,
            'status' => $checkbox,
            'status_btn' => $status_btn,
            'button_link' => $button_link,
            'created_at' => $dt
        ];
    } else {
        $data = [
            'head_slider' => $head,
            'desc_slider' => $desc,
            'status' => $checkbox,
            'status_btn' => $status_btn,
            'button_link' => $button_link,
            'images' => NULL,
            'created_at' => $dt
        ];
    }



    if($act == 'delete') {

        $where = array('id' => $id);
        $deleted = delete('slider',$where);

        if($deleted) {

            $url = admin_url().'admin.php?page=slider';
            wp_redirect($url);
            exit;

        }
    }

    if(!empty($head)) {

        if($act == 'edit') {

            functionUpdated();

        }else {
            $storeData = store('slider',$data);
            if($storeData) {
                $url = admin_url().'admin.php?page=slider';
                wp_redirect($url);
                exit;
            }
        }

    }

    include TEMP_DIR . 'all-data.php';

}

function functionUpdated() {
    $act = isset($_GET['act']) ? $_GET['act'] : '';
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    $head = isset($_POST['head_slider']) ? $_POST['head_slider'] : '';
    $desc = isset($_POST['desc_slider']) ? $_POST['desc_slider'] : '';
    $button_link = isset($_POST['button_link']) ? $_POST['button_link'] : '';
    $checkbox = isset($_POST['checkbox']) ? 1 : 0;
    $status_btn = isset($_POST['status_btn']) ? 1 : 0;
    $images = isset($_FILES['images']['name']) ? $_FILES['images']['name'] : '';
    $images_tmp = isset($_FILES['images']['tmp_name']) ? $_FILES['images']['tmp_name'] : '';
    $dt=date("Y-m-d H:i:s");
    
    if($_FILES['images']['name'] > 0) {

        $name_file = isset($_FILES['images']['name']) ? $_FILES['images']['name'] : '';
        $tmp_name = isset($_FILES['images']['tmp_name']) ? $_FILES['images']['tmp_name'] : '';
     
        if( move_uploaded_file( $tmp_name, $target_dir_location.$name_file ) ) {
            echo "File was successfully uploaded";
        } else {
            echo "The file was not uploaded";
        }
        $data = [
            'head_slider' => $head,
            'desc_slider' => $desc,
            'images' => $name_file,
            'status' => $checkbox,
            'status_btn' => $status_btn,
            'button_link' => $button_link,
            'created_at' => $dt
        ];
        $where = array('id' => $id);
        $updateData =  update('slider',$data, $where);
        
        if($updateData) {
            $url = admin_url().'admin.php?page=slider';
            wp_redirect($url);
            exit;
        }

    } else {
        $where = array('id' => $id);
        $andWhere = " AND id='".$id."' ";
        $edit_data = edit('slider',$andWhere);
        $images = $edit_data->images;
        $dataUpdated = [
            'head_slider' => $head,
            'desc_slider' => $desc,
            'status' => $checkbox,
            'status_btn' => $status_btn,
            'button_link' => $button_link,
            'images' => $images,
            'created_at' => $dt
        ];
        $updateData =  update('slider',$dataUpdated, $where);
        
        if($updateData) {
            $url = admin_url().'admin.php?page=slider';
            wp_redirect($url);
            exit;
        }
    }
}

?>