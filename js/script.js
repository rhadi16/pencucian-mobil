$(document).ready(function() {
    $('#search').on('keyup', function() {
        $.ajax({
            type: 'POST',
            url: 'search.php',
            data: {
                search: $(this).val()
            },
            cache: false,
            success: function(data) {
                $('#tampil').html(data);
            }
        });
    });
});