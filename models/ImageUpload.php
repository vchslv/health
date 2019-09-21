<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model{

  public $image;

  // валидация на тип загружаемого файла, только jpg или png, и обязателен к заполнению
  public function rules()
  {
      return [
        [['image'], 'required'],
        [['image'], 'file', 'extensions' => 'jpg,png']
      ];
  }

  public function uploadFile(UploadedFile $file, $currentImage)
  {
      $this->image = $file;

      // если валидация успешно пройдена
      if($this->validate())
      {
          // если файл существует в web/uploads, то заменить его
          $this->deleteCurrentImage($currentImage);

          // загрузка картинки с уникальным именем
          return $this->saveImage();
      }
  }

  // возвращает путь к паке uploads
  public function getFolder()
  {
      return Yii::getAlias('@web') . 'uploads/';
  }

  // возвращает уникальное имя файла в нижнем регистре
  public function generateFilename()
  {
      return strtolower(md5(uniqid($this->image->baseName)) . '.' . $this->image->extension);
  }

  // если картинка существует в web/uploads, то заменить его
  public function deleteCurrentImage($currentImage)
  {
    if($this->fileExists($currentImage))
    {
        unlink($this->getFolder() . $currentImage);
    }
  }

  // метод проверки существования картинки
  public function fileExists($currentImage)
    {
        // проверка на нуль и пустое значение передаваемой картинки
        if(!empty($currentImage) && $currentImage != null)
        {
            return file_exists($this->getFolder() . $currentImage);
        }
    }

  // метод для загрузки картинки с уникальным именем
  public function saveImage()
  {
    // уникальное имя файла в нижнем регистре
    $filename = $this->generateFilename();

    // загрузка картинки
    $this->image->saveAs($this->getFolder() . $filename);

    return $filename;
  }

}
