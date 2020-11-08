<?php
    if ($_GET['d'] && !empty($_GET['d'])) {
        $d = $_GET['d'];
        $d = trim($d);
        if ($d[0] == '/') {
            $d = substr($d, 1, strlen($d) - 1);
        }
        if ($d[strlen($d) - 1] == '/') {
            $d = substr($d, 0, strlen($d) - 1);
        }
    } else {
        $d = "";
    }

    if (strpos($d, '..') !== false || $d == 'wfm') {
        $d = '';
    }

    $path = '';

    if ($_GET['f'] && !empty($_GET['f'])) {
        $f = $_GET['f'];
        $f = str_replace('/', '', $f);

        if (empty($d)) {
            $path = '';
        } else {
            $path = $d . '/';
        }

        $path .= $f;

        define('PATH', $path);
        include('wfm/file.php');
    } else {
        if (empty($d)) {
            $path = '';
        } else {
            $path = '/' . $d;
        }

        define('PATH', $path);
        include('wfm/directory.php');
    }
