$( document ).ready(function() {
    $('#searchbox').focus(function() {
        $('#searchbox').val('');
        $('#searchbox').removeClass('grey');
        $('#searchbox').addClass('black');
    });

    $('#searchbox').focusout(function() {
        var keywords = $('#searchbox').val();

        if (keywords.length == 0) {
            $('#searchbox').removeClass('black');
            $('#searchbox').addClass('grey');
            $('#searchbox').val('Search keywords');
        }
    });
});
