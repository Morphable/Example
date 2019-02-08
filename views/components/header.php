<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= (getenv('APP_NAME') != null ? getenv('APP_NAME') : 'Example') ?> <?= isset($this->getData()['page']) ? ' | ' . ucfirst($this->getData()['page']) : '' ?></title>
    <link rel="stylesheet" href="/resources/css" type="text/css">
</head>
<body class="wrapper">

<nav class="header is-primary navbar has-shadow" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="/"><?= (getenv('APP_NAME') != null ? getenv('APP_NAME') : 'Example') ?></a>

    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start"></div>
    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
            <? if (\App\Domain\Auth\Authorized::isLoggedIn()) { ?>
                <a class="button is-light" href="/auth/logout">Logout</a>
            <? } else { ?>
                <a class="button is-light" href="/login">Log in</a>
            <? } ?>
        </div>
      </div>
    </div>
  </div>
</nav>

<main class="main-content">
