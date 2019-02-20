<?= $this->include('components/header.php') ?>

<div class="container section">

    <? if (!isset($_GET['type']) || $_GET['type'] == null) { ?>
        <h1 class="title is-1">Login</h1>
        <hr>
        <?= $this->include('forms/auth/login.php') ?>
    <? } else { ?>

        <? if ($_GET['type'] == 'forgot-password') { ?>
            <h1 class="title is-1">Forgot password</h1>
            <hr>
            <?= $this->include('forms/auth/forgotPassword.php') ?>
        <? } elseif ($_GET['type'] == 'register') { ?>
            <h1 class="title is-1">Register</h1>
            <hr>
            <?= $this->include('forms/auth/register.php') ?>
        <? } elseif ($_GET['type'] == 'new-password') { ?>
            <? if (!isset($_GET['token'])) { ?>
                <? header('Location: /'); die; ?>
            <? } else { ?>
                <h1 class="title is-1">New password</h1>
                <hr>
                <?= $this->include('forms/auth/newPassword.php') ?>
            <? } ?>
        <? } ?>

    <? } ?>
</div>
<?= $this->include('components/footer.php') ?>
