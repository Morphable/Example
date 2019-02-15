<?= $this->include('components/header.php') ?>

<div class="container section">

    <h1 class="title is-1">Authentication</h1>
    <hr>

    <? if ($_GET['type'] == 'forgot-password') { ?>
        <h3 class="title is-5">Forgot password</h3>
        <?= $this->include('forms/auth/forgotPassword.php') ?>
    <? } elseif ($_GET['type'] == 'register') { ?>
        <h3 class="title is-5">Register</h3>
        <?= $this->include('forms/auth/register.php') ?>
    <? } else { ?>
        <h3 class="title is-5">Login</h3>
        <?= $this->include('forms/auth/login.php') ?>
    <? } ?>
</div>
<?= $this->include('components/footer.php') ?>
