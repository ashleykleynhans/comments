// Email validation function
function validateEmail(email) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

    if (filter.test(email)) {
        return true;
    } else {
        return false;
    }
}

function save() {
    var commentData = new Object();
    commentData.name = $('#name').val();
    commentData.email = $('#email').val();
    commentData.comment = $('#comment').val();
    commentData.commentid = $('#commentid').val();

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

    var updateCommentRequest = $.postJSON("/updatecomment", commentData, function(data) {});

    updateCommentRequest.complete(function(data) {
        enableButtons();
    });

    updateCommentRequest.success(function(data) {
        if (data.result == 1 || data.message == 'Session expired') {
            // Reload the page
            location.reload();
        } else {
            alert(data.message);
        }

        closeLightbox();
    });

    updateCommentRequest.error(function(data) {
        alert('Failed to save comment');
    });
}

function closeLightbox() {
    $.fancybox.close();
}

// Display AJAX spinner while data is loading
function displaySpinner() {
    $('#buttons').replaceWith('<div id="buttons"><img src="/images/ajax-loader-large.gif" /></div>');
}

// Enable the comment buttons
function enableButtons() {
    $('#buttons').replaceWith('<div id="buttons"><button type="button" id="saveComment" class="btn btn-success btn-large" onclick="save();">Save</button><button type="button" id="cancelComment" class="btn btn-warning btn-large" onclick="closeLightbox();">Cancel</button></div>');
}

$( document ).ready(function() {
    jQuery.extend({
        postJSON: function(url, data, callback) {
            return jQuery.post(url, data, callback, "json");
        }
    });

    $('.fancybox').fancybox({
        wrapCSS: 'fancyboxBackground',
        helpers : { 
            overlay: {
                opacity: 0.8
            }
        }
    });

    $('#saveComment').click(function() {
        save();
    });

    $('#cancelComment').click(function() {
        closeLightbox();
    });

    $('.fancybox').click(function() {
        var comment_id = $(this).attr('data-comment-id');
        var name = $('#name-' + comment_id).html();
        var email = $('#email-' + comment_id).html();
        var comment = $('#comment-' + comment_id).html();

        $('#commentid').val(comment_id);
        $('#name').val(name);
        $('#email').val(email);
        $('#comment').val(comment);
    });
});
