function validateEmail(email) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

    if (filter.test(email)) {
        return true;
    } else {
        return false;
    }
}

function saveComment() {
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

    addCommentRequest.success(function(data) {
        closeLightbox();
    });

    addCommentRequest.error(function(data) {
        enableButtons();
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
    $('#buttons').replaceWith('<div id="buttons"><button type="button" id="saveComment" class="btn btn-success btn-large" onclick="saveComment();">Save</button><button type="button" id="cancelComment" class="btn btn-warning btn-large" onclick="cancelComment();">Cancel</button></div>');
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
        saveComment();
    });

    $("#cancelComment").click(function() {
        closeLightbox();
    });
});
