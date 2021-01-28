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

    function getFAClass($type) {
        $faClasses = array(
            'application' => 'fas fa-terminal',
            'application/pdf' => 'far fa-file-pdf',
            'image' => 'far fa-file-image',
            'audio' => 'far fa-file-audio',
            'video' => 'far fa-file-video',
            'text' => 'far fa-file-alt',
            'file' => 'far fa-file',
            'dir' => 'far fa-folder',
            'up' => 'fas fa-level-up-alt',
            'download' => 'fas fa-download',
            'login' => 'fas fa-sign-in-alt',
        );
        return $faClasses[$type];
    }