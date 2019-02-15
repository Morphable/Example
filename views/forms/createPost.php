<? use \App\Infrastructure\Application as A; ?>

<form action="/post/create" method="POST">
    <input type="hidden" name="user-id" value="<?= A::getService('encryption')->encrypt($_SESSION['user']['id']) ?>">
    <div class="field">
        <div class="control">
            <textarea class="textarea" placeholder="What's up?" name="content" cols="30" rows="3"></textarea>
        </div>
    </div>
    <div class="field">
        <div class="control">
            <input type="text" class="input" placeholder="tags, comma seperated" name="tags">
        </div>
    </div>

    <div class="field">
        <div class="control">
            <button class="button is-primary">submit</button>
        </div>
    </div>
</form>
