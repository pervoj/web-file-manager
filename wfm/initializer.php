<?php
    function sortFiles($files = array()) {
        $alphabetically = $files;
        sort($alphabetically);
        $accdir = array();

        foreach ($alphabetically as $file) {
            if (filetype($file) === 'dir') {
                $accdir[] = $file;
            }
        }

        foreach ($alphabetically as $file) {
            if (filetype($file) === 'file') {
                $accdir[] = $file;
            }
        }

        return $accdir;
    }

    function getSize($fsize) {
        $size = $fsize . ' B';
        if ($size > 1000) {
            $size = number_format(substr($size, 0, -2) / 1000, 0, '.', '');
            $size = $size . ' kB';
            if ($size > 1000) {
                $size = number_format(substr($size, 0, -3) / 1000, 0, '.', '');
                $size = $size . ' MB';
                if ($size > 1000) {
                    $size = number_format(substr($size, 0, -3) / 1000, 0, '.', '');
                    $size = $size . ' GB';
                    if ($size > 1000) {
                        $size = number_format(substr($size, 0, -3) / 1000, 0, '.', '');
                        $size = $size . ' TB';
                    }
                }
            }
        }
        return $size;
    }