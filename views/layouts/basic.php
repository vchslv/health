<?php

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use app\models\User;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Будем здоровы</title>
    <?php $this->head() ?>
</head>

<!-- установка favicon -->
<?php
$this->registerLinkTag([
    'rel' => 'icon',
    'type' => 'image/png',
    'href' => Url::to(['/favicon.png'])
]);
?>

<body>

<?php $this->beginBody() ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/site/index">Будем здоровы</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="/site/index">Статьи<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/site/categories">Категории</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/site/about">О нас</a>
      </li>
    </ul>

    <ul class="nav navbar-nav text-uppercase float-right">
        <?php if(Yii::$app->user->isGuest):?>
            <li><a href="<?= Url::toRoute(['auth/login'])?>">Войти</a></li>
            <li><a href="<?= Url::toRoute(['auth/signup'])?>">Регистрация</a></li>
        <?php else: ?>

            <?php if(Yii::$app->user->identity->name == 'admin'):?>
              <li><a href="<?= Url::toRoute(['/admin'])?>">Админка</a></li>
            <?php endif;?>
            <?= Html::beginForm(['/auth/logout'], 'post')
            . Html::submitButton(
                'Выйти (' . Yii::$app->user->identity->name . ')',
                ['class' => 'btn btn-link logout', 'style'=>"padding-top:14px;"]
            )
            . Html::endForm() ?>
        <?php endif;?>
    </ul>

  </div>
</nav>

  <?= $content ?>

  <br>
  <footer class="footer">
      <div class="container">
          <p class="pull-left">&copy; Моя компания <?= date('Y') ?></p>
      </div>
  </footer>

<?php $this->endBody() ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
<?php $this->endPage() ?>
