<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = 'My Yii Application';
?>
<div class="site-index">

<?php foreach($articles as $article): ?>
  <div class="container-fluid">
    <div class="container">
      <div class="card">
      <a href="<?= Url::toRoute(['/site/post', 'id' => $article->id]);?>">
        <img src="<?= $article->getImage();?>"
        width="100%" height="auto" class="card-img-top" alt="">
      </a>
        <div class="card-body">
          <p class="card-text text-uppercase text-center">
            <a href="<?= Url::toRoute(['/site/category', 'id'
            => $article->category->id]);?>"><?= $article->category->title;?></a>
          </p>
          <h4><p class="card-text text-uppercase text-center"><?= $article->title;?></p></h4>
          <p class="card-text text-center"><?= $article->description;?></p>
          <div class="row justify-content-center">
            <a href="<?= Url::toRoute(['/site/post', 'id' => $article->id]);?>"
            button type="button" class="btn btn-primary">Читать</a>
          </div>
        </div>
      </div>
    </div>
  </div>
    <br>
<?php endforeach; ?>

</div>
