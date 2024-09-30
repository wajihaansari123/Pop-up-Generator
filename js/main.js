jQuery(document).ready(function($) {
    // Show popup after 2 seconds
    setTimeout(function() {
        $('.popup-wrapper').fadeIn();
    }, 2000);

    // Close the popup when the close button is clicked
    $('.close').click(function() {
        $('.popup-wrapper').fadeOut();
    });

    // Handle image upload button click
    $('#upload_image_button').on('click', function(e) {
        e.preventDefault();
        var image_frame;

        if (image_frame) {
            image_frame.open();
            return;
        }

        image_frame = wp.media({
            title: 'Select or Upload an Image',
            button: {
                text: 'Select Image'
            },
            multiple: false
        });

        // After selecting an image, update the hidden field and the preview
        image_frame.on('select', function() {
            var media_attachment = image_frame.state().get('selection').first().toJSON();
            $('#popup-image-url').val(media_attachment.url);
            $('#popup-image-preview').attr('src', media_attachment.url).show();

            // Dynamically add the radio button for the uploaded image
            var uploaded_image_radio = `
                <li>
                    <input type="radio" name="popup-image" value="${media_attachment.url}" id="${media_attachment.url}" checked>
                    <label for="${media_attachment.url}">${media_attachment.filename}</label>
                </li>`;
            $('ul').append(uploaded_image_radio);
        });

        image_frame.open();
    });
});
