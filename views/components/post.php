
<?
use \App\Infrastructure\Application as A;
$post = $this->getData();
?>

<div class="card">
    <div class="card-content">
        <div class="media">
            <div class="media-left">
                <figure class="image is-64x64">
                    <img src="<?= $post['profilePic'] ?>" alt="<?= $post['username'] ?>">
                </figure>
            </div>
            <div class="media-content">
                <a class="title is-4 is-pulled-left" style="margin-right: 1rem;" href="/profile/<?= $post['slug'] ?>">
                    <?= $post['username'] ?>
                </a>
                <?= A::getService('view')->serve('forms/follow.php', [
                    'subjectId' => $post['userId'],
                    'classes' => ['is-pulled-left']
                ]) ?>
            </div>
        </div>

        <div class="content is-medium"><?= $post['content'] ?></div>
        <div class="meta content">
            <? if (!empty($post['tags'])) { ?>
                <br>
                <? foreach($post['tags'] as $tag) { ?>
                    <i>#<?= $tag ?> </i>
                <? } ?>
            <? } ?>
            <br>
            <time datetime="<?= date('Y-m-d', strtotime($post['createdAt'])) ?>"><?= date('Y-m-d', strtotime($post['createdAt'])) ?></time>
        </div>
    </div>
</div>
