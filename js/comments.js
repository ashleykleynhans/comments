function validateEmail(email) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

    if (filter.test(email)) {
        return true;
    } else {
        return false;
    }
}

// Display AJAX spinner while data is loading
function displaySpinner() {
    $('#buttons').replaceWith('<div id="buttons"><img src="/images/ajax-loader-large.gif" /></div>');
}

$( document ).ready(function() {
    jQuery.extend({
        postJSON: function(url, data, callback) {
            return jQuery.post(url, data, callback, "json");
        }
    });

    $(".fancybox").fancybox({
        wrapCSS: 'fancyboxBackground',
        helpers : { 
            overlay: {
                opacity: 0.8
            }
        }
    });

    $("#saveComment").click(function() {
        var commentData = new Object();
        commentData.name = $('#name').val();
        commentData.email = $('#email').val();
        commentData.comment = $('#comment').val();

        if ($.trim(commentData.name).length == 0) {
            alert('Please enter your name');
            return false;
        }

        if ($.trim(commentData.email).length == 0) {
            alert('Please enter your email address');
            return false;
        }

        if (!validateEmail(commentData.email)) {
            alert('Please enter a valid email address');
            return false;
        }

        if ($.trim(commentData.comment).length == 0) {
            alert('Please enter a comment');
            return false;
        }

        displaySpinner();

        var addCommentRequest = $.postJSON("/add", parms, function(data) {});

        addCommentRequest.complete(function(data) {
            refreshComments();
        });

        addCommentRequest.error(function(data) {
            alert('Failed to save comment');
        });
    });

    $("#cancelComment").click(function() {
        $.fancybox.close();
    });
});
