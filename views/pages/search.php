<?= $this->include('components/header.php') ?>

<?
    use \App\Infrastructure\Application as A;
    $data = $this->getData();
    $users = $data['users'];
?>
<div class="container">


<? foreach ($users as $user) { ?>
    <?= A::getService('view')->serve('components/userPreview.php', [
        'user' => $user
    ]) ?>
    <br>
<? } ?>

</div>

<?= $this->include('components/footer.php') ?>
