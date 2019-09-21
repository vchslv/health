<?php
use yii\helpers\Url;
?>

<?php foreach($articles as $article): ?>
<div class="container-fluid">
  <div class="container">
    <div class="card">
    <img src="<?= $article->getImage();?>" width="100%" height="auto" class="card-img-top" alt="">
      <div class="card-body">
        <p class="card-text"><a href="<?= Url::toRoute(['/site/category', 'id' => $article->category->id]);?>"><?= $article->category->title;?></a></p>
        <p class="card-text"><?= $article->title;?></p>
        <p class="card-text"><?= $article->description;?></p>
        <p class="card-text"><?= $article->date;?></p>
        <p class="card-text"><?= $article->viewed;?></p>
      <a href="<?= Url::toRoute(['/site/post', 'id' => $article->id]);?>" button type="button" class="btn btn-primary">Читать</a>
      </div>
    </div>
  </div>
</div>
    <br>

<?php endforeach; ?>
