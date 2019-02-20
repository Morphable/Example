<form action="/auth/login" method="POST">

    <div class="field">
        <div class="control">
            <input placeholder="Email" class="input" type="email" name="email" id="login-email">
        </div>
    </div>

    <div class="field">
        <div class="control">
            <input placeholder="Password" class="input" type="password" name="password" id="login-password">
        </div>
    </div>

    <div class="field">
        <label for="login-remember-me">
            <div class="control is-unselectable">
                <input class="checkbox" type="checkbox" name="remember-me" id="login-remember-me">
                Remember me
            </div>
        </label>
    </div>

    <div class="field is-grouped">
        <div class="control">
            <button class="button is-primary">Login</button>
        </div>
        <div class="control">
            <a class="button is-text" href="/auth?type=register">Sign up!</a>
        </div>
        <div class="control">
            <a class="button is-text" href="/auth?type=forgot-password">Forgot password XD</a>
        </div>
    </div>

</form>
