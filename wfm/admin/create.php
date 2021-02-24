<?php
    if (!isset($_SESSION['wfm_user']) || !canUserDo($_SESSION['wfm_user'], 'dirs')) {
        die('Permission denied');
    }

    $path = '.' . $_GET['d'] . '/' . $_GET['n'];
    mkdir($path);

    header('Location: index.php?d=' . $_GET['d']);
    exit();
