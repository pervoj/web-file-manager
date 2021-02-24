<!doctype html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/js/all.js" integrity="sha512-yo/DGaftoLvI3LRwd6sVDlo4zu1AhQg+ej3UruAEzwWuzmNZglbF3luwTif1l9wvHZmLRp8Wyiv8wloA9JsVyA==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/styles/atom-one-dark-reasonable.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    <link rel="stylesheet" href="wfm/libs/pptxjs/css/pptxjs.css">
    <link rel="stylesheet" href="wfm/libs/pptxjs/css/nv.d3.min.css">
    <script src="wfm/libs/pptxjs/js/jquery-1.11.3.min.js"></script>
    <script src="wfm/libs/pptxjs/js/jszip.min.js"></script>
    <script src="wfm/libs/pptxjs/js/filereader.js"></script>
    <script src="wfm/libs/pptxjs/js/d3.min.js"></script>
    <script src="wfm/libs/pptxjs/js/nv.d3.min.js"></script>
    <script src="wfm/libs/pptxjs/js/pptxjs.js"></script>
    <script src="wfm/libs/pptxjs/js/divs2slides.js"></script>
    <link rel="stylesheet" href="wfm/style.css">
    <title>Web file manager</title>
</head>
<body>
<?php if (isset($_SESSION['wfm_user'])): ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <span class="navbar-brand">Web file manager</span>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php if (defined('ACTION') && ACTION == 'files') {echo('active');} ?>">
                    <a class="nav-link" href="index.php">
                        <span class="<?= getFAClass('file'); ?>"></span>
                        Files
                    </a>
                </li>
            </ul>

            <form class="form-inline my-2 my-lg-0">
                <a href="index.php?a=logout" class="btn btn-outline-danger"><span class="<?= getFAClass('logout'); ?>"></span> Logout</a>
                <span class="admin-user-name"><a href="index.php?a=profile"><?= $_SESSION['wfm_user']; ?></a></span>
            </form>
    </nav>
<?php else: ?>
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">Web file manager</span>

        <form class="form-inline">
            <?php if (defined('ADMIN_PAGE') && ADMIN_PAGE == 'login'): ?>
                <a href="index.php" class="btn btn-outline-success"><span class="<?= getFAClass('up'); ?>"></span> Back</a>
            <?php else: ?>
                <a href="index.php?a=login" class="btn btn-outline-success"><span class="<?= getFAClass('admin'); ?>"></span> Administration</a>
            <?php endif; ?>
        </form>
    </nav>
<?php endif; ?>

<div class="container">