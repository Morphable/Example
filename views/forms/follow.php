<?
    use \App\Infrastructure\Application as A;

    $data = $this->getData();
    $userId = $data['userId'];
    $subjectId = $data['subjectId'];
    $isFollowing = A::getService('userRepository')->checkUserIsFollowing($userId, $subjectId);
?>

<form action="/user/follow/<?= $subjectId ?>" method="POST">
    <input type="hidden" name="user-id" value="<?= $userId ?>">
    <button>
        <span class="icon is-small">
            <i class="fas fa-user-<?= $isFollowing ? 'minus' : 'plus' ?>"></i>
        </span>
    </button>
</form>
