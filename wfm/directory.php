<?php
    include('header.php');
?>

    <table>
        <?php
        $fls = array();
        if (empty(PATH)) {
            $fls = sortFiles(glob('*'));
        } else {
            $fls = sortFiles(glob('.' . PATH . '/*'));
        }
        $files = array();
        if (!empty(PATH)) {
            $files[] = '..';
        }
        foreach ($fls as $fl) {
            $files[] = $fl;
        }
        foreach ($files as $file) {
            $fa = explode("/", htmlspecialchars($file));
            $fileName = $fa[sizeof($fa) - 1];
            if ($file != "wfm" && $file != "index.php" && $file != "LICENSE" && $file != "README.md") {
                $size = getSize(filesize($file));
                $faClass = "";
                if (filetype($file) == 'dir') {
                    $faClass = getFAClass('dir');
                } else {
                    $types = array(
                        'application',
                        'application/pdf',
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
                        if ($fileShift == $type || $fileType == $type) {
                            $faClass = getFAClass($type);
                            $conformity = true;
                        }
                    }
                    if (!$conformity) {
                        $faClass = getFAClass('file');
                    }
                }
                $date = date('j.n.Y H:i:s', filemtime($file));
                if ($file == '..') {
                    $size = '';
                    $faClass = getFAClass('up');
                    $date = '';
                }
                echo('<tr><td class="td-img"><span class="' . $faClass . '"></span></td><td class="td-name">');
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
                    $newPathA = explode('/', PATH);
                    $newPath = '?d=' . join('/', $newPathA) . '&f=' . $fileName;
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