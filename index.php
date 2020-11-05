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

    define('DIR', $d);

    include('wfm/index.php');