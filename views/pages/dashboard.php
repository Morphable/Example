<?= $this->include('components/header.php') ?>

<?
use \App\Infrastructure\Application as A;
$data = $this->getData();
$posts = $data['posts'];
?>

<section class="section">

    <div class="container">

    <?= $this->include('forms/createPost.php') ?>

    <section class="section">
        <? foreach ($posts as $post) { ?>
            <?= A::getService('view')->serve('components/post.php', $post) ?>
            <br>
        <? } ?>
    </section>


    </div>
</section>

<?= $this->include('components/footer.php') ?>
