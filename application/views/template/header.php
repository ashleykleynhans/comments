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
        <div class="container-fluid">
            <div class="header">
                <a href="/"><img src="<?= URL::base(true) ?>images/testFrontEnd_03.jpg" /></a>
            </div>

            <div class="search">
                <img src="<?= URL::base(true) ?>images/testFrontEnd_05.jpg" />
            </div>

            <div class="sectionDivider"></div>
