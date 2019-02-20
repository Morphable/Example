<form action="/auth/new-password" method="POST">
    <input type="hidden" name="token" value="<?= $_GET['token'] ?>">

    <div class="field">
        <div class="control">
            <input placeholder="Password" class="input" type="password" name="password" value="">
        </div>
    </div>

    <div class="field">
        <div class="control">
            <input placeholder="Repeat password" class="input" type="password" name="repeat-password" value="">
        </div>
    </div>

    <div class="field">
        <div class="control">
            <button class="button is-primary">submit</button>
        </div>
    </div>

</form>
