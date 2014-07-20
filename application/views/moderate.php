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
                    <td><?= $comment['category_name'] ?></td>
                    <td><?= $comment['product_code'] ?></td>
                    <td><?= $comment['name'] ?></td>
                    <td><?= $comment['email'] ?></td>
                    <td><?= $comment['comment_text'] ?></td>
                    <td><?= $comment['created'] ?></td>
                    <td>
                        <?php if ($comment['approved'] == 1): ?>
                            <a href="/moderate/unapprove/<?= $comment['comment_id'] ?>">
                                <img src="/images/tick_green_20px.png" />
                            </a>
                        <?php else: ?>
                            <a href="/moderate/approve/<?= $comment['comment_id'] ?>">
                                <img src="/images/cross_red_20px.png" />
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>

            </table>
        <?php else: ?>
            <h4>No comments to moderate.<h4>
        <?php endif; ?>

    </div>

    <!-- Javascript -->
    <?= HTML::script('js/jquery-2.1.1.min.js') ?>
    <?= HTML::script('js/bootstrap.min.js') ?>
    <?= HTML::style('js/fancybox/source/jquery.fancybox.css') ?>
    <?= HTML::script('js/fancybox/source/jquery.fancybox.js') ?>
    <?= HTML::script('js/comments.js') ?>
</body>
</html>