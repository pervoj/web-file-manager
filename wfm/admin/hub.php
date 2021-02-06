<?php
    if (defined('ADMIN_ACTION_GET')) {
        // When you use $_GET['a'], this will switch file, which will process it
        switch (ADMIN_ACTION_GET) {
            case 'logout':
                session_destroy();
                header('Location: index.php?a=login');
                break;
            case 'login':
                define('ADMIN_PAGE', 'login');
                include('wfm/admin/login.php');
                break;
            case 'delete':
                define('ADMIN_PAGE', 'delete');
                include('wfm/admin/delete.php');
                break;
            case 'create':
                define('ADMIN_PAGE', 'create');
                include('wfm/admin/create.php');
                break;
            default:
                header('Location: index.php');
                exit();
                break;
        }
    } else {
        // When you send data from some form, this will switch file, which will process it
        switch (ADMIN_ACTION_POST) {
            case 'login':
                define('ADMIN_PAGE', 'login');
                include('wfm/admin/login.php');
                break;
            case 'upload':
                define('ADMIN_PAGE', 'upload');
                include('wfm/admin/upload.php');
                break;
            default:
                header('Location: index.php');
                exit();
                break;
        }
    }
