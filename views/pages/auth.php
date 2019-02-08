<?= $this->include('components/header.php') ?>

<div class="container section">

    <h1 class="title is-1">Authentication</h1>
    <hr>

    <div class="columns is-multiline">
        <div class="column is-6">
            <h3 class="title is-5">Login</h3>
            <?= $this->include('forms/auth/login.php') ?>
        </div>
        <div class="column is-6 box">
            <h3 class="title is-5">Register</h3>
            <?= $this->include('forms/auth/register.php') ?>
        </div>
        <div class="column is-6 box">
            <h3 class="title is-5">Forgot password</h3>
            <?= $this->include('forms/auth/forgotPassword.php') ?>
        </div>
    </div>
</div>
<?= $this->include('components/footer.php') ?>
