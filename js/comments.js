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
    commentData.parentid = $('#parentid').html();

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
            $('#parentid').html('0');

            var margin = 0;

            if (data.comment.parent_id > 0) {
                // Get the indentation of the parent
                var parentMargin = $('#comment-' + data.comment.parent_id).css('margin-left');

                // parse parentMargin as int otherwise it gets concatenated as a string
                margin = parseInt(parentMargin) + 30;
            }

            // Create a div containing the new comment
            var newComment = $('<div id="comment-container-' + data.comment.comment_id +'">' +
                '<div id="comment-' + data.comment.comment_id + '" class="comment" style="margin-left:' + margin + 'px">' +
                '<div class="commentText">' + data.comment.comment_text + '</div>' +
                '<div class="commentDetail">' + data.comment.name  + '&nbsp;&nbsp; - &nbsp;&nbsp;' +
                data.comment.created + '</div><div class="commentReply">' +
                '<a href="#addComment" class="btn btn-sm btn-success fancybox" data-comment-id="' + data.comment.comment_id +
                '" id="add-' + data.comment.comment_id + '" onclick="setParentId(this);">Reply</a></div></div></div>');

            if (data.comment.parent_id > 0) {
                // Display the new comment below its parent
                $('#comment-container-' + data.comment.parent_id).append(newComment);
            } else {
                // Display the new comment on bottom of the comment list
                $('#comments').append(newComment);
            }
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

// Enable the comment buttons
function enableButtons() {
    $('#buttons').replaceWith('<div id="buttons"><button type="button" id="saveComment" class="btn btn-success btn-large" onclick="save();">Save</button><button type="button" id="cancelComment" class="btn btn-warning btn-large" onclick="closeLightbox();">Cancel</button></div>');
}

function setParentId(element) {
    var comment_id = $(element).attr('data-comment-id');
    $('#parentid').html(comment_id);
    return false;
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
        setParentId(this);
    });
});
