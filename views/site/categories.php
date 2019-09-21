<?php
use yii\helpers\Url;
?>

<div class="container">
  <h2>Категории, по которым Вы можете найти интересующую Вас информацию.</h2>
  <h4>По мере наполнения сайта информацией их будет становиться больше :)</h4>
  <?php foreach($categories as $category): ?>

    <p class="text-uppercase"><a href="<?= Url::toRoute(['/site/category', 'id' => $category->id]);?>"><?= $category->title ?></a></p>

  <?php endforeach; ?>
</div>
