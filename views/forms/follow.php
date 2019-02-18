<?
    use \App\Infrastructure\Application as A;
    use \App\Domain\Auth\Authorization;

    $data = $this->getData();
    $subjectId = $data['subjectId'];

    if (!\App\Domain\Auth\Authorized::isLoggedIn() || $subjectId == $_SESSION['user']['id']) {
        return;
    }

    $userId = $_SESSION['user']['id'];
    $isFollowing = A::getService('userRepository')->checkUserIsFollowing($userId, $subjectId);

    $classes = '';
    if (isset($data['classes'])) {
        foreach ($data['classes'] as $class) {
            $class .= "$class ";
        }
    }
?>

<form class="<?= trim($classes) ?>" action="/user/follow/<?= $subjectId ?>" method="POST">
    <input type="hidden" name="user-id" value="<?= $userId ?>">
    <button class="button is-primary is-small">
        <span class="icon is-small">
            <i class="fas fa-user-<?= $isFollowing ? 'minus' : 'plus' ?>"></i>
        </span>
    </button>
</form>
