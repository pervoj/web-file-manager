<?php
    include('header.php');

    $backA = explode('/', PATH);
    unset($backA[sizeof($backA) - 1]);
    $back = '?d=' . join('/', $backA);
?>

<?php if (file_exists(PATH)): ?>
    <table>
        <tr>
            <td class="td-img">
                <img src="wfm/image/up.png" alt="up">
            </td>
            <td>
                <a href="<?= $back ?>">Back</a>
            </td>
        </tr>
    </table>

    <div class="file">
        <span class="file-name"><?= htmlspecialchars(basename(PATH)); ?></span>

        <div class="file-meta">
            <table>
                <tr>
                    <td>
                        <strong>Path:</strong> <?= htmlspecialchars(PATH); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Size:</strong> <?= htmlspecialchars(getSize(filesize(PATH))); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Date of creation:</strong> <?= htmlspecialchars(date('j.n.Y H:i:s', filemtime(PATH))); ?>
                    </td>
                </tr>
            </table>
        </div>

        <a class="btn btn-success" href="<?= PATH ?>" download><span class="fas fa-download"></span> Download</a>

        <div class="file-preview">
            <?php
                $fileMime = mime_content_type(PATH);
                $fileMimeA = explode('/', $fileMime);
                $fileType = array_shift($fileMimeA);
            ?>

            <?php if ($fileType == 'text'): ?>
                <div class="file-preview-text">
                    <?= htmlspecialchars(file_get_contents(PATH)); ?>
                </div>
            <?php elseif ($fileType == 'image'): ?>
                <div class="container" class="file-preview-image">
                    <img src="<?= PATH ?>">
                </div>
            <?php elseif ($fileType == 'video'): ?>
                <div class="file-preview-video">
                    <video class="container" src="<?= PATH ?>" controls></video>
                </div>
            <?php else: ?>
                <p>No preview available for this file.</p>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <div class="file">This file doesn't exist.</div>
<?php endif; ?>

<?php
    include('footer.php');
?>
