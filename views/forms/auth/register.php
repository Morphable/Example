<form action="/auth/register" method="POST">

    <div class="field">
        <div class="control">
            <input
                placeholder="Email"
                class="input"
                type="text"
                name="email"
                id="register-email"
                value="<?= (isset($_SESSION['post']['email']) ? $_SESSION['post']['email'] : '' ) ?>"
                >
            <? if (isset($_SESSION['message']['form']['email'])) { ?>
                <p class="help is-danger"><?= $_SESSION['message']['form']['email'] ?></p>
            <? } ?>
        </div>
    </div>

    <div class="field">
        <label for="register-password" class="label"></label>
        <div class="control">
            <input
                placeholder="Password"
                class="input"
                type="password"
                name="password"
                id="register-password"
                value="<?= isset($_SESSION['post']['password']) ? $_SESSION['post']['password'] : '' ?>"
                >
            <? if (isset($_SESSION['message']['form']['password'])) { ?>
                <p class="help is-danger"><?= $_SESSION['message']['form']['password'] ?></p>
            <? } ?>
        </div>
    </div>

    <div class="field">
        <div class="control">
            <input
                placeholder="Repeat password"
                class="input"
                type="password"
                name="password-repeat"
                id="register-password-repeat"
                >
            <? if (isset($_SESSION['message']['form']['password-repeat'])) { ?>
                <p class="help is-danger"><?= $_SESSION['message']['form']['password-repeat'] ?></p>
            <? } ?>
        </div>
    </div>

    <div class="field">
        <div class="control">
            <button class="button is-primary">Register</button>
        </div>
    </div>

</form>
