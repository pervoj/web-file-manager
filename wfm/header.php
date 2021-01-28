<?php
    include('wfm/initializer.php');
?>

<!doctype html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="wfm/style.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/js/all.js" integrity="sha512-yo/DGaftoLvI3LRwd6sVDlo4zu1AhQg+ej3UruAEzwWuzmNZglbF3luwTif1l9wvHZmLRp8Wyiv8wloA9JsVyA==" crossorigin="anonymous"></script>
    <title>Web file manager</title>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <span class="navbar-brand mb-0 h1">Web file manager</span>
    <form class="form-inline">
        <button class="btn btn-outline-success" disabled><span class="<?= getFAClass('login'); ?>"></span> Login</button>
    </form>
</nav>
<div class="container">