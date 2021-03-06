<?= $this->include('components/header.php') ?>

<?
use \App\Infrastructure\Application as A;
$user = $this->getData()['user'];
$posts = $this->getData()['posts'];
?>
<section class="section container">
    <div class="columns">
        <div class="column is-4">
            <div class="card">
                <div class="card-image">
                    <figure class="image">
                        <img src="<?= $user['profilePic'] ?>" alt="Placeholder image">
                    </figure>
                </div>
                <div class="card-content">
                    <div class="media">
                        <div class="media-content">
                            <p class="title is-4 is-pulled-left" style="margin-right: 1rem;"><?= $user['username'] ?></p>
                            <?= A::getService('view')->serve('forms/follow.php', [
                                'subjectId' => $user['id'],
                                'classes' => ['is-pulled-left']
                            ]) ?>
                        </div>
                    </div>

                    <div class="content">
                        <?= trim($user['bio']) != null ? trim($user['bio']) : '' ?>
                        <hr>
                        <span><b>Member since:</b> <?= date('Y-m-d', strtotime($user['createdAt'])) ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="column is-8">
            <? foreach ($posts as $post) { ?>
                <?= A::getService('view')->serve('components/post.php', $post) ?>
                <hr>
            <? } ?>
        </div>
    </div>

</section>

<?= $this->include('components/footer.php') ?>
