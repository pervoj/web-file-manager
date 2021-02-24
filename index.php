<?php
    session_start();
    include('wfm/initializer.php');
    include('wfm/admin/users/manager.php');

    if ((isset($_GET['a']) && !empty($_GET['a']) && !isset($adminUnknownAction)) || isset($_POST['admin'])) {
        if (isset($_GET['a'])) {
            define('ADMIN_ACTION_GET', $_GET['a']);
        } else {
            define('ADMIN_ACTION_POST', $_POST['admin']);
        }
        include('wfm/admin/hub.php');
    } else {
        define('ACTION', 'files');
        if (isset($_GET['d']) && !empty($_GET['d'])) {
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

        if (isset($_GET['f']) && !empty($_GET['f'])) {
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
    }