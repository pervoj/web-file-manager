<?php
    if (!defined('ADMIN_PAGE') || ADMIN_PAGE != 'login') {
        die('Permission denied');
    }

    if (isset($_SESSION['wfm_user'])) {
        header('Location: index.php');
        exit();
    }

    if (isset($_POST['user'])) {
        $userFocus = '';
        $passFocus = 'autofocus';
        $username = htmlspecialchars($_POST['user']);
    } else {
        $userFocus = 'autofocus';
        $passFocus = '';
        $username = '';
    }

    if (isset($_POST['user']) && !empty($_POST['pass']) && isset($_POST['pass']) && !empty($_POST['pass'])) {
        if (contains($_POST['user'], ' ') || contains($_POST['user'], '.') || contains($_POST['user'], '_') || contains($_POST['user'], ',') || contains($_POST['user'], '=') || contains($_POST['user'], '?') || contains($_POST['user'], '%') || contains($_POST['user'], '/') || contains($_POST['user'], '|') || contains($_POST['user'], '\\') || contains($_POST['user'], '*') || contains($_POST['user'], '+') || contains($_POST['user'], '-')) {
            $messageText = 'Remove forbidden characters from username (<code> </code>, <code>.</code>, <code>_</code>, <code>,</code>, <code>=</code>, <code>?</code>, <code>%</code>, <code>/</code>, <code>|</code>, <code>\</code>, <code>*</code>, <code>+</code>, <code>-</code>)';
            $messageType = 'danger';
        } else {
            if (isPassValid($_POST['user'], $_POST['pass'])) {
                $_SESSION['wfm_user'] = htmlspecialchars($_POST['user']);
                header('Location: index.php');
                exit();
            } else {
                $messageText = 'Incorrect username or password';
                $messageType = 'danger';
            }
        }
    }

    include('wfm/header.php');
?>

<form class="form-login" action="index.php" method="post">
    <?php if (isset($messageText) && isset($messageType)): ?>
        <div class="alert alert-<?= $messageType; ?>" role="alert"><?= $messageText; ?></div>
    <?php endif; ?>
    <input type="hidden" name="admin" value="login">
    <div class="form-group">
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><span class="<?= getFAClass('user'); ?>"></span></div>
            </div>
            <input class="form-control" type="text" name="user" placeholder="Username" value="<?= $username; ?>" <?= $userFocus; ?> required>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><span class="<?= getFAClass('pass'); ?>"></span></div>
            </div>
            <input class="form-control" type="password" name="pass" placeholder="Password" <?= $passFocus; ?> required>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">
        <span class="<?= getFAClass('login'); ?>"></span>
        Login
    </button>
</form>

<?php
    include('wfm/footer.php');
?>

