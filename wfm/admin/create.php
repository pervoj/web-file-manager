<?php
    if (!isset($_SESSION['wfm_user'])) {
        die('Permission denied');
    }

    $path = '.' . $_GET['d'] . '/' . $_GET['n'];
    mkdir($path);

    header('Location: index.php?d=' . $_GET['d']);
    exit();
