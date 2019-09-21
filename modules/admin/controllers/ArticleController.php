<?php
// контроллер ничего не решает, он только передает данные

namespace app\modules\admin\controllers;

use Yii;
use app\models\Article;
use app\models\Category;
use app\models\ImageUpload;
use app\models\ArticleSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();

        if ($model->load(Yii::$app->request->post()) && $model->saveArticle()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->saveArticle()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSetImage($id)
    {
        $model = new ImageUpload;

        if (Yii::$app->request->isPost)
        {
            // извлечение из базы записи статьи
            $article = $this->findModel($id);
            // получение загруженного файла
            $file = UploadedFile::getInstance($model, 'image');
            // если картинка сохранена в БД, то пененаправить пользователя на
            // страницу view
            if($article->saveImage($model->uploadFile($file, $article->image)))
            {
                // перенаправление пользователя на view
                return $this->redirect(['view', 'id'=>$article->id]);
            }
        }
        // вывод пустой формы пользователю
        return $this -> render('image', ['model'=>$model]);
    }

    public function actionSetCategory($id)
    {
        // извлечение статьи из базы
        $article = $this->findModel($id);
        // готовим значение для формы
        $selectedCategory = $article->category->id;
        // загрузка в $categories массива из базы, выбираем текущий id
        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'title');

        // отлавливание значения кнопки из dropdown. Если форма отправлена, в
        // переменную $category передаем значение из инпута 'category'
        if(Yii::$app->request->isPost)
        {
            $category = Yii::$app->request->post('category');
            // вызов метода модели Article для сохранения категории
            // если категория сохранилась (установилось true), то
            if($article->saveCategory($category))
            {
              // отправляем пользователя на страницу view
              return $this->redirect(['view', 'id'=>$article->id]);
            }
        }

        // передача данных в вид category
        return $this->render('category', [
            'article'=>$article,
            'selectedCategory'=>$selectedCategory,
            'categories'=>$categories
          ]);

    }
}
