<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<!-- вывод поста -->
<div class="container-fluid">
  <div class="container">
    <div class="card">
    <img src="<?= $article->getImage();?>" width="100%" height="auto" class="card-img-top" alt="">
      <div class="card-body">
        <p class="card-text text-uppercase text-center">
          <a href="<?= Url::toRoute(['/site/category', 'id' => $article
            ->category->id]);?>"><?= $article->category->title;?></a>
        </p>
        <h4><p class="card-text text-uppercase text-center"><?= $article->title;?></p></h4>
        <p class="card-text text-center"><?= $article->content;?></p>
        <p class="card-text text-right font-italic"><?= $article->formatDate();?></p>
        <p class="card-text text-right">
          <img src="/img/eye.png" width="24" height="24" alt="">
          <?= $article->viewed;?>
        </p>
      </div>
    </div>
  </div>
</div>
<br>

<div class="container">
  <p><h4>Комментарии:</h4></p>

  <!-- вывод комментариев -->
  <?php if(!empty($comments)):?>

      <?php foreach ($comments as $comment):?>
        <div class="card bg-light mb-8" style="max-width: 480px;">
          <div class="row no-gutters">
              <div class="col-md-3">
                <img src="<?= $comment->user->image;?>" class="card-img" alt="">
              </div>
              <div class="col-md-9">
                <div class="card-body">
                  <h5 class="card-title"><?= $comment->user->name;?></h5>
                  <p class="card-text"><?= $comment->text;?></p>
                  <p class="card-text text-right" style="padding-right:14px;">
                    <small class="text-muted font-italic"><?= $comment->date;?></small>
                  </p>
                </div>
              </div>
          </div>
        </div>
        <br>
      <?php endforeach;?>

  <?php else: ?>
    <p><h4>Отсутствуют</h4></p>
  <?php endif;?>

  <!-- комментарии могут писать только авторизованные пользователи -->
  <?php if (!Yii::$app->user->isGuest):?>
    <?php $form = ActiveForm::begin([
              'action'=>['site/comment', 'id'=>$article->id],
              'options'=>['class'=>'form-horizontal contact-form', 'role'=>'form']])?>
          <div class="form-group">
              <div class="col-md-8">
                  <?= $form->field($commentForm, 'comment')
                  ->textarea(['class'=>'form-control','placeholder'
                  =>'Написать комментарий'])->label(false)?>
              </div>
          </div>
          <button type="submit" class="btn btn-primary">Добавить комментарий</button>
    <?php ActiveForm::end();?>

  <?php endif;?>
</div>
