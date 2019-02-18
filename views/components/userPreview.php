<?

use \App\Infrastructure\Application as A;

$data = $this->getData();
$user = $data['user'];
?>

<div class="card">
    <div class="media">
        <div class="media-left">
            <figure class="image is-64x64">
                <img src="<?= $user['profilePic'] ?>" alt="<?= $user['username'] ?>">
            </figure>
        </div>
        <div class="media-content">
            <a class="title is-4 is-pulled-left" style="margin-right: 1rem;" href="/profile/<?= $user['slug'] ?>">
                <?= $user['username'] ?>
            </a>
            <?= A::getService('view')->serve('forms/follow.php', [
                'subjectId' => $user['id'],
                'classes' => ['is-pulled-left']
            ]) ?>
        </div>
    </div>
</div>
