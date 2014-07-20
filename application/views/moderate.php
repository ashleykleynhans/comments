<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">

    <title>Comment Engine</title>
    <meta name="description" content="Comment Engine">
    <meta name="author" content="Ashley Kleynhans">

    <!-- Styles -->
    <?= HTML::style('css/bootstrap.min.css') ?>
    <?= HTML::style('css/bootstrap-theme.css') ?>
    <?= HTML::style('css/comments.css') ?>

    <!-- TODO: Fav and touch icons -->
</head>
<body>
    <div class="container-fluid" id="moderation">
        <div class="pull-right">
            <a href="/logout" class="btn btn-info">Logout</a>
        </div>

        <div class="clearfix"></div>

        <h2 class="greyHeader">Comment Moderation</h2>

        <?php if (count($comments)): ?>
            <h5>Click the image in the approved column to change the moderation status</h5>
            <table class="table formattedTable table-striped" cellpadding="5" cellspacing="0" width="100%">
                <tr valign="middle" class="formattedTableHeader">
                    <th>Category</th>
                    <th>Product Code</th>
                    <th>Name</td>
                    <th>Email</th>
                    <th>Comment</th>
                    <th>Created</th>
                    <th align="center">Approved</th>
                </tr>

            <?php foreach ($comments as $comment): ?>
                <tr>
                    <td><a href="#editComment" class="fancybox" data-comment-id="<?= $comment['comment_id'] ?>"><?= $comment['category_name'] ?></a></td>
                    <td><a href="#editComment" class="fancybox" data-comment-id="<?= $comment['comment_id'] ?>"><?= $comment['product_code'] ?></a></td>
                    <td><a href="#editComment" class="fancybox" data-comment-id="<?= $comment['comment_id'] ?>"><div id="name-<?= $comment['comment_id'] ?>"><?= $comment['name'] ?></div></a></td>
                    <td><a href="#editComment" class="fancybox" data-comment-id="<?= $comment['comment_id'] ?>"><div id="email-<?= $comment['comment_id'] ?>"><?= $comment['email'] ?></div></a></td>
                    <td><a href="#editComment" class="fancybox" data-comment-id="<?= $comment['comment_id'] ?>"><div id="comment-<?= $comment['comment_id'] ?>"><?= $comment['comment_text'] ?></div></a></td>
                    <td><a href="#editComment" class="fancybox" data-comment-id="<?= $comment['comment_id'] ?>"><?= $comment['created'] ?></a></td>
                    <td class="center">
                        <?php if ($comment['approved'] == 1): ?>
                            <a href="/moderate/unapprove/<?= $comment['comment_id'] ?>">
                                <img src="/images/tick_green_20px.png" title="Unapprove" alt="Tick" width="20" height="20" />
                            </a>
                        <?php else: ?>
                            <a href="/moderate/approve/<?= $comment['comment_id'] ?>">
                                <img src="/images/cross_red_20px.png" title="Approve" alt="Cross" width="20" height="20" />
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>

            </table>
        <?php else: ?>
            <h4>No comments to moderate.<h4>
        <?php endif; ?>

        <div id="editComment" style="display:none;">
            <div id="commentid" style="display:none;">0</div>
            <h4>Edit comment</h4>

            <form id="commentForm" action="javascript:void();" method="post">
                <fieldset>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" />
                </fieldset>

                <fieldset>
                    <label for="email">Email Address</label>
                    <input type="text" name="email" id="email" />
                </fieldset>

                <fieldset>
                     <label for="comment">Comment</label>
                     <textarea name="email" id="comment"></textarea>
                </fieldset>

                <div id="buttons">
                     <button type="button" id="saveComment" class="btn btn-success btn-large">Save</button>
                     <button type="button" id="cancelComment" class="btn btn-warning btn-large">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Javascript -->
    <?= HTML::script('js/jquery-2.1.1.min.js') ?>
    <?= HTML::script('js/bootstrap.min.js') ?>
    <?= HTML::style('js/fancybox/source/jquery.fancybox.css') ?>
    <?= HTML::script('js/fancybox/source/jquery.fancybox.js') ?>
    <?= HTML::script('js/moderate.js') ?>
</body>
</html>