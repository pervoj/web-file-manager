<?php
    include('header.php');
?>
    <table>
        <?php
        $fls = sortFiles(glob('.' . PATH . '/*'));
        if (PATH != "") {
            $files[] = "..";
        }
        foreach ($fls as $fl) {
            $files[] = $fl;
        }
        foreach ($files as $file) {
            $fa = explode("/", htmlspecialchars($file));
            $fileName = $fa[sizeof($fa) - 1];
            if ($file != "./wfm" && $file != "./directory.php" && $file != "./LICENSE" && $file != "./README.md") {
                $size = filesize($file) . ' B';
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
                if (filetype($file) == 'dir') {
                    $image = 'dir';
                } else {
                    $types = array(
                        'application',
                        'image',
                        'audio',
                        'video',
                        'text',
                    );
                    $conformity = false;
                    foreach ($types as $type) {
                        $fileType = mime_content_type($file);
                        $fileArray = explode('/', $fileType);
                        $fileShift = array_shift($fileArray);
                        if ($fileShift == $type) {
                            $image = $type;
                            $conformity = true;
                        }
                    }
                    if (!$conformity) {
                        $image = 'file';
                    }
                }
                $date = date('j.n.Y H:i:s', filemtime($file));
                if ($file == '..') {
                    $size = '';
                    $image = 'up';
                    $date = '';
                }
                echo('<tr><td class="td-img"><img src="wfm/image/' . $image . '.png" alt="' . filetype($file) . '"></td><td class="td-name">');
                if ($file == "..") {
                    if (PATH == "") {
                        $newPath = "";
                    } else {
                        $newPathA = explode('/', PATH);
                        unset($newPathA[sizeof($newPathA) - 1]);
                        $newPath = '?d=' . join('/', $newPathA);
                    }
                } elseif (filetype($file) == 'dir') {
                    $newPathA = explode('/', PATH);
                    $newPathA[] = $fileName;
                    $newPath = '?d=' . join('/', $newPathA);
                } else {
                    $newPath = $file;
                }
                echo('<a href="' . $newPath . '">' . $fileName . '</a>');
                echo('</td><td class="td-size">' . $size . '</td><td class="td-date">' . $date . '</td></tr>');
            }
        }
        ?>
    </table>
<?php
    include('footer.php');
?>