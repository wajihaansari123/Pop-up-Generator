<?php
if (!defined('ABSPATH')) {
    die();
}

if (isset($_POST['save_popup'])) {
    $popup_img = esc_sql($_POST['popup-image']);
}
?>
<div class="wrap">
    <h1 class="wp_heading_inline"><?php echo get_admin_page_title(); ?></h1>
    <h3>Select Popup to Show</h3>
    <form action="admin.php?page=Pop-up+Gen" method="post">
        <ul>
            <?php
            // Fetch the uploaded image (if any) from the saved option
            $saved_popup = get_option('pop-up-image');
            if ($saved_popup) {
                $checked = ($saved_popup == get_option('pop-up-image')) ? 'checked' : '';
                echo "
                <li>
                <input type='radio' name='popup-image' value='$saved_popup' id='$saved_popup' $checked>
                <label for='$saved_popup'>$saved_popup</label>
                </li>";
            } else {
                echo "<li>No uploaded image selected</li>";
            }
            ?>
        </ul>
        <h3>Or Upload a Custom Popup Image</h3>
        <button type="button" id="upload_image_button" class="button">Upload Image</button>
        <input type="hidden" id="popup-image-url" name="popup-image" value="<?php echo get_option('pop-up-image'); ?>" />
        <img id="popup-image-preview" src="<?php echo get_option('pop-up-image'); ?>" style="max-width: 300px; display: <?php echo get_option('pop-up-image') ?>;" />
        <br><br>
        <input type="submit" value="Save" name="save_popup" class="button button-primary">
    </form>
</div>
