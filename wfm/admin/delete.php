<?php
    if (!isset($_SESSION['wfm_user'])) {
        die('Permission denied');
    }

    function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
                        rrmdir($dir. DIRECTORY_SEPARATOR .$object);
                    else
                        unlink($dir. DIRECTORY_SEPARATOR .$object);
                }
            }
            rmdir($dir);
        }
    }

    if (is_dir($_GET['f'])) {
        rrmdir($_GET['f']);
    } else {
        unlink($_GET['f']);
    }

    header('Location: index.php?d=' . $_GET['d']);
    exit();
