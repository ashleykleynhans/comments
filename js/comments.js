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
    commentData.parentid = $('#parentId').val();

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

    var addCommentRequest = $.postJSON("/savecomment", commentData, function(data) {});

    addCommentRequest.complete(function(data) {
        enableButtons();
    });

    addCommentRequest.success(function(data) {
        if (data.result == 1) {
            $('#name').val('');
            $('#email').val('');
            $('#comment').val('');
            $('#parentId').val('0');

            $('#comments').append('<div class="comment"><div class="commentText">' +
                data.comment.comment_text + '<div class="commentDetail">' + data.comment.name  + '&nbsp;&nbsp; - &nbsp;&nbsp;' +
                data.comment.created + '</div><div class="commentReply"><button class="btn btn-sm btn-success">Reply</button></div></div>');
        } else {
            alert(data.message);
        }

        closeLightbox();
    });

    addCommentRequest.error(function(data) {
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

function enableButtons() {
    $('#buttons').replaceWith('<div id="buttons"><button type="button" id="saveComment" class="btn btn-success btn-large" onclick="save();">Save</button><button type="button" id="cancelComment" class="btn btn-warning btn-large" onclick="closeLightbox();">Cancel</button></div>');
}

// Enable the comment buttons

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
        save();
    });

    $("#cancelComment").click(function() {
        closeLightbox();
    });
});
