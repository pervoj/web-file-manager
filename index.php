<?php
    if ($_GET['d'] && !empty($_GET['d'])) {
        $d = $_GET['d'];
        $d = trim($d);
        if ($d[0] != "/") {
            $d = "/" . $d;
        }
    } else {
        $d = "";
    }

    if ((strpos($d, "..") !== false) || ($d == "wfm" || $d == "/wfm" || $d == "wfm/" || $d == "/wfm/")) {
        $d = "";
    }

    if ($_GET['f'] && !empty($_GET['f'])) {
        $f = $_GET['f'];
        $f = str_replace('/', '', $f);

        define('PATH', $d . '/' . $f);
        include('wfm/file.php');
    } else {
        define('PATH', $d);
        include('wfm/directory.php');
    }