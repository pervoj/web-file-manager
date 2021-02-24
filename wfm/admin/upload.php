<?php
    if (!isset($_SESSION['wfm_user']) || !canUserDo($_SESSION['wfm_user'], 'upload')) {
        die('Permission denied');
    }

    $target_file = '.' . $_POST['path'] . '/' . basename($_FILES['file']['name']);
    $uploadOk = 1;

    $message = '';

    // Check if file already exists
    if (file_exists($target_file)) {
        $message .= 'File already exists. ';
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $message .= 'Your file was not uploaded. ';
    // if everything is ok, try to upload file
    } else {
        if (!copy($_FILES['file']['tmp_name'], $target_file)) {
            $message .= 'There was an error uploading your file.';
        }
    }

    header('Location: index.php?d=' . $_POST['path'] . '&m=' . trim($message));
    exit();
