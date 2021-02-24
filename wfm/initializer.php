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
            'pdf' => 'far fa-file-pdf',
            'image' => 'far fa-file-image',
            'audio' => 'far fa-file-audio',
            'video' => 'far fa-file-video',
            'text' => 'far fa-file-alt',
            'office_text' => 'far fa-file-word',
            'office_presentation' => 'far fa-file-powerpoint',
            'office_spreadsheet' => 'far fa-file-excel',
            'file' => 'far fa-file',
            'dir' => 'far fa-folder',
            'up' => 'fas fa-level-up-alt',
            'download' => 'fas fa-download',
            'upload' => 'fas fa-upload',
            'admin' => 'fas fa-cogs',
            'login' => 'fas fa-sign-in-alt',
            'logout' => 'fas fa-sign-out-alt',
            'user' => 'fas fa-user',
            'pass' => 'fas fa-lock',
            'delete' => 'far fa-trash-alt',
            'move' => 'fas fa-arrows-alt',
            'new' => 'fas fa-plus',
        );
        return $faClasses[$type];
    }

    function contains($text, $part) {
        return (strpos($text, $part) !== false);
    }

    function getExtension($fileName) {
        $fileExtensionA = explode(".", $fileName);
        return $fileExtensionA[sizeof($fileExtensionA) - 1];
    }

    function getFileFAClass($file) {
        $faClass = "";
        if (filetype($file) == 'dir') {
            $faClass = getFAClass('dir');
        } else {
            $extensions = array(
                'pdf',
                'docx',
                'doc',
                'odt',
                'pptx',
                'ppt',
                'odp',
                'xlsx',
                'xls',
                'ods',
            );
            $extensionIcon = array(
                'pdf' => 'pdf',
                'docx' => 'office_text',
                'doc' => 'office_text',
                'odt' => 'office_text',
                'pptx' => 'office_presentation',
                'ppt' => 'office_presentation',
                'odp' => 'office_presentation',
                'xlsx' => 'office_spreadsheet',
                'xls' => 'office_spreadsheet',
                'ods' => 'office_spreadsheet',
            );
            $types = array(
                'application',
                'image',
                'audio',
                'video',
                'text',
            );
            $conformity = false;
            foreach ($extensions as $extension) {
                if (getExtension($file) == $extension) {
                    $faClass = getFAClass($extensionIcon[$extension]);
                    $conformity = true;
                }
            }
            if (!$conformity) {
                foreach ($types as $type) {
                    $fileType = mime_content_type($file);
                    $fileArray = explode('/', $fileType);
                    $fileShift = array_shift($fileArray);
                    if ($fileShift == $type || $fileType == $type) {
                        $faClass = getFAClass($type);
                        $conformity = true;
                    }
                }
            }
            if (!$conformity) {
                $faClass = getFAClass('file');
            }
        }
        return $faClass;
    }