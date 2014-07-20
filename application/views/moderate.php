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
            <?php foreach ($comments as $comment): ?>
            <?php endforeach; ?>
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