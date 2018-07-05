requirejs([
    'jquery',
], function ($) {

    $( document ).ready(function() {

        if($('#delivery_date_general_date_format').length < 1)
            return;

        $('#delivery_date_general_date_format').after('<p class="note">date preview: <span id="date-preview"></span></p>');

        var dateFormat = $('#delivery_date_general_date_format').val();
        var now = new Date();
        $('#date-preview').text(now.format(dateFormat));

        $('#delivery_date_general_date_format').on('keyup', function()
        {
            var dateFormat = $(this).val();
            var now = new Date();
            $('#date-preview').text(now.format(dateFormat));
        });
    });
});