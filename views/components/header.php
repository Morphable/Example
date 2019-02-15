<? use \App\Infrastructure\Application as A; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= (getenv('APP_NAME') != null ? getenv('APP_NAME') : 'Example') ?> <?= isset($this->getData()['page']) ? ' | ' . ucfirst($this->getData()['page']) : '' ?></title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="/resources/css" type="text/css">
</head>
<body class="wrapper">

<nav class="header is-primary navbar has-shadow" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="<?= (\App\Domain\Auth\Authorized::isLoggedIn() ? '/dashboard' : '/') ?>"><?= (getenv('APP_NAME') != null ? getenv('APP_NAME') : 'Example') ?></a>

    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div class="navbar-menu">
    <div class="navbar-start"></div>
    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
            <? if (\App\Domain\Auth\Authorized::isLoggedIn()) { ?>
                <a class="button" href="/profile/me" title="me"><span class="icon is-small"><i class="fas fa-user"></i></span></a>
                <a class="button is-light" href="/auth/logout">Logout</a>
            <? } else { ?>
                <a class="button is-light" href="/auth">Log in</a>
            <? } ?>
        </div>
      </div>
    </div>
  </div>

<? if (isset($_SESSION['message']['form']['general']['msg']) && $_SESSION['message']['form']['general']['msg'] != null) { ?>
<?
    switch ($_SESSION['message']['form']['general']['type']) {
        case 'error':
            $notifType = 'is-danger';
            break;
        case 'success':
            $notifType = 'is-success';
            break;
        case 'info':
            $notifType = 'is-info';
            break;
        case 'warning':
            $notifType = 'warning';
            break;
        default:
            $notifType = '';
            break;
    }
?>
    <div class="main-notification notification <?= $notifType ?>">
        <button class="delete"></button>
        <?= $_SESSION['message']['form']['general']['msg'] ?>
    </div>
<? } ?>

</nav>

<main class="main-content">
