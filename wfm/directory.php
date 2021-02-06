<?php
    if (!defined('ACTION') || ACTION != 'files') {
        die('Permission denied');
    }

    include('wfm/header.php');
?>

<?php if (isset($_GET['m']) && !empty($_GET['m'])): ?>
    <div class="dir-alert alert alert-danger"><?= htmlspecialchars($_GET['m']); ?></div>
<?php endif; ?>

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
                echo('</td><td class="td-size">' . $size . '</td><td class="td-date">' . $date . '</td>');

                if (isset($_SESSION['wfm_user']) && $file != '..') {
                    echo('<td class="td-admin">');
                    echo('<a onclick="deleteFile(\'' . $file . '\', \'' . $fileName . '\');" href="#" class="admin-action-delete"><span class="' . getFAClass('delete') . '"></span></a>');
                    echo('<a onclick="alert(\'Comming soon :)\');" href="#" class="admin-action-move" aria-disabled="true"><span class="' . getFAClass('move') . '"></span></a>');
                    echo('</td>');
                }

                echo('</tr>');
            }
        }
    ?>
</table>

<?php if (isset($_SESSION['wfm_user'])): ?>
<form class="admin-action-upload" method="post" action="index.php" enctype="multipart/form-data">
    <input type="hidden" name="admin" value="upload">
    <input type="hidden" name="path" value="<?= PATH; ?>">
    <label>Upload file:</label>
    <input type="file" name="file" required>
    <button type="submit" class="btn btn-success">
        <span class="<?= getFAClass('upload'); ?>"></span>
        Upload
    </button>
    <a onclick="createDir();" href="#" class="btn btn-warning">
        <span class="<?= getFAClass('new'); ?>"></span>
        Create new directory
    </a>
</form>

<script>
    function deleteFile(file, name) {
        if (confirm('Do you really want to delete ' + name + ' file (directory)?')) {
            window.location.href = 'index.php?a=delete&d=<?= PATH; ?>&f=' + file;
        }
    }

    function createDir() {
        var name = prompt('Directory name:', '');
        if (name != null && name != "") {
            window.location.href = 'index.php?a=create&d=<?= PATH; ?>&n=' + name;
        }
    }
</script>
<?php endif; ?>

<?php
    include('wfm/footer.php');
?>